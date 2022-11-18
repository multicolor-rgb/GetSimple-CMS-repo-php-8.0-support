<?php


	# get correct id for plugin
	$thisfile=basename(__FILE__, ".php");

 
	# register plugin
	register_plugin(
		$thisfile, //Plugin id
		'UploaderExt', 	//Plugin name
		'1.1', 		//Plugin version
		'Mateusz Skrzypczak',  //Plugin author
		'https://multicolor.stargard.pl', //author website
		'Uploader with compress photo and convert to webp ', //Plugin description
		'files', //page type - on which admin tab to display
		'UploaderExt'  //main function (administration)
	);
 

	add_action('footer','uploaderExt');


	function uploaderExt(){
	 
		include('uploaderExt/uploaderExtFunction.php');
		
};

;?>