<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

    $informacoesContato = ControllerContatos::resgatarDadosContatos($id)[0];
    $imagemUsuario = "uploads/images/";
    $imagemUsuario = $informacoesContato['fotoContato'] === NULL ? "defaultUser.jpg" : $informacoesContato['fotoContato'];

    $nomeFoto = file_exists("uploads/images/" . $informacoesContato['fotoContato']) ? $informacoesContato['fotoContato'] : "defaultUserImage/defaultUser.jpg";

?>
<section class="w-100 h-70 d-flex justify-content-between  bg-secondary">
    <form class="d-flex flex-column align-items-center gap-4 w-50 mt-3" action="" method="POST">
        <div class="cadastrarNomeContainer w-75">
            <label class="form-label" for="cadastrarNome">Nome</label>
            <input class="form-control" type="text" id="cadastrarNome" name="cadastrarNome" placeholder="Novo nome aqui" value="<?= $informacoesContato['nomeContato'] ?>">
        </div>
        <div class="w-75">
            <label class="form-label" for="cadastrarEmail">Email</label>
            <div class="input-group">
                <span class="form-label input-group-text my-0" for="cadastrarEmail">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <input class="form-control" type="email" id="cadastrarEmail" name="cadastrarEmail" placeholder="E-mail" value="<?= $informacoesContato['emailContato'] ?>">
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
                        <input type="radio" id="cadastrarSexoMasculino" name="cadastrarSexo" value="M" 
                        <?= $informacoesContato['sexoContato'] === "M" ? 'checked' : null ?>>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="form-label my-0 fs-3" for="cadastrarSexoFeminino">
                            <i class="fa-solid fa-person-dress"></i>
                        </span>
                        <label for="cadastrarSexoFeminino">feminino</label>
                        <input type="radio" id="cadastrarSexoFeminino" name="cadastrarSexo" value="F"  
                        <?= $informacoesContato['sexoContato'] === "M" ? 'checked' : null ?>>
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
                <input class="form-control" type="text" id="cadastrarContato" name="cadastrarContato" placeholder="(xx) xxxxxxxxx"
                value="<?= $informacoesContato['telefoneContato'] ?>">
            </div>
        </div>
        <div class="cadastrarNacsimentolContainer w-75">
            <label class="form-label" for="cadastrarNacsimento">Data de Nascimento</label>
            <div class="input-group">
                <span class="form-label input-group-text my-0" for="cadastrarNacsimento">
                    <i class="fa-solid fa-calendar"></i>
                </span>
                <input class="form-control" type="date" id="cadastrarNacsimento" name="cadastrarNascimento" value="<?= $informacoesContato['dataNascimentoContato'] ?>">
            </div>
        </div>
        <div class="w-75">
            <input class="btn btn-success w-100" type="submit" name="submit" value="Cadastrar">
        </div>
    </form>
    <div class="imagemUsuario mt-3 align-self-center">
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