<?php
include("../../__lib.includes/config.inc.php");

Header("content-type: application/x-javascript");
?>

var http_server_base = '<?php echo $CONFIG->siteurl; ?>';

jQuery(function($) {

$('#link_name').change(function() {
  var txtAmtval = $('#link_name').val();
  $('#link_url').val(txtAmtval+".html");
});

$('.show-details-btn').on('click', function(e) {
    e.preventDefault();
    $(this).closest('tr').next().toggleClass('open');
    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
});
 $(".trClick").click(function() {
        window.location = $(this).data("href");
    });
<?php if($_SESSION[$CONFIG->sessionPrefix.'page_name'] == "nav_ae_offer") { ?> 
var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>'});
				var container1 = demo1.bootstrapDualListbox('getContainer');
				container1.find('.btn').addClass('btn-white btn-info btn-bold');
<?php } ?>                
<?php if($_SESSION[$CONFIG->sessionPrefix.'page_name'] == "nav_master") { ?>
    var active_class = 'active';
    $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
        var th_checked = this.checked;//checkbox inside "TH" table header
        
        $(this).closest('table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
            else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
        });
    });
<?php } ?>				

<?php if($_SESSION[$CONFIG->sessionPrefix.'page_name'] == "import_data") {  $timestamp = time(); ?> 
    multiUpload('cam');
    multiUpload('franklin');
    multiUpload('karvy');
    multiUpload('sundram');
<?php } ?>   
<?php if($_SESSION[$CONFIG->sessionPrefix.'page_name'] == "mf_list_data" || $_SESSION[$CONFIG->sessionPrefix.'page_name'] == "mf_search_data") { ?> 

 $('.input-daterange').datepicker({autoclose:true});
 selectAutocomplete('scheme');    
 selectAutocomplete('inv_name');
 selectAutocomplete('brok_code');
 
<?php } ?>   
<?php if($_SESSION[$CONFIG->sessionPrefix.'page_name'] == "home") {?>
		
       
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "2012-2013",  data: 38.7, color: "#68BC31"},
				{ label: "2013-2014",  data: 24.5, color: "#2091CF"},
				{ label: "2014-2015",  data: 8.2, color: "#AF4E96"},
				{ label: "2015-2016",  data: 18.6, color: "#DA5430"},
				{ label: "2016-2017",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent'].toFixed()+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			 $('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
            var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}    
			var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
			$.plot("#sales-charts", [
					{ label: "New User", data: d1 },
					{ label: "ITR Filling", data: d2 },
					{ label: "MFs", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
		  });			
<?php }?> 
    //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
    //so disable dragging when clicking on label
    var agent = navigator.userAgent.toLowerCase();
    if(ace.vars['touch'] && ace.vars['android']) {
      $('#tasks').on('touchstart', function(e){
        var li = $(e.target).closest('#tasks li');
        if(li.length == 0)return;
        var label = li.find('label.inline').get(0);
        if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
      });
    }
});

function deleteFnf(getFileID,getTargetURL,getDeleteName='',getTableName='')
{
    bootbox.confirm("Do You want to delete "+getDeleteName+"?", function(result) {
        if (result === null) {
            
        } else {
            if(result) 
            {
            	$.ajax( {
                  type: "POST",
                  url: "../ajax-request/admin_response.php",
                  data: {"tableName":getTableName,"value":getFileID},
                  success: function( response ) {
                    //location.href='<?php echo $CONFIG->siteurl;?>secureAdmin/?'+getTargetURL;
                  }
            	});
            }
        }
    });
}

function recomendNAV(form)
{
	var atLeastOneIsChecked = $('input[name="recomend[]"]:checked').length > 0;
	if(atLeastOneIsChecked)
    {    	
    	var resNAV = ajaxFormSubmit(form,"recomend_status");       
    }
}
<!-- function updateRec(form)
{

    	var resNAV = ajaxFormSubmit(form,"recomend_update");       
}
 -->
function ajaxFormSubmit(form,loder='')
{
	<!-- $('#'+loder).html('<img src="<?php //echo $CONFIG->staticURL;?>th_4/img/preloader.gif">'); -->
	$.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {   
        	console.log(response);     	
            $('#'+loder).html(response);
        }            
    });
}
function selectAutocomplete(getEleName)
{
	$( "#"+getEleName ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "../ajax-request/suggesstion.php",
          dataType: "jsonp",
          data: {
            term: request.term,
            field: getEleName
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 3,
      select: function( event, ui ) {
        //scheme( "Selected: " + ui.item.value + " aka " + ui.item.id );
        $( "#"+getEleName ).val(ui.item.value);
      }
    } );
}
function multiUpload(getElementName)
{
	<?php $timestamp = time(); ?>
	$('#file_upload_'+getElementName).uploadify({
        'formData'     : {
        	'fileSizeLimit' : '100MB',
        	'queueID'  : 'queue_'+getElementName,
            'timestamp' : '<?php echo $timestamp;?>',
            'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
        },
        'onUploadSuccess' : function(file, data, response) {
        	if(data != 2)
            {
            	$('#fetchProgressbar_'+getElementName).html('<div id=\"fetchProgressbarInner_'+getElementName+'\" class=\"ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success\" style=\"width: 77%;\"><strong>Fetching all the data from uploaded files.....</strong></div>');
            	$('#after_upload_'+getElementName).addClass('show');
            	$('#fetchProgressbarInner_'+getElementName).css('width',"78%");   
               
                $.ajax( {
                  type: "GET",
                  url: "../ajax-request/post_login_response.php",
                  data: {"name":'MF_IMPORT',"value":getElementName+'_@_'+data},
                  success: function( response ) {
                  	//console.log(response);alert(response);
                  	$('#fetchProgressbarInner_'+getElementName).css('width',"100%"); 
                    $('#fetchProgressbarInner_'+getElementName).html('<strong><span class="red">'+response+'</span> row(s) has been imported successfully.</strong>');
                  }
                });
            }
            else
            {
            	$('#after_upload_'+getElementName).addClass('show red bigger-150');
        		$('#after_upload_'+getElementName).html('Invalid File Type....');
            }
    	},
        'buttonImage' : '<?php echo $CONFIG->siteurl;?>__UI.assets/postloginAssets/uploadify/browse-btn.png',
        'swf'      : '<?php echo $CONFIG->siteurl;?>__UI.assets/postloginAssets/uploadify/uploadify.swf',
        'uploader' : '../ajax-request/uploadify.php'
    });
}