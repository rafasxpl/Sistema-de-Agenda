$(document).ready(function() {
    $('.btnFavoritarContato').on('click', function() {
        let flagFavoritoContato = Number($(this).prop('id'));
        let idContato           = Number($(this).data('id'));

        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/contatos/ViewContatos.php',
            type: 'POST',
            data: { flagFavorito: flagFavoritoContato === 1 ? 0 : 1, id: idContato },
            success: function() {
                location.reload();
            },
            error: function(_, __, error) {
                console.log('Erro ' + error);
            }
        });
    })
})