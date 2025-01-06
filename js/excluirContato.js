$(document).ready(function() {
    $('.excluirContatosButton').on('click', function() {
        var userId = $(this).data('id');

        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/contatos/ViewExcluirContatos.php',
            type: 'POST',
            data: { id: userId },
            success: function() {
                location.reload();
            },
            error: function(_, __, error) {
                console.log('Erro ao excluir contato: ' + error);
            }
        });
    });
});