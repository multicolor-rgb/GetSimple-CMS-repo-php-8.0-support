<?php

	# get correct id for plugin
	$thisfile=basename(__FILE__, ".php");

	i18n_merge('massiveAdmin') || i18n_merge('massiveAdmin','en_US');

	# register plugin
	register_plugin(
		$thisfile, //Plugin id
		'Massive Admin Theme', 	//Plugin name
		'2.5', 		//Plugin version
		'Mateusz Skrzypczak',  //Plugin author
		'https://multicolor.stargard.pl', //author website
		'Admin theme with new function', //Plugin description
		'settings', //page type - on which admin tab to display
		'massiveOption'  //main function (administration)
	);
 


 



#new option on file browser

	add_action('file-extras','newOptionsMassive');

	function newOptionsMassive(){
	include('massiveAdmin/newOptionsMassive.php');
	}



#massive uploader on i18n gallery
	
	add_action('pages-sidebar','massiveUploader');


	if (strpos($_SERVER['REQUEST_URI'], "i18n_gallery&edit") !== false){
		add_action('i18n_gallery-sidebar','massiveUploader');
	};


	if (strpos($_SERVER['REQUEST_URI'], "i18n_gallery&create") !== false){
		add_action('i18n_gallery-sidebar','massiveUploader');
	};

	function massiveUploader(){

		echo' <li style="margin: 0 0 3px 0;" class="masive-uploader">
			<h3>'.i18n_r("massiveAdmin/UPLOADFILE").'</h3>
			<form action="#" class="dropzone"></form>
			</li>';

		$DropFiles = i18n_r('massiveAdmin/DROPFILES');
		echo '<script> const dropFilesName = "'.$DropFiles.'"</script>';
		echo "<script>document.addEventListener('DOMContentLoaded', function(){document.querySelector('.dz-button').innerHTML = dropFilesName});</script>";

		$ds   = DIRECTORY_SEPARATOR;

		$storeFolder = '../data/uploads/';   

		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];             
			$targetPath = __DIR__ . $ds. $storeFolder . $ds;  
			$targetFile =  $targetPath. $_FILES['file']['name'];  
			move_uploaded_file($tempFile,$targetFile); 
		};
	}

	//component on pages

	add_action('pages-sidebar','compomassive');
	
	function compomassive(){
		echo'<li><a href="components.php" class="compmassive">'.i18n_r("massiveAdmin/EDITCOMPONENTS").'</a> </li>';
	};


 


	
	# activate massive active script and css
	$folder = GSDATAOTHERPATH . '/massiveadmin/';

	register_style('masivestyle', $SITEURL.'plugins/massiveAdmin/css/style.css', '2.0', 'screen');
	queue_style('masivestyle',GSBACK); 


	add_action('footer','ckeStyleImplementation');
		function ckeStyleImplementation(){
			include('massiveAdmin/ckeditorStyleImplementation.php');
		};


	$massiveOptionFile = GSDATAOTHERPATH . '/massiveadmin/massiveOption.json';

		$massiveOptionFileContent = @file_get_contents($massiveOptionFile);

		if(file_exists($massiveOptionFile)){

			$newmassiveOptionFile = json_decode($massiveOptionFileContent);

	if( $newmassiveOptionFile->gridfront == "yes"){
		register_style('massivegrid', $SITEURL.'plugins/massiveAdmin/css/bootstrap-grid.min.css', '2.0', 'screen');
		queue_style('massivegrid',GSFRONT); 
	};

	if($newmassiveOptionFile->grid == "no"){
			echo'<style>.upcke{display:none !important}</style>';
	};

		};





	register_script('masivescript', $SITEURL.'plugins/massiveAdmin/js/script.js', '4.0', TRUE);
	queue_script('masivescript',GSBACK); 

	register_style('masivestyledropzone', $SITEURL.'plugins/massiveAdmin/css/dropzone.min.css', '1.1', 'screen');
	queue_style('masivestyledropzone',GSBACK); 

	register_script('masivescriptdropzone', $SITEURL.'plugins/massiveAdmin/js/dropzone.min.js', '1.1',FALSE);
	queue_script('masivescriptdropzone',GSBACK); 

	add_action( 'header', 'masiveicon');

//massiveicon
	
	function masiveicon() {
		echo '<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.8/css/unicons.css">';
		echo ' <meta name="viewport" content="width=device-width, initial-scale=1.0">';


		 
$massiveOptionFile = GSDATAOTHERPATH . '/massiveadmin/massiveOption.json';

 	$massiveOptionFileContent = @file_get_contents($massiveOptionFile);
$newmassiveOptionFile = json_decode($massiveOptionFileContent);



}



	//codeminor fixes

	add_action('footer','footerCodeMirror');

	function footerCodeMirror(){
		echo'<script>if(document.querySelector(".CodeMirror")!==null){document.querySelector(".CodeMirror textarea").filter="invert(100%)"}</script>';
	};



	//maitence mode on or off check

	add_action('theme-footer','massivemaintence');

	function massivemaintence(){
	
		include('massiveAdmin/maintence.php');

	};

	//mtoper on front website

	if (isset($_COOKIE['GS_ADMIN_USERNAME'])) {
		$cookie_user_id = _id($_COOKIE['GS_ADMIN_USERNAME']);
		if (file_exists(GSUSERSPATH . $cookie_user_id.'.xml')) {
			$datau = getXML(GSUSERSPATH  . $cookie_user_id.'.xml');
			$USR = stripslashes($datau->USR);
			$HTMLEDITOR = $datau->HTMLEDITOR;
			$TIMEZONE = $datau->TIMEZONE;
			$LANG = $datau->LANG;

		add_action('theme-header','massivefronter'); 

		function massivefronter(){
			include('massiveAdmin/mToper.php');
		}
		} else {
			$USR = null;
		};
	};


//login plugins
	add_action('index-login','scriptHeader');
	function scriptHeader(){
include('massiveAdmin/scriptHeader.php');
};
$massiveAdminSettingsTitle = i18n_r("massiveAdmin/MASSIVEADMINSETTINGSTITLE");



// plugins search admin
add_action('plugin-hook','searchplugin');
function searchplugin(){
include('massiveAdmin/searchPlugin.php');
};


//new module massiveMenuExternal

$MenuExternalTitle = i18n_r('massiveAdmin/MENUEXTERNAL');

add_action( 'settings-sidebar', 'createSideMenu', [$thisfile, $MenuExternalTitle, 'menuext'] );

add_action('nav-tab','massiveExtNavbar');

function massiveExtNavbar(){
	include('massiveAdmin/menuExtNavbar.php');
};


//hidden section and user manager

$HideMassiveTitle = i18n_r('massiveAdmin/HIDEMENUTITLE');
add_action('settings-sidebar','createSideMenu',[$thisfile, $HideMassiveTitle, 'hideadminsection']);

add_action('footer','hideSectionfooter'); 

function hideSectionfooter(){
include('massiveAdmin/hiddenAdminSectionFooter.php'); 
};
 



//Own footer option

$OwnFooterOption = i18n_r('massiveAdmin/OWNFOOTERTITLE');
add_action('settings-sidebar','createSideMenu',[$thisfile, $OwnFooterOption, 'ownfooteroption']);
add_action('footer','ownFooterScripts'); 


function ownFooterScripts(){
include('massiveAdmin/ownFooterScript.php'); 
};

add_action('header','ownFooterScriptHeader'); 
function ownFooterScriptHeader(){
	include('massiveAdmin/ownFooterScriptHeader.php'); 
	};

	add_action('index-login','ownFooterIndex');

	function ownFooterIndex(){
		include('massiveAdmin/ownFooterIndex.php'); 
		};
	

	


//create massive option

$MassiveAdminSettingTitle = i18n_r('massiveAdmin/MASSIVEADMINSETTINGSTITLE');
add_action('settings-sidebar','createSideMenu',[$thisfile, $MassiveAdminSettingTitle, 'massiveoption']);


//create helpdesk option

$helpTitle = i18n_r('massiveAdmin/USERHELPTITLE');

add_action('settings-sidebar','createSideMenu',[$thisfile, $helpTitle, 'helpdesk']);


$helpFile= GSDATAOTHERPATH .'/massiveHelpDesk/helpdesk.json';


if(file_exists($helpFile)){
	$helpFileContent = file_get_contents($helpFile);
$HelpfileDecode = json_decode($helpFileContent);
$checkTrue = $HelpfileDecode->checkbox;
$help = i18n_r('massiveAdmin/HELP');

if( $checkTrue == 'true'){
	add_action('nav-tab','createSideMenu',[$thisfile, '<i class="uil uil-life-ring"></i>'.$help, 'helpfromuser']);
	}
}





//all massive option  

	function massiveOption(){	

		if(isset($_GET['massiveoption'])){
			include('massiveAdmin/massiveOption.php');
		}elseif(isset($_GET['helpfromuser'])){
			include('massiveAdmin/helpDeskInfo.php');
		}elseif(isset($_GET['helpdesk'])){
			include('massiveAdmin/helpDesk.php');
		}elseif(isset($_GET['hideadminsection'])){
		include('massiveAdmin/hideAdminSection.php');
		}elseif(isset($_GET['menuext'])){
			include('massiveAdmin/menuExt.php');
			}elseif(isset($_GET['ownfooteroption'])){
				include('massiveAdmin/ownFooterOptions.php');
			};
	};


?>
