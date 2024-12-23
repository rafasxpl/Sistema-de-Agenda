<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    $id = $_GET['id'] ?? "";
    $querySql = "SELECT * FROM contatos WHERE idContato={$id}";

    $informacoesContato = ControllerContatos::resgatarDadosQuery($querySql);
    $informacoesContato = $informacoesContato[0] ?? [];
    
?>
<section>
    <form action="" method="POST">
        <div class="cadastrarNomeContainer">
            <label for="atualizarNome">Nome</label>
            <input type="text" id="atualizarNome" name="atualizarNome" 
            value="<?= $informacoesContato['nomeContato'] ?? ""; ?>" 
            >
        </div>
        <div class="cadastrarEmailContainer">
            <label for="atualizarEmail">Email</label>
            <input type="email" id="atualizarEmail" name="atualizarEmail" 
            value="<?= $informacoesContato['emailContato'] ?? ""; ?>"
            >
        </div>
        <div class="cadastrarSexoContainer">
            <label id="labelSexo">Sexo</label>

            <label for="atualizarSexoMasculino">Masculino</label>
            <input type="radio" id="atualizarSexoMasculino" name="atualizarSexo" 
            value="M"
            <?= ($informacoesContato['sexoContato'] === "M") ? "checked" : ""; ?>
            >

            <label for="cadastrarSexoFeminino">Feminino</label>
            <input type="radio" id="atualizarSexoFeminino" name="atualizarSexo" 
            value="F"
            <?= ($informacoesContato['sexoContato'] === "F") ? "checked" : ""; ?>
            >
        </div>
        <div class="cadastrarContatolContainer">
            <label for="atualizarContato">Contato</label>
            <input type="text" id="atualizarContato" name="atualizarContato"
            value="<?= $informacoesContato['telefoneContato'] ?>"
            >
        </div>
        <div class="cadastrarNascimentolContainer">
            <label for="atualizarNascimento">Data de nascimento</label>
            <input type="date" id="atualizarNascimento" name="atualizarNascimento"
            value="<?= $informacoesContato['dataNascimentoContato'] ?>"
            >
        </div>
        <div>
            <input type="submit" name="submit" value="Atualizar">
        </div>
    </form>
</section>
<pre>
</pre>
<?php
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    if(isset($_POST['atualizarNascimento']) || isset($_POST['atualizarNome']) || isset($_POST['atualizarEmail']) || isset($_POST['atualizarSexo']) || isset($_POST['atualizarContato'])) {

        $dataNascimento = date_create($_POST['atualizarNascimento'] ?? null);
        $dataFormatada  = date_format($dataNascimento, 'Y-m-d');

        ControllerContatos::atualizarInformacoesContatos(
            [
                "nomeContato"           =>  $_POST['atualizarNome']     ?? null,
                "emailContato"          =>  $_POST['atualizarEmail']    ?? null,
                "sexoContato"           =>  $_POST['atualizarSexo']     ?? null,
                "telefoneContato"       =>  $_POST['atualizarContato']  ?? null,
                "dataNascimentoContato" =>  $dataFormatada              ?? null,
            ],
            $id
        );
    }
?>