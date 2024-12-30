<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerTarefas.php";
    
    $dadosTarefas = ControllerTarefas::resgatarDadosTarefas(null);

   
?>
<section class="containerTarefas">
    <form action="index.php?page=buscarTarefas" method="POST" class="formBuscaTarefas">
        <input type="text" placeholder="Buscar Tarefa" name="chaveBusca">
        <button id="buscarTarefa" type="submit">Buscar</button>
    </form>
    </div>
    <div class="exibirTarefas">
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
                <?php foreach($dadosTarefas as $content):?>
                    <tr>
                        <th>
                            <?= $content['idTarefa']?>
                        </th>
                        <th>
                            <?= $content['tituloTarefa'] ?>
                        </th>
                        <th>
                            <?= $content['descricaoTarefa'] ?>
                        </th>
                        <th>
                            <?= $content['dataConclusaoTarefa'] ?>
                        </th>
                        <th>
                            <?= $content['horaConclusaoTarefa'] ?>
                        </th>
                        <th>
                            <?= $content['dataLembreteTarefa']?>
                        </th>
                        <th>
                            <?= $content['horaLembreteTarefa']?>
                        </th>
                        <th>
                            <?= $content['recorrenciaTarefa']?>
                        </th>
                        <th>
                            <?= $content['statusTarefa']?>
                        </th>
                        <th>
                            <a href="index.php?page=editarTarefa&id=<?= $content['idTarefa']?>">Editar</a>
                        </th>
                        <th>
                            <button class="excluirTarefasButton" data-id="<?= $content['idTarefa'] ?>">Excluir</button>
                        </th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <button class="adicionarTarefasButton">
            <a href="index.php?page=adicionarTarefas">Adicionar Tarefa</a>
        </button>
    </div>
    <div class="paginasTarefas">
    <?php 
        $quantidadeRegistroTarefas = ControllerTarefas::resgatarQuantidadeTarefas();
        $intervaloPaginas           = ControllerTarefas::getLimiteTarefasPagina();
        $paginaAtual                = ControllerTarefas::getPaginaAtual();
        $quantidadePaginas          = ControllerTarefas::getQuantidadePaginas();

        $blocoAtual = ceil($paginaAtual / $intervaloPaginas); 
        $paginaInicio = (($blocoAtual - 1) * $intervaloPaginas) + 1; 
        $paginaFim = min($paginaInicio + $intervaloPaginas - 1, $quantidadePaginas); 

        if ($blocoAtual > 1): 
            $paginaAnterior = $paginaInicio - 1;
        ?>
            <a class="paginaTarefa" href="index.php?page=Tarefas&idPagina=1">« Primeira Página</a>
            <a class="paginaTarefa" href="index.php?page=Tarefas&idPagina=<?= $paginaAnterior ?>">« Anterior</a>
        <?php endif; ?>

        <?php for ($i = $paginaInicio; $i <= $paginaFim; $i++): ?>
            <a class="paginaTarefa <?= $i == $paginaAtual ? 'paginaAtiva' : '' ?>" 
            href="index.php?page=Tarefas&idPagina=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($paginaFim < $quantidadePaginas): 
            $paginaProxima = $paginaFim + 1;
        ?>
            <a class="paginaTarefa" href="index.php?page=Tarefas&idPagina=<?= $paginaProxima ?>">Próximo »</a>
            <a class="paginaTarefa" href="index.php?page=Tarefas&idPagina=<?= $quantidadePaginas ?>">UltimaPagina »</a>
        <?php endif; ?>
</div>  
</section>
