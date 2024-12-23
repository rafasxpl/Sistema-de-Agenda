<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";
    $id = $_GET['id'] ?? "";

    ControllerContatos::excluirContato($id);
    
    if(!ControllerContatos::resgatarDadosContatos()) {
        ControllerContatos::executarQuerySql("TRUNCATE TABLE contatos");
    }
?>
