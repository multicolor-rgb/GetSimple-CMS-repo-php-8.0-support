<?php
 
# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'MultiBlock Migrator', 	//Plugin name
	'1.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'', //author website
	'This is Url Changer for MultiBlock', //Plugin description
	'plugins', //page type - on which admin tab to display
	'MultiBlockURLChanger'  //main function (administration)
);
 
# activate filter 
 
 
# add a link in the admin tab 'theme'
add_action('plugins-sidebar','createSideMenu',[$thisfile, 'MultiBlock Migrator 🧱']);
 
 
function MultiBlockURLChanger() {
    global $SITEURL;

    
 
      
    
    echo '

    <style>
.inputer{
    width:100%;
    padding:10px;
    box-sizing:border-box;
    margin-top:10px;
    border-radius:5px;
    border:solid 1px #ddd;
}

 
.button-18 {
  align-items: center;
  background-color: #0A66C2;
  border: 0;
  border-radius: 100px;
  box-sizing: border-box;
  color: #ffffff;
  cursor: pointer;
  display: inline-flex;
  font-family: -apple-system, system-ui, system-ui, "Segoe UI", Roboto, "Helvetica Neue", "Fira Sans", Ubuntu, Oxygen, "Oxygen Sans", Cantarell, "Droid Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Lucida Grande", Helvetica, Arial, sans-serif;
  font-size: 16px;
  font-weight: 600;
  justify-content: center;
  line-height: 20px;
  max-width: 480px;
  min-height: 40px;
  min-width: 0px;
  overflow: hidden;
  padding: 0px;
  padding-left: 20px;
  padding-right: 20px;
  text-align: center;
  touch-action: manipulation;
  transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
  user-select: none;
  -webkit-user-select: none;
  vertical-align: middle;
}

.button-18:hover,
.button-18:focus { 
  background-color: #16437E;
  color: #ffffff;
}

.button-18:active {
  background: #09223b;
  color: rgb(255, 255, 255, .7);
}

.button-18:disabled { 
  cursor: not-allowed;
  background: rgba(0, 0, 0, .08);
  color: rgba(0, 0, 0, .3);
}

.ok{
width:100%;border-radius:10px;
background:#0A66C2;
color:#fff;
padding:10px;
box-sizing:border-box;
margin-bottom:15px;
}

    </style>

    <h3>MultiBlock Migrator</h3>';


    if(isset($_GET['info'])){

      echo'<div class="ok">Ok, your url on all MultiBlocks replaced</div>';

    }

    echo'

    <form method="post" action="'.$SITEURL.'admin/load.php?id=MultiBlockMigrator&info" style="padding:10px;background:#fafafa;border-radius:5px;border:solid 1px #ddd">
        <p style="margin:0;padding:0;margin-top:10px;">old domain adress</p>
    <input class="inputer" required type="text" name="old" placeholder="http://youroldadress.com/" value="">
    <p style="margin:0;padding:0;margin-top:10px;">new domain adress</p>
    <input class="inputer" required type="text" name="new" placeholder="http://yournewadress.com/">
    <br>
    <br>
    <input type="submit" name="replace" class="button-18"  value="Replace URL">
    </form>';


    echo '
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style=" box-sizing:border-box;display:grid; width:100%;grid-template-columns:1fr auto; padding:10px;background:#fafafa;border:solid 1px #ddd;margin-top:20px;">
      <p style="margin:0;padding:0;"> '.i18n_r('multiBlock/PAYPAL').' </p>
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL">
      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" border="0">
      <img alt="" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" border="0">
    </form>';


    if(isset($_POST['replace'])){

        $folder = GSDATAOTHERPATH.'multiBlock/**/*.{txt,json}';
        foreach(glob($folder,GLOB_BRACE) as $file){

          $old = str_replace(" ","",$_POST['old']);
          $new = str_replace(" ","",$_POST['new']);


            $oldcontent = file_get_contents($file);
            $newcontent = str_replace([$old, $old.'/'],[$new, $new.'/'],$oldcontent);

            
    
            file_put_contents($file,$newcontent);
    
     
             
    } 
    
    }

    
  } 

 
?>
