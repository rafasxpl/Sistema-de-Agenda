<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerTarefas.php";
    
    $dadosTarefas = ControllerTarefas::resgatarDadosTarefas(null);

   
?>
<section class="containerTarefas w-100 h-100 d-flex flex-column align-items-center">
    <form class="w-75 my-3 d-flex justify-content-center column-gap-3" action="index.php?page=buscarTarefas" method="POST" class="formBuscaTarefas">
        <input class="w-75 form-control p-1" type="text" placeholder="Buscar Tarefa" name="chaveBusca">
        <button class="w-auto btn btn-primary px-3 py-2" id="buscarTarefa" type="submit">Buscar</button>
        <button class="adicionarTarefasButton">
            <a href="index.php?page=adicionarTarefas">Adicionar Tarefa</a>
        </button>
    </form>
    <div class="exibirTarefas w-100">
        <table class="table table-dark table-striped table-hover">
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
                <?php foreach($dadosTarefas as $content):?>
                    <tr class="table-row">
                        <th class="table-cell align-middle text-center">
                            <?= $content['idTarefa']?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['tituloTarefa'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['descricaoTarefa'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['dataConclusaoTarefa'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['horaConclusaoTarefa'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['dataLembreteTarefa']?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['horaLembreteTarefa']?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['recorrenciaTarefa']?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['statusTarefa']?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <a href="index.php?page=editarTarefa&id=<?= $content['idTarefa']?>">Editar</a>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <button class="excluirTarefasButton" data-id="<?= $content['idTarefa'] ?>">Excluir</button>
                        </th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
    </div>
    <div class="paginasTarefas d-flex justify-content-around align-items-center gap-4 bg-light-subtle p-3 w-75">
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
            <a class="paginaTarefa text-decoration-none text-primary fs-6" href="index.php?page=Tarefas&idPagina=1">« Primeira Página</a>
            <a class="paginaTarefa text-decoration-none text-primary fs-6" href="index.php?page=Tarefas&idPagina=<?= $paginaAnterior ?>">« Anterior</a>
        <?php endif; ?>

        <?php for ($i = $paginaInicio; $i <= $paginaFim; $i++): ?>
            <a class="paginaTarefa text-decoration-none text-primary <?= $i == $paginaAtual ? 'paginaAtiva' : '' ?>" 
            href="index.php?page=Tarefas&idPagina=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($paginaFim < $quantidadePaginas): 
            $paginaProxima = $paginaFim + 1;
        ?>
            <a class="paginaTarefa text-decoration-none text-primary" href="index.php?page=Tarefas&idPagina=<?= $paginaProxima ?>">Próximo »</a>
            <a class="paginaTarefa text-decoration-none text-primary" href="index.php?page=Tarefas&idPagina=<?= $quantidadePaginas ?>">UltimaPagina »</a>
        <?php endif; ?>
</div>  
</section>
