<?php
$filename      = GSDATAOTHERPATH . '/massiveadmin/massiveOption.json';
$chmod_mode    = 0755;

if(file_exists($filename)){
	$datee = file_get_contents($filename);
$data = json_decode($datee);
}
?>

<style>
.massiveoption form{width:100%;padding:10px}.massiveoption select{margin:20px 0;padding:10px;width:100%}
.massiveoption label{font-size:1.2rem;margin-bottom:5px}
.massiveoption textarea{height:200px;width:100%}
.massiveoption .save{width: 100%;
padding: 10px;
margin-top: 20px;
background: #000;
color: #fff;
border: none;
border-radius: 5px;}.hidetitle{width:100%;background:#fafafa;padding:10px;border:solid 1px #ddd;display:flex;justify-content:space-between;align-items:center;margin-top:20px}.hidetitle h3{margin:0;padding:0}.hide{display:none}.hidecontent{padding:15px;border:solid 1px #ddd;margin-bottom:20px}
</style>

 



			<div class="massiveoption">

			<div class="hidetitle" id="hidetitle1"><h3><?php echo i18n_r('massiveAdmin/MAITENANCETITLE');?></h3> <i class="uil uil-arrow-down"></i></div>

			<div class="hidecontent hidecontent1">

				<form action="#" method="post">
					<label for="maintence"><?php echo i18n_r("massiveAdmin/MAINTENANCE_ON") ;?></label>
					<select name="maintence" class="maintenceselect" id="">
						<option value="no"><?php echo i18n_r("massiveAdmin/NO") ?></option>
						<option value="yes"><?php echo i18n_r("massiveAdmin/YES") ?></option>
					</select>

					<label for="content"><?php echo i18n_r("massiveAdmin/CONTENT_MAINTENANCE_MODE") ;?></label>
					<textarea name="content" class="ckeditors"><?php echo $data->maintencecontent??'';?></textarea>
<br>
					<input type="submit" name="save-option"  style="width: 100%;
padding: 10px;
margin-top: 20px;
background: #000 !important;
color: #fff;
border: none;
border-radius: 5px;" value="<?php echo i18n_r("massiveAdmin/SAVEOPTION") ;?>" class="submit">


</div>




<div class="hidetitle" id="hidetitle2"><h3><?php echo i18n_r('massiveAdmin/BOOTSTRAPTITLE');?></h3>  <i class="uil uil-arrow-down"></i></div>
<div class="hidecontent hidecontent2">

					<label for="grid" style="margin-top:10px"><?php echo i18n_r("massiveAdmin/TURNONBOOTSTRAPGRID") ;?></label>
					<select name="grid" class="gridselect" id="">
						<option value="no"><?php echo i18n_r("massiveAdmin/NO") ;?></option>
						<option value="yes"><?php echo i18n_r("massiveAdmin/YES") ;?></option>
					</select>

					<label for="gridfront" style="margin-top:10px"> <?php echo i18n_r("massiveAdmin/TURNONBOOTSTRAPGRIDONTHEME") ;?></label>
					<select name="gridfront" class="gridselectfront" id="">
						<option value="no"><?php echo i18n_r("massiveAdmin/NO") ;?></option>
						<option value="yes"> <?php echo i18n_r("massiveAdmin/YES") ;?></option>
					</select>


					

					<input type="submit" name="save-option" style="width: 100%;
padding: 10px;
margin-top: 20px;
background: #000 !important;
color: #fff;
border: none;
border-radius: 5px;" value="<?php echo i18n_r("massiveAdmin/SAVEOPTION") ;?>" class="submit">
				</form>

</div>



				<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

				<script>

				const ckeditorReplace = document.querySelector(".ckeditors");

				CKEDITOR.replace(ckeditorReplace, {
					filebrowserBrowseUrl: "filebrowser.php?type=all",	
					filebrowserImageBrowseUrl: "filebrowser.php?type=images",
					filebrowserWindowWidth: "730",
					filebrowserWindowHeight: "500"
					, toolbar: "advanced"
				});

				</script>



<script>

document.querySelector('.hidecontent1').classList.add('hide');

document.querySelector('#hidetitle1').addEventListener('click',()=>{

    if(document.querySelector('.hidecontent1').classList.contains('hide')== true){
        document.querySelector('.hidecontent1').classList.remove('hide');
    }else{
        document.querySelector('.hidecontent1').classList.add('hide');
    }
 
});

document.querySelector('.hidecontent2').classList.add('hide');

document.querySelector('#hidetitle2').addEventListener('click',()=>{

    if(document.querySelector('.hidecontent2').classList.contains('hide')== true){
        document.querySelector('.hidecontent2').classList.remove('hide');
    }else{
        document.querySelector('.hidecontent2').classList.add('hide');
    }
 
});
</script>


			</div>
 
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="display:grid; width:100%;grid-template-columns:1fr auto; padding:10px;background:#fafafa;border:solid 1px #ddd;margin-top:20px;">
				<p style="margin:0;padding:0;"> <?php echo i18n_r("massiveAdmin/SUPPORT");?></p>
				<input type="hidden" name="cmd" value="_s-xclick" />
				<input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
				<img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
			</form>



            <?php 


if(file_exists($filename)){

if(  $data->maintence == 'yes'){
    echo '<script>document.querySelector(".maintenceselect").value = "yes"</script></script>';
}else{
    echo '<script>document.querySelector(".maintenceselect").value = "no"</script></script>';
};

if( $data->grid == 'yes'){
    echo '<script>document.querySelector(".gridselect").value = "yes"</script></script>';
}else{
    echo '<script>document.querySelector(".gridselect").value = "no"</script></script>';
};

if($data->gridfront == 'yes'){
    echo '<script>document.querySelector(".gridselectfront").value = "yes"</script></script>';
}else{
    echo '<script>document.querySelector(".gridselectfront").value = "no"</script></script>';
};

};





if (isset($_POST['save-option'])){
	// Set up the data
	$grid= $_POST["grid"];
	$gridfront= $_POST["gridfront"];
	$maintence= $_POST["maintence"];
	$mcontent = $_POST["content"];
    $mcontentNew =  json_encode($mcontent,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

	// Set up the folder name and its permissions
	// Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
	$folder        = GSDATAOTHERPATH . '/massiveadmin/';
	$filename      = $folder . 'massiveOption.json';
	$chmod_mode    = 0755;
	$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);

	$json= '{

		"maintence" : "'.$maintence.'",
		"maintencecontent" : '.$mcontentNew.',
		"grid" : "'.$grid.'",
		"gridfront" : "'.$gridfront.'"
	}';

	 
	// Save the file (assuming that the folder indeed exists)
	if ($folder_exists) {
		file_put_contents($filename, $json);
	};

	
	echo "<script>const Another = '".i18n_r('massiveAdmin/ANOTHERPAGE')."'</script>";
	echo "<script>document.querySelector('.massiveoption').innerHTML = '<span>'+Another+'</span>' </script>";
	
	echo("<meta http-equiv='refresh' content='0'>");

};
?>
