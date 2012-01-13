<?php
/* Get the MODX Core path, and set the source path for BasicMenu */
$core = $modx->getOption('core_path');
$basicMenuSource  = $core . 'components/basicmenu/classes/class.basicmenu.php'; 
require_once($basicMenuSource);

$menu			= new BasicMenu(0,$modx);
$output			= '';

$resource               = $modx->resource;
$id=$resource->get('id');

/*
  * Check the options:
  * jQuery
  * HoverIntent
  * Default CSS
*/

($loadJQuery) ? $modx->regClientStartupScript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js') : '';

if ($useHoverIntent == 1) {


	$modx->regClientScript($core . 'components/basicmenu/js/hoverintent/jquery.hoverIntent.minified.js');
	$modx->regClientScript($core . 'components/basicmenu/js/hoverintent/jquery.hoverintent.config.js');
}

$output .= ($useDefaultCSS == 1) ? $modx->getChunk('basicMenuDefaultCSS') : '';

// Process the Menu
$data = array();
$data['menu']			.= $menu->showMenu();

$output .= $modx->getChunk('basicMenuWrapper',$data);

if ($id != $modx->getOption('site_unavailable_page')) {
return $output;
} else {
return '';
}
?>