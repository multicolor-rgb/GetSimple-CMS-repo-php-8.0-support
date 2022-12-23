<?php 

$filename = GSDATAOTHERPATH.'/massiveOwnFooter/OwnFooter.json';
$datee = @file_get_contents($filename);
$data = json_decode($datee);

;?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<style>
#ownfooterform{
    width:100%;
   
    background:#fafafa;
    border:solid 1px #ddd;
    padding:10px;
}

#ownfooterform input{
    width:100%;
    padding:5px;
    margin:10px 0;
}


#ownfooterform input[type="submit"]{
    background: #000;
    color:#fff;
    border:none;
    padding:10px;
}


#ownfooterform input[type="checkbox"]{
  all:revert;
  padding: 0;
}
</style>
<h3><?php echo i18n_r('massiveAdmin/OWNFOOTERTITLE');?></h3>



<form id="ownfooterform" action="#" method="POST"  enctype="multipart/form-data">

<div style="background:#ddd;padding:10px;display:flex;aling-items:center;margin-bottom:10px;justify-content:space-between;border:solid 1px #111;">
<label for="turnon" style="margin-top: 2px;"><?php echo i18n_r('massiveAdmin/TURNON');?></label>
<input type="checkbox" name="turnon" class="checkbox" value="true">

</div>

<label for="ownfootername"><?php echo i18n_r('massiveAdmin/OWNFOOTERNAME');?> </label>
<input type="text" value="<?php echo $data->ownfootername?? '';?>" name="ownfootername">

<label for="ownfootericon"><?php echo i18n_r('massiveAdmin/OWNFOOTERICON');?></label>
<input type="file" name="ownfootericon">

<label for="ownlogo"><?php echo i18n_r('massiveAdmin/OWNLOGO');?></label>

<select name="ownlogo" class="ownlogo" style="width:100%;padding:5px;margin:10px 0;"><br>
<option value="yes"><?php echo i18n_r('massiveAdmin/YES');?></option>
<option value="no" ><?php echo i18n_r('massiveAdmin/NO');?></option>
</select>


<label for="ownfooterlink"><?php echo i18n_r('massiveAdmin/OWNFOOTERLINK');?></label>


<input type="text" value="<?php echo $data->ownfooterlink ?? '';?>" style="margin-top:10px;display:block;" name="ownfooterlink">






<label for="ownheader"><?php echo i18n_r('massiveAdmin/OWNFOOTERHEADER');?></label>

<textarea name="ownheader" style="width:100%;height:200px;margin-top:10px; display:block;">
<?php echo $data->ownheader ?? '';?>
</textarea>

<br>

<label for="ownfooter"><?php echo i18n_r('massiveAdmin/OWNFOOTERFOOTER');?></label>

<textarea name="ownfooter" style="width:100%;height:200px;margin-top:10px;display:block;">
<?php echo $data->ownfooter ?? '';?>
</textarea>

<br>
<label>Change color CMS</label>
<div class="colors" style="background:#ddd;padding:5px;display:flex;aling-items:center;margin:20px 0;justify-content:space-between;border:solid 1px #111;flex-wrap:wrap;">

<div class="colors-item" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:5px;">

<label for="turncolor"><?php echo i18n_r('massiveAdmin/TURNON');?></label>
<input type="checkbox" class="turncolor" value="true" name="turncolor">

</div>

<div class="colors-item" style="width:50%;padding:10px;">
<label for="ownmaincolor">Main color</label>
<input type="color" value="<?php echo $data->maincolor ?? '';?>" name="maincolor">
</div>

<div class="colors-item" style="width:50%;padding:10px;">
<label for="ownmaincolor">Background color</label>
<input type="color" value="<?php echo $data->bgcolor ?? '';?>" name="bgcolor">
</div>

</div>


<input type="submit" name="submit" value="<?php echo i18n_r('massiveAdmin/SAVEOPTION');?>">
</form>



 



<script>

const checkbox = '<?php echo $data->turnon;?>';
 const turncolor = '<?php echo $data->turncolor;?>';

 if( turncolor == 'true'){
document.querySelector('.turncolor').checked = true;
}else{
document.querySelector('.turncolor').checked = false;
}


if( checkbox == 'true'){
document.querySelector('.checkbox').checked = true;
}else{
document.querySelector('.checkbox').checked = false;
}


if( "<?php echo $data->ownlogo;?>" == "yes"){
  document.querySelector(".ownlogo").value = "yes";

}else{
  document.querySelector(".ownlogo").value = "no";

}


</script>



<?php
if(isset($_POST['submit'])){
            $turnon = $_POST['turnon'];
            if($turnon == 'true'){
                $turnon="true";
            }else{
                $turnon="false";
            };

            $ownfootername = $_POST['ownfootername'];
            $ownlogo = $_POST['ownlogo'];
            $ownheader = $_POST['ownheader'];
            $ownheadernew =  json_encode($ownheader, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            $ownfooter = $_POST['ownfooter'];
            $ownfooternew =  json_encode($ownfooter, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            $ownfootericon = $_FILES["ownfootericon"]["name"];

            $maincolor = $_POST['maincolor'];
            $bgcolor = $_POST['bgcolor'];
            $turncolor = $_POST['turncolor'];
            if($turncolor == 'true'){
              $turncolor="true";
          }else{
              $turncolor="false";
          };


            if($ownfootericon==""){
            $ownfootericon = $data->ownfootericon;
            }
            

            $ownfooterlink = $_POST['ownfooterlink'];
      

            $json = '{
            "turnon": "'.$turnon.'",
            "ownfootername": "'.$ownfootername.'",
            "ownfootericon": "'.$ownfootericon.'",
            "ownfooterlink": "'.$ownfooterlink.'",
            "ownlogo": "'.$ownlogo.'",
            "ownheader": '.$ownheadernew.',
            "ownfooter": '.$ownfooternew.',
            "turncolor": "'.$turncolor.'",
            "bgcolor": "'.$bgcolor.'",
            "maincolor": "'.$maincolor.'"
            }';


     


            $massiveOwnFooterFolder = GSDATAOTHERPATH.'/massiveOwnFooter/';
            $filejson ='OwnFooter.json';
            $finaljson = $massiveOwnFooterFolder.$filejson;
            $chmod_mode    = 0755;
            $folder_exists = file_exists( $massiveOwnFooterFolder) || mkdir( $massiveOwnFooterFolder, $chmod_mode);



           
            file_put_contents($finaljson , $json);

            $massiveOwnFooterFolderFoto = GSPLUGINPATH.'/massiveAdmin/footerfoto/';

            $target_dir =  $massiveOwnFooterFolderFoto;
            $target_file = $target_dir . basename($_FILES["ownfootericon"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {

              $check = getimagesize($_FILES["ownfootericon"]["tmp_name"]);
              if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "File is not an image.";
                $uploadOk = 0;
              }
            }            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }
            
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
            } else {
              if (move_uploaded_file($_FILES["ownfootericon"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["ownfootericon"]["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }
            
         echo("<meta http-equiv='refresh' content='0'>");

            
        };?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="display:grid; width:100%;grid-template-columns:1fr auto; padding:10px;background:#fafafa;border:solid 1px #ddd;margin-top:20px;">
				<p style="margin:0;padding:0;"> <?php echo i18n_r("massiveAdmin/SUPPORT");?></p>
				<input type="hidden" name="cmd" value="_s-xclick" />
				<input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
				<img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
			</form>
