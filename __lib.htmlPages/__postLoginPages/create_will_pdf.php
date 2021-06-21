<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$json = file_get_contents('php://input');
$data1 = json_decode($json);

require('fpdf/fpdf.php');
include_once("../../__lib.includes/config.inc.php");
//encryption functions
if(function_exists('openssl_encrypt')) {
    function RC4($key, $data) {
        return openssl_encrypt($data, 'RC4-40', $key, OPENSSL_RAW_DATA);
    }
} elseif(function_exists('mcrypt_encrypt')) {
    function RC4($key, $data) {
        return @mcrypt_encrypt(MCRYPT_ARCFOUR, $key, $data, MCRYPT_MODE_STREAM, '');
    }
}
else {
    function RC4($key, $data) {
        static $last_key, $last_state;
        if($key != $last_key) {
            $k = str_repeat($key, 256/strlen($key)+1);
            $state = range(0, 255);
            $j = 0;
            for ($i=0; $i<256; $i++){
                $t = $state[$i];
                $j = ($j + $t + ord($k[$i])) % 256;
                $state[$i] = $state[$j];
                $state[$j] = $t;
            }
            $last_key = $key;
            $last_state = $state;
        }
        else
            $state = $last_state;

        $len = strlen($data);
        $a = 0;
        $b = 0;
        $out = '';
        for ($i=0; $i<$len; $i++){
            $a = ($a+1) % 256;
            $t = $state[$a];
            $b = ($b+$t) % 256;
            $state[$a] = $state[$b];
            $state[$b] = $t;
            $k = $state[($state[$a]+$state[$b]) % 256];
            $out .= chr(ord($data[$i]) ^ $k);
        }
        return $out;
    }
}

function hex2dec($couleur = "#000000"){
    $R = substr($couleur, 1, 2);
    $rouge = hexdec($R);
    $V = substr($couleur, 3, 2);
    $vert = hexdec($V);
    $B = substr($couleur, 5, 2);
    $bleu = hexdec($B);
    $tbl_couleur = array();
    $tbl_couleur['R']=$rouge;
    $tbl_couleur['V']=$vert;
    $tbl_couleur['B']=$bleu;
    return $tbl_couleur;
}

//conversion pixel -> millimeter at 72 dpi
function px2mm($px){
    return $px*25.4/72;
}

function txtentities($html){
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    return strtr($html, $trans);
}

class PDF_HTML extends FPDF {
    protected $encrypted = false;  //whether document is protected
    protected $Uvalue;             //U entry in pdf document
    protected $Ovalue;             //O entry in pdf document
    protected $Pvalue;             //P entry in pdf document
    protected $enc_obj_id;         //encryption object id
    private $name;
    private $place;
    private $date;
    //variables of html parser
    protected $B;
    protected $I;
    protected $U;
    protected $HREF;
    protected $fontList;
    protected $issetfont;
    protected $issetcolor;

    function __construct($orientation='P', $unit='mm', $format='A4') {
        //Call parent constructor
        parent::__construct($orientation,$unit,$format);

        //Initialization
        $this->B=0;
        $this->I=0;
        $this->U=0;
        $this->HREF='';

        $this->tableborder=0;
        $this->tdbegin=false;
        $this->tdwidth=0;
        $this->tdheight=0;
        $this->tdalign="L";
        $this->tdbgcolor=false;

        $this->oldx=0;
        $this->oldy=0;

        $this->fontlist=array("arial","times","courier","helvetica","symbol");
        $this->issetfont=false;
        $this->issetcolor=false;
    }

    
    function SetProtection($permissions=array(), $user_pass='', $owner_pass=null) {
        $options = array('print' => 4, 'modify' => 8, 'copy' => 16, 'annot-forms' => 32 );
        $protection = 192;
        foreach($permissions as $permission) {
            if (!isset($options[$permission]))
                $this->Error('Incorrect permission: '.$permission);
            $protection += $options[$permission];
        }
        if ($owner_pass === null)
            $owner_pass = uniqid(rand());
        $this->encrypted = true;
        $this->padding = "\x28\xBF\x4E\x5E\x4E\x75\x8A\x41\x64\x00\x4E\x56\xFF\xFA\x01\x08".
                        "\x2E\x2E\x00\xB6\xD0\x68\x3E\x80\x2F\x0C\xA9\xFE\x64\x53\x69\x7A";
        $this->_generateencryptionkey($user_pass, $owner_pass, $protection);
    }
    
    function _putstream($s) {
        if ($this->encrypted)
            $s = RC4($this->_objectkey($this->n), $s);
        parent::_putstream($s);
    }

    function _textstring($s) {
        if (!$this->_isascii($s))
            $s = $this->_UTF8toUTF16($s);
        if ($this->encrypted)
            $s = RC4($this->_objectkey($this->n), $s);
        return '('.$this->_escape($s).')';
    }
    /**
    * Compute key depending on object number where the encrypted data is stored
    */
    function _objectkey($n) {
        return substr($this->_md5_16($this->encryption_key.pack('VXxx',$n)),0,10);
    }

    function _putresources() {
        parent::_putresources();
        if ($this->encrypted) {
            $this->_newobj();
            $this->enc_obj_id = $this->n;
            $this->_put('<<');
            $this->_putencryption();
            $this->_put('>>');
            $this->_put('endobj');
        }
    }

    function _putencryption() {
        $this->_put('/Filter /Standard');
        $this->_put('/V 1');
        $this->_put('/R 2');
        $this->_put('/O ('.$this->_escape($this->Ovalue).')');
        $this->_put('/U ('.$this->_escape($this->Uvalue).')');
        $this->_put('/P '.$this->Pvalue);
    }

    function _puttrailer() {
        parent::_puttrailer();
        if ($this->encrypted) {
            $this->_put('/Encrypt '.$this->enc_obj_id.' 0 R');
            $this->_put('/ID [()()]');
        }
    }
    /** * Get MD5 as binary string */
    function _md5_16($string) {
        return md5($string, true);
    }
    /** * Compute O value */
    function _Ovalue($user_pass, $owner_pass) {
        $tmp = $this->_md5_16($owner_pass);
        $owner_RC4_key = substr($tmp,0,5);
        return RC4($owner_RC4_key, $user_pass);
    }
    /** * Compute U value */
    function _Uvalue() {
        return RC4($this->encryption_key, $this->padding);
    }
    /** * Compute encryption key */
    function _generateencryptionkey($user_pass, $owner_pass, $protection) {
        // Pad passwords
        $user_pass = substr($user_pass.$this->padding,0,32);
        $owner_pass = substr($owner_pass.$this->padding,0,32);
        // Compute O value
        $this->Ovalue = $this->_Ovalue($user_pass,$owner_pass);
        // Compute encyption key
        $tmp = $this->_md5_16($user_pass.$this->Ovalue.chr($protection)."\xFF\xFF\xFF");
        $this->encryption_key = substr($tmp,0,5);
        // Compute U value
        $this->Uvalue = $this->_Uvalue();
        // Compute P value
        $this->Pvalue = -(($protection^255)+1);
    }
    // Page header
    function Header() {
        global $data1;
        
        $name = $data1->name;
        $place = $data1->place;
        $date = $data1->date;

        // $name = $GLOBALS['name'];
        // $place = $GLOBALS['place'];
        // $date = $GLOBALS['date'];

        $this->SetFont('courier','B',10);
        // $this->SetFont('Arial','B',8);
        // Move to the right
        $this->Cell(80);
        $headertext = "This last will of ".$name." executed at ".$place." on ".$date;
        $this->Cell(30,10,$headertext,0,0,'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial','B',8);

        $footertext = "[Full sign of Testator]                              [Full sign of Witness]                                    [Full sign of Witness]                 Page ".$this->PageNo()."/{nb}";

        $this->SetY(-10);
        $this->Cell(0,10,$footertext,0,0,'C');
    }

    
    //////////////////////////////////////
    //html parser

    function WriteHTML($html) {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $html=str_replace("\t",'',$html); //replace carriage returns with spaces
        $html=str_replace("&nbsp;",' ',$html); //replace &nbsp; with spaces
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e) {
            if($i%2==0) {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            } else {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $attr=array();
                    foreach($a2 as $v) {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag,$attr) {
        switch($tag){
            case 'SUP':
                if( !empty($attr['SUP']) ) {    
                    //Set current font to 6pt     
                    $this->SetFont('','',6);
                    //Start 125cm plus width of cell to the right of left margin         
                    //Superscript "1" 
                    $this->Cell(2,2,$attr['SUP'],0,0,'L');
                }
                break;
            case 'TABLE': // TABLE-BEGIN
                if( !empty($attr['BORDER']) ) $this->tableborder=$attr['BORDER'];
                else $this->tableborder=0;
                break;
            case 'TR': //TR-BEGIN
                break;
            case 'TD': // TD-BEGIN
                if( !empty($attr['WIDTH']) ) $this->tdwidth=($attr['WIDTH']/4);
                else $this->tdwidth=40; // Set to your own width if you need bigger fixed cells
                if( !empty($attr['HEIGHT']) ) $this->tdheight=($attr['HEIGHT']/6);
                else $this->tdheight=6; // Set to your own height if you need bigger fixed cells
                if( !empty($attr['ALIGN']) ) {
                    $align=$attr['ALIGN'];        
                    if($align=='LEFT') $this->tdalign='L';
                    if($align=='CENTER') $this->tdalign='C';
                    if($align=='RIGHT') $this->tdalign='R';
                }
                else $this->tdalign='L'; // Set to your own
                if( !empty($attr['BGCOLOR']) ) {
                    $coul=hex2dec($attr['BGCOLOR']);
                        $this->SetFillColor($coul['R'],$coul['G'],$coul['B']);
                        $this->tdbgcolor=true;
                    }
                $this->tdbegin=true;
                break;

            case 'HR':
                if( !empty($attr['WIDTH']) )
                    $Width = $attr['WIDTH'];
                else
                    $Width = $this->w - $this->lMargin-$this->rMargin;
                $x = $this->GetX();
                $y = $this->GetY();
                $this->SetLineWidth(0.2);
                $this->Line($x,$y,$x+$Width,$y);
                $this->SetLineWidth(0.2);
                $this->Ln(2);
                break;
            case 'STRONG':
                $this->SetStyle('B',true);
                break;
            case 'EM':
                $this->SetStyle('I',true);
                break;
            case 'B':
            case 'I':
            case 'U':
                $this->SetStyle($tag,true);
                break;
            case 'A':
                $this->HREF=$attr['HREF'];
                break;
            case 'IMG':
                if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
                    if(!isset($attr['WIDTH']))
                        $attr['WIDTH'] = 0;
                    if(!isset($attr['HEIGHT']))
                        $attr['HEIGHT'] = 0;
                    $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
                }
                break;
            case 'BLOCKQUOTE':
            case 'BR':
                $this->Ln(5);
                break;
            case 'P':
                $this->Ln(5);
                $this->ALIGN=$attr['ALIGN'];
                break;
            case 'FONT':
                if (isset($attr['COLOR']) && $attr['COLOR']!='') {
                    $coul=hex2dec($attr['COLOR']);
                    $this->SetTextColor($coul['R'],$coul['G'],$coul['B']);
                    $this->issetcolor=true;
                }
                if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
                    $this->SetFont(strtolower($attr['FACE']));
                    $this->issetfont=true;
                }
                if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist) && isset($attr['SIZE']) && $attr['SIZE']!='') {
                    $this->SetFont(strtolower($attr['FACE']),'',$attr['SIZE']);
                    $this->issetfont=true;
                }
                break;

        }
    }

    function CloseTag($tag) {
        //Closing tag
        if($tag=='SUP') {
        }
        if($tag=='TD') { // TD-END
            $this->tdbegin=false;
            $this->tdwidth=0;
            $this->tdheight=0;
            $this->tdalign="L";
            $this->tdbgcolor=false;
        }
        if($tag=='TR') { // TR-END
            $this->Ln();
        }
        if($tag=='TABLE') { // TABLE-END
            $this->tableborder=0;
        }
        if($tag=='STRONG')
            $tag='B';
        if($tag=='EM')
            $tag='I';
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='FONT'){
            if ($this->issetcolor==true) {
                $this->SetTextColor(0);
            }
            if ($this->issetfont) {
                $this->SetFont('arial');
                $this->issetfont=false;
            }
        }
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag, $enable) {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s) {
            if($this->$s>0)
                $style.=$s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt) {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

}
// Instanciation of inherited class
$pdf = new PDF_HTML();
// $pdf->SetProtection(array('print'));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('courier','',10);
$pdf->SetAutoPageBreak(true, 40);
// echo $data1->htmlcode;
$url_link = $CONFIG->siteurl.$CONFIG->userFilesURL.$CONFIG->willpath.$data1->uid.'-WillPDF.pdf';
echo $CONFIG->siteurl.$CONFIG->userFilesURL.$CONFIG->willpath.$data1->uid.'-WillPDF.pdf';
// $pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');
$pdf->writeHTML($data1->htmlcode);
//print_contents($pdf);
$pdf->Output($CONFIG->wwwroot.$CONFIG->userFilesURL.$CONFIG->willpath.$data1->uid.'-WillPDF.pdf','F');
$sql_query = "UPDATE bfsi_users_settings set url_link='".$url_link."' where pk_user_settings_id='".$data1->willid."' and fr_user_id = '".$CONFIG->loggedUserId."'";
// echo $sql_query;
$db->db_run_query($sql_query);
?>