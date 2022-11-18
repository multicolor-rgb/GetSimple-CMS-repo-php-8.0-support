<style>
.mb_title{
    width: 100%;
    padding: 10px;
}

.mb_textarea{
    width: 100%;
    height: 400px;
    padding: 10px ;
    box-sizing: border-box;
}

.mb_submit{
    background: #000;
    width:150px;
    color:#fff;
    padding: 10px 15px;
    border:none;

}

.mb_buttons{
    margin-right: 0;
margin-left: auto;
width: auto;
display: flex;
justify-content: end;
gap: 5px;
}

.mb_btngeneral,.mb_btntemplate,.backtolist{
    all: unset;
    background: #000;
    color:#fff;
    padding:10px 15px;
    border:none;
    color:#fff !important;
    text-decoration: none !important;
    cursor: pointer;
}

.backtolist{
    background: #222;
}

.mb_inputs{
    margin: 0 !important;
    padding: 0 !important;
    list-style-type: none;
    width: 100%;
    display: block;
 
    box-sizing: border-box !important;
}

.mb_inputs li,.info{
    display: grid;
    grid-template-columns: 25px 1fr 1fr 1fr 1fr 30px;
    gap: 10px;
    justify-content: space-between;
    align-items: center;
padding: 10px;
box-sizing: border-box;
}

.info{
    text-align: center;
    background: #fafafa;
    border:solid 1px #ddd;
    
margin-top:20px;}

.info p{
    margin: 0;
    padding: 0;

}

.mb_inputs li p{
    font-size: 12px;
    margin: 0 !important;
    padding: 0 !important;
    text-align: center;
    font-weight: bold;
}

.mb_inputs li:nth-child(odd){
    background: #fafafa;
}

.mb_inputs li input,.mb_inputs li select{
    width: 100%;
padding: 5px;
}


.mb_addbtndiv{
    width: 100%;
    margin-top: 20px;

    
}

.mb_close{
    background-color: red;
    font-size: 14px;
    color:#fff; 
    border:none;
    height: 100%;
}


.mb_newinput{
    background: #000 ;
    color: #fff;
    display: inline-block;
    border:none;
    padding:10px 15px;
    cursor: pointer;
}


.mb_inputs li input, .mb_inputs li select{
    box-sizing: border-box;
}

input{
    box-sizing: border-box;
}

</style>

<h3>MultiBlock - <?php echo i18n_r("multiBlock/ADDNEWCATEGORY");?></h3>

<form method="post" >
<input type="text" style="display:none" value="<?php echo str_replace(" ","-",@$_GET['categoryname']);?>" name="check">
<input type="text" required placeholder="<?php echo i18n_r("multiBlock/CATEGORYNAMEPLACEHOLDER");?>" class="mb_title" name="categoryname" value="<?php if(isset($_GET['categoryname'])){echo str_replace('-',' ',@$_GET['categoryname']);}?>">


<hr>

 

<div class="mb_buttons"  style="width:100%;background:#fafafa;display:flex; justify-content:flex-end;padding:5px;box-sizing:border-box;border:solid 1px #ddd;margin-bottom:20px;">
<button class="mb_btngeneral"><?php echo i18n_r("multiBlock/GENERALBTN");?></button>
<button class="mb_btntemplate"><?php echo i18n_r("multiBlock/TEMPLATEBTN");?></button>
<a href="<?php global $SITEURL;echo $SITEURL;?>admin/load.php?id=multiBlock&category" class="backtolist"><?php echo i18n_r("multiBlock/BACKBTN");?></a>
</div>


 




<div class="mb_general">


<div class="mb_addbtndiv">

<button class="mb_newinput"><?php echo i18n_r("multiBlock/ADDNEWBTN");?> ➕</button>

</div>


<div class="info"> 

 

<p><?php echo i18n_r("multiBlock/ID");?></p>
<p><?php echo i18n_r("multiBlock/FIELDNAME");?></p>
<p><?php echo i18n_r("multiBlock/SLUG");?></p>
 <p><?php echo i18n_r("multiBlock/DEFAULTVALUE");?></p>
<p><?php echo i18n_r("multiBlock/FIELDTYPE");?></p>

 

</div>

<ul id="mb_inputs" class="mb_inputs">
 


<?php

 
if(isset($_GET['categoryname'])){
    $cat = file_get_contents(GSDATAOTHERPATH.'multiBlock/category/'.str_replace(" ","-",$_GET['categoryname']).'.json');

 
$multicategory = json_decode($cat);


 $count = 0;
 


foreach ($multicategory as $category){

 echo '
 <li>
 <p>'.@$category->key.'</p>
<input type="text" required class="mb_input" placeholder="'.i18n_r("multiBlock/FIELDNAME").'" value="'.@$category->title.'" name="title[]">
<input type="text" required class="mb_input" placeholder="'.i18n_r("multiBlock/SLUG").'" value="'.@$category->label.'" name="label[]">
<input type="text" class="mb_input" value="'.@$category->value.'" placeholder="'.i18n_r("multiBlock/DEFAULTVALUE").'" name="value[]" >
<select class="mb_input meselect-'.$count.'" name="select[]"  >
<option>text</option>
<option>wysywig</option>
<option>textarea</option>
<option>color</option>
<option>date</option>
<option>image</option>
<option>dropdown</option>
</select>
<button class="mb_close">X</button>
</li>
 <script>document.querySelector(".meselect-'.$count.'").value="'.@$category->select.'"</script>
 ';

 $count++;

}

};

 

;?>



</ul>
</div>


<div class="mb_template">
<b><?php echo i18n_r("multiBlock/TEMPLATE1");?></b>

<div style="width:100%;height:auto;padding:15px;background:#fafafa;border:solid 1px #ddd;margin:10px 0;font-size:12px !important;box-sizing:border-box">

<b><?php echo i18n_r("multiBlock/TEMPLATE2");?></b><br>
<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mbvaluetext('valuename');?&#62; </code> <br>

<b><?php echo i18n_r("multiBlock/TEMPLATE3");?></b><br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mbvalue('valuename');?&#62; </code> <br>

<b><?php echo i18n_r("multiBlock/TEMPLATE4");?></b><br>
<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mborder();?&#62; </code> <br>

<br>


<b><?php echo i18n_r("multiBlock/DROPDOWPLACEHOLDER");?></b><br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mbdropdown('valuename');?&#62; </code> <br>


<b><?php echo i18n_r("multiBlock/DROPDOWNVALUE");?></b>
 <br>


 <code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;">    example 1|example 2|example 3</code> <br>

    
 <br>



 <b><?php echo i18n_r("multiBlock/THUMBNAILPLACEHOLDER");?></b><br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mbthumb('imageslug',300 or different number width);?&#62; </code> <br>


 
    
 <br>


<hr>
<br>

<b><?php echo i18n_r("multiBlock/TEMPLATE5");?></b>
 
<br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php getMultiBlock('categoryname');?&#62; </code> <br>

<br>

<b><?php echo i18n_r("multiBlock/TEMPLATE6");?></b>
 <br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php getMultiBlock('categoryname' , '#idContainer or .classContainer');?&#62; </code> <br>

</div>

<textarea name="template" class="mb_textarea">
    <?php

if(isset($_GET['categoryname'])){
   echo file_get_contents(GSDATAOTHERPATH.'multiBlock/category/'.str_replace(" ","-",$_GET['categoryname']).'.txt');
}

;?>
</textarea>
</div>


<div style="width:100%;background:#fafafa;display:flex; justify-content:flex-end;padding:5px;box-sizing:border-box;border:solid 1px #ddd;margin-top:20px;">

<input type="submit"  name="savecat" class="mb_submit" value="<?php echo i18n_r("multiBlock/SAVECAT");?>">

</div>


</form>




<script>

document.querySelector('.mb_template').style.display="none";



document.querySelector('.mb_btntemplate').addEventListener('click',(btn)=>{
btn.preventDefault();

if(document.querySelector('.mb_template').style.display=="none"){
document.querySelector('.mb_template').style.display="block";
document.querySelector('.mb_general').style.display="none";
}else if( document.querySelector('.mb_template').style.display=="block"){
    document.querySelector('.mb_template').style.display="none";
    document.querySelector('.mb_general').style.display="block";

}

});



document.querySelector('.mb_btngeneral').addEventListener('click',(btn)=>{
btn.preventDefault();

if(document.querySelector('.mb_template').style.display=="block"){
document.querySelector('.mb_template').style.display="none";
document.querySelector('.mb_general').style.display="block";
}else if( document.querySelector('.mb_template').style.display=="none"){
    document.querySelector('.mb_template').style.display="block";
    document.querySelector('.mb_general').style.display="none";

}

});





let count = 0;



document.querySelector('.mb_newinput').addEventListener('click',(btn)=>{
btn.preventDefault();

    const former = `<li >
 <p>auto</p>
 <input type="text" required class="mb_input" placeholder="title" name="title[]">
<input type="text" required class="mb_input" placeholder="slug" name="label[]">
<input type="text" class="mb_input" placeholder="default value" name="value[]" >
<select class="mb_input" name="select[]" >
    <option>text</option>
    <option>wysywig</option>
    <option>textarea</option>
    <option>color</option>
    <option>date</option>
    <option>image</option>
    <option>dropdown</option>
</select>
<button class="mb_close">X</button>
</li>`;

count++;

document.querySelector('.mb_inputs').insertAdjacentHTML('beforeend',former);


document.querySelectorAll('.mb_close').forEach(closebtn=>{
    closebtn.addEventListener('click',x=>{
        x.preventDefault();
        closebtn.parentElement.remove();
    })
})


});


 if(document.querySelector('.mb_inputs li')){
document.querySelector('.mb_inputs li').addEventListener('click',()=>{

    document.querySelectorAll('.mb_input').forEach(x=>{
  });

 })
};


document.querySelectorAll('.mb_close').forEach(closebtn=>{
    closebtn.addEventListener('click',x=>{
        x.preventDefault();
        closebtn.parentElement.remove();
    })
})

</script>


<script src="<?php global $SITEURL; echo $SITEURL;?>plugins/multiBlock/js/Sortable.min.js"></script>

<script>
var el = document.getElementById('mb_inputs');
var sortable = Sortable.create(el,{
    animation:200,
});





document.querySelector('.mb_title').addEventListener('keyup',x=>{

    document.querySelector('form').setAttribute('action', '<?php global $SITEURL;echo $SITEURL;?>admin/load.php?id=multiBlock&addnew&categoryname='+document.querySelector('.mb_title').value)
    
})

</script>


<?php 


if(isset($_POST['savecat'])){



 
$costa ='[';
 
    foreach ($_POST['label'] as $key => $value) {
     
        if($key > 0){
            $costa .= ',';
        }

        $costa .= json_encode([
            'key' => $key,
            'title'=> $_POST['title'][$key],
            'label' => str_replace(" ","-",strtolower($_POST['label'][$key])),
            'value' => $_POST['value'][$key],
            'select' => $_POST['select'][$key],
        ],true);
     


    };

    $costa .=']';
 

    if(isset($_POST['savecat'])){
        $categoryname = str_replace(" ","-",$_POST['categoryname']);
    }else{
        $categoryname = str_replace(" ","-",$_GET['categoryname']);
    }

    $templatedata = @$_POST['template'];



    $folder        = GSDATAOTHERPATH . '/multiBlock/category/';
$filename      = $folder . $categoryname.'.json';
$template    = $folder . $categoryname.'.txt';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode,true);
 
// Save the file (assuming that the folder indeed exists)
if ($folder_exists) {
  file_put_contents($filename, $costa);
  file_put_contents($template, $templatedata);
  echo("<meta http-equiv='refresh' content='0'>");

}


if($_POST['check']!==$_POST['categoryname'] ){
 
    rename(GSDATAOTHERPATH . '/multiBlock/category/'.str_replace(" ","-",$_POST['check']).'.json', GSDATAOTHERPATH . '/multiBlock/category/'.str_replace(" ","-",$_POST['categoryname']).'.json');
    rename(GSDATAOTHERPATH . '/multiBlock/category/'.str_replace(" ","-",$_POST['check']).'.txt', GSDATAOTHERPATH . '/multiBlock/category/'.str_replace(" ","-",$_POST['categoryname']).'.txt');


};

echo("<meta http-equiv='refresh' content='0'>");


}

 
 

;?>