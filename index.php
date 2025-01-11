<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Agenda</title>
</head>
<body class="h-100">
    <header class="d-flex justify-content-around align-items-center py-3 bg-dark">
        <div class="logo w-25 mx-auto">
            <i class="fs-1 fa-regular fa-clock" style="color: #ffffff;"></i>
        </div>
        <nav class="d-flex align-items-center justify-content-around gap-5 w-50">
            <ul class="list-unstyled d-flex align-items-center gap-5 my-0">
                <li><a class="text-decoration-none text-white" href="index.php?page=contatos">Contatos</a></li>
                <li>
                    <select class="form-select" name="eventos" id="eventos" onchange="location = this.value;">
                        <option selected disabled>Eventos</option>
                        <option value="index.php?page=eventos">Todos</option>
                        <option value="index.php?page=eventosConcluidos">Concluídos</option>
                    </select>
                </li>
                <li>
                    <select class="form-select" name="tarefas" id="tarefas" onchange="location = this.value;">
                        <option selected disabled>Tarefas</option>
                        <option value="index.php?page=tarefas">Todas</option>
                        <option value="index.php?page=tarefasConcluidas">Concluídas</option>
                    </select>
                </li>
                </ul>
                <div>
                    <button class="btnLogout btn btn-transparent d-flex align-items-center gap-3">
                        <i class="fs-4 fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                        <span class="text-white">
                            <?= isset($_SESSION['nomeUsuario']) && !empty($_SESSION['nomeUsuario']) ? $_SESSION['nomeUsuario'] : null ?>
                        </span>
                    </button>
                </div>
        </nav>
    </header>
    <main class="bg-secondary vh-100">
        <?php
            require_once "routes/routes.php";

            if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
                $page = isset($_GET['page']) ? $_GET['page'] : null;
                $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');
                
                !array_key_exists($page, $routes) ? header('Location: 404/404.php') : require_once __DIR__ . $routes[$page];
            } else {
                header("Location: acount/pageLogin.php");
                exit();
            }

        ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/excluirDados.js"></script>
    <script src="js/hideShowElements.js"></script>
    <script src="js/alterarStatus.js"></script>
    <script src="js/favoritarContato.js"></script>
    <script src="js/logout.js"></script>
    <script src="https://kit.fontawesome.com/fd7710791c.js" crossorigin="anonymous"></script>
</body>
</html>