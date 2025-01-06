$(document).ready(() => {
    $(".excluirTarefasButton").on("click", function() {
        let idTarefa = $(this).data('id')

        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/tarefas/ViewExcluirTarefa.php',
            type: 'POST',
            data: { idTarefa: idTarefa },
            success: function() {
                location.reload();
            },
            error: function(_, __, error) {
                console.log('Erro ao excluir contato: ' + error);
            }
        });
    })
})