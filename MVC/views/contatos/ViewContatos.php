<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";
    $dadosContatos = ControllerContatos::resgatarDadosContatos(null);

    if(!ControllerContatos::resgatarDadosContatos(null)) {
        ControllerContatos::executarQuerySql("TRUNCATE TABLE contatos");
    }
?>
<section class="containerContatos">
    <form action="index.php?page=buscarContatos" method="POST" class="formBuscaContatos">
        <input type="text" placeholder="Buscar contato" name="chaveBusca">
        <button id="buscarContato" type="submit">Buscar</button>
    </form>
    </div>
    <div class="exibirContatos">
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
                <?php foreach($dadosContatos as $content):?>
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
        <button class="adicionarContatosButton">
            <a href="index.php?page=adicionarContatos">Adicionar contato</a>
        </button>
    </div>
</section>
