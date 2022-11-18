<?php 



function runCarousel(){
global $SITEURL;
 
$datee = @file_get_contents(GSDATAOTHERPATH.'/createCarousel/settings.json');
$data = json_decode($datee);
 
$filecontent = @file_get_contents( GSDATAOTHERPATH.'/createCarousel/sliders.json');
$resultMe = json_decode($filecontent);
 
 
 

if(file_exists(GSDATAOTHERPATH.'/createCarousel/settings.json')){

 echo '<style>

 .slider-item{
  height:'.$data->height.';
 }
 .slider-fog{
  background:rgba(0,0,0,'.$data->fog.');
 }
 </style>';

};

 

    echo '<div class="slider-container">';
    echo '<div id="slider" class="swipe">';
    echo '<div class="swipe-wrap">';


    if(isset($resultMe)){

    foreach($resultMe as $res){

      echo'<div class="slider-item" style="background:url('.$res->name.');background-size:cover;background-position:center center;">';
      echo'<div class="slider-fog">';
echo'<div class="slider-item-content">'.$res->content.'</div>';
     echo'</div>';
     echo'</div>';


    };

  };

    echo '</div></div><button class="slider-prev" ><img src="'.$SITEURL.'plugins/carouselCreator/img/left.svg"></button>';
    echo '<button class="slider-next" ><img src="'.$SITEURL.'plugins/carouselCreator/img/right.svg"></button></div>';


};

?>


<script>

if(document.querySelector(".carousel-replace")){
  document.querySelector(".carousel-replace").outerHTML = `<?php runCarousel();?>`
}
</script>
