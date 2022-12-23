<?php

$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, //Plugin id
	'Accessibility sidebar', 	//Plugin name
	'1.0.1', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'https://discord.gg/GHV8ba3r', //author website
	'Accesibilty options for your website', //Plugin description
	'plugins'
 
);

# activate filter 
add_action('theme-footer','fronthelpAccess'); 
 

# functions
function fronthelpAccess() {

	include(GSPLUGINPATH.'accessibilitySidebar/frontToolbar.php');
	
}

 
?>