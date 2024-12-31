$(document).ready(function() {
    $('.excluirContatosButton').on('click', function() {
        var userId = $(this).data('id');

        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/contatos/ViewExcluirContatos.php',
            type: 'POST',
            data: { id: userId },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log('Erro ao excluir contato: ' + error);
            }
        });
    });
});