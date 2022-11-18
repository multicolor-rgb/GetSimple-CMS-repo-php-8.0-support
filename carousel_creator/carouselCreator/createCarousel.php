<?php 
function giveMe(){
  $filecontent = @file_get_contents(GSDATAOTHERPATH. '/createCarousel/sliders.json');

  $resultMe = json_decode($filecontent);

if(isset($resultMe)){
  foreach($resultMe as $res){
  
    global $SITEURL;

    echo'<div class="slider-item">
    <div style="display:grid;grid-template-columns:100px 1fr;gap:10px;align-items:center;">
    <img src="'.$res->name.'"  class="thumbnails">
    <h3 style="font-size:1.2rem;font-weight:400;font-style:italic;margin-top:10px;">'.$res->title.'</h3>
    </div>
    <button class="formerclose"><img src="'.$SITEURL.'plugins/carouselCreator/img/close.svg"></button>
    <button class="formerdrag"><img src="'.$SITEURL.'plugins/carouselCreator/img/drag.svg"></button>
    <div class="cotentdiv"><hr>
    <div style="display:flex;flex-direction:column;">
    <input type="text" name="text[]" value="'.$res->name.'" class="inputer">
    <div>
    <button class="buttonfoto">📷 '.i18n_r('carouselCreator/CHOOSEFILE').'</button>
    <button class="editcontent">📝 '.i18n_r('carouselCreator/EDITCONTENT').'</button></div>
    <div class="listfile">';
  
foreach (glob("../data/uploads/{,*/,*/*/,*/*/*/}*.{jpg,png,gif,bmp,jpeg,webp}",GLOB_BRACE) as $images) {
   
$dater = $SITEURL.'data/uploads/'.basename($images);
$newimagedir=str_replace("../data/uploads/", "" , $images);

$img = '
     <a href="'.str_replace('../', $SITEURL , $images).'" class="thisphoto">
     <img src="'.$images.'" style="width:100%;height:150px;object-fit:cover">
     <br>
     <p>'.$newimagedir.'</p>
     </a>';
        echo $img;
};

echo '
</div>
<div class="content">
<input type="text" name="name[]" value="'.$res->title.'" placeholder="title slider" style="margin-top:20px;width:100%;padding:10px;margin-bottom:20px;box-sizing:border-box;">
<textarea  class="sliderContent" name="content[]">'.$res->content.'</textarea></div>
</div>
</div>
</div>';
 
  };
}
};
;?>

<div
    style="width:100%;padding:10px;box-sizing:border-box;background:#fafafa;border:solid 1px #ddd;margin-bottom:15px;">
    <p style="margin:0;padding:0;">
        <h3 style="margin-bottom:5px;"><?php echo i18n_r('carouselCreator/CAROUSELCREATOR');?></h3>
        <p style="margin:0;"><?php echo i18n_r('carouselCreator/INFO');?>
        </p>
    </div>

    <button class="addSlider"><?php echo i18n_r('carouselCreator/ADDSLIDER');?>
    </button>
    <button class="reorder"><?php echo i18n_r('carouselCreator/REORDER');?></button>

    
<hr style="margin:20px 0;"> 

    <a
        href="<?php global $SITEURL; echo $SITEURL;?>admin/load.php?id=carouselCreator&carouselcreator"
        class="cancelorder"><?php echo i18n_r('carouselCreator/CANCELEDIT');?></a>

    <form action="#" method="post">
        <div id="former" class="former">

            <?php giveMe();?>

        </div>
        <input
            type="submit"
            class="savebtn"
            name="submit"
            value="<?php echo i18n_r('carouselCreator/SAVECAROUSEL');?> 💾"/>
    </form>

    <form
        action="https://www.paypal.com/cgi-bin/webscr"
        class="moneyshot"
        method="post"
        target="_top"
        style="display:grid;grid-template-columns: 1fr 79px;align-items:center;">
        <p style="margin:0;padding:0;"><?php echo i18n_r('carouselCreator/SUPPORT');?> ☕
        </p>
        <input type="hidden" name="cmd" value="_s-xclick"/>
        <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL"/>
        <input
            type="image"
            src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif"
            border="0"
            name="submit"
            title="PayPal - The safer, easier way to pay online!"
            alt="Donate with PayPal button"/>
        <img
            alt=""
            border="0"
            src="https://www.paypal.com/en_PL/i/scr/pixel.gif"
            width="1"
            height="1"/>
    </form>



<?php 

global $sliderArray;
 

if (isset($_POST['submit'])){

 $arsen = [];

 if(isset($_POST['text'])){

  $title = $_POST['text'];
  $titlename = $_POST['name'];
  $content = $_POST['content'];
 

foreach ( $content as $key => $value) {


$folder        = GSDATAOTHERPATH . '/createCarousel/';
$filename      = $folder . 'sliders.json';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
array_push($arsen,['name'=>$title[$key], 'content'=>$content[$key], 'title'=>$titlename[$key]]);
$jser = json_encode($arsen,true);

 if ($folder_exists) {
  file_put_contents($filename, $jser);
}
    };
  }else{

    $folder        = GSDATAOTHERPATH . '/createCarousel/';
$filename      = $folder . 'sliders.json';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
$jser = '';

 if ($folder_exists) {
  file_put_contents($filename, $jser);
}

  };

echo("<meta http-equiv='refresh' content='0'>");
};

;?>

    <script>

        document
            .querySelectorAll('.sliderContent')
            .forEach(c => {

                CKEDITOR.replace(c, {
                    filebrowserBrowseUrl: "filebrowser.php?type=all",
                    filebrowserImageBrowseUrl: "filebrowser.php?type=images",
                    filebrowserWindowWidth: "730",
                    filebrowserWindowHeight: "500",
                    toolbar: "advanced"
                });

            });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script
        src="<?php global $SITEURL; echo $SITEURL;?>plugins/carouselCreator/js/sort.js"></script>

    <script>

        document
            .querySelectorAll('.formerclose')
            .forEach(btn => {
                console.log(btn.parentElement);
                btn.addEventListener('click', (e) => {
                    e.preventDefault;
                    btn
                        .parentElement
                        .remove();
                });

            })

        const former = document.querySelector('.former');
        let counters = 1;

        document
            .querySelector('.addSlider')
            .addEventListener('click', () => {

                let id = 'sliderContent' + counters;

                const forms = `<div class="slider-item">
<div style="display:grid;grid-template-columns:1fr;align-items:center;">
 <h3 style="font-size:1.2rem;font-weight:400;font-style:italic;margin-top:10px;f"><?php echo i18n_r('carouselCreator/NEWSLIDE');?></h3>
</div>
<button class="formerclose" style="right:10px;"><img src="<?php global $SITEURL; echo $SITEURL;?>plugins/carouselCreator/img/close.svg"></button>
<div class="cotentdiv"><hr>
<div style="display:grid;grid-template-columns:1fr 150px;grid-gap:10px;">
<input type="text" name="text[]" placeholder="<?php echo i18n_r('carouselCreator/IMAGEURL');?>" class="inputer" style="width:100%">
<button class="buttonfoto">📷 <?php echo i18n_r('carouselCreator/CHOOSEFILE');?></button>

</div>



<?php 

echo '<div class="listfile">';
  
foreach (glob("../data/uploads/{,*/,*/*/,*/*/*/}*.{jpg,png,gif,bmp,jpeg,webp}",GLOB_BRACE) as $images) {
   
$dater = $SITEURL.'data/uploads/'.basename($images);
$newimagedir=str_replace("../data/uploads/", "" , $images);

$img = '
     <a href="'.str_replace('../', $SITEURL , $images).'" class="thisphoto">
     <img src="'.$images.'" style="width:100%;height:150px;object-fit:cover">
     <br>
     <p>'.$newimagedir.'</p>
     </a>';
        echo $img;
};

echo '
</div>
    ';
?>


<div class="content">
<input type="text" name="name[]"  placeholder="<?php echo i18n_r('carouselCreator/SLIDETITLE');?>" style="margin-top:20px;width:100%;padding:10px;margin-bottom:20px;box-sizing:border-box;">
<textarea id="${id}" class="sliderContent" name="content[]"></textarea></div>
</div>
</div></div>`;

                document
                    .querySelector('.former')
                    .insertAdjacentHTML('beforeend', forms);

                counters++;

                CKEDITOR.replace(id, {
                    filebrowserBrowseUrl: 'filebrowser.php?type=all',
                    filebrowserImageBrowseUrl: 'filebrowser.php?type=images',
                    filebrowserWindowWidth: '730',
                    filebrowserWindowHeight: '500',
                    toolbar: 'advanced'
                });

                document
                    .querySelectorAll('.formerclose')
                    .forEach(btn => {
                        console.log(btn.parentElement);
                        btn.addEventListener('click', (e) => {
                            e.preventDefault();
                            btn
                                .parentElement
                                .remove();
                        });

                    })

                document
                    .querySelectorAll('.listfile')
                    .forEach(x => {

                        x.style.display = "none";

                    });

                document
                    .querySelectorAll('.buttonfoto')
                    .forEach((x, i) => {

                        x.addEventListener('click', (e) => {
                            e.preventDefault();

                            if (document.querySelectorAll('.listfile')[i].style.display == "none") {
                                document
                                    .querySelectorAll('.listfile')[i]
                                    .style
                                    .display = "grid";
                            } else {
                                document
                                    .querySelectorAll('.listfile')[i]
                                    .style
                                    .display = "none"
                            }

                        })

                    });

                document
                    .querySelectorAll('.listfile')
                    .forEach((c, i) => {

                        c
                            .querySelectorAll('.thisphoto')
                            .forEach(x => {
                                x.addEventListener('click', (item) => {
                                    item.preventDefault();

                                    let linker = x.getAttribute('href');

                                    document
                                        .querySelectorAll('.inputer')[i]
                                        .value = linker;
                                    document
                                        .querySelectorAll('.listfile')[i]
                                        .style
                                        .display = "none"

                                })
                            })

                    })

            });

        document
            .querySelectorAll('.formerclose')
            .forEach(btn => {
                console.log(btn.parentElement);
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    btn
                        .parentElement
                        .remove();
                });

            })
    </script>
