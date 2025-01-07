<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerEventos.php";

    $chaveBusca = $_POST['chaveBusca'] ?? "";
    $chaveBusca = preg_match("/[0-9]/", $chaveBusca) ? (int) $chaveBusca : (string) $chaveBusca;
    
    $dadosEventos = ControllerEventos::resgatarDadosEventos($chaveBusca, false); 
    ?>
<section class="w-75 d-flex flex-column align-items-center mx-auto">
    <header class="w-100 d-flex align-items-center gap-3 my-3">
        <span class="fs-2">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <h1 class="align-self-center fs-2 my-0    text-white">Buscar Eventos</h1>
    </header>
    <table class="table table-dark table-striped table-hover">
            <thead>
                <tr class="table-row">
                    <th class="table-cell align-middle text-center">Status</th>
                    <th class="table-cell align-middle text-center">Evento</th>
                    <th class="table-cell align-middle text-center">Descrição</th>
                    <th class="table-cell align-middle text-center">Data de conclusão</th>
                    <th class="table-cell align-middle text-center">Hora de conclusão</th>
                    <th class="table-cell align-middle text-center" colspan="2">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dadosEventos as $content):?>
                    <tr class="table-row">
                        <th class="table-cell align-middle text-center">
                            <input id="<?= $content['idEvento'] ?>" class="checkBoxEvento form-check-input" type="checkbox" name="status" <?= $content['statusEvento'] === '0' ? '' : 'checked' ?>>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['tituloEvento'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['descricaoEvento'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['dataFimEvento'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['horaFimEvento'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <a class="btn btn-primary" href="index.php?page=editarEvento&id=<?= $content['idEvento']?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <button class="excluirEventosButton btn btn-danger" data-id="<?= $content['idEvento'] ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <div class="paginasEventos d-flex justify-content-around align-items-center gap-4 bg-light-subtle p-3 w-75 ">
    <?php 
        $quantidadeRegistroEventos  = ControllerEventos::resgatarQuantidadeEventos();
        $intervaloPaginas           = ControllerEventos::getLimiteEventosPagina();
        $paginaAtual                = ControllerEventos::getPaginaAtual();
        $quantidadePaginas          = ControllerEventos::getQuantidadePaginas();

        $blocoAtual = ceil($paginaAtual / $intervaloPaginas); 
        $paginaInicio = (($blocoAtual - 1) * $intervaloPaginas) + 1; 
        $paginaFim = min($paginaInicio + $intervaloPaginas - 1, $quantidadePaginas); 

        if ($blocoAtual > 1): 
            $paginaAnterior = $paginaInicio - 1;
    ?>
            <a class="paginaEvento text-decoration-none text-primary fs-6" href="index.php?page=eventos&idPagina=1">« Primeira Página</a>
            <a class="paginaEvento text-decoration-none text-primary fs-6" href="index.php?page=eventos&idPagina=<?= $paginaAnterior ?>">« Anterior</a>
        <?php endif; ?>

        <?php for ($i = $paginaInicio; $i <= $paginaFim; $i++): ?>
            <div>
                <a class="paginaEvento text-decoration-none text-primary <?= $i == $paginaAtual ? 'paginaAtiva' : '' ?>"
                href="index.php?page=eventos&idPagina=<?= $i ?>">
                    <?= $i ?>
                </a>
            </div>  
        <?php endfor; ?>

        <?php if ($paginaFim < $quantidadePaginas): 
            $paginaProxima = $paginaFim + 1;
        ?>
            <a class="paginaEvento text-decoration-none text-primary" href="index.php?page=eventos&idPagina=<?= $paginaProxima ?>">Próximo »</a>
            <a class="paginaEvento text-decoration-none text-primary" href="index.php?page=eventos&idPagina=<?= $quantidadePaginas ?>">UltimaPagina »</a>
        <?php endif; ?>
    </div>  
</section>
