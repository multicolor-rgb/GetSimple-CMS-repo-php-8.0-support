<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

i18n_merge('easy_contactform') || i18n_merge('easy_contactform','en_US');
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'Easy_ContactForm', 	//Plugin name
	'5.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'https://multicolor.stargard.pl/', //author website
	'Easy Contact form for your page', //Plugin description
	'settings', //page type - on which admin tab to display
	'contactFormSettings'  //main function (administration)
);
 
# activate filter 


add_action('theme-header','contactPHP'); 
add_action('footer','easyContactCKE'); 
add_action('theme-footer','captcha'); 

 
 

register_style('contactFormStyle', $SITEURL.'plugins/easy_contactform/css/stylecontactform.css', '2.0', 'screen');
queue_style('contactFormStyle',GSBOTH); 

# add a link in the admin tab 'theme'
$easyName = i18n_r('easy_contactform/EASYNAMEONMENU');
add_action('settings-sidebar','createSideMenu',[$thisfile, $easyName]);
 
# functions

function contactPHP(){
    include('easy_contactform/form.php');
}



function easyContactCKE(){
	include('easy_contactform/easyContactFormCke.php');
};


function captcha(){

$captcha = file_get_contents('data/other/easy_contactform/captcha.txt');

	if($captcha=='google'){
		include('easy_contactform/googlecaptcha.php');
	};

	if($captcha=='default'){
		include('easy_contactform/captcha.php');
	}

};



 
function contactFormSettings() {

	 $captchas = @file_get_contents('../data/other/easy_contactform/captcha.txt');

	echo'<h3>'.i18n_r('easy_contactform/EASYNAMEONMENU').'</h3>';

	echo '<form action="#" method="POST">

	<label for="sender">'.i18n_r('easy_contactform/SENDER').'</label><br>
<input type="mail" style="width:100%;padding:10px;box-sizing:border-box;" name ="sender" value="';
	echo @file_get_contents( '../data/other/easy_contactform/sender.txt');
	echo '">
	
	<label for="easyFormMail" style="margin-top:20px">'.i18n_r('easy_contactform/DELIVER').' </label><br>
<input type="mail" style="width:100%;padding:10px;box-sizing:border-box;" name ="easyFormMail" value="';
	echo @file_get_contents('../data/other/easy_contactform/mail.txt');
	echo '">
	<label for="easyFormSubject" style="margin-top:20px">'.i18n_r('easy_contactform/SUBJECTMESS').'</label><br>
	<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name ="easyFormSubject" value="';	
	echo @file_get_contents('../data/other/easy_contactform/subject.txt'); echo '">
	<label for="sentmessageinfo" style="margin-top:20px">'.i18n_r('easy_contactform/TEXTSUCCESS').'</label><br>
	<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name ="sentmessageinfo" value="';	
	echo @file_get_contents('../data/other/easy_contactform/success.txt'); echo '">

	<label for="failmessageinfo" style="margin-top:20px">'.i18n_r('easy_contactform/TEXTNOSUCCESS').'</label><br>
	<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name ="failmessageinfo" value="';	
	echo @file_get_contents('../data/other/easy_contactform/fail.txt'); echo '">
<br><br>
 
	<h3>'.i18n_r('easy_contactform/LABELSMAIL').'</h3>

	<label for="fromlabel">'.i18n_r('easy_contactform/FROMLABEL').'</label>
	<br>
	<input type="text" name="fromlabel" style="width:100%;padding:10px;box-sizing:border-box;" value="'; echo @file_get_contents('../data/other/easy_contactform/fromlabel.txt'); echo '">
	<br><br>
	<label for="fromlabelmail">'.i18n_r('easy_contactform/EMAILLABEL').'</label>
	<br>
	<input type="text" name="fromlabelmail" style="width:100%;padding:10px;box-sizing:border-box;" value="'; echo @file_get_contents('../data/other/easy_contactform/fromlabelmail.txt'); echo '">

	<br><br>

	<label for="fromlabelphone">'.i18n_r('easy_contactform/PHONELABEL').'</label>
	<br>
	<input type="text" name="fromlabelphone" style="width:100%;padding:10px;box-sizing:border-box;" value="'; echo @file_get_contents('../data/other/easy_contactform/fromlabelphone.txt'); echo '">

	<br><br>

	<label for="fromlabelcontent">'.i18n_r('easy_contactform/CONTENTLABEL').'</label>
	<br>
	<input type="text" name="fromlabelcontent" style="width:100%;padding:10px;box-sizing:border-box;" value="'; echo @file_get_contents('../data/other/easy_contactform/fromlabelcontent.txt'); echo '">

<br><br>
	<h3>Captcha info</h3>
	<p>'.i18n_r('easy_contactform/CAPTCHAINFO').'</p>
	<div class="">
<label for="googledomain">'.i18n_r('easy_contactform/DOMAINCODE').'</label><br>
<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name="googledomain" value="'.@file_get_contents('../data/other/easy_contactform/googledomain.txt').'">
<br><br>
<label for="googlesecret">'.i18n_r('easy_contactform/SECRETCODE').'</label><br>
<input  type="text" style="width:100%;padding:10px;box-sizing:border-box;" name="googlesecret" value="'.@file_get_contents('../data/other/easy_contactform/googlesecret.txt').'">
	</div>

	<select name="captcha" style="width:100%;margin:20px 0;padding:10px;border-radius:0;border:none;">
<option value="default"  class="default-op" >'.i18n_r('easy_contactform/DEFAULTCAPTCHA').'</option>
<option value="google"  class="google-op" >'.i18n_r('easy_contactform/GOOGLECAPTCHA').'</option>
	</select>



	<input type="submit" name="submit" style="padding:10px 15px;margin-top:10px;background:#000;color:#fff;border:none;" value="'.i18n_r('easy_contactform/SAVESETTINGS').'">
	</form>
	
	
<p style="margin:0;margin-top:20px;"> '.i18n_r('easy_contactform/CREATED').' <a href="mail:skrzypczak.design@gmail.com">Multic0lor</a>
</p>
    <hr style="margin-top:10px;border:none;border-bottom:solid 1px rgba(0,0,0,0.3)">

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:flex; width:100%;align-items:center;justify-content:space-between;">
        <p style="margin:0;padding:0;">'.i18n_r('easy_contactform/SUPPORT').'</p>
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        <img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
        </form>

		

		<script>
if("'.$captchas.'"=="google"){
document.querySelector(".google-op").selected = true;
}else{
	document.querySelector(".default-op").selected = true;	
}

		</script>
		 
	';
	
 

	// Set up the data

// Set up the folder name and its permissions
// Note the constant GSDATAOTHERPATH, which points to /path/to/gsetsimple/data/other/
$EasyContactFormFolder        = GSDATAOTHERPATH . '/easy_contactform/';
$mailname      = $EasyContactFormFolder   . 'mail.txt';
$subject      = $EasyContactFormFolder   . 'subject.txt';
$successfile      = $EasyContactFormFolder   . 'success.txt';
$failfile      = $EasyContactFormFolder   . 'fail.txt';
$senderfile     = $EasyContactFormFolder   . 'sender.txt';
$questionanswerfile     = $EasyContactFormFolder   . 'questionanswer.txt';

$fromLabelfile = $EasyContactFormFolder . 'fromlabel.txt';
$fromLabelmailfile = $EasyContactFormFolder . 'fromlabelmail.txt';
$fromLabelphonefile = $EasyContactFormFolder . 'fromlabelphone.txt';
$fromLabelcontentfile = $EasyContactFormFolder . 'fromlabelcontent.txt';
$captchafile = $EasyContactFormFolder . 'captcha.txt';

$googledomainfile = $EasyContactFormFolder . 'googledomain.txt';
$googlesecretfile = $EasyContactFormFolder . 'googlesecret.txt';

$chmod_mode    = 0755;
$folder_exists = file_exists($EasyContactFormFolder) || mkdir($EasyContactFormFolder,$chmod_mode);
 
// Save the file (assuming that the folder indeed exists);
if( isset($_POST["submit"]) ){

$maildata = $_POST["easyFormMail"];
$sentmessageinfo = $_POST["sentmessageinfo"];
$failmessageinfo = $_POST["failmessageinfo"];
$easyFormSubject = $_POST["easyFormSubject"];
$sender = $_POST["sender"];

$fromlabel = $_POST["fromlabel"];
$fromlabelmail = $_POST["fromlabelmail"];
$fromlabelphone = $_POST["fromlabelphone"];
$fromlabelcontent = $_POST["fromlabelcontent"];
$captchacontent = $_POST["captcha"];
$googledomaincontent = $_POST["googledomain"];
$googlesecretcontent = $_POST["googlesecret"];

if ($folder_exists) {
  file_put_contents($mailname, $maildata);
  file_put_contents($subject , $easyFormSubject);
  file_put_contents($successfile , $sentmessageinfo);
  file_put_contents($failfile , $failmessageinfo);
  file_put_contents($senderfile , $sender);
  file_put_contents($fromLabelfile,$fromlabel);
  file_put_contents($fromLabelmailfile,$fromlabelmail);
  file_put_contents($fromLabelphonefile,$fromlabelphone);
  file_put_contents($fromLabelcontentfile,$fromlabelcontent);
 
  file_put_contents($captchafile,$captchacontent);
  file_put_contents($googledomainfile,$googledomaincontent);
  file_put_contents($googlesecretfile,$googlesecretcontent);
  echo "<meta http-equiv='refresh' content='0'>";

};
};

}
?>
