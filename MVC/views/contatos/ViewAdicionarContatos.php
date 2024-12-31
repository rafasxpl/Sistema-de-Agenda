<section class="w-100 h-100 d-flex justify-content-center bg-secondary">
    <form class="d-flex flex-column align-items-center gap-4 w-50 mt-3" action="" method="POST">
        <div class="cadastrarNomeContainer w-75">
            <label class="form-label" for="cadastrarNome">Nome</label>
            <input class="form-control" type="text" id="cadastrarNome" name="cadastrarNome" placeholder="Seu nome aqui">
        </div>
        <div class="w-75">
            <label class="form-label" for="cadastrarEmail">Email</label>
            <div class="input-group">
                <span class="form-label input-group-text my-0" for="cadastrarEmail">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <input class="form-control" type="email" id="cadastrarEmail" name="cadastrarEmail" placeholder="E-mail">
            </div>
        </div>
        <div class="w-75">
            <label class="form-label" for="containerInputs">Sexo</label>
            <div id="containerInputs" class="input-group">
                <span class="form-label input-group-text my-0">
                    <i class="fa-solid fa-venus-mars"></i>
                </span>
                <div class="form-control d-flex justify-content-around align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span class="form-label my-0 fs-3" for="cadastrarSexoMasculino">
                            <i class="fa-solid fa-person"></i>
                        </span>
                        <label for="cadastrarSexoMasculino">masculino</label>
                        <input type="radio" id="cadastrarSexoMasculino" name="cadastrarSexo" value="M">
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="form-label my-0 fs-3" for="cadastrarSexoFeminino">
                            <i class="fa-solid fa-person-dress"></i>
                        </span>
                        <label for="cadastrarSexoFeminino">feminino</label>
                        <input type="radio" id="cadastrarSexoFeminino" name="cadastrarSexo" value="F">
                    </div>
                </div>
            </div>
        </div>
        <div class="cadastrarContatolContainer w-75">
            <label class="form-label" for="cadastrarContato">Contato</label>
            <div class="input-group">
                <span class="form-label input-group-text my-0" for="cadastrarContato">
                    <i class="fa-solid fa-phone"></i>
                </span>
                <input class="form-control" type="text" id="cadastrarContato" name="cadastrarContato" placeholder="(xx) xxxxxxxxx">
            </div>
        </div>
        <div class="cadastrarNacsimentolContainer w-75">
            <label class="form-label" for="cadastrarNacsimento">Data de Nascimento</label>
            <div class="input-group">
                <span class="form-label input-group-text my-0" for="cadastrarNacsimento">
                    <i class="fa-solid fa-calendar"></i>
                </span>
                <input class="form-control" type="date" id="cadastrarNacsimento" name="cadastrarNascimento">
            </div>
        </div>
        <div class="w-75">
            <input class="btn btn-success w-100" type="submit" name="submit" value="Cadastrar">
        </div>
    </form>
</section>
<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    if(isset($_POST['cadastrarNascimento']) || isset($_POST['cadastrarNome']) || isset($_POST['cadastrarEmail']) || isset($_POST['cadastrarSexo']) || isset($_POST['cadastrarContato'])) {

        $dataNascimento = date_create($_POST['cadastrarNascimento'] ?? null);
        $dataNascimentoFormatada  = date_format($dataNascimento, 'Y-m-d');

        ControllerContatos::cadastrarContato( 
            [
                "nomeContato"           =>  $_POST['cadastrarNome']     ?? null,
                "emailContato"          =>  $_POST['cadastrarEmail']    ?? null,
                "sexoContato"           =>  $_POST['cadastrarSexo']     ?? null,
                "telefoneContato"       =>  $_POST['cadastrarContato']  ?? null,
                "dataNascimentoContato" =>  $dataNascimentoFormatada    ?? null,
            ],  
            [
                "nomeContatoTipo"           => PDO::PARAM_STR,
                "emailContatoTipo"          => PDO::PARAM_STR,
                "sexoContatoTipo"           => PDO::PARAM_STR,
                "telefoneContatoTipo"       => PDO::PARAM_STR,
                "dataNascimentoContatoTipo" => PDO::PARAM_STR,
            ]
        );
    }
?>