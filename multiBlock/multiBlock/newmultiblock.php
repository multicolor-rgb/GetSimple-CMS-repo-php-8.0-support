<style>
.mb_category{
    width: 100%;
    padding: 10px;
    border: none;
    background: #fafafa;
    border:solid 1px #ddd;
}

.cats{
    display: grid;
    grid-template-columns: 1fr 150px;
    gap:10px;
    border:none;
}

.choosecat{
    background: #000;
    border: none;
    color:#fff;
    padding:10px 15px;
    box-sizing: border-box;
}

.mb_catlist ul{
display: flex;
flex-direction: column;
margin-top: 30px;
margin: 0 !important;
padding: 0 !important;
}

.mb_catlist ul li{
    display: grid;
    grid-template-columns: 1fr 50px 50px;
    justify-content: space-between;
    align-items: center;
padding: 10px;
}

.mb_catlist p{
    font-size:15px;
    margin: 0 !important;  
    padding: 0 !important;
    font-weight: 400;
}

.mb_catlist li:nth-child(odd){
    background: #fafafa;
}


.addnewblock {
  width: 150px;
  background: #000;
  padding: 10px 15px;
  color: #fff !important;
  border: none;
  display: inline-block;
  text-align: center;
  text-decoration: none !important;
  margin-bottom: 40px;
}


.mb_edit{
all:unset;
    background: #000;
display: inline-flex;
align-items: center;
justify-content: center ;
text-decoration: none !important;
color:#fff !important;
height:auto;
border:none !important;
margin-right:10px;
text-align: center;
cursor: pointer;
padding:10px;
 
box-sizing: border-box;

}

.mb_edit_delete{
    background: red;
    border:none;
}


.button-3{
    padding:10px 15px;
    background: #000;
    color:#fff;
    border:none;
}

    </style>

<h3><?php echo i18n_r("multiBlock/MULTIBLOCKSECTION");?></h3>

<form method="post" class="cats">

<select class="mb_category" name="category">
 
    

    <?php 

foreach (glob(GSDATAOTHERPATH."/multiBlock/category/*.json") as $filename) {

    $info = pathinfo($filename);
    $namevalue = str_replace(' ','-',basename($filename,'.'.$info['extension']));
    $name = str_replace('-',' ',basename($filename,'.'.$info['extension']));
 
    echo '<option value="'.$namevalue.'">'.$name.'</option>';

}

;?>

</select>

<input type="submit" name="choosecat" class="choosecat" value="<?php echo i18n_r("multiBlock/CHOOSESECTION");?>">

</form>


 








<div class="mb_catlist">




<?php 


$counterlist = 0;

 if(isset($_GET['newmulticategory']) || isset($_GET['refresh']) ){


echo '<div style="width:100%;margin-top:20px;">

<a class="addnewblock">'.i18n_r("multiBlock/ADDNEWBTN2").' ➕</a>

</div>';


    echo '<br>
<h3>'.i18n_r("multiBlock/MULTIBLOCKIN").'</h3>
<br>
<ul id="mb_catlist_list" class="mb_catlist_list">
';


    foreach (glob(GSDATAOTHERPATH."/multiBlock/".str_replace(" ","-",$_GET['newmulticategory'])."/*.json") as $filename) {
 global $SITEURL;
        $info = pathinfo($filename);
        $namevalue = str_replace(' ','-',basename($filename,'.'.$info['extension']));
        $name = str_replace('-',' ',basename($filename,'.'.$info['extension']));
     

        echo '<li data-id="'.$counterlist.'"><p>'.$name.'</p>
        

        <a href="'.$SITEURL.'admin/load.php?id=multiBlock&newblock&newmulticategory='.$_GET['newmulticategory'].'&namefile='.$name.'" class="mb_edit" style="width:45px;">'.i18n_r("multiBlock/EDIT").'</a>

        <form method="post"  onclick="return confirm(`Are you sure?`);" 
        style="display:inline-flex" 
        action="'.$SITEURL.'admin/load.php?id=multiBlock&newmultiblock&newmulticategory='.@$_GET['newmulticategory'].'&refresh">

        <input type="text"  style="display:none;" name="delthis" value="'.basename($filename,'.'.$info['extension']).'">

        <input type="submit" name="delthisbtn" value="'.i18n_r("multiBlock/DELETE").' " class="mb_edit mb_edit_delete"> 
        </form>
        
        </li>';

        $counterlist++; 
    
    }



 } 
 echo'</ul>';


 if(isset($_GET['newmulticategory'])){
global $SITEURL;
    echo'
     
    <form method="post" style="margin-top:20px;" action="'.$SITEURL.'admin/load.php?id=multiBlock&newmultiblock&newmulticategory='.$_GET['newmulticategory'].'">
    <input type="text" style="display:none" class="array" name="array" value="'. @file_get_contents(GSDATAOTHERPATH . 'multiBlock/'.$_GET['newmulticategory'].'/order.txt').'">
    <input type="submit" class="button-3" value="'.i18n_r("multiBlock/SAVEORDER").' 🎢" name="saveorder">
    </form>
    ';
    

 }
 
 ;?>
 



<script>

const arraylist = '<?php echo @file_get_contents(GSDATAOTHERPATH . 'multiBlock/'.$_GET['newmulticategory'].'/order.txt');?>';
const arraychange = arraylist.split(',');



arraychange.forEach((x,i)=>{
if(document.querySelector(`.mb_catlist_list li[data-id="${x}"]`) !== null){
  document.querySelector('.mb_catlist_list').append(document.querySelector(`.mb_catlist_list li[data-id="${x}"]`)); 
} 
 });
</script>


</div>





<script>

document.querySelector('.cats').setAttribute('action','<?php global $SITEURL;echo $SITEURL;?>admin/load.php?id=multiBlock&newmultiblock&newmulticategory='+document.querySelector('.mb_category').value);


if(document.querySelector('.addnewblock')!==null){
    document.querySelector('.addnewblock').setAttribute('href','<?php global $SITEURL;echo $SITEURL;?>admin/load.php?id=multiBlock&newblock&newmulticategory='+document.querySelector('.mb_category').value);

}


document.querySelector('.mb_category').addEventListener('click',(x)=>{

    x.preventDefault();
    document.querySelector('.cats').setAttribute('action','<?php global $SITEURL;echo $SITEURL;?>admin/load.php?id=multiBlock&newmultiblock&newmulticategory='+document.querySelector('.mb_category').value);
    document.querySelector('.addnewblock').setAttribute('href','<?php global $SITEURL;echo $SITEURL;?>admin/load.php?id=multiBlock&newblock&newmulticategory='+document.querySelector('.mb_category').value);

})




    <?php 

if(isset($_POST['choosecat'])){
global $SITEURL;
   echo "document.querySelector('.mb_category').value = '".@$_GET['newmulticategory']."';";

   echo "document.querySelector('.addnewblock').setAttribute('href','".$SITEURL."admin/load.php?id=multiBlock&newblock&newmulticategory=".@$_GET['newmulticategory']."')";
   

}

 
 


if(isset($_POST['delthisbtn'])){

    
    unlink(GSDATAOTHERPATH."multiBlock/".str_replace(" ","-",$_GET['newmulticategory'])."/".$_POST['delthis'].".json");
 
 
header("Refresh:0");
    
    
}

;?>

</script>


<script src="<?php global $SITEURL; echo $SITEURL;?>plugins/multiBlock/js/Sortable.min.js"></script>

<script>



var el = document.getElementById('mb_catlist_list');
var sortable = Sortable.create(el,{
    dataIdAttr: 'data-id',
    animation:200,

    onStart: function (evt) {

document.querySelector('.array').value = sortable.toArray();

},


    onUpdate: function (evt) {

document.querySelector('.array').value = sortable.toArray();

}



});

 
</script>



<?php 


if(isset($_POST['saveorder'])){

 
    $owncategory = $_GET['newmulticategory'];
    $arrayinfo = $_POST['array'];

 

$folder        = GSDATAOTHERPATH . 'multiBlock/'.$owncategory.'/';
$filename      = $folder.'order.txt';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
 
// Save the file (assuming that the folder indeed exists)
if ($folder_exists) {
  file_put_contents($filename, $arrayinfo);
 
}
echo("<meta http-equiv='refresh' content='0'>");


};

;?>
