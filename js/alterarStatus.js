$(document).ready(() => {
    $(".checkBoxTarefa").on("click", function() {
        let checkBoxTarefaIsChecked = $(this).prop("checked");
        let idCheckBoxTarefa        = $(this).prop('id');

        $.post('http://localhost:81/Sistema-de-Agenda/MVC/views/tarefas/ViewTarefas.php', 
        { checked: checkBoxTarefaIsChecked ? '1' : '0' , id: idCheckBoxTarefa }, 
        function() {
            console.log("sucess");
            
        }).fail(function(_, __, error) {
            console.log('Erro concluir tarefa: ' + error);
        });
    });

    $(".checkBoxEvento").on("click", function() {
        let checkBoxEventoIsChecked = $(this).prop("checked");
        let idCheckBoxEvento        = $(this).prop('id');

        $.post('http://localhost:81/Sistema-de-Agenda/MVC/views/eventos/ViewEventos.php', 
        { checked: checkBoxEventoIsChecked ? '1' : '0' , id: idCheckBoxEvento }, 
        function() {
            console.log("sucess");
            
        }).fail(function(_, __, error) {
            console.log('Erro concluir tarefa: ' + error);
        });
    });
});
