$(document).ready(() => {
    $(".checkBoxTarefa").on("click", function() {
        let checkBoxIsChecked = $(this).prop("checked");
        let idCheckBox        = $(this).prop('id');

        console.log(checkBoxIsChecked);
        
        $.post('http://localhost:81/Sistema-de-Agenda/MVC/views/tarefas/ViewTarefas.php', 
        { checked: checkBoxIsChecked ? '1' : '0' , id: idCheckBox }, 
        function(response) {
            console.log("sucess");
            
        }).fail(function(xhr, status, error) {
            console.log('Erro concluir tarefa: ' + error);
        });
    });
});
