<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

    $informacoesContato = ControllerContatos::resgatarDadosContatos($id)[0];
    $imagemUsuario = "uploads/images/";
    $imagemUsuario = $informacoesContato['fotoContato'] === NULL ? "defaultUser.jpg" : $informacoesContato['fotoContato'];

    $nomeFoto = file_exists("uploads/images/" . $informacoesContato['fotoContato']) ? $informacoesContato['fotoContato'] : "defaultUserImage/defaultUser.jpg";

?>
<section class="editContatoContainer">
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
        <div class="cadastrarContatoContainer">
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
    <div class="imagemUsuario">
        <img width="50%" src="uploads/<?= $imagemUsuario?>" alt="">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="imagemUsuario">
            <input type="submit" value="Upload">
        </form>
    </div>
</section>
<?php
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    if(isset($_POST['atualizarNascimento']) || isset($_POST['atualizarNome']) || isset($_POST['atualizarEmail']) || isset($_POST['atualizarSexo']) || isset($_POST['atualizarContato'])) {
        $dataNascimento = date_create($_POST['atualizarNascimento'] ?? null);
        $dataNascimentoFormatada  = date_format($dataNascimento, 'Y-m-d');

        ControllerContatos::atualizarInformacoesContatos(
            [
                "nomeContato"           =>  $_POST['atualizarNome']     ?? null,
                "emailContato"          =>  $_POST['atualizarEmail']    ?? null,
                "sexoContato"           =>  $_POST['atualizarSexo']     ?? null,
                "telefoneContato"       =>  $_POST['atualizarContato']  ?? null,
                "dataNascimentoContato" =>  $dataNascimentoFormatada    ?? null,
            ],
            $id
        );
    }

    if(!empty($_FILES['imagemUsuario'])) {
        $diretorioDestino = "uploads/";

        $arquivoImagem    = $_FILES['imagemUsuario']['name'];
        $arquivoImagem = str_replace(" ", "-", $arquivoImagem);

        $nomeTemporario   = $_FILES['imagemUsuario']['tmp_name'];
        $destinoArquivo   = $diretorioDestino . $arquivoImagem;
        
        if (file_exists($destinoArquivo)) {
            throw new RuntimeException("Arquivo já existe");    
        } else {
            move_uploaded_file($nomeTemporario,$destinoArquivo);
            ControllerContatos::cadastrarImagemContato($arquivoImagem, $id, false);
            header("Refresh: 0");
        }
    }
?>