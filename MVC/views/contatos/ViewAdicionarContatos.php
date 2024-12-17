<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";
    $controllerContato = new ControllerContatos();
    
    $dadosQuery = $controllerContato->cadastrarContato(
        "contatos", 
        [
            "nomeContato"           =>  $_POST['cadastrarNome']       ,
            "emailContato"          =>  $_POST['cadastrarEmail']      ,
            "telefoneContato"       =>  $_POST['cadastrarContato']   ,
            "sexoContato"           =>  $_POST['cadastrarSexo']       ,
            "dataNascimentoContato" =>  $_POST['cadastrarNacsimento'] 
        ]);
?>
<section>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <div class="cadastrarNomeContainer">
            <label for="cadastrarNome">Nome</label>
            <input type="text" id="cadastrarNome" name="cadastrarNome" placeholder="Seu nome aqui">
        </div>
        <div class="cadastrarEmailContainer">
            <label for="cadastrarEmail">Email</label>
            <input type="email" id="cadastrarEmail" name="cadastrarEmail" placeholder="E-mail">
        </div>
        <div class="cadastrarSexoContainer">
            <label for="cadastrarSexo">Sexo</label>

            <label for="cadastrarSexoMasculino">Masculino</label>
            <input type="radio" id="cadastrarSexoMasculino" name="cadastrarSexo" value="M">

            <label for="cadastrarSexoFeminino">Feminino</label>
            <input type="radio" id="cadastrarSexoFeminino" name="cadastrarSexo" value="F">
        </div>
        <div class="cadastrarContatolContainer">
            <label for="cadastrarContato">Contato</label>
            <input type="number" id="cadastrarContato" name="cadastrarContato" placeholder="(xx) xxxxxxxxx">
        </div>
        <div class="cadastrarNacsimentolContainer">
            <label for="cadastrarNacsimento">Data de nascimento</label>
            <input type="date" id="cadastrarNacsimento" name="cadastrarNacsimento">
        </div>
        <div>
            <input type="submit" value="Cadastrar">
            <input type="reset" value="Limpar">
        </div>
    </form>
</section>