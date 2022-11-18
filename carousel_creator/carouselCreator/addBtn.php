<script>


if(document.querySelector('#edit .snav')){

const carouselEdit = document.querySelector('#edit .snav');

const carouselBtn = document.createElement('li');
carouselBtn.innerHTML = '<a href="#"><?php echo i18n_r('carouselCreator/CAROUSELTOPAGE');?></a>';
carouselEdit.insertAdjacentElement('beforeend',carouselBtn);


  carouselBtn.addEventListener("click",(e)=>{
        e.preventDefault();
        CKEDITOR.instances["post-content"].insertHtml("<div class='carousel-replace' style='width:100%;height:300px;background:#fafafa;border:solid 1px #ddd;display:flex;align-items:center;justify-content:center;'><p>Carousel</p></div>");
    });

}

</script>
