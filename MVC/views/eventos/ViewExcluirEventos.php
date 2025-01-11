<?php 
    require_once __DIR__ . "../../../controllers/eventos/ControllerEventos.php";

    if(isset($_POST['idEvento'])) {
        $idEvento = $_POST['idEvento'];
        
        try {
            ControllerEventos::excluirEvento($idEvento);
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }
