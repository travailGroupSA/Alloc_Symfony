$(document).ready(function () {
    //charger les chambres
    $(".pagination .page-item").attr('class', "page-item");
    $(".page-link").click(function (e) {
        e.preventDefault();
        let linkhref = $(this).attr('href');
        let numpage = linkhref ? linkhref.split('=')[1] : 1

        $.ajax({
            url: "/chambre/",
            method: "GET",
            data: {
                page: parseInt(numpage)
            },
            success: function (rendu) {
                $('#paginate_container').html(rendu);
            },
            dataType: 'text'
        })
    })



    //ajout chambre
    $('#add_chambre').submit(function (e) {
        e.preventDefault();
        let numBatiment = $('#chambre_numBatiment').val();
        let type = $('#chambre_type').val();
        if (numBatiment == '' || type == '' || type == 0) {
            alert('Saisir les donnes');
        } else {
            $.ajax({
                url: '/chambre/create',
                method: 'POST',
                data: {
                    numBatiment,
                    type,
                },
                success: function (data) {
                    if (data['response'] == 'envoyé') {
                        alert('Vous avez ajoute une chambre avec succès');
                        window.location.href = '/chambre';
                    } else {
                        alert('Veuillez vérifier les informations saisies svp!');
                    }
                },
                dataType: 'json',
            });
        }
    });

    //modifier chambre
    $('#update_chambre').submit(function (e) {
        e.preventDefault();
        let url = $("#url_edit").attr('name');
        let numBatiment = $('#chambre_numBatiment').val();
        let type = $('#chambre_type').val();
        if (numBatiment == '' || type == '' || type == 0) {
            alert('Saisir les donnes');
        } else {
            $.ajax({
                url,
                method: 'POST',
                data: {
                    numBatiment,
                    type,
                },
                success: function (data) {
                    if (data['response'] == 'envoyé') {
                        alert('Vous avez ajoute une chambre avec succès');
                        window.location.href = '/chambre';
                    } else {
                        alert('Veuillez vérifier les informations saisies svp!');
                    }
                },
                dataType: 'json',
            });
        }
    });
});