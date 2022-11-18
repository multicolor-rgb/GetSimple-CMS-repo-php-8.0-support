<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'scrollup plugin', 	//Plugin name
	'2.0', 		//Plugin version
	'Matuesz Skrzypczak',  //Plugin author
	'https://paypal.me/multicol0r', //author website
	'This plugin add ScrollUp button to your website', //Plugin description
	'plugins', //page type - on which admin tab to display
	'scrollup_settings'  //main function (administration)
);
 
# activate filter 
add_action('theme-footer','scrollupfront'); 
 
# add a link in the admin tab 'theme'
add_action('plugins-sidebar','createSideMenu',[$thisfile, 'scrollUp Settings']);
 
# functions
function scrollupfront() {

    $filename = GSDATAOTHERPATH.'/scrollup/settings.json';

    if(file_exists($filename)){
        include('scrollup/scrollupfront.php');
    }
    
}
 
function scrollup_settings() {

    include('scrollup/scrollupsettings.php');
    
}
?>
