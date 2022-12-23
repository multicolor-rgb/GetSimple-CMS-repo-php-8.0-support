<style>
.hideadminsectionform input[type="submit"]{
    width:100%;
    padding:10px;
    margin-top:20px;
    background:#000;
    color:#fff;
    border:none;
    border-radius:5px;
}

.hideadminsectionform input{
    width:100%;
    padding:10px;
    margin-top:20px;

    border:solid 1px #ddd;

    border-radius:5px;
}

.hideadminsectionform select{
    width:100%;
    padding:10px;
    margin:10px 0;
}

.hideadminsectionform {
display:grid;
grid-template-columns: 1fr 1fr;
align-items: center;
}

.hideadminsectionform p{
    margin: 0;padding: 0;
}

@media(max-width:960px){
    .hideadminsectionform{
        display:flex;
        flex-direction: column;
    }
}

.hidetitle{
    width:100%;
    background:#fafafa;
    padding:10px;
    border:solid 1px #ddd;
    display:flex;
    justify-content: space-between;
    align-items: center;
    margin-top:20px;
}



.hidetitle h3{
    margin: 0;
    padding: 0;
}

.hide{
    display:none;
}

.hidecontent{
    padding:15px;
    border:solid 1px #ddd;
    margin-bottom:20px;
}

.userhiddenoption{
    width:100%;border:solid 1px #ddd;background:#fafafa;padding:10px;grid-column:1/3;margin-top:20px;
}

</style>

<div>

 
<div class="hidetitle" id="hidetitle3">
<h3><?php echo i18n_r("massiveAdmin/CREATENEWUSER") ;?></h3> <i class="uil uil-arrow-down" style="font-size:1.2rem"></i>
</div>

<div class="hidecontent hidecontent3" id="hidecontent3">

<form action="" method="post">
<br>
<?php echo i18n_r("massiveAdmin/USERNAMECREATE") ;?>
<br>
<input type="text" name="createuserhidden">
<br><br>
<?php echo i18n_r('massiveAdmin/PASSWORDCREATE');?>  
<br>
<input type="password" name="createpassword">
<br> <br>
<?php echo i18n_r('massiveAdmin/EMAILCREATE');?>  

<br>
<input type="e-mail" name="createuseremail">
<br> <br>
<?php echo i18n_r('massiveAdmin/LANGCREATE');?>  
<br><br>
<select name="lang">
 
  <?php

$files = glob("../admin/lang/*.php");

foreach ($files as &$value) {

    $old = ["../admin/lang/", ".php"];
    $newreplace = ['', ''];
    $new =str_replace($old,$newreplace,$value);
    echo ' <option value="'.$new.'">'.$new.'</option>';


};

;?>


</select>

<input type="submit" name="savecreateuser"  style="width: 100%;
padding: 10px;
margin-top: 20px;
background: #000;
color: #fff;
border: none;
border-radius: 5px;" value="<?php echo i18n_r('massiveAdmin/CREATENEWUSER');?>">
</form>
</div>
 
</div>




<script>

document.querySelector('.hidecontent3').classList.add('hide');

document.querySelector('#hidetitle3').addEventListener('click',()=>{

    if(document.querySelector('.hidecontent3').classList.contains('hide')== true){
        document.querySelector('.hidecontent3').classList.remove('hide');
    }else{
        document.querySelector('.hidecontent3').classList.add('hide');
    }
 
});
</script>



<?php 
	if (isset($_COOKIE['GS_ADMIN_USERNAME'])) {
if(isset($_POST['savecreateuser'])){
$newposUser = $_POST['createuserhidden'];

$newposUserwithspace = str_replace(' ','-',$newposUser);
$supportUserMailMonkey = str_replace('@', '', $newposUserwithspace);
$supportUserMailFinal = str_replace('.', '', $supportUserMailMonkey );
$createUserEmail =$_POST['createuseremail'];
$pass = $_POST['createpassword'];
$lang = $_POST['lang'];
$passhash = passhash($pass);
$folder = '../data/users';
$newUserFile = $folder.'/'.$supportUserMailFinal.'.xml';
$userinfo='<?xml version="1.0" encoding="UTF-8"?>
<item><USR>'.strtolower($newposUser).'</USR><NAME/><PWD>'.$passhash.'</PWD><EMAIL>'.$createUserEmail.'</EMAIL><HTMLEDITOR>1</HTMLEDITOR><TIMEZONE/><LANG>'.$lang.'</LANG></item>';
file_put_contents($newUserFile , $userinfo);

echo("<meta http-equiv='refresh' content='0'>");

};

    };

;?>




<?php 
 $massiveHiddenSection = GSDATAOTHERPATH . '/massiveHiddenSection/';
 $filejson ='userhidden.json';
 $finaljson = $massiveHiddenSection.$filejson;
 $chmod_mode    = 0755;
 $folder_exists = file_exists($massiveHiddenSection) || mkdir($massiveHiddenSection, $chmod_mode);
 if(file_exists($finaljson)){
    $datee = file_get_contents( $finaljson);
    $data = json_decode($datee);
 };


?>

<div id="hidetitle1" class="hidetitle"><h3><?php echo i18n_r('massiveAdmin/HIDSECTIONTITLE');?></h3> <i class="uil uil-arrow-down" style="font-size:1.2rem"></i></div>

<div id="hidecontent1" class="hidecontent hidecontent1">

<form action="#"  method="POST"  style="width:100%;height:auto" class="hideadminsectionform" >


<p><?php echo i18n_r('massiveAdmin/HIDEPAGES');?>
</p>
<select name="hidepages">
<option value="show"  ><?php echo i18n_r('massiveAdmin/SHOW');?></option>
<option value="hide" ><?php echo i18n_r('massiveAdmin/HIDE');?></option>

</select>

<p><?php echo i18n_r('massiveAdmin/HIDEFILES');?>
</p>
<select name="hidefiles">
<option value="show"  ><?php echo i18n_r('massiveAdmin/SHOW');?></option>
<option value="hide" ><?php echo i18n_r('massiveAdmin/HIDE');?></option>
</select>

 
<p><?php echo i18n_r('massiveAdmin/HIDETHEMES');?></p>

<select name="hidethemes">
<option value="show"  ><?php echo i18n_r('massiveAdmin/SHOW');?></option>
<option value="hide" ><?php echo i18n_r('massiveAdmin/HIDE');?></option>
</select>
 
<p><?php echo i18n_r('massiveAdmin/HIDEBACKUP');?>
</p>
<select name="hidebackup">
<option value="show"  ><?php echo i18n_r('massiveAdmin/SHOW');?></option>
<option value="hide" ><?php echo i18n_r('massiveAdmin/HIDE');?></option>
</select>
 

<p><?php echo i18n_r('massiveAdmin/HIDEPLUGIN');?>
</p>
<select name="hideplugin">
<option value="show"  ><?php echo i18n_r('massiveAdmin/SHOW');?></option>
<option value="hide" ><?php echo i18n_r('massiveAdmin/HIDE');?></option>
</select>



<p><?php echo i18n_r('massiveAdmin/HIDESUPPORT');?>
</p>
<select name="hidesupport">
<option value="show"  ><?php echo i18n_r('massiveAdmin/SHOW');?></option>
<option value="hide" ><?php echo i18n_r('massiveAdmin/HIDE');?></option>
</select>


<p><?php echo i18n_r('massiveAdmin/HIDESETTINGS');?>
</p>
<select name="hidesettings">
<option value="show"  ><?php echo i18n_r('massiveAdmin/SHOW');?></option>
<option value="hide" ><?php echo i18n_r('massiveAdmin/HIDE');?></option>
</select>


<p><?php echo i18n_r('massiveAdmin/HIDEI18NGALLERY');?>
</p>
<select name="hidei18n">
<option value="show"><?php echo i18n_r('massiveAdmin/SHOW');?></option>
<option value="hide"><?php echo i18n_r('massiveAdmin/HIDE');?></option>
</select>
 
<br>

<div class="userhiddenoption">
<h4 style=""><?php echo i18n_r('massiveAdmin/HIDEUSERS');?></h4>
<input type="text" name="hideuser" style="grid-column:1/3"  placeholder="example,example2,example3">
</div>

<br>
<input type="submit" name="submit"  value="<?php echo i18n_r('massiveAdmin/SAVEOPTION');?>" style="grid-column:1/3" />


</form>

</div>

<script>

document.querySelector('.hidecontent1').classList.add('hide');

document.querySelector('#hidetitle1').addEventListener('click',()=>{

    if(document.querySelector('.hidecontent1').classList.contains('hide')== true){
        document.querySelector('.hidecontent1').classList.remove('hide');
    }else{
        document.querySelector('.hidecontent1').classList.add('hide');
    }
 
});
</script>


<style>
ul.user-list{
    width:100%;
    background:#fafafa;
    list-style-type:none;
    margin:0 !important;
    padding:0 !important;
border:solid 1px #ddd !important;
margin-bottom:20px !important;
display:block;
}

input{
    width:100%;
    padding:10px;
    margin-top:10px;
}

.user-list li{
    padding:10px;
    display:flex;
    width:100% !important;
    flex-direction:row;
    justify-content:space-between;
}

.user-list li:nth-child(2n){
    background:#ddd;
};
 

#hidecontent3 select{
    margin-top:10px;
    margin-bottom: 10px;
    width:100%;
    padding:10px;
}

</style>


<div class="hidetitle" id="hidetitle2"><h3><?php echo i18n_r('massiveAdmin/USERMANAGER');?></h3>  <i class="uil uil-arrow-down" style="font-size:1.2rem"></i></div>


<div class="hidecontent hidecontent2">

<ul class="user-list">
<?php

$files = glob("../data/users/*.xml");

foreach ($files as &$value) {

    $oldDir = ["../data/users/", ".xml"];
    $newDir = ['', ''];
    $newValue =str_replace($oldDir,$newDir,$value);

    $username = new SimpleXMLElement(file_get_contents($value));

    $usrfile = $username->USR[0];


    echo '<li> <span class="name">'. $usrfile.'</span><form action="" method="POST"><button type="submit" name="'.$newValue.'" class="delete-this" style="background:red;color:#fff;border:none;font-size:1.1rem;border-radius:3px"><i class="uil uil-trash-alt"></i></button></form> </li>';
 

    if(isset($_POST[$newValue])){
    unlink($value);
    echo("<meta http-equiv='refresh' content='0'>");

    };

 


};

;?>


</ul>




<script>

 

document.querySelector('.hidecontent2').classList.add('hide');

document.querySelector('#hidetitle2').addEventListener('click',()=>{

    if(document.querySelector('.hidecontent2').classList.contains('hide')== true){
        document.querySelector('.hidecontent2').classList.remove('hide');
    }else{
        document.querySelector('.hidecontent2').classList.add('hide');
    }
 
});
 

document.body.setAttribute('data-nodelete','<?php echo $_COOKIE['GS_ADMIN_USERNAME'];?>');

const nodelete = document.body.getAttribute('data-nodelete');

document.querySelectorAll('.user-list li').forEach(x=>{

const name = x.querySelector('span').innerHTML;

if(name===nodelete){
x.querySelector('.delete-this').remove();
}

})


</script>
 


</div>






<script>

document.querySelector('input[name="createuserhidden"]').addEventListener('keyup',(x)=>{

const valuethis = document.querySelector('input[name="createuserhidden"]').value;
console.log(valuethis);

if(valuethis==nodelete){
    document.querySelector('input[name="savecreateuser"]').addEventListener('click',btn=>{

        alert('<?php echo i18n_r("massiveAdmin/CHANGENAME") ;?>');

        document.querySelector('input[name="createuserhidden"]').value = "";

        btn.preventDefault();

    });
}



})

if(name===nodelete){
x.querySelector('.delete-this').remove();
x.querySelector('span').insertAdjacentHTML('beforeend','(ADMIN)');
}



if('<?php echo $data->hidepages;?>' == "show"){

document.querySelector('select[name="hidepages"]').value = "show";

}else if('<?php echo $data->hidepages;?>' == "hide"){
document.querySelector('select[name="hidepages"]').value = "hide";
};


if('<?php echo $data->hidefiles;?>' == "show"){

    document.querySelector('select[name="hidefiles"]').value = "show";

}else if('<?php echo $data->hidefiles;?>' == "hide"){
    document.querySelector('select[name="hidefiles"]').value = "hide";
};




if('<?php echo $data->hidethemes;?>' == "show"){

document.querySelector('select[name="hidethemes"]').value = "show";

}else if('<?php echo $data->hidethemes;?>' == "hide"){
document.querySelector('select[name="hidethemes"]').value = "hide";
};



if('<?php echo $data->hidebackup;?>' == "show"){

document.querySelector('select[name="hidebackup"]').value = "show";

}else if('<?php echo $data->hidebackup;?>' == "hide"){
document.querySelector('select[name="hidebackup"]').value = "hide";
};



if('<?php echo $data->hideplugin;?>' == "show"){

document.querySelector('select[name="hideplugin"]').value = "show";

}else if('<?php echo $data->hideplugin;?>' == "hide"){
document.querySelector('select[name="hideplugin"]').value = "hide";
};

if('<?php echo $data->hidei18n;?>' == "show"){

document.querySelector('select[name="hidei18n"]').value = "show";

}else if('<?php echo $data->hidei18n;?>' == "hide"){
document.querySelector('select[name="hidei18n"]').value = "hide";
};


if('<?php echo $data->hidesupport;?>' == "show"){

document.querySelector('select[name="hidesupport"]').value = "show";

}else if('<?php echo $data->hidesupport;?>' == "hide"){
document.querySelector('select[name="hidesupport"]').value = "hide";
};



if('<?php echo $data->hidesettings;?>' == "show"){

document.querySelector('select[name="hidesettings"]').value = "show";

}else if('<?php echo $data->hidesettings;?>' == "hide"){
document.querySelector('select[name="hidesettings"]').value = "hide";
};



if('<?php echo $data->hideuser;?>'.length > 0){

document.querySelector('input[name="hideuser"]').value ='<?php echo $data->hideuser;?>';

}

</script>




<?php
if(isset($_POST['submit'])){
            $hidefiles = $_POST['hidefiles'];
            $hidebackup = $_POST['hidebackup'];
            $hidethemes = $_POST['hidethemes'];
            $hideplugin = $_POST['hideplugin'];
            $hidei18n = $_POST['hidei18n'];
            $hidepages = $_POST['hidepages'];
            $hideuser = $_POST['hideuser'];
            $hidesupport = $_POST['hidesupport'];
            $hidesettings = $_POST['hidesettings'];



            $json = '{
            "hidefiles": "'.$hidefiles.'",
            "hidebackup": "'.$hidebackup.'",
            "hidethemes": "'.$hidethemes.'",
            "hidei18n": "'.$hidei18n.'",
            "hideplugin":"'.$hideplugin.'",
            "hidepages": "'.$hidepages.'",
            "hideuser": "'.$hideuser.'",
            "hidesupport": "'.$hidesupport.'",
            "hidesettings": "'.$hidesettings.'"
            
            }';


            $massiveHiddenSection = GSDATAOTHERPATH . '/massiveHiddenSection/';
            $filejson ='userhidden.json';
            $finaljson = $massiveHiddenSection.$filejson;
            $chmod_mode    = 0755;
            $folder_exists = file_exists($massiveHiddenSection) || mkdir($massiveHiddenSection, $chmod_mode);

            file_put_contents($finaljson , $json);
           
            
            echo("<meta http-equiv='refresh' content='0'>");

            
        };?>


