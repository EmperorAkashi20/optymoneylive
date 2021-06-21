<script>var QUERY_STRING = '<?php echo $_SERVER['QUERY_STRING']; ?>';</script>
<!-- basic scripts -->
		<!--[if !IE]> -->
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/jquery/dist/jquery.min.js"></script>
		<!-- <![endif]-->
		<!--[if IE]>
<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/jquery.1x/dist/jquery.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/_mod/jquery.mobile.custom/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!--[if lte IE 8]>
		  <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/ExplorerCanvas/excanvas.min.js"></script>
		<![endif]-->
        <?php //if($CONFIG->pageName != "itr_forms") {?>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/_mod/jquery-ui.custom/jquery-ui.custom.min.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js"></script>
         <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/jquery-ui.js"></script>
         <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/jquery-ui.custom.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/jquery.ui.touch-punch.js"></script>
        <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/bootbox.js/bootbox.min.js"></script>
        
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/Flot/jquery.flot.min.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/Flot/jquery.flot.pie.min.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/Flot/jquery.flot.resize.min.js"></script>		
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/elements.scroller.js"></script>	
        <?php //}?>	
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.js"></script>
        <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/elements.fileinput.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.basics.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.scrolltop.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.ajax-content.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.sidebar.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.widget-box.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.settings.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/js/src/ace.settings-skin.js"></script>
       	<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/jquery-validation/dist/jquery.validate.min.js"></script>
        <?php if ($CONFIG->pageName == 'profile' || $CONFIG->pageName == 'search') {
    ?>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/select2/dist/js/select2.min.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/_mod/x-editable/bootstrap-editable.min.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/_mod/x-editable/ace-editable.min.js"></script>
		<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/components/jquery.gritter/js/jquery.gritter.min.js"></script>                        
		<?php
} ?>
		<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'itr_forms') {
        ?>
        <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/plupload/js/plupload.full.js"></script>
        <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/js/itr_functions.js"></script>			
		 <?php
    } ?>       
        <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/js/js_function.php"></script>		
		<script type="text/javascript"> ace.vars['base'] = '.'; </script>		

<!--new template footer files -->
	
<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/vendors/js/vendor.bundle.addons.js"></script>
    
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/off-canvas.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/hoverable-collapse.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/misc.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/settings.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/todolist.js"></script>
    
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/demo_7/dashboard.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/formpickers.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/form-addons.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/x-editable.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/dropify.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/dropzone.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/jquery-file-upload.js"></script>
    <script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/form-repeater.js"></script>
	<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/modal-demo.js"></script>
	<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/iCheck.js"></script>
	<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/data-table.js"></script>
	<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/wizard.js"></script>
	<script src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/js/shared/tabs.js"></script>
	<script type="text/javascript">
		/*-----------------------------------*/
	//$("#pancheck").focusout(function(){

	$("#pancheck").focusout(function(){
				
		var regExp = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/; 
		var txtpan = $(this).val().trim(); 
		if (txtpan != "") 
		{
			if(txtpan.length == 10 ) 
			{ 
			  if( txtpan.match(regExp) )
			  { 
			     $("#loading-btn").attr("disabled", false);
			  }
			  else 
			  {
				alert("Not a valid PAN number");
				$('#loading-btn').prop("disabled", true);
				event.preventDefault(); 
			  }  
			} 
			else 
			{ 
			    alert('Please enter 10 digits for a valid PAN number');
			    $('#loading-btn').prop("disabled", true);
			    event.preventDefault(); 
			}
		}
		else
		{
			$('#loading-btn').prop("disabled", true);
			event.preventDefault();
		}
	});

	/*---------------------------------*/

	</script>
	<script type="text/javascript">
		//$("#last_check").checkde
		/*$('#last_check'). click(function(){
if($(this). prop("checked") == true){
alert("Checkbox is checked." );
}
else if($(this). prop("checked") == false){
alert("Checkbox is unchecked." );

*/
	/*if(!$("#last_check").is(":checked"))*/
	$("#last_check").change(function(){
		
		if($(this).prop("checked") == true && $("#tax_re_place").val() != "")
		{
			//alert("HI");
			$("#submit-itr").prop("disabled", false);
		}
		else
		{
			//alert("Bye");
			$("#submit-itr").prop("disabled", true);
		}
	});
	/*{
    //do something
    alert("Checkbox is checked." );
	}
	else
	{
		alert("Checkbox is unchecked." );
	}*/
	</script>
