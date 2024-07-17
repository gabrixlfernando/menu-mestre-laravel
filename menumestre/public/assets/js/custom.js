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

function formContato(e) {
    e.preventDefault();
    e.stopPropagation();

    // Validar os campos do formulário
    var nomeContato = document.getElementById('nomeContato').value.trim();
    var emailContato = document.getElementById('emailContato').value.trim();
    var foneContato = document.getElementById('foneContato').value.trim();
    var assuntoContato = document.getElementById('assuntoContato').value.trim();
    var mensContato = document.getElementById('mensContato').value.trim();

    var camposVazios = [];

    if (!nomeContato) {
        camposVazios.push("Nome");
    }
    if (!emailContato) {
        camposVazios.push("Email");
    }
    if (!foneContato) {
        camposVazios.push("Telefone");
    }
    if (!assuntoContato) {
        camposVazios.push("Assunto");
    }
    if (!mensContato) {
        camposVazios.push("Mensagem");
    }

    if (camposVazios.length > 0) {
        showAlert(`<div class="alert alert-danger">Por favor, preencha os seguintes campos: ${camposVazios.join(', ')}.</div>`, "contatoMensagem");
        return; // Impede o envio do formulário se algum campo estiver vazio
    }

    var data = {
        nomeContato: nomeContato,
        emailContato: emailContato,
        foneContato: foneContato,
        assuntoContato: assuntoContato,
        mensContato: mensContato
    };

    var formSection = document.getElementById('contato');
    var contatoUrl = formSection.getAttribute('data-contato-url');

    fetch(contatoUrl, {
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
        } else {
            showAlert(
                `<div class="alert alert-danger">Erro ao enviar email.</div>`,
                "contatoMensagem"
            );
        }
    })
    .catch(error => {
        let errorMessage = "Erro desconhecido";

        if (error.errors) {
            // Se houver erros de validação, exiba cada mensagem de erro
            errorMessage = Object.values(error.errors).flat().join('<br>');
        } else if (error.message) {
            // Se houver uma mensagem de erro geral, exiba essa mensagem
            errorMessage = error.message;
        } else if (typeof error === 'object') {
            // Exibir detalhes do erro caso seja um objeto
            errorMessage = JSON.stringify(error);
        }

        showAlert(
            `<div class="alert alert-danger">${errorMessage}</div>`,
            "contatoMensagem"
        );
    });
}





$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#btnVoltarAoTopo').fadeIn();
        } else {
            $('#btnVoltarAoTopo').fadeOut();
        }
    });

    $('#btnVoltarAoTopo').click(function() {
        $('html, body').animate({scrollTop : 0},300);
        return false;
    });
});




