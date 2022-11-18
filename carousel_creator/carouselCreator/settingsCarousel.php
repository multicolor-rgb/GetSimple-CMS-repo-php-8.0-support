<?php 

$filename = GSDATAOTHERPATH.'/createCarousel/settings.json';
$datee = @file_get_contents($filename);
$data = json_decode($datee);

?>


<style>
.settings-former input,.settings-former select{width:100%;padding:10px;box-sizing: border-box;margin:15px 0;}
 

.moneyshot{
  width: 100%;
  border:solid 1px #ddd;
  padding:10px;
  display:grid;
  grid-template-columns: 1fr 100px;
  margin-top:20px;
  background:#fafafa;
  box-sizing: border-box;
}
 </style>   


<form action="#" class="settings-former" method="POST">


<div style="box-sizing:border-box;padding:15px;border:solid 1px #ddd;background:#fafafa;margin-bottom:20px;">
<h3 style="margin:0;margin-bottom:5px;"><?php echo i18n_r('carouselCreator/TITLE3');?></h3>
<p style="margin:0;"><?php echo i18n_r('carouselCreator/INFO2');?></p>
</div>


<label for=""><?php echo i18n_r('carouselCreator/SLIDERTIME');?></label>
<input type="text" name="autotimer" value= "<?php if(file_exists($filename)){ echo $data->autotimer;};?>" placeholder="3000 default" >

<label for=""><?php echo i18n_r('carouselCreator/DARKBACKGROUND');?></label>
<input type="text" name="fog" value= "<?php if(file_exists($filename)){ echo $data->fog;};?>" placeholder="give number from 0.0 - 1" >

<label for=""><?php echo i18n_r('carouselCreator/SLIDERHEIGHT');?></label>
<input type="text" name="height" value= "<?php if(file_exists($filename)){ echo $data->height;};?>" placeholder="example: 450px or 60vh" >




<label for=""><?php echo i18n_r('carouselCreator/MOUSEEVENT');?></label>
<select name="draggable" id="">
    <option value="true"><?php echo i18n_r('carouselCreator/YES');?></option>
    <option value="false"><?php echo i18n_r('carouselCreator/NO');?></option>
</select>

<label for=""><?php echo i18n_r('carouselCreator/AUTORESTART');?></label>
<select name="autorestart" id="">
    <option value="true"><?php echo i18n_r('carouselCreator/YES');?></option>
    <option value="false"><?php echo i18n_r('carouselCreator/NO');?></option>
</select>

<label for=""><?php echo i18n_r('carouselCreator/PREVENT');?></label>
<select name="disablescroll" id="">
    <option value="true"><?php echo i18n_r('carouselCreator/YES');?></option>
    <option value="false"><?php echo i18n_r('carouselCreator/NO');?></option>
</select>

<input type="submit" name="submit" value="<?php echo i18n_r('carouselCreator/SAVESETTINGS');?>" style="background:#000;color:#fff;border:none;border-radius:5px;">
</form>


<script>

if(<?php echo $data->draggable;?> ==true){
    document.querySelector('select[name="draggable"]').value = "true";
}else{
    document.querySelector('select[name="draggable"]').value = "false";
}

if(<?php echo $data->autorestart;?> ==true){
    document.querySelector('select[name="autorestart"]').value = "true";
}else{
    document.querySelector('select[name="autorestart"]').value = "false";
}

if(<?php echo $data->disablescroll;?> ==true){
    document.querySelector('select[name="disablescroll"]').value = "true";
}else{
    document.querySelector('select[name="disablescroll"]').value = "false";
}

</script>

<form action="https://www.paypal.com/cgi-bin/webscr" class="moneyshot" method="post" target="_top" style="display:flex; width:100%;align-items:center;justify-content:space-between;">
        <p style="margin:0;padding:0;"><?php echo i18n_r('carouselCreator/SUPPORT');?></p>
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        <img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
        </form>
        
<?php 


if (isset($_POST['submit'])){

$autotimer =$_POST['autotimer'];
$draggable =$_POST['draggable'];
$autorestart =$_POST['autorestart'];
$disablescroll = $_POST['disablescroll'];
$height = $_POST['height'];
$fog = $_POST['fog'];

$jsonsettings = '{
    "autotimer" : "'.$autotimer.'",
    "draggable" : "'.$draggable.'",
    "height" : "'.$height.'",
    "autorestart" : "'.$autorestart.'",
    "disablescroll" : "'.$disablescroll.'",
    "fog" : "'.$fog.'"
}';
 
 
$folder        = GSDATAOTHERPATH . '/createCarousel/';
$filename      = $folder . 'settings.json';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
 
 if ($folder_exists) {
  file_put_contents($filename, $jsonsettings);
};
echo("<meta http-equiv='refresh' content='0'>");
};


;?>