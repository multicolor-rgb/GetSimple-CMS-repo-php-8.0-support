<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php
 $domainkey = file_get_contents('data/other/easy_contactform/googledomain.txt');
$googleinput = '<div class="g-recaptcha" style="margin:10px 0;"  data-callback="recaptchaCallback"  data-sitekey="'.$domainkey.'"></div>';
?>






<script>
    if(document.querySelector('.easyContactForm')!==null){
        document.querySelector('.easyContactForm .privacy-div').insertAdjacentHTML('afterend',`<?php echo $googleinput;?>`);

 


        window.onload = function() {
    const recaptcha = document.querySelector('#g-recaptcha-response');

    if(recaptcha) {
        recaptcha.setAttribute("required", "required");
    }

};

document.querySelector('.easyContactForm #submit').disabled = true;


function recaptchaCallback() {
    document.querySelector('.easyContactForm #submit').disabled = false;
};

    };


</script>