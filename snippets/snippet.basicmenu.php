<?php
require_once('core/components/basicmenu/classes/class.basicmenu.php');

$menu			= new BasicMenu(0,$modx);
$output			= '';

$resource               = $modx->resource;
$id=$resource->get('id');

// Check need to register HoverIntent and Default CSS
if ($useHoverIntent == 1) {
	$modx->regClientScript('core/components/basicmenu/js/hoverintent/jquery.hoverIntent.minified.js');
	$modx->regClientScript('core/components/basicmenu/js/hoverintent/jquery.hoverintent.config.js');
}

$output .= ($useDefaultCSS == 1) ? $modx->getChunk('basicMenuDefaultCSS') : '';

// Process the Menu
$output			.= $menu->showMenu();


if ($id != $modx->getOption('site_unavailable_page')) {
return $output;
} else {
return '';
}