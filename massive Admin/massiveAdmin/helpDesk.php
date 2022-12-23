<?php

$folder        = GSDATAOTHERPATH . '/massiveHelpDesk/';
$filename      = $folder . 'helpdesk.json';
$chmod_mode    = 0755;

if(file_exists($filename)){
    $datee = @file_get_contents($filename);
$data = json_decode($datee);
};



;?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<h3><?php echo i18n_r('massiveAdmin/USERHELPTITLE');?></h3>

<form action="#" method="POST">
    <div style="background:#ddd;padding:15px;display:flex;aling-items:center;margin-bottom:10px;justify-content:space-between;border:solid 1px #111;">
    <label for=""><?php echo i18n_r('massiveAdmin/TURNON');?></label>  <input type="checkbox" name="checkbox" class="checkbox" value="true" style="margin-right:10px;"> 
</div>

<textarea name="helper" class="ckeditors" >
<?php
if(file_exists($filename)){
   echo $data->content;
};?>

</textarea>
<input type="submit" value="<?php echo i18n_r('massiveAdmin/SAVEOPTION');?>" name="savehelpinfo" style="width: 100%;
padding: 10px;
margin-top: 20px;
background: #000;
color: #fff;
border: none;
border-radius: 5px;">
</form>

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


const json =  `<?php echo @file_get_contents($filename);?>` ;


if('<?php if(isset($data->checkbox)){echo $data->checkbox;};?>' == "true"){
document.querySelector('.checkbox').checked = true;
}else{
document.querySelector('.checkbox').checked = false;
}
</script>
 

<?php
if(isset($_POST['savehelpinfo'])){

    $checkbox = $_POST['checkbox'];
    if($checkbox == 'true'){
        $checkboxer="true";
    }else{
        $checkboxer="false";
    }
    $helper = $_POST['helper'];
    $helpers =  json_encode($helper,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    $json = '{
        "content": '.$helpers.',
        "checkbox":  "'.$checkboxer.'" 
    }';

$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
 
// Save the file (assuming that the folder indeed exists)
if ($folder_exists) {
  file_put_contents($filename, $json);
};

echo("<meta http-equiv='refresh' content='0'>");

}


;?>


<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="display:grid; width:100%;grid-template-columns:1fr auto; padding:10px;background:#fafafa;border:solid 1px #ddd;margin-top:20px;">
				<p style="margin:0;padding:0;"> <?php echo i18n_r("massiveAdmin/SUPPORT");?></p>
				<input type="hidden" name="cmd" value="_s-xclick" />
				<input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
				<img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
			</form>
