<?php 

$filename = GSDATAOTHERPATH.'/createCarousel/settings.json';
$datee = @file_get_contents($filename);
$data = json_decode($datee);

?>

<script>
   
   if(document.getElementById("slider")){
    var mySwipeElement = document.getElementById("slider");
    window.mySwipe = new Swipe(mySwipeElement, {
      startSlide: 0,
  auto: <?php if(isset($data->autotimer)){echo $data->autotimer;}else{echo '3000';};?>,
  draggable: <?php if(isset($data->draggable)){echo $data->draggable;}else{echo true;};?>,
  autoRestart: <?php if(isset($data->autorestart)){echo $data->autorestart;}else{echo true;};?>,
  continuous: true,
  disableScroll:  <?php if(isset($data->disablescroll)){echo $data->disablescroll;}else{echo true;};?>,
  stopPropagation: true,
  callback: function(index, element) {},
  transitionEnd: function(index, element) {}
    });


          prevBtn = document.querySelector('.slider-prev');
          nextBtn = document.querySelector('.slider-next');
      nextBtn.onclick = mySwipe.next;
     prevBtn.onclick = mySwipe.prev;
   }





    </script>