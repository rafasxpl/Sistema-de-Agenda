<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";
    
    if(isset($_POST['id'])) {
        $id = $_POST['id'] ?? "";
    }

    ControllerContatos::excluirContato($id);
    
    if(!ControllerContatos::resgatarDadosContatos()) {
        ControllerContatos::executarQuerySql("TRUNCATE TABLE contatos");
    }
?>
