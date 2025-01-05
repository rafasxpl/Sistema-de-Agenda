$(document).ready(() => {
    $(".excluirTarefasButton").on("click", function() {
        let idTarefa = $(this).data('id')

        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/tarefas/ViewExcluirTarefa.php',
            type: 'POST',
            data: { idTarefa: idTarefa },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log('Erro ao excluir contato: ' + error);
            }
        });
    })
})