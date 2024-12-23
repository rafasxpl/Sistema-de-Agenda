<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";
    $controllerContato = new ControllerContatos();
    $dadosContatos = $controllerContato->resgatarDadosContatos();
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
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dadosContatos as $content):?>
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
</section>
<script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous">
    </script>
<script>
$(".excluirContatosButton").click(function() {
        var contatoId = $(this).data("id");
        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/contatos/ViewExcluirContatos.php',
            type: 'POST',
            data: { id: contatoId }, // Envia o ID do contato para o servidor
        });

        location.reload();
    });
</script>