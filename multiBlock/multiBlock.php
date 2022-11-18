<?php
 
# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

$plugin_id='multiBlock';

i18n_merge($plugin_id) || i18n_merge($plugin_id, 'en_US');

# register plugin
register_plugin(
	$thisfile, //Plugin id
	'MultiBlock 🧱', 	//Plugin name
	'2.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'https://discord.gg/d5s83yk4R6', //author website
	'create block what you want', //Plugin description
    'pages',
	'multiblock'  //main function (administration)
);
 
 
 
 
add_action( 'pages-sidebar', 'createSideMenu', [$thisfile, i18n_r('multiBlock/MULTIBLOCK').' 🧱', 'newmultiblock'] );
add_action( 'plugins-sidebar', 'createSideMenu', [$thisfile, i18n_r('multiBlock/MULTIBLOCKSETTINGS').' 🧱', 'category'] );
 
 
 
 
# functions
function multiblock() {
    
     if( isset( $_GET[ 'category' ] ) ){
	
        include('multiBlock/category.php');

		echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="box-sizing:border-box;display:grid; width:100%;grid-template-columns:1fr auto; padding:10px;background:#fafafa;border:solid 1px #ddd;margin-top:20px;">
			<p style="margin:0;padding:0;"> '.i18n_r('multiBlock/PAYPAL').'  </p>
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" border="0">
			<img alt="" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" border="0">
		</form>';


		echo '<form  method="post" style="background:#fafafa;padding:10px;border:solid 1px #ddd;margin-top:10px;">
	<input type="submit" value="'.i18n_r("multiBlock/CACHETHUMB").'" class="cleanthumb" style="padding:5px 10px;border:none;background:red;color:#fff;" name="cleanthumb">
	</form>';


    };

    if( isset( $_GET[ 'addnew' ] ) ){

	include('multiBlock/addnew.php');

};

 
if( isset( $_GET[ 'newmultiblock' ] ) ){

	include('multiBlock/newmultiblock.php');



	echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style=" box-sizing:border-box;display:grid; width:100%;grid-template-columns:1fr auto; padding:10px;background:#fafafa;border:solid 1px #ddd;margin-top:20px;">
		<p style="margin:0;padding:0;"> '.i18n_r('multiBlock/PAYPAL').' </p>
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" border="0">
		<img alt="" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" border="0">
	</form>';

	
    
};


if( isset( $_GET[ 'newblock' ] ) ){

	include('multiBlock/newblock.php');

	
    
};



}

//get function 



function mbOrder(){
	global $counterOrder;

	if($counterOrder==''){
		$counterOrder = 0;
	};

	echo "data-id='".$counterOrder."' ";
	$counterOrder++;

};



function mbvaluetext($value){
global $getmb;
		echo $getmb->$value;	
	 
 };


function mbvalue($value){

	global $getmb;
	echo html_entity_decode( $getmb->$value);	
 
 };


//dropdown 

function mbdropdown($value){

	global $getmb;
	echo  str_replace("^"," ",$getmb->$value);
 
 };

//dropdonwend




 ///thumb generate - new on 2.0

 function mbthumb($value,$width){

	
	global $getmb;
	global $SITEURL;
 
  
 
 $file = file_get_contents($getmb->$value);
 
 $folder =GSPLUGINPATH."multiBlock/thumb/";

 $extension =  pathinfo($getmb->$value, PATHINFO_EXTENSION);



 $base = pathinfo($getmb->$value, PATHINFO_BASENAME);
 
 $finalfile = $folder.$width."-".$base ;

 
 if(file_exists($finalfile)){

 }else{
 
	$origPic = imagecreatefromstring($file);
 
	$width_orig=imagesx($origPic);
	$height_orig=imagesy($origPic);
	
	$height = $height_orig  * 1.77;


	$ratio_orig = $width_orig/$height_orig;
	
	if ($width/$height > $ratio_orig) {
	   $width = $height*$ratio_orig;
	} else {
	   $height = $width/$ratio_orig;
	}
	
	
	$thumbnail = imagecreatetruecolor($width,$height);
	
	imagecopyresampled($thumbnail,$origPic,0,0,0,0,$width,$height,$width_orig,$height_orig);
	

	if($extension == 'jpeg' || $extension == 'jpg'){
		imagejpeg($thumbnail, $finalfile);
	}elseif($extension == 'png'){
		imagepng($thumbnail, $finalfile);
	}elseif($extension == 'webp'){
		imagewebp($thumbnail, $finalfile);
	}elseif($extension == 'gif'){
		imagegif($thumbnail, $finalfile);
	}
	elseif($extension == 'bmp'){
		imagebmp($thumbnail, $finalfile);
	}else{
		imagejpeg($thumbnail, $finalfile);
	}



	
	imagedestroy($origPic);
	imagedestroy($thumbnail);
 };


  
  
 echo str_replace(GSPLUGINPATH,$SITEURL.'plugins/',$finalfile);
	   
 }
 
 

 /// end thumb generated


 ///

 function mbCleanThumb(){

	$imager = glob(GSPLUGINPATH.'multiBlock/thumb/*', GLOB_BRACE);

	foreach($imager as $img){

		unlink($img);

	};


 };


 if(isset($_POST['cleanthumb'])){


	mbCleanThumb();


 };


 ///



function getMultiBlock($category,$orderid=''){


	global $getmb;

	$getmb;


	$orders = @file_get_contents(GSDATAOTHERPATH.'multiBlock/'.$category.'/order.txt');
 
	 

	
 
 
    foreach (glob(GSDATAOTHERPATH."multiBlock/".$category."/*.json") as $mbBlock) {
$info = pathinfo($mbBlock);
        $name = basename($mbBlock,'.'.$info['extension']);
        $template = GSDATAOTHERPATH.'multiBlock/category/'.$category.'.txt';
 
 
		$mbjson = file_get_contents($mbBlock);
  
		global $getmb;
	
		$getmb = json_decode($mbjson);
		
	
	include($template);	 
    }



	if($orderid!==''){

	echo"
		<script>

const arraylist = '".@file_get_contents(GSDATAOTHERPATH . 'multiBlock/'.$category.'/order.txt')."';
 
const arraychange = arraylist.split(',');



arraychange.forEach((x,i)=>{
if(document.querySelector(`".$orderid." [data-id='`+x+`']`)!== null){
  document.querySelector('".$orderid."').append(document.querySelector(`[data-id='`+x+`']`)); 
} 
 });

</script>";
		

	}



};

 


 
 
 
?>
