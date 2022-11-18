<?php 
$path = (isset($_GET['path'])) ? $_GET['path'] : "";
 

global $SITEURL;

;?>

 
<script>if(document.querySelector(".uploadform")){document.querySelector(".uploadform").outerHTML = `
<div style="background:#182227;padding:10px;border-radius:5px;color:#fff;">
<h3 style="color:#fff;text-shadow:0 0 0;">Upload file</h3>

<form action="upload.php?path=<?php echo $path ;?>"   method="POST" enctype="multipart/form-data">
<div style="background:rgba(0,0,0,0.4);padding:10px;box-sizing:border-box;border:solid 1px #ddd;border-radius:5px;">
<input type="file"   name="filer[]" multiple style="width:100%;text-overflow: ellipsis;"> 
</div>
    <div class="compress" style="background: rgba(0,0,0,0.4);width:100%;padding:10px;border:solid 1px #fff;margin:10px 0;color:#fff;box-sizing:border-box;border-radius:5px;">
   
    <label for="compress" style="color:#fff" style="margin-bottom:10px;margin-top:5px;sfont-size:11px;">Compress photo? </label>
    <input type="checkbox" name="compress">
    
    <input type="text" placeholder="width in pixel (without px)"  style="width:100%;display:block;margin:10px 0;padding:5px;box-sizing:border-box;" name="compressvalue">

    </div>
   
    <div class="webp" style="background: rgba(0,0,0,0.4);width:100%;padding:10px;border:solid 1px #fff;border-radius:5px;margin:10px 0;color:#fff;box-sizing:border-box;">
    <label for="webp" style="color:#fff;margin-bottom:10px;">convert photo to .webp?</label><input type="checkbox" name="webp"></div>


     <input type="submit" style="width:100%;
     height:40px; border:none;color:#fff;border-radius:5px; border:none;background:#CF3805;" value="Upload" name="fileUploader"></form></div>`;}</script>
 

 <script>

document.querySelector('input[name="compress"]').addEventListener('click',function(){

    if(this.checked == true){
document.querySelector('.webp').style.display="none";
    }else{
        document.querySelector('.webp').style.display="block";

    }

});

document.querySelector('input[name="webp"').addEventListener('click',function(){

if(this.checked == true){
document.querySelector('.compress').style.display="none";
}else{
    document.querySelector('.compress').style.display="block";

}

});

</script>
 
<?php

 
$ds   = DIRECTORY_SEPARATOR;
$path = (isset($_GET['path'])) ? $_GET['path'] : "";

$storeFolder = '../data/uploads/'.$path;   
 



if(isset($_POST['fileUploader'])){

    


if (!empty($_FILES)) {


$ds   = DIRECTORY_SEPARATOR;
$path = (isset($_GET['path'])) ? $_GET['path'] : "";
$storeFolder = '../data/uploads/'.$path.'/';   
$count = 0;


foreach($_FILES['filer']['tmp_name'] as $key => $tmp_name)
{

$tempFile = $_FILES['filer']['tmp_name'][$count];
$basename = basename($_FILES['filer']['name'][$count]);
$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
$filetype = finfo_file($fileinfo, $tempFile);


$allowedTypes = [
    'audio/aac' => 'aac',
    'application/x-abiword' => 'aac',
    'application/x-freearc' => 'arc',
    'image/avif' => 'avif',
    'video/x-msvideo' => 'avi',
    'application/vnd.amazon.ebook' => 'azw',
    'image/bmp' => 'bmp',
    'text/css' => 'css',
    'text/csv' => 'csv',
    'application/msword' => 'doc',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
    'application/vnd.ms-fontobject' => 'eot',
    'application/gzip' => 'gz',
    'image/gif' => 'gif',
    'image/vnd.microsoft.icon' => 'ico',
    'image/jpeg' => 'jpg',
    'image/jpeg' => 'jpeg',
    'audio/mpeg' => 'mp3',
    'video/mp4' => 'mp4',
    'video/mpeg' => 'mpeg',
    'application/vnd.oasis.opendocument.presentation' => 'odp',
    'application/vnd.oasis.opendocument.spreadsheet' => 'ods',
    'application/vnd.oasis.opendocument.text' => 'odt',
    'audio/ogg' => 'ogg',
    'video/ogg' => 'ogv',
    'application/ogg' => 'ogx',
    'audio/opus' => 'opus',
    'font/otf' => 'otf',
    'image/png' => 'png',
    'application/pdf' => 'pdf',
    'application/vnd.ms-powerpoint' => 'ppt',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
    'application/vnd.rar' => 'rar',
    'application/rtf' => 'rtf',
    'image/svg+xml' => 'svg',
    'application/x-tar' => 'tar',
    'image/tiff' => 'tif',
    'image/tiff' => 'tiff',
    'font/ttf' => 'ttf',
    'text/plain' => 'txt',
    'audio/wav' => 'wav',
    'audio/webm' => 'weba',
    'audio/webm' => 'webm',
    'image/webp' => 'webp',
    'font/woff' => 'woff',
    'font/woff2' => 'woff2',
    'application/zip' => 'zip',
    'video/3gpp' => '3gp',
    'application/x-7z-compressed' => '7z',
    'video/quicktime' => 'mov',

 ];
 $extension = $allowedTypes[$filetype];

 
 #check file support

 if(!in_array($filetype, array_keys($allowedTypes))) {

    echo'<div class="success-glass" style=" display:flex;align-items:center;justify-content:center;position:fixed;top:0;left:0;width:100%;height:100vh;background-color:rgba(0,0,0,0.9);z-index:2;"><div style="text-align:center"><img src="'.$SITEURL.'/plugins/uploaderExt/img/error.svg" style="filter:invert(100%);width:100px;display:block;margin:0 auto;margin-bottom:20px;"><h3 style="color:#fff;text-align:center;text-shadow:unset;">unsuported file</h3></div></div>';
echo("<meta http-equiv='refresh' content='1'>");


    die();
 }


## $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
$targetPath = $storeFolder;
$targetFile =  $targetPath.$_FILES['filer']['name'][$count];  

##check space 
$targetNameWithoutSpace = $targetPath.str_replace(" ", "-", $_FILES['filer']['name'][$count]);



#check file exist 
if(file_exists($targetFile)){ 
   $name = pathinfo($targetNameWithoutSpace,PATHINFO_FILENAME);
    $targetNameWithoutSpace = $targetPath.$name.'-'.rand(1,1000).'.'.$extension;
 

}

#replace big letter to lower
$targetFile = strtolower($targetNameWithoutSpace);

#upload files
move_uploaded_file($tempFile,$targetFile); 
 

#if compress used
if(isset($_POST['compress'])){
    $compressUser = $_POST['compressvalue'];
    $original = $targetFile;
    $original_dimensions = getimagesize($original);
    $width = $original_dimensions[0];
    $height = $original_dimensions[1];
    $aspect = $width/$compressUser;
    $new_width = $compressUser;
    $new_height = $height/$aspect;
    $small = imagecreatetruecolor($new_width, $new_height);

if(exif_imagetype($targetFile) == IMAGETYPE_JPEG){
   
$source = imagecreatefromjpeg($original);
imagecopyresampled($small, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);


imagejpeg($small, $targetFile);

};

if(exif_imagetype($targetFile) == IMAGETYPE_PNG){

    $source = imagecreatefrompng($original);
    imagecopyresampled($small, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    imagepng($small, $targetFile);
    };
 
    if(exif_imagetype($targetFile) == IMAGETYPE_GIF){

        $source = imagecreatefromgif($original);
        imagecopyresampled($small, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagegif($small, $targetFile);
        };


    };
    #end compress used


    
    if(isset($_POST['webp'])){



$dir = pathinfo($targetFile, PATHINFO_DIRNAME);
$name = pathinfo($targetFile, PATHINFO_FILENAME);
$destination = $targetPath . DIRECTORY_SEPARATOR . $name . '.webp';
$info = getimagesize($targetFile);
$isAlpha = false;
if(exif_imagetype($targetFile) == IMAGETYPE_JPEG){
$image = imagecreatefromjpeg($targetFile);
};

if(exif_imagetype($targetFile) == IMAGETYPE_GIF){
$image = imagecreatefromgif($targetFile);
};

if(exif_imagetype($targetFile) == IMAGETYPE_PNG){
$image = imagecreatefrompng($targetFile);
}; 
if ($isAlpha) {
imagepalettetotruecolor($image);
imagealphablending($image, true);
imagesavealpha($image, true);
}

$quality = 80;


imagewebp($image, $destination, $quality);

unlink($targetFile);

    };


$count=$count + 1; 
                    
};



};

 
echo'<div class="success-glass" style=" display:flex;align-items:center;justify-content:center;position:fixed;top:0;left:0;width:100%;height:100vh;background-color:rgba(0,0,0,0.9);z-index:2;"><div style="text-align:center"><img src="'.$SITEURL.'/plugins/uploaderExt/img/success.svg" style="filter:invert(100%);width:100px;display:block;margin:0 auto;margin-bottom:20px;"><h3 style="color:#fff;text-align:center;text-shadow:unset;">success!</h3></div></div>';
echo("<meta http-equiv='refresh' content='1'>");


}
 
 
 ?>