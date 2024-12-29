<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    $id = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : null;
    
    ControllerContatos::excluirContato($id);