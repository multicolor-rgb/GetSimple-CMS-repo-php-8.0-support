const hatext = document.querySelector('.ha-text');
const hacontrast = document.querySelector('.ha-contrast');
const hagrayscale = document.querySelector('.ha-grayscale');


hatext.addEventListener('click', (e) => {
    e.preventDefault();
    hatext.classList.toggle('ha_active');
    document.querySelector('html').classList.toggle('body-hatext');


    if(localStorage.getItem('hatext')== 'true'){
        localStorage.removeItem("hatext");

    }else{
        localStorage.setItem("hatext", 'true');

    }
 

});


hacontrast.addEventListener('click', (e) => {
    e.preventDefault();
    hacontrast.classList.toggle('ha_active');
    document.querySelector('html').classList.toggle('body-hacontrast');

    if(localStorage.getItem('hacontrast')== 'true'){
        localStorage.removeItem("hacontrast");

    }else{
        localStorage.setItem("hacontrast", 'true');

    }
 

});


hagrayscale.addEventListener('click', (e) => {
    e.preventDefault();
    hagrayscale.classList.toggle('ha_active');
    document.querySelector('html').classList.toggle('body-hagrayscale');

    if(localStorage.getItem('hagrayscale')== 'true'){
        localStorage.removeItem("hagrayscale");

    }else{
        localStorage.setItem("hagrayscale", 'true');

    }
 
});



//local check

if (localStorage.hatext == 'true') {
    hatext.classList.add('ha_active');
    document.querySelector('html').classList.add('body-hatext');
};

if (localStorage.hagrayscale == 'true') {
    hagrayscale.classList.add('ha_active');
    document.querySelector('html').classList.add('body-hagrayscale');
};

if (localStorage.hacontrast == 'true') {
    hacontrast.classList.add('ha_active');
    document.querySelector('html').classList.add('body-hacontrast');
};