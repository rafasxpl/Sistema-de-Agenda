<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/config.php";

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

    $informacoesContato = ControllerContatos::resgatarDadosContatos($id)[0];
    $imagemUsuario      = "uploads/images/";
    $imagemUsuario      = $informacoesContato['fotoContato'] === NULL ? "defaultUser.jpg" : $informacoesContato['fotoContato'];

    if(isset($_POST['atualizarNascimento']) || isset($_POST['atualizarNome']) || isset($_POST['atualizarEmail']) || isset($_POST['atualizarSexo']) || isset($_POST['atualizarContato'])) {
        $dataNascimento           = date_create($_POST['atualizarNascimento'] ?? null);
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

    if(isset($_FILES['imagemUsuario']['name'])) {
        $mensagemErroImagem       = "";
        $mensagemSucessoImagem    = "";
        $diretorioDestino = "/uploads/";

        $arquivoImagem = $_FILES['imagemUsuario']['name'];
        $arquivoImagem = str_replace(" ", "-", $arquivoImagem);

        $nomeImagemTemporario   = $_FILES['imagemUsuario']['tmp_name'];
        $diretorioDestinoImagem   = ROOT_DIR . $diretorioDestino . $arquivoImagem;

        if (file_exists($diretorioDestinoImagem)) {
            $erroImagem = "Imagem já existe";
        } else {
            if (move_uploaded_file($nomeImagemTemporario, $diretorioDestinoImagem)) {
                ControllerContatos::cadastrarImagemContato($arquivoImagem, $id);
                $imagemUsuario = ControllerContatos::resgatarDadosContatos($id)[0]['fotoContato'] === NULL ? "defaultUser.jpg" : ControllerContatos::resgatarDadosContatos($id)[0]['fotoContato'];
                $sucessoImagem = "Imagem cadastrada com sucesso";
            } else {
                $erroImagem = "Erro ao fazer upload da imagem";
            }
        }
    }
?>
<section class="w-100 h-70 d-flex justify-content-between  bg-secondary">
    <form class="d-flex flex-column align-items-center gap-4 w-50 mt-3" action="" method="POST">
        <div class="cadastrarNomeContainer w-75">
            <label class="form-label" for="cadastrarNome">Nome</label>
            <input class="form-control" type="text" id="cadastrarNome" name="atualizarNome" placeholder="Novo nome aqui" value="<?= $informacoesContato['nomeContato'] ?>">
        </div>
        <div class="w-75">
            <label class="form-label" for="cadastrarEmail">Email</label>
            <div class="input-group">
                <span class="form-label input-group-text my-0" for="cadastrarEmail">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <input class="form-control" type="email" id="cadastrarEmail" name="atualizarEmail" placeholder="E-mail" value="<?= $informacoesContato['emailContato'] ?>">
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
                        <input type="radio" id="cadastrarSexoMasculino" name="atualizarSexo" value="M" 
                        <?= $informacoesContato['sexoContato'] === "M" ? 'checked' : "" ?>>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="form-label my-0 fs-3" for="cadastrarSexoFeminino">
                            <i class="fa-solid fa-person-dress"></i>
                        </span>
                        <label for="cadastrarSexoFeminino">feminino</label>
                        <input type="radio" id="cadastrarSexoFeminino" name="atualizarSexo" value="F"  
                        <?= $informacoesContato['sexoContato'] === "F" ? 'checked' : "" ?>>
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
                <input class="form-control" type="text" id="cadastrarContato" name="atualizarContato" placeholder="(xx) xxxxxxxxx"
                value="<?= $informacoesContato['telefoneContato'] ?>">
            </div>
        </div>
        <div class="cadastrarNacsimentolContainer w-75">
            <label class="form-label" for="cadastrarNacsimento">Data de Nascimento</label>
            <div class="input-group">
                <span class="form-label input-group-text my-0" for="cadastrarNacsimento">
                    <i class="fa-solid fa-calendar"></i>
                </span>
                <input class="form-control" type="date" id="cadastrarNacsimento" name="atualizarNascimento" value="<?= $informacoesContato['dataNascimentoContato'] ?>">
            </div>
        </div>
        <div class="w-75">
            <input class="btn btn-success w-100" type="submit" name="submit" value="Atualizar">
        </div>
    </form>
    <div class="imagemUsuario mt-3 d-flex flex-column justify-content-center align-items-center w-50">
        <img width="50%" height="auto" src="uploads/<?= $imagemUsuario?>" alt="">
        <div class="input-group w-50">
            <button id="btn-foto-usuario" class="btn btn-primary form-control" type="button">Alterar foto</button>
        </div>
        <form id="form-alterar-foto" class="mt-3" action="" method="post" enctype="multipart/form-data">
            <div class="input-group w-auto">
                <span class="input-group-text">
                    <i class="fa-solid fa-camera"></i>
                </span>
                <input class="form-control w-auto d-inline-block" type="file" name="imagemUsuario">
            </div>
            <button id="btn-submit-foto" class="btn btn-success w-100 mt-3" type="submit">Upload</button>
        </form>
        <?php 
            // if(isset($erroImagem) && !empty($erroImagem)) {
            //     echo '<div class="text-danger bg-danger-subtle p-1 w-50 text-center rounded border border-danger mt-3">' . $erroImagem . '</div>';
            // } else if(isset($sucessoImagem) && !empty($sucessoImagem)) {
            //     echo '<div class="text-success bg-success-subtle p-1 w-50 text-center rounded border border-success mt-3">' . $sucessoImagem . '</div>';
            // }
        ?>

        <?php if(isset($erroImagem) && !empty($erroImagem)): ?>
            <div class="text-danger bg-danger-subtle p-1 w-50 text-center rounded border border-danger mt-3">
                <?= $erroImagem ?>
            </div>
        <?php endif?>
        <?php if(isset($sucessoImagem) && !empty($sucessoImagem)): ?>
            <div class="text-success bg-success-subtle p-1 w-50 text-center rounded border border-success mt-3">
                <?= $sucessoImagem ?>
            </div>
        <?php endif ?>
    </div>
</section>
