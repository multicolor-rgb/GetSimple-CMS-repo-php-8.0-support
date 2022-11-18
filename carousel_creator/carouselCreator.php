<?php

$thisfile=basename(__FILE__, ".php");
if (!i18n_merge('carouselCreator')) i18n_merge('carouselCreator', 'en_US');


# register plugin
register_plugin(
	$thisfile, //Plugin id
	'Carousel Creator', 	//Plugin name
	'2.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'https://multicolor.stargar.pl/', //author website
	'Create carousel with easy creator', //Plugin description
	'pages', //page type - on which admin tab to display
	'createCarousel'  //main function (administration)
);
 
# activate filter 
add_action('theme-footer','carouselRun'); 
add_action('theme-footer','carouselConfig');

add_action('footer','carouselButton');

register_script('swipejs', $SITEURL.'plugins/carouselCreator/js/swipe.min.js', '0.1', TRUE);
 queue_script('swipejs',GSFRONT); 
 
register_script('carouselCKE', $SITEURL.'admin/template/js/ckeditor/ckeditor.js', '1.1', FALSE);
queue_script('carouselCKE',GSBACK); 


register_style('carouselstyle', $SITEURL.'plugins/carouselCreator/css/carousel.css', GSVERSION, 'screen');
queue_style('carouselstyle',GSFRONT); 

register_style('carouselstyleback', $SITEURL.'plugins/carouselCreator/css/carouselback.css', GSVERSION, 'screen');
queue_style('carouselstyleback',GSBACK); 
 
# add a link in the admin tab 'theme'
add_action('pages-sidebar','createSideMenu',[$thisfile, i18n_r('carouselCreator/TITLE1').' 🎠', 'carouselcreator']);
add_action('plugins-sidebar','createSideMenu',[$thisfile, i18n_r('carouselCreator/TITLE2').' 🎠', 'carouselsettings']);



function carouselButton(){
include('carouselCreator/addBtn.php');
};


 

function createCarousel(){

	if(isset($_GET['carouselcreator'])){
include('carouselCreator/createCarousel.php');
}elseif(isset($_GET['carouselsettings'])){
include('carouselCreator/settingsCarousel.php');
}

}


function carouselRun(){
	include('carouselCreator/runCarousel.php');
};

function carouselConfig(){
	include('carouselCreator/carouselConfig.php');
}


?>
