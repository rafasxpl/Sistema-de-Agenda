<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/eventos/ControllerEventos.php";

    if(isset($_POST['idEvento'])) {
        $idEvento = $_POST['idEvento'];
        
        try {
            ControllerEventos::excluirEvento($idEvento);
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }
