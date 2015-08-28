<?php
/*------------------------------------------------------------------------
# mod_onpageload_popup - Auto onPageLoad Popup
# ------------------------------------------------------------------------
# author    Infyways Solutions
# copyright Copyright (C) 2012 Infyways Solutions. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.infyways.com
# Technical Support:  Forum - http://support.infyways/com
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');
JPluginHelper::importPlugin('content');
$document = JFactory::getDocument();
/*Search for jQuery files in the header*/
$header = $document->getHeadData(); 
$jqmatch[]='jquery';
$jqmatch[]='jqeasy';
$jqPresent=false;
foreach($header['scripts'] as $scriptName => $scriptData){
        foreach($jqmatch as $pat) if(preg_match('/'.$pat.'/i',$scriptName)){ $jqPresent=true; break; }
        if($jqPresent==true) break;
}



$base_url=JURI::root();
$document->addStyleSheet(JURI::root().'modules/mod_onpageload_popup/tmpl/css/jquery.fancybox.css');
$rgb=modAutoHelper::hex2RGB($bgColor);
if($bgImage==0)
{
$bgImg="";
}
else{
$bgImg="url($base_url/modules/mod_onpageload_popup/tmpl/images/bg_$bgImage.png) repeat scroll 0 0";
}
$style="
.fancybox-overlay{
	background:  $bgImg rgba($rgb[red], $rgb[green], $rgb[blue], $opacity);
}

.fancybox-skin{
background: $popBgColor;
color:$popTxtColor;
}
.fancybox-close{
background:url('$base_url/modules/mod_onpageload_popup/tmpl/images/close_button_$closeButtonStyle.png');
}
";
$document->addStyleDeclaration( $style );
if($modal==1)
$modal='false';
else
$modal='true';

//Code for Cookie	
if($use)
	$add=",{ expires: $cookie_expire,path: '/'}";
else
	$add=",{path: '/'}";
	
//Code for Auto Close	
if($auto_close==1){
$close= ",afterShow: function(){setTimeout('parent.jQuery.fancybox.close ()',$close_timer);}";
}
else{
$close="";
}
//Code to set cookie
if($mode==1)
{
$setCookie="";
}
else{
$setCookie="afterClose :function(){	jQuery.cookie('the_cookie$module->id', 'true' $add);},";
}
// Code for Auto Open
if($auto_open==0){
$open= "setTimeout(function () {
     jQuery('.auto-popup$module->id').fancybox({
		modal: $modal,	
		width: $width,
		maxHeight : $height,
		$setCookie
		helpers: {overlay: {opacity: $opacity}}$close
	}).trigger('click');
	}, $open_timer);";
}
else{
$open="jQuery('.auto-popup$module->id').fancybox({
		modal: $modal,
		width     : $width,
		maxHeight : $height,
		$setCookie
		helpers: {overlay: {opacity: $opacity}}$close
	}).trigger('click');";	
}
//Test Mode

if($mode==1)
{
	$modeJs= $open;
}
else{
$modeJs="
if (!(jQuery.cookie('the_cookie$module->id'))) {
		$open	
    }";
	
}

if($jsfiles==1)
{
	if($load1==1)
	{
	if(!$jqPresent)	$document->addScript(JURI::root().'modules/mod_onpageload_popup/tmpl/js/jquery.min.js' );
	}
	$document->addScript(JURI::root().'modules/mod_onpageload_popup/tmpl/js/jquery.fancybox.js' );
	if(!($mode)){
	$document->addScript(JURI::root().'modules/mod_onpageload_popup/tmpl/js/jquery-cookie.js' );
	}
// $document->addScript(JURI::root().'modules/mod_onpageload_popup/tmpl/js/jquery.noconflict.js' );
$document->addscriptdeclaration(" jQuery(document).ready(function() { $modeJs     });");
}
else
{
	if($load1==1)
	{
	if(!$jqPresent){
		echo '<script src="'.$base_url.'modules/mod_onpageload_popup/tmpl/js/jquery.min.js" type="text/javascript"></script>';
		}
	}
	echo '<script src="'.$base_url.'modules/mod_onpageload_popup/tmpl/js/jquery.fancybox.js" type="text/javascript"></script>
	<script src="'.$base_url.'modules/mod_onpageload_popup/tmpl/js/jquery-cookie.js" type="text/javascript"></script>
	 
	<script type="text/javascript">
  jQuery(document).ready(function() {
' .$modeJs .'
  }
     );
</script>';
}
?>
<div id="auto_popup">
	<a class="auto-popup<?php echo $module->id;?>" href="#inline-auto<?php echo $module->id;?>"></a>
		<div style="display:none;">
			<div id="inline-auto<?php echo $module->id;?>" >
			<?php 
				if($input_method)
				{
					if($message_above!='')
						echo $message_above;
					if($mod_id!="")
						echo modAutoHelper::get_module($mod_id);
					if($message_below!='')
						echo $message_below;
				}
				else
				{
					if($message1!="")
					{
						$rows1->introtext = JHtml::_('content.prepare',$rows1->introtext, '', 'mod_onpageload_popup');
						echo $rows1->introtext;
					}
					if($mod_id!="")
						echo modAutoHelper::get_module($mod_id);
					if($message2!="")
					{
						$rows2->introtext = JHtml::_('content.prepare',$rows2->introtext, '', 'mod_onpageload_popup');
						echo $rows2->introtext;
					}	
				}
			?>
			</div>
		</div>
</div>