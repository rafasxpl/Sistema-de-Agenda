<?php 
    require_once __DIR__ . "../../../controllers/tarefas/ControllerTarefas.php";

    if(isset($_POST['idTarefa'])) {
        $idTarefa = $_POST['idTarefa'];
        
        try {
            ControllerTarefas::excluirTarefa($idTarefa);
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }
