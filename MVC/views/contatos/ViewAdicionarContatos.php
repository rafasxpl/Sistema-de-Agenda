<!DOCTYPE html>
<section>
    <form action="" method="POST">
        <div class="cadastrarNomeContainer">
            <label for="cadastrarNome">Nome</label>
            <input type="text" id="cadastrarNome" name="cadastrarNome" placeholder="Seu nome aqui">
        </div>
        <div class="cadastrarEmailContainer">
            <label for="cadastrarEmail">Email</label>
            <input type="email" id="cadastrarEmail" name="cadastrarEmail" placeholder="E-mail">
        </div>
        <div class="cadastrarSexoContainer">
            <label id="labelSexo">Sexo</label>

            <label for="cadastrarSexoMasculino">Masculino</label>
            <input type="radio" id="cadastrarSexoMasculino" name="cadastrarSexo" value="M">

            <label for="cadastrarSexoFeminino">Feminino</label>
            <input type="radio" id="cadastrarSexoFeminino" name="cadastrarSexo" value="F">
        </div>
        <div class="cadastrarContatolContainer">
            <label for="cadastrarContato">Contato</label>
            <input type="text" id="cadastrarContato" name="cadastrarContato" placeholder="(xx) xxxxxxxxx">
        </div>
        <div class="cadastrarNacsimentolContainer">
            <label for="cadastrarNacsimento">Data de nascimento</label>
            <input type="date" id="cadastrarNacsimento" name="cadastrarNascimento">
        </div>
        <div class="cadastrarFavoritoContainer">
            <label for="cadastrarFavorito">Favorito</label>
            <input type="number" id="cadastrarFavorito" name="cadastrarFavorito">
        </div>
        <div>
            <input type="submit" name="submit" value="Cadastrar">
            <input type="reset" value="Limpar">
        </div>
    </form>
</section>
<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    if(isset($_POST['cadastrarNascimento']) || isset($_POST['cadastrarNome']) || isset($_POST['cadastrarEmail']) || isset($_POST['cadastrarSexo']) || isset($_POST['cadastrarContato'])) {

        $dataNascimento = date_create($_POST['cadastrarNascimento'] ?? null);
        $dataFormatada  = date_format($dataNascimento, 'Y-m-d');

        ControllerContatos::cadastrarContato( 
            [
                "nomeContato"           =>  $_POST['cadastrarNome']     ?? null,
                "emailContato"          =>  $_POST['cadastrarEmail']    ?? null,
                "sexoContato"           =>  $_POST['cadastrarSexo']     ?? null,
                "telefoneContato"       =>  $_POST['cadastrarContato']  ?? null,
                "dataNascimentoContato" =>  $dataFormatada              ?? null,
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