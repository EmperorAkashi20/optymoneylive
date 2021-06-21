<?php
echo "string";
echo exec('java test');

$temp = new Java('java.sql.Timestamp');
$javaObject = $temp->valueOf('2007-12-31 0:0:0');


$params = new Java("java.util.HashMap");
$params->put("text", "This is a test string");
$params->put("date",$javaObject);


/*------------------------------------------------------*/

// Show The Java Version Before Setting Environmental Variable
        $output = shell_exec("java -version 2>&1");
        echo "<strong>Java Version Before Setting Environmental Variable</strong>";
        echo "<hr/>";
        echo "$output<br/><br/><br/><br/>";

?>