$(document).ready(function() {
    $('.excluirContatosButton').on('click', function() {
        let idContato = $(this).data('id');

        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/contatos/ViewExcluirContatos.php',
            type: 'POST',
            data: { id: idContato },
            success: function() {
                location.reload();
            },
            error: function(_, __, error) {
                console.log('Erro ao excluir contato: ' + error);
            }
        });
    });

    $('.excluirTarefasButton').on('click', function() {
        let idTarefa = $(this).data('id')

        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/tarefas/ViewExcluirTarefa.php',
            type: 'POST',
            data: { idTarefa: idTarefa },
            success: function() {
                location.reload();
            },
            error: function(_, __, error) {
                console.log('Erro ao excluir tarefa: ' + error);
            }
        });
    })

    $('.excluirEventosButton').on('click', function() {
        let idEvento = $(this).data('id')

        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/eventos/ViewExcluirEventos.php',
            type: 'POST',
            data: { idEvento: idEvento },
            success: function() {
                location.reload();
            },
            error: function(_, __, error) {
                console.log('Erro ao excluir evento: ' + error);
            }
        });
    })
});