<?php 
    session_start();
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/auth/ControllerAuth.php";

    if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
        header("Location: ../index.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userName']) && isset($_POST['password'])) {
        $nome = $_POST['userName'];
        $senha = $_POST['password'];
        $existenciaUsuario = ControllerAuth::checarExistenciaUsuario($nome, $senha);

        if($existenciaUsuario) {
            $_SESSION['login'] = true;
            $_SESSION['nomeUsuario'] = $nome;
            header("Location: ../index.php");
            exit();
        }
    }
?>
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="pageLogin.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4 text-light">Login</h2>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="userName" class="form-label text-light">Nome</label>
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-light">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label text-light" for="rememberMe">Remember me</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="createAcount.php" class="text-decoration-none text-primay-emphasis">Criar conta</a>
                        </div>
                        <?php if(isset($existenciaUsuario) && !$existenciaUsuario):?>
                            <div class="alert alert-danger mt-3 text-center" role="alert">
                                Usuário não existe
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>