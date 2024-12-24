<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";
    $dadosContatos = ControllerContatos::resgatarDadosContatos(null);

    if(!ControllerContatos::resgatarDadosContatos(null)) {
        ControllerContatos::executarQuerySql("TRUNCATE TABLE contatos");
    }

    $quantidadeRegistroContatos = ControllerContatos::resgatarQuantidadeContatos();
    $intervaloPaginas = 10;
    $paginaAtual = isset($_GET['idPagina']) ? $_GET['idPagina'] : 1;

    $quantidadePaginas = round($quantidadeRegistroContatos / $intervaloPaginas);
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
    <div class="paginasContatos">
    <?php 
        // Calcular total de páginas e o bloco atual
        $blocoAtual = ceil($paginaAtual / $intervaloPaginas); // Define o bloco atual
        $paginaInicio = (($blocoAtual - 1) * $intervaloPaginas) + 1; // Página inicial do bloco
        $paginaFim = min($paginaInicio + $intervaloPaginas - 1, $quantidadePaginas); // Página final do bloco

        // Botão para o bloco anterior
        if ($blocoAtual > 1): 
            $paginaAnterior = $paginaInicio - 1;
        ?>
            <a class="paginaContato" href="index.php?page=contatos&idPagina=<?= $paginaAnterior ?>">« Anterior</a>
        <?php endif; ?>

        <!-- Links das páginas dentro do bloco atual -->
        <?php for ($i = $paginaInicio; $i <= $paginaFim; $i++): ?>
            <a class="paginaContato <?= $i == $paginaAtual ? 'paginaAtiva' : '' ?>" 
            href="index.php?page=contatos&idPagina=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <!-- Botão para o próximo bloco -->
        <?php if ($paginaFim < $quantidadePaginas): 
            $paginaProxima = $paginaFim + 1;
        ?>
            <a class="paginaContato" href="index.php?page=contatos&idPagina=<?= $paginaProxima ?>">Próximo »</a>
        <?php endif; ?>
</div>

</section>
