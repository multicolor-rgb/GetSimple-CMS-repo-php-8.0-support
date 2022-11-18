<script>

if (document.querySelector('#edit #post-title') !== null) {
    const contactFormBtn = document.createElement("a");
    contactFormBtn.innerHTML = "<?php echo i18n_r('easy_contactform/ADDFORM');?>";
    contactFormBtn.classList.add('btn-contact');
    document.querySelector('#edit #metadata_toggle').insertAdjacentElement('beforebegin', contactFormBtn);


    const removeContactForm = document.createElement("a");
    removeContactForm.innerHTML = "<?php echo i18n_r('easy_contactform/REMOVEFORM');?>";
    removeContactForm.classList.add('btn-remove-contact');
    document.querySelector('#edit .btn-contact ').insertAdjacentElement('beforebegin', removeContactForm);



    const easyContactOption = document.createElement('div');
    easyContactOption.classList.add('easyContactOption');

    const easyContactOptionStyle = `position:fixed;
width:100%;
height:100vh;
background:rgba(0,0,0,0.7);
display:none;
align-items:center;
justify-content:center;
z-index:99;
    `;
    easyContactOption.setAttribute('style', easyContactOptionStyle);

    easyContactOption.innerHTML = `

    <style>
.ECoption{
    position:relative;
    width:500px;
    height:auto;
    padding:10px;
    border-radius:5px;
    background:#fff;
}
.ECoption label{

}
.ECoption input{
    margin:5px 0;
    box-sizing:border-box;
}

.addFormFromOption,.btn-close-ecoption{
    padding:10px 15px;
    background:red;
    color:#fff;
    border-radius:5px;
    border:none;
}

.btn-close-ecoption{
    background:black;
}

    </style>
    
    <div class="ECoption">

    <form>

    <label for="ecname"><?php echo i18n_r('easy_contactform/CKNAME');?> <input type="checkbox" style="margin-left:5px" name="ecname-required" class="ecname-required"> <?php echo i18n_r('easy_contactform/REQ');?> </label> 
    <input name="ecname" class="ecname" type="text" style="width:100%;padding:10px;">


    
    <label for="ecphone"> <?php echo i18n_r('easy_contactform/CKPHONE');?> <input type="checkbox" style="margin-left:5px" name="ecphone-required" class="ecphone-required"> <?php echo i18n_r('easy_contactform/REQ');?> </label>
    <input name="ecphone" type="text"  class="ecphone" style="width:100%;padding:10px;">


        
    <label for="ecmail"><?php echo i18n_r('easy_contactform/CKMAIL');?> <input type="checkbox" style="margin-left:5px" name="ecmail-required" class="ecmail-required"> <?php echo i18n_r('easy_contactform/REQ');?> </label>
    <input name="ecemail" type="text" class="ecmail" style="width:100%;padding:10px;">


    <label for="eccontent"><?php echo i18n_r('easy_contactform/CKMESS');?> <input type="checkbox" style="margin-left:5px" name="eccontent-required" class="eccontent-required"> <?php echo i18n_r('easy_contactform/REQ');?> </label>
    <input name="eccontent" class="eccontent" type="text" style="width:100%;padding:10px;">


    <label for="ecprivacy"> <?php echo i18n_r('easy_contactform/CKPRIVACY');?> <input type="checkbox" style="margin-left:5px" name="ecpolicy-required" class="ecpolicy-required"> <?php echo i18n_r('easy_contactform/REQ');?> </label>
    <input name="ecprivacy" type="text" class="ecprivacy" style="width:100%;padding:10px;">
<br>
    <hr>
    </br>
    <label for="required"><?php echo i18n_r('easy_contactform/CKREQ');?></label>
    <input name="required" class="required-text" type="text" style="width:100%;padding:10px;">
<br>
    <label for="submittext"><?php echo i18n_r('easy_contactform/CKSUBMIT');?></label>
    <input name="submittext" class="submittext" type="text" style="width:100%;padding:10px;">
    <br>

   

    <div style="width:100%;display:flex;background:#ddd;border:solid 1px #ddd;padding:10px; text-align:center;box-sizing:border-box;">
 <div style="width:50%">
 <label name="colorbutton"><?php echo i18n_r('easy_contactform/CKCOLOR');?></label>
 <input name="colorbutton" class="colorbutton" type="color" style="width:60%;border-radius:5px;border:none;height:30px;margin-top:10px;">
 </div>

 <div style="width:50%">
 <label name="colorhoverbutton"><?php echo i18n_r('easy_contactform/CKHOVERCOLOR');?></label>
 <input name="colorhoverbutton" class="colorhoverbutton" type="color" style="width:60%;border-radius:5px;border:none;height:30px;margin-top:10px;">
 </div>
    </div>


    <input type="submit" name="ecsubmit" value="<?php echo i18n_r('easy_contactform/ADDFORM');?>" class="addFormFromOption">

  
    <a href="#" class="btn-close-ecoption" ><?php echo i18n_r('easy_contactform/CLOSE');?></a>
    
    </form>


    </div>

    
    
    `;




    document.body.insertAdjacentElement('afterbegin', easyContactOption);



    contactFormBtn.addEventListener('click', (contactClicker) => {
        contactClicker.preventDefault();
        document.querySelector('.easyContactOption').style.display = "flex";
    });



    document.querySelector('.addFormFromOption').addEventListener('click', (x) => {
        x.preventDefault();
        document.querySelector('.easyContactOption').style.display = "none";
        let namefreq = '';
        let telfreq = '';
        let mailfreq = '';
        let messagefreq = '';
        let privacyfreq = '';

        const namereq = () => {
            if (document.querySelector('.ecname-required').checked == true) {
                const reqresults = document.querySelector('.required-text').value;
                namefreq = 'required';
                return reqresults;
            } else {
                return "";
                namefreq = '';
            }
        };

        const telreq = () => {
            if (document.querySelector('.ecphone-required').checked == true) {
                const reqresults = document.querySelector('.required-text').value;
                telfreq = 'required';

                return reqresults;
            } else {
                telfreq = '';
                return "";
            }
        };

        const mailreq = () => {
            if (document.querySelector('.ecmail-required').checked == true) {
                mailfreq = 'required';
                const reqresults = document.querySelector('.required-text').value;
                return reqresults;
            } else {
                mailfreq = '';
                return "";
            }
        };


        const messagereq = () => {
            if (document.querySelector('.eccontent-required').checked == true) {
                messagefreq = 'required';
                const reqresults = document.querySelector('.required-text').value;
                return reqresults;

            } else {
                messagefreq = '';
                return "";
            }
        };


        const privacyreq = () => {
            if (document.querySelector('.ecpolicy-required').checked == true) {
                privacyfreq = ' required';
                const reqresults = document.querySelector('.required-text').value;
                return reqresults;
            } else {
                privacyfreq = '';
                return "";
            }
        };


        const formFormula = `<div class="cke-outer"><form class="easyContactForm" role="form" method="post" action="#" accept-charset="UTF-8"> 
        <label for="name" class="nameblank">${document.querySelector('.ecname').value} <b>${namereq()}</b></label> 
        <input type="text" style=" box-sizing:border-box;width: 100%;border-radius: 5px;padding:10px; border:solid 1px rgba(0,0,0,0.3);" 
        class="form-control namecf" id="name" name="name" placeholder="" value="" ${namefreq} >

         <label for="tel">${document.querySelector('.ecphone').value} <b>${telreq()}</b></label> 
         
         <input type="tel" style="width: 100%;box-sizing:border-box;border-radius: 5px;padding:10px; border:solid 1px rgba(0,0,0,0.3);" 
         class="form-control" id="tel" name="tel" placeholder="" value=""  ${telfreq}> 
         
         
         <label for="mail" >${document.querySelector('.ecmail').value} <b>${mailreq()}</b></label>
         <input type="email" style="width: 100%;box-sizing:border-box;border-radius: 5px;padding:10px; border:solid 1px rgba(0,0,0,0.3);"
           class="form-control" id="email" name="email" placeholder="" value="" ${mailfreq}>
         
         
           <label for="message">${document.querySelector('.eccontent').value} <b>${messagereq()}</b></label>
           
           <textarea class="form-control"  ${messagefreq}
           style="width: 100%;box-sizing:border-box;border-radius: 5px; ;padding:10px; border:solid 1px rgba(0,0,0,0.3);" rows="3"
            placeholder="" name="message" id="message" > 
            </textarea>

           
            <div style="width:100%" class="privacy-div">
            <input type="checkbox" value="zgoda" ${privacyfreq}   id="privacy" style="width:20px;margin:10px auto;" 
        > ${document.querySelector('.ecprivacy').value}  <b>${privacyreq()}</b>
            </div>

            <style>
#submit{
    padding:10px 25px;
             background:${document.querySelector('.colorbutton').value};
              color:#fff;border:0;
              padding:5px 15px;
              border-radius:5px;border-radius: 5px;
              padding: 10px 25px;width: auto;
              transition:all 250ms linear;
}

#submit:hover{
background:${document.querySelector('.colorhoverbutton').value};
}
            </style>

              <input id="submit" name="submit" type="submit" 
              value="${document.querySelector('.submittext').value}">
        </form></div>`;
        CKEDITOR.instances['post-content'].insertHtml(formFormula);



    });





    removeContactForm.addEventListener('click', (e) => {
        e.preventDefault();
        CKEDITOR.instances['post-content'].editable().findOne('.easyContactForm').remove();
    });




    if (document.querySelector('.btn-close-ecoption') !== null) {

        document.querySelector('.btn-close-ecoption').addEventListener('click', (ee) => {
            ee.preventDefault();
            document.querySelector('.easyContactOption').style.display = "none";

        });
    };



};

</script>
