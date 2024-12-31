<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        try {
            ControllerContatos::excluirContato($id);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }