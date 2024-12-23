<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sistema-de-Agenda/css/style.css?v=1.0">
    <link rel="stylesheet" href="/Sistema-de-Agenda/css/ViewContatos.css?v=1.0">
    <link rel="stylesheet" href="/Sistema-de-Agenda/css/ViewAdicionarContatos.css?v=1.0">
    <title>Agenda</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Agenda</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=contatos">Contatos</a></li>
                <li><a href="index.php?page=eventos">Eventos</a></li>
                <li><a href="index.php?page=tarefas">Tarefas</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
            require_once "routes/routes.php";
            $page = $_GET['page'] ?? "";
            $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');
            
            !array_key_exists($page, $routes) ? header('Location: 404/404.php') : require_once __DIR__ . $routes[$page];
        ?>
    </main>
</body>
</html>