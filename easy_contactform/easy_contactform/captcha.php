<?php 

$random = rand(1000,4900);
$randomSh = sha1($random);

global $SITEURL;

;?>

<script>
if(document.querySelector('.easyContactForm')!==null){

const captcha = `
<style>
@import url('https://fonts.googleapis.com/css2?family=Shizuru&family=Special+Elite&display=swap');
</style>

<div style="display: flex;
align-items: center;
-webkit-touch-callout: none;
-webkit-user-select: none;
-khtml-user-select: none; 
-moz-user-select: none;
-ms-user-select: none; 
user-select: none;
justify-content: center;border-radius:5px;margin-top:10px;overflow:hidden;text-align:center;width:130px;height:50px;font-size:2rem;font-family: 'Shizuru', cursive;background:url('<?php echo $SITEURL.'plugins/easy_contactform/img/bg.jpg';?>');">
<?php echo $random;?>
</div>

<input type="text" name="captcha" required style="width:110px;">

<input type='hidden' name='hiddencaptcha' style="display:none"  value='<?php echo $randomSh;?>'>
<br>


`;

document.querySelector('.easyContactForm .privacy-div').insertAdjacentHTML('afterend',captcha);
}
</script>
