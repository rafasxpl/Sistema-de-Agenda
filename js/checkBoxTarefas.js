$(document).ready(() => {
    $(".checkBoxTarefa").on("click", function() {
        let checkBoxIsChecked = $(this).prop("checked");
        let idCheckBox        = $(this).prop('id');

        $.post('http://localhost:81/Sistema-de-Agenda/MVC/views/tarefas/ViewTarefas.php', 
        { checked: checkBoxIsChecked ? '1' : '0' , id: idCheckBox }, 
        function() {
            console.log("sucess");
            
        }).fail(function(_, __, error) {
            console.log('Erro concluir tarefa: ' + error);
        });
    });
});
