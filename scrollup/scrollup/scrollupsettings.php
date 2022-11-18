<?php 
$filename = GSDATAOTHERPATH.'/scrollup/settings.json';
$datee = @file_get_contents($filename);
$data = json_decode($datee);

global $SITEURL;

    ;?>


<h3>scrollUp Settings</h3>

<form method="post" style="background: #fafafa;
border: solid 1px #ddd; padding:10px; width:100%;box-sizing:border-box;margin-bottom:10px;">

<p style="margin:10px 0;">scrollup color</p>

<input type="color" class="color-select" value="<?php if($data !== null){echo $data->color;}?>" style="width:100%;height:40px;background:#fff;border:solid 1px #ddd;" name ="color">

 

<p style="margin:10px 0;">scrollup size</p>

<select name="size" class="size-select" style="width:100%;padding:10px;background:#fff;border:solid 1px #ddd;">

<option value="40"  <?php if(file_exists($filename)){ echo  $data->scrollupsize==="40"?"selected":"";};?> >40px</option>
<option value="50" <?php if(file_exists($filename)){ echo $data->scrollupsize==="50"?"selected":"";};?> >50px</option>
<option value="60" <?php if(file_exists($filename)){ echo $data->scrollupsize==="60"?"selected":"";};?>>60px</option>

</select>



 

<p style="margin:10px 0;"> Choose icon</p>

<select name="icon" class="icon-select" style="width:100%;padding:10px;background:#fff;border:solid 1px #ddd;">

<option value="1"  >Type 1</option>
<option value="2"  >Type 2</option>
<option value="3" >Type 3</option>
<option value="4" >Type 4</option>

<option value="5" >Type 5</option>
<option value="6" >Type 6</option>
<option value="7" >Type 7</option>
<option value="8" >Type 8</option>
<option value="9" >Type 9</option>

</select>

<br>
<p style="margin:10px 0;">Example icon</p>
<div class="col-md-12 border bg-light mt-3">


<div style="display:grid;grid-template-columns:1fr 1fr 1fr;">

<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up1.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">1.</p>

</div>

<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up2.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">2.</p>

</div>

<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up3.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">3.</p>

</div>

<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up4.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">4.</p>

</div>

<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up5.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">5.</p>

</div>

<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up6.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">6.</p>

</div>

<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up7.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">7.</p>

</div>

<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up8.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">8.</p>

</div>


<div class="col-md-4 my-3">
<img src="<?php echo $SITEURL.'plugins/scrollup/img/up9.svg';?>" style="width:30px;height:30px;display:block;margin:0 auto;">
<p style="text-align:center;" class="h5">9.</p>

</div>
</div>

</div>


<br>
<p style="margin:10px 0;"> Invert color icon</p>

<select name="invert" class="invert-select" style="width:100%;padding:10px;background:#fff;border:solid 1px #ddd;">

<option value="100%" <?php if(file_exists($filename)){echo $data->invert==="100%"?"selected":"";};?> >Yes</option>
<option value="0"  <?php if(file_exists($filename)){ echo $data->invert==="0"?"selected":"";};?> >No</option>

</select>

<br>

<p style="margin:10px 0;">Border</p>
<select name="border" class="border-select" style="width:100%;padding:10px;background:#fff;border:solid 1px #ddd;">

<option value="border:solid 1px #000"  <?php if(file_exists($filename)){ echo $data->border==="border:solid 1px #000"?"selected":"";};?> >Border dark</option>
<option value="border:solid 1px #fff"  <?php if(file_exists($filename)){echo $data->border==="border:solid 1px #fff"?"selected":"";};?> >Border light</option>
<option value="border:none" <?php if(file_exists($filename)){ echo $data->border==="border:none"?"selected":"";};?> >none</option>

</select>




<p style="margin:10px 0;">Border radius</p>
<select name="radius" class="radius-select" style="width:100%;padding:10px;background:#fff;border:solid 1px #ddd;">

<option value="border-radius:0"  <?php if(file_exists($filename)){ echo $data->radius==="border-radius:0"?"selected":"";};?> >Border radius none</option>
<option value="border-radius:5%"  <?php if(file_exists($filename)){ echo $data->radius==="border-radius:5%"?"selected":"";};?> >Border radius 5%</option>
<option value="border-radius:10%"  <?php if(file_exists($filename)){echo $data->radius==="border-radius:10%"?"selected":"";};?> >Border radius 10%</option>
<option value="border-radius:50%" <?php if(file_exists($filename)){ echo $data->radius==="border-radius:50%"?"selected":"";};?> >Border radius 50%</option>

</select>



<br>
<p style="margin:10px 0;"> Show on mobile</p>

<select name="mobile" class="mobile-select" style="width:100%;padding:10px;background:#fff;border:solid 1px #ddd;">

<option value="flex"  <?php if(file_exists($filename)){echo  $data->mobile==="flex"?"selected":"";};?> >Yes</option>
<option value="none"  <?php if(file_exists($filename)){echo  $data->mobile==="none"?"selected":"";};?> >No</option>

</select>





<input type="submit" name="submit" value="Save settings" style="background:#000;width:100%;color:#fff;padding:10px 15px;margin-top:20px;margin-bottom:20px;border:none;border-radius:5%;">

</form>


<div style="width:100%;background:#fafafa;border:solid 1px #ddd;padding:10px;text-align:center;box-sizing:border-box;">

<p>If you want support my work, and you want saw new plugins:) </p>

<a href="https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"  />
</a>

</div>
 

<?php 

if(file_exists($filename)){


$scripter = '<script>';

$scripter .= 'document.querySelector(".icon-select").value = "'.$data->icon.'";';
$scripter .= 'document.querySelector(".invert-select").value = "'.$data->invert.'";';
$scripter .= 'document.querySelector(".mobile-select").value = "'.$data->mobile.'";';
$scripter .= 'document.querySelector(".border-select").value = "'.$data->border.'";';
$scripter .= 'document.querySelector(".size-select").value = "'.$data->scrollupsize.'";';
$scripter .= 'document.querySelector(".color-select").value = "'.$data->scrollupcolor.'";';
$scripter .= 'document.querySelector(".radius-select").value = "'.$data->radius.'";';

$scripter .='</script>';

echo $scripter;

    
};

?>





<?php


if (isset($_POST['submit'])){

    $scrollupcolor =$_POST['color'];
    $scrollupsize =$_POST['size'];
    $icon =$_POST['icon'];
    $invert = $_POST['invert'];
    $border = $_POST['border'];
    $mobile = $_POST['mobile'];
    $radius = $_POST['radius'];
  
     
    $jsonsettings = '{
        "scrollupcolor" : "'.$scrollupcolor.'",
        "scrollupsize" : "'.$scrollupsize.'",
        "icon" : "'.$icon.'",
        "invert" : "'.$invert.'",
        "border" : "'.$border.'",
        "mobile" : "'.$mobile.'",
        "radius" : "'.$radius.'"
    }';
     
     
    $folder        = GSDATAOTHERPATH . '/scrollup/';
    $filename      = $folder . 'settings.json';
    $chmod_mode    = 0755;
    $folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
     
     if ($folder_exists) {
      file_put_contents($filename, $jsonsettings);
    };

    echo("<meta http-equiv='refresh' content='0'>");
    };

;?>