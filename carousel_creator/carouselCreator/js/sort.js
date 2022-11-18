//slider-item events

document
    .querySelectorAll('.slider-item')
    .forEach(x => {

        x
            .querySelector('.content')
            .style
            .display = "none";

        x
            .querySelector('.editcontent')
            .addEventListener('click', (e) => {
                e.preventDefault();

                if (x.querySelector('.content').style.display == "block") {
                    x
                        .querySelector('.content')
                        .style
                        .display = "none";
                } else {
                    x
                        .querySelector('.content')
                        .style
                        .display = "block";
                }

            })

    })

//sortable

var el = document.getElementById('former');
var sortable = Sortable.create(el, {
    handle: ".formerdrag",
    animation: 200
});

//drag

document
    .querySelectorAll('.formerdrag')
    .forEach(x => {
        x.style.display = "none"
    });
document
    .querySelectorAll('.formerclose')
    .forEach(x => {
        x.style.right = "10px"
    });

document
    .querySelector('.reorder')
    .addEventListener('click', () => {
        document
            .querySelectorAll('.formerdrag')
            .forEach(x => {
                x.style.display = "block"
            });
        document
            .querySelectorAll('.addSlider')
            .forEach(x => {
                x.style.display = "none"
            });
        document
            .querySelectorAll('.formerclose')
            .forEach(x => {
                x.style.right = "35px"
            });
        document
            .querySelectorAll('.cotentdiv')
            .forEach(x => {
                x.style.display = "none"
            });

        document
            .querySelector('.cancelorder')
            .style
            .display = "inline-block";

    })

//listfile

document
    .querySelectorAll('.listfile')
    .forEach(x => {

        x.style.display = "none";

    });

document
    .querySelectorAll('.buttonfoto')
    .forEach((x, i) => {

        x.addEventListener('click', (e) => {
            e.preventDefault();

            if (document.querySelectorAll('.listfile')[i].style.display == "none") {
                document
                    .querySelectorAll('.listfile')[i]
                    .style
                    .display = "grid";
            } else {
                document
                    .querySelectorAll('.listfile')[i]
                    .style
                    .display = "none"
            }

        })

    });

document
    .querySelectorAll('.listfile')
    .forEach((c, i) => {

        c
            .querySelectorAll('.thisphoto')
            .forEach(x => {
                x.addEventListener('click', (item) => {
                    item.preventDefault();

                    let linker = x.getAttribute('href');

                    document
                        .querySelectorAll('.inputer')[i]
                        .value = linker;
                    document
                        .querySelectorAll('.listfile')[i]
                        .style
                        .display = "none"

                })
            })

    })

//listfile hideorder

document
    .querySelector('.cancelorder')
    .style
    .display = "none";