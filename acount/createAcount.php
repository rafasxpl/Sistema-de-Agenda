<?php 
    session_start();
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/auth/ControllerAuth.php";

    if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
        header("Location: ../index.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nomeUsuario']) && isset($_POST['senhaUsuario'])) {
        $nomeUsuario = $_POST['nomeUsuario'];
        $senhaUsuario = $_POST['senhaUsuario'];

        $sucessoCriarUsuario = ControllerAuth::criarUsuario($nomeUsuario, $senhaUsuario);

        if($sucessoCriarUsuario) {
            $_SESSION['nomeUsuario'] = $nomeUsuario;
            $_SESSION['login'] = true;
            header("Location: ../index.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="pageLogin.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4 text-light">Criar conta</h2>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nomeUsuario" class="form-label text-light">Nome</label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" id="nomeUsuario" placeholder="Seu nome" name="nomeUsuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="senhaUsuario" class="form-label text-light">Senha</label>
                                <input type="password" class="form-control bg-dark text-light border-secondary" id="senhaUsuario" placeholder="****" name="senhaUsuario" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Criar conta</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="pageLogin.php" class="text-decoration-none text-primary">Já tem uma conta? Log in</a>
                        </div>
                        <?php if(isset($sucessoCriarUsuario) && !$sucessoCriarUsuario): ?>
                            <div class="alert alert-danger mt-3 text-center" role="alert">
                                Usuário já existe
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>