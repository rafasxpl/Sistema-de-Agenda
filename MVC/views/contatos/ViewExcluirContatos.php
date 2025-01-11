<?php 
    require_once __DIR__ . "../../../controllers/contatos/ControllerContatos.php";

    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        try {
            ControllerContatos::excluirContato($id);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }