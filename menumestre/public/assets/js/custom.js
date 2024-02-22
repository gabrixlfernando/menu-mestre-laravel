// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();


// isotope js
$(window).on('load', function () {
    $('.filters_menu li').click(function () {
        $('.filters_menu li').removeClass('active');
        $(this).addClass('active');

        var data = $(this).attr('data-filter');
        $grid.isotope({
            filter: data
        })
    });

    var $grid = $(".grid").isotope({
        itemSelector: ".all",
        percentPosition: false,
        masonry: {
            columnWidth: ".all"
        }
    })
});

// nice select
$(document).ready(function() {
    $('select').niceSelect();
  });

/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

// client section owl carousel
$(".client_owl-carousel").owlCarousel({
    loop: true,
    margin: 0,
    dots: false,
    nav: true,
    navText: [],
    autoplay: true,
    autoplayHoverPause: true,
    navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        1000: {
            items: 2
        }
    }
});

function showAlert(mensagem, targetElementId, timeout = 3000) {
    var messageDiv = document.getElementById(targetElementId);
    messageDiv.innerHTML = mensagem;
    messageDiv.classList.remove('msgContato');

    setTimeout(function() {
        messageDiv.classList.add('msgContato');
    }, timeout);
}

function displayError(erros) {
    let todosOsErros = "";

    for (const [key, value] of Object.entries(erros)) {
        todosOsErros += `<div class="alert alert-danger">${value.join(", ")}</div>`;
    }

    if (todosOsErros) {
        showAlert(todosOsErros, "contatoMensagem");
    }
}

function formContato(e){
    e.preventDefault();
    e.stopPropagation();


    var data = {
        nomeContato : document.getElementById('nomeContato').value,
        emailContato : document.getElementById('emailContato').value,
        foneContato : document.getElementById('foneContato').value,
        assuntoContato : document.getElementById('assuntoContato').value,
        mensContato : document.getElementById('mensContato').value
    };




    fetch('/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errorData => {
                throw errorData;
            });
        }
        return response.json();
    })
    .then((data) => {
        if (data.success) {
            showAlert(
                `<div class="alert alert-success">${data.success}</div>`,
                 "contatoMensagem"
            );
            document.getElementById('formContato').reset();
        } else{
            showAlert(
                `<div class="alert alert-danger">Erro ao enviar email.</div>`,
                "contatoMensagem"
            );
        }
    })

    .catch(error => {
            if (error.errors) {
                displayError(error.errors);
            }else {
                console.log("Erro desconhecido", error);
            }
    });
}



// function formContato(e){
//     e.preventDefault();
//     e.stopPropagation();

//     var form = document.getElementById('formContato');

//     fetch('/', {
//         method: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: new FormData(form)
//     })
//     .then(response => {
//         if (!response.ok) {
//             return response.json().then(errorData => {
//                 throw errorData;
//             });
//         }
//         return response.json();
//     })
//     .then((data) => {
//         if (data.success) {
//             showAlert(
//                 `<div class="alert alert-success">${data.success}</div>`,
//                  "contatoMensagem"
//             );
//             form.reset();
//         } else{
//             showAlert(
//                 `<div class="alert alert-danger">Erro ao enviar email.</div>`,
//                 "contatoMensagem"
//             );
//         }
//     })
//     .catch(error => {
//             if (error.errors) {
//                 displayError(error.errors);
//             }else {
//                 console.log("Erro desconhecido", error);
//             }
//     });
// }
