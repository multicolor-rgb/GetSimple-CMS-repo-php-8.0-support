<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'fb sidebar', 	//Plugin name
	'2.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'http://www.multicolor.stargard.pl', //author website
	'Add fb sidebar to your website', //Plugin description
	'plugins', //page type - on which admin tab to display
	'fbsidebar_active'  //main function (administration)
);
 
 
 






# activate filter 
add_action('theme-header','fbslider'); 
 
# add a link in the admin tab 'theme'
add_action('plugins-sidebar','createSideMenu',[$thisfile, 'Fb sidebar settings']);
 
# functions
function fbslider() {
	
	$plugin_id = 'fbsidebar';
 
// Set up the folder name and its permissions
// Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
$folder        = GSDATAOTHERPATH . '/' . $plugin_id . '/';
$fbname      = $folder.'fbname.txt';
$positiontop = $folder.'positiontop.txt';
$leftorright = $folder.'leftorright.txt';

	$style = '
	<style>
		@media(max-width:960px){
		#fb-left{display:none;}	
		#fb-right{display:none;}	
		}
		
		#fb-left{position:fixed; left:0;top:'.@file_get_contents($positiontop).';
		transform:translate(-300px,0); z-index:999;
		-webkit-transition: all 1s ease-out;
		-moz-transition: all 1s ease-out;
		-ms-transition: all 1s ease-out;
		-o-transition: all 1s ease-out;
		transition: all 1s ease-out;
		}
						
		#fb-left:hover{transform:translate(0,0); }
		#fb-left:after{content:"f"; padding:20px;font-weight:bold;background:#3b5998;float:right;color:#fff;font-size:20px;
		border-bottom-right-radius:5px;    border-top-right-radius:5px}

		//right

		@media(max-width:960px){
		#fb-right{display:none;}	
		}
									
											
		#fb-right{position:fixed; right:0;top:'.@file_get_contents($positiontop).';transform:translate(300px,0); z-index:999;
		-webkit-transition: all 1s ease-out;
		-moz-transition: all 1s ease-out;
		-ms-transition: all 1s ease-out;
		-o-transition: all 1s ease-out;
		transition: all 1s ease-out;
		}
											
		#fb-right:hover{transform:translate(0,0);}
		#fb-right:before{content:"f"; padding:20px;font-weight:bold;background:#3b5998;
		float:left;color:#fff;font-size:20px;
		border-bottom-left-radius:5px;    border-top-left-radius:5px}
		</style>';

		echo $style;


	echo '<div id="fb-'.file_get_contents($leftorright).'" class="">
	  <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fhttps://web.facebook.com/'.file_get_contents($fbname).'?_rdc=1&_rdr&tabs=timeline&width=300&height=300&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="300" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
		  
	  </div>';
}
 
function fbsidebar_active() {
// Set up the data

 $plugin_id = 'fbsidebar';
 
// Set up the folder name and its permissions
// Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
$folder        = GSDATAOTHERPATH . '/' . $plugin_id . '/';
$fbname      = $folder.'fbname.txt';
$positiontop = $folder.'positiontop.txt';
$leftorright = $folder.'leftorright.txt';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
 
// Save the file (assuming that the folder indeed exists)


  
echo' <b>Your fb </b> (example: Getsimplecms) works only on fb fanpage on firm site  '.@file_get_contents($fbname).'<br><br>';

  
  	echo'

	 <form  action="#" style="margin:0 auto;width:100%;box-sizing:border-box;padding:10px;margin-bottom:20px;border:solid 1px #ddd;background:#fafafa;" method="POST">
 <label>FB name</label>
 <input type="text" placeholder="name from url (example: https://www.facebook.com/GetSimpleCMS name is: GetSimpleCMS)" value="'.@file_get_contents($fbname).'" style="border:solid 1px #ddd;padding:10px;border-radius:5px;width:100%;box-sizing:border-box;margin-top:10px;margin-bottom:10px;"  name="fbname" />
 <label>Position</label>

 <select name="leftorright" style="border:solid 1px #ddd;border-radius:5px;margin:20px 0;min-width:100%;padding:10px;">
<option value="left" class="left">Left</option>
<option value="right" class="right">Right</option>
 </select>

 <label>Position from top</label>
 <input type="text" placeholder="default:200px" value="'.@file_get_contents($positiontop).'" style="border:solid 1px #ddd;padding:10px;border-radius:5px;width:100%;box-sizing:border-box;margin-top:10px;margin-bottom:10px;"  name="fbtop" />


    <input type="submit" name="submit" style="background:#000;color:#fff;padding:10px;margin-top:10px;border:solid 0 ;border-radius:10px;" value="Save settings" />
  </form>
 
  <script>

  if("'.@file_get_contents($leftorright).'"=="left"){
	document.querySelector(".left").setAttribute("selected","");
  }else if("'.@file_get_contents($leftorright).'"=="right"){
	document.querySelector(".right").setAttribute("selected","");
  }

  </script>
 
  ';

  
  echo '<p style="background:#fafafa; border:solid 1px #ddd;display:flex; justify-content:space-between; align-items:center;padding:10px;">Please support my work if you want saw new plugins:) 

  <a href="https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72">
  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"  />
  </a>
  </p>';

  
 	    
  if(isset($_POST['submit'])){
$fbnameinput = $_POST['fbname'];
$leftorrightinput = $_POST['leftorright'];
$positiontopinput = $_POST['fbtop'];

 
  file_put_contents($fbname, $fbnameinput);
  file_put_contents($leftorright, $leftorrightinput);
  file_put_contents($positiontop, $positiontopinput);

  
  echo '<div style="width:100%;background:green;color:#fff;border-radius:5px;padding:10px;text-align:center;">ok ! ';
  echo 'your fb: '; echo file_get_contents($fbname);
  echo'</div>';
  echo"<meta http-equiv='refresh' content='0'>"; 
}

}
?>
