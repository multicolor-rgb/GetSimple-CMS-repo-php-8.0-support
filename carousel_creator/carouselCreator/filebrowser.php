<div class='listfile'>
  
  <?php foreach (glob("../data/uploads/{,*/,*/*/,*/*/*/}*.{jpg,png,gif,bmp,jpeg,webp}",GLOB_BRACE) as $images) {
     
  $dater = $SITEURL.'data/uploads/'.basename($images);
  
$img = '
       <a href="'.str_replace('../', $SITEURL , $images).'" class="thisphoto">
       <img src="'.$images.'" style="width:100%;height:150px;object-fit:cover">
       <br>
       <p>'.$newimagedir.'</p>
       </a>';
  
          echo $img;
  
  
  };?>

  </div>
