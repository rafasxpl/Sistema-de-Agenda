<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/opt/lampp/htdocs/Sistema-de-Agenda/css/style.css">
    <title>Agenda</title>
</head>
<body>
    <header class="d-flex justify-content-around align-items-center p-3 bg-dark">
        <div class="logo">
            <h1 class="text-white">Agenda</h1>
        </div>
        <nav>
            <ul class="list-unstyled d-flex gap-5">
                <li><a class="text-decoration-none text-white" href="index.php?page=home">Home</a></li>
                <li><a class="text-decoration-none text-white" href="index.php?page=contatos">Contatos</a></li>
                <li><a class="text-decoration-none text-white" href="index.php?page=eventos">Eventos</a></li>
                <li><a class="text-decoration-none text-white" href="index.php?page=tarefas">Tarefas</a></li>
            </ul>
        </nav>
    </header>
    <main class="bg-secondary vh-100">
        <?php
            require_once "routes/routes.php";

            $page = isset($_GET['page']) ? $_GET['page'] : null;
            $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');
            
            !array_key_exists($page, $routes) ? header('Location: 404/404.php') : require_once __DIR__ . $routes[$page];
        ?>
    </main>
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/fd7710791c.js" crossorigin="anonymous"></script>
    <script src="js/excluirContato.js"></script>
</body>
</html>