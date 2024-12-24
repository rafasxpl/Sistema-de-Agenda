<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";

    $chaveBusca = $_POST['chaveBusca'] ?? "";
    $chaveBusca = preg_match("/[0-9]/", $chaveBusca) ? (int) $chaveBusca : (string) $chaveBusca;

    $dadosContato = ControllerContatos::resgatarDadosContatos($chaveBusca);
?>
<section>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Sexo</th>
            <th>Nascimento</th>
            <th colspan="2">Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dadosContato as $content):?>
            <tr>
                <th>
                    <?= $content['idContato']?>
                </th>
                <th>
                    <?= $content['nomeContato'] ?>
                </th>
                <th>
                    <?= $content['emailContato'] ?>
                </th>
                <th>
                    <?= $content['telefoneContato'] ?>
                </th>
                <th>
                    <?= $content['sexoContato'] ?>
                </th>
                <th>
                    <?= $content['dataNascimentoContato']?>
                </th>
                <th>
                    <a href="index.php?page=editarContatos&id=<?= $content['idContato']?>">Editar</a>
                </th>
                <th>
                    <button class="excluirContatosButton" data-id="<?= $content['idContato'] ?>">Excluir</button>
                </th>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</section>
