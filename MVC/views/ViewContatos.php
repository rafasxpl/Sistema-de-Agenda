<?php 
    require_once "MVC/controllers/ControllerContatos.php";
    $controllerContato = new ControllerContatos();
    $dados = $controllerContato->getData();
?>
<section>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Sexo</th>
                <th>Nascimento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dados as $content):?>
                <tr>
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
                </tr>
                <?php endforeach ?>
            </tbody>
    </table>
</section>