<?php 

$filename = GSDATAOTHERPATH.'/scrollup/settings.json';
$datee = @file_get_contents($filename);
$data = json_decode($datee);
global $SITEURL;

?>


<style>
html,body{
    scroll-behavior: smooth;
}
.scrollup{
    position: fixed;
    z-index: 999;
    bottom: 10px;
    right:10px;
    background: <?php echo $data->scrollupcolor;?>;
    width:<?php echo $data->scrollupsize;?>px;
    height:<?php echo $data->scrollupsize;?>px;
    padding: 5px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 250ms linear;
  transform: translate(100px,0);
  <?php echo $data->border;?>;
  <?php echo $data->radius;?>
}

.scrollup:hover{
    box-shadow: 1px 1px 10px rgba(0, 0,0,0.1);
}

.scrollup img{
    width: 90%;
    height: 90%;
    filter:invert(<?php echo $data->invert;?>);
}

@media(max-width:960px){

    .scrollup{
        display:<?php echo $data->mobile;?>
    }

}

</style>

<a href="#" class="scrollup">
    <img src="<?php echo $SITEURL.'plugins/scrollup/img/up'.$data->icon.'.svg';?>">
</a>


<script>
    window.addEventListener('scroll',()=>{
        
        if(window.scrollY >=100){
            document.querySelector('.scrollup').style.transform = 'translate(0,0)'
        }else{
            document.querySelector('.scrollup').style.transform = 'translate(100px,0)'

        }

    })
</script>