<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    $chaveBusca = $_POST['chaveBusca'] ?? "";
    $chaveBusca = preg_match("/[0-9]/", $chaveBusca) ? (int) $chaveBusca : (string) $chaveBusca;

    $dadosContato = ControllerContatos::resgatarDadosContatos($chaveBusca);
?>
<section class="w-100 d-flex flex-column align-items-center mt-5">
<table class="table table-striped w-75">
    <thead>
        <tr class="table-row">
            <th class="table-cell align-middle text-center">ID</th>
            <th class="table-cell align-middle text-center">Nome</th>
            <th class="table-cell align-middle text-center">E-mail</th>
            <th class="table-cell align-middle text-center">Telefone</th>
            <th class="table-cell align-middle text-center">Sexo</th>
            <th class="table-cell align-middle text-center">Nascimento</th>
            <th class="table-cell align-middle text-center" colspan="2">Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dadosContato as $content):?>
            <tr class="table-row">
                <th class="table-cell align-middle text-center">
                    <?= $content['idContato']?>
                </th>
                <th class="table-cell align-middle text-center">
                    <?= $content['nomeContato'] ?>
                </th>
                <th class="table-cell align-middle text-center">
                    <?= $content['emailContato'] ?>
                </th>
                <th class="table-cell align-middle text-center">
                    <?= $content['telefoneContato'] ?>
                </th>
                <th class="table-cell align-middle text-center">
                    <?= $content['sexoContato'] ?>
                </th>
                <th class="table-cell align-middle text-center">
                    <?= $content['dataNascimentoContato']?>
                </th>
                <th class="table-cell align-middle text-center">
                    <a href="index.php?page=editarContatos&id=<?= $content['idContato']?>">Editar</a>
                </th>
                <th class="table-cell align-middle text-center">
                    <button class="excluirContatosButton excluirContatosButton btn btn-danger" data-id="<?= $content['idContato'] ?>">Excluir</button>
                </th>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</section>
