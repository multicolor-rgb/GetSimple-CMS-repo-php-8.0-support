<style>
    
    

/*listfile */


.listfile{
    width:100%;height:300px;overflow-y: scroll;background:#ddd;margin-top:20px;color:#000;padding:10px;
    display:grid;
    grid-template-columns: repeat(3,minmax(200px,1fr));
    gap:10px;
    align-items: flex-start;
}

.thisphoto{
    text-align:center;cursor:pointer;
    width:100%;
    display: block;
    word-break: break-all;
   color:#000 !important;
   text-decoration: none !important;
   font-weight: 300 !important;
   font-size:12px !important;
}

.thisphoto:hover{
    background: rgba(0,0,0,0.1);
    font-weight: 300 !important;
    font-weight: normal !important;
    text-decoration: none !important;
}
    
</style>

<?php 


if(isset($_GET['namefile'])){
    $datas = file_get_contents(GSDATAOTHERPATH.'multiBlock/'.str_replace(" ","-",@$_GET['newmulticategory']).'/'.@str_replace(" ","-",$_GET['namefile']).'.json');
$dater = json_decode($datas);

 
} 

;?>

<style>
    .mbformer input {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        margin: 10px 0;
    }

    .mbformer h4 {
        font-size: 1.2rem;
        font-weight: 400;

    }

    .mb_img {
        display: grid;
        grid-template-columns: 80px 1fr 200px;
        align-items: center;
        gap:10px;
        margin-top: 10px;
      

    }

    .mb_img img{
        outline: 1px solid #BABABA;
outline-offset: 3px;
background-color: #ddd;
border: none;
    }

    .mb_img .mb_fotobtn {
        height: 40px;
        border: none;
        background: #000;
        color: #fff;
    }
</style>

<h3><?php echo i18n_r("multiBlock/EDITBLOCK");?></h3>

<form method="POST" class="mbformer">

<div style="background:#fafafa;border:solid 1px #ddd; padding:10px;">
<?php echo i18n_r('multiBlock/SECTION');?>: <input
        type="text"
        name="cat"
        class="cat"
        disabled="disabled"
        style="width:200px;border:none;margin:0;font-size:13px;padding:0;"
        value="<?php echo @$_GET['newmulticategory'];?>">
</div>
  
    <input
        type="text"
        style="display:none"
        name="nameolder"
        class="namefileolder"
        placeholder="title"
        value="<?php echo str_replace("-"," ",@$_GET['namefile']);?>">
    
    <h4 style="margin-top:20px"><?php echo i18n_r("multiBlock/BLOCKTITLE");?></h4>
    
    <input
        type="text"
        required="required"
        name="name"
        class="namefile"
        placeholder="title"
        value="<?php if(isset($_GET['namefile'])){echo str_replace("-"," ",@$_GET['namefile']);}?>">

    <hr>

    <h4 style="margin-top:20px;margin-bottom:10px;"><?php echo i18n_r("multiBlock/OPTIONS");?></h4>

<?php 

if(isset($_GET['newmulticategory'])){

    $cat = file_get_contents(GSDATAOTHERPATH.'multiBlock/category/'.str_replace(" ","-",$_GET['newmulticategory']).'.json');
    $multicategory = json_decode($cat);
    
 
$multicategory = json_decode($cat);


 $count = 0;

 

foreach ($multicategory as $category){
     $nis = str_replace(" ","",$category->label);

   

     if(isset($dater)){
        $valer = $dater->$nis;

    }else{
        $valer=$category->value;
    }
     
    
 


 
    if($category->select == 'wysywig'){


        echo '<p style="margin: 0;
  margin:0;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;
margin-bottom:5px;">'.$category->title.' :</p>
 
        <textarea id="post-content" name="'.str_replace(" ","",$category->label).'" style="width:100%;display:block;height:250px;" class="mbinput">'.html_entity_decode($valer).'</textarea>
        
 
'; }elseif($category->select == 'image'){


   

    global $SITEURL;

    echo'<span class="formedit">';
        echo '<p style="margin: 0;
  margin-top: 0px;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;">'.$category->title.' :</p>


        <div class="mb_img">';

        if($valer!=='undefined'){
            echo' <img src="'.$valer.'" style="width:80px;height:80px;object-fit:cover;">';
         };
 

        echo '
        <input type="text" class="mb_foto foto mbinput" name="'.str_replace(" ","",$category->label).'" value="'.$valer.'">
        
        <button class="mb_fotobtn choose-image">'.i18n_r("multiBlock/CHOOSEIMAGE").'</button>

        </div>
    
        ';


        
 echo "
  
 <div class='listfile'>
  ";

  
foreach (glob("../data/uploads/{,*/,*/*/,*/*/*/}*.{jpg,png,gif,bmp,jpeg,webp}",GLOB_BRACE) as $images) {
    $daterx = $SITEURL.'data/uploads/'.basename($images);
     $newimagedir=str_replace("../data/uploads/", "" , $images);
    
    
        $img = '
     <a href="'.str_replace('../', $SITEURL , $images).'" class="thisphoto">
     <img src="'.$images.'" style="width:100%;height:150px;object-fit:cover">
     <br>
     
     <p>'.$newimagedir.'</p>
    
     </a>
        
        ';
    
        echo $img;
    
    
    };


 
 echo "
 </div>

 </span>

 ";
 



    }elseif($category->select == 'textarea'){
     
    
 
            echo '<p style="margin: 0;
  margin-top: 0px;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;display:inline-block;">'.$category->title.' :</p>


 
            <textarea class="mbinput" style="width:100%;height:250px;" name="'.str_replace(" ","",$category->label).'">'.html_entity_decode($valer).'</textarea>';
        
     
    }elseif($category->select == 'dropdown'){

        

        


      $ars = explode( '|', $category->value );
    
      echo '<p style="margin: 0;
      margin-top: 0px;
    margin-top: 20px;
    font-weight: 400px;
    font-size: 15px;display:inline-block;">'.$category->title.' :</p>';
    
    echo '<select style="width:100%;padding:10px;" class="'.str_replace(" ","",$category->label).'" name="'.str_replace(" ","",$category->label).'">';
    
        foreach($ars as $sel){
 
         

            echo '<option value="'.str_replace(" ","^",$sel).'" >'.$sel.'</option>';

        }

    echo'</select>';


 echo '<script>
 
 document.querySelector("select.'.str_replace(" ","",$category->label).'").value = "'.str_replace(" ","^",$valer).'"; </script>';
    
    
    
    }else{

        
     
    

        echo '<p style="margin: 0;
  margin:0;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;">'.$category->title.' :</p>


        <input class="mbinput" type="'.$category->select.'" name="'.str_replace(" ","",$category->label).'" value="'.html_entity_decode($valer).'">
        
        ';
    

    }
 

}

};

 


;?>

<div style="backgorund:#fafafa;border:solid 1px #ddd;padding:10px;box-sizing:border-box;display:flex;margin-top:10px;">
<input
        type="submit"
        name="saveblock"
        style="width:200px;background:#000;color:#fff;margin:0; border:none;" value="<?php echo i18n_r("multiBlock/UPDATE");?>">
</div>
</form>

<script>

    document
        .querySelector('form')
        .setAttribute(
            'action',
            '<?php global $SITEURL;echo $SITEURL;?>admin/load.php?id=multiBlock&newblock&newmulticategory=' + document.querySelector('.cat').value +
                    '&namefile=' + document.querySelector('.namefile').value
        );

    document
        .querySelector('.namefile')
        .addEventListener('keyup', () => {

            document
                .querySelector('form')
                .setAttribute(
                    'action',
                    '<?php global $SITEURL;echo $SITEURL;?>admin/load.php?id=multiBlock&newblock&newmulticategory=' + document.querySelector('.cat').value +
                            '&namefile=' + document.querySelector('.namefile').value.replace(/ /g, "-")
                );

        });
</script>

<?php 

$coner = 0;

if(isset($_POST['saveblock'])){

    $costa ='{';
 
    foreach ($_POST as $key => $value) {
     
        if($coner > 0){
            $costa .= ',';
        }

      $costa .= '"'.$key.'":"'.trim(preg_replace('/\s\s+/', ' ',htmlentities($value))).'"';
      

        $coner++;

    };

    $costa .='}';

    $owncategory = $_GET['newmulticategory'];

    $name = str_replace(" ","-", $_POST['name']);


$folder        = GSDATAOTHERPATH . 'multiBlock/'.$owncategory.'/';
$filename      = $folder .$name.'.json';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
 
// Save the file (assuming that the folder indeed exists)
if ($folder_exists) {
  file_put_contents($filename, $costa);


  echo("<meta http-equiv='refresh' content='0'>");


}

 

if($_POST['nameolder']!==''){
    if($_POST['nameolder']!==$_POST['name']){
 
        rename($folder.str_replace(" ","-",$_POST['nameolder']).'.json', $folder.str_replace(" ","-",$_POST['name']).'.json');
        
        };
}

 
echo("<meta http-equiv='refresh' content='0'>");

}




;?>

<script type="text/javascript" src="template/js/ckeditor/ckeditor.js?t=3.3.16"></script>

<script type="text/javascript">

    document
        .querySelectorAll(`#post-content`)
        .forEach(c => {

            var editor = CKEDITOR.replace(c, {
                skin: 'getsimple',
                forcePasteAsPlainText: true,
                language: 'en',
                defaultLanguage: 'en',
                entities: true,
                // uiColor : '#FFFFFF',
                height: '300px',
                baseHref: '<?php global $SITEURL;echo $SITEURL;?>',
                tabSpaces: 10,
                filebrowserBrowseUrl: 'filebrowser.php?type=all',
                filebrowserImageBrowseUrl: 'filebrowser.php?type=images',
                filebrowserWindowWidth: '730',
                filebrowserWindowHeight: '500',
                toolbar: 'advanced'
            });
        });
</script>

<script>

    if (document.querySelector('.mb_foto') !== null) {

        document
            .querySelectorAll('.formedit')
            .forEach((e, i) => {
                e
                    .querySelector('.listfile')
                    .style
                    .display = 'none';
                e
                    .querySelector('.choose-image')
                    .addEventListener('click', y => {
                        y.preventDefault();
                        e
                            .querySelector('.listfile')
                            .style
                            .display = 'grid';
                    })

                e
                    .querySelectorAll('.thisphoto')
                    .forEach(x => {
                        x.addEventListener('click', g => {
                            g.preventDefault();
                            const namer = x.getAttribute('href');
                            e
                                .querySelector('.foto')
                                .value = namer;
                            e
                                .querySelector('.listfile')
                                .style
                                .display = 'none'
                        })
                    })
            })

    }
</script>





 