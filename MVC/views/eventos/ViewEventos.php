<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/eventos/ControllerEventos.php";
    
    $dadosEventos = ControllerEventos::resgatarDadosEventos(null, false);

    if(isset($_POST['checked']) ?? "" && isset($_POST['id'])) {
        $status = $_POST['checked'];
        $idCheckBox = $_POST['id'];
        ControllerEventos::concluirEvento($status ,$idCheckBox);
    }
?>
<section class="containerEventos w-100 h-100 d-flex flex-column align-items-center mx-auto">
    <header class="w-75 my-3 d-flex align-items-center gap-3">
        <span class="fs-2">
            <i class="fa-solid fa-calendar-days"></i>
        </span>
        <h1 class="align-self-center fs-2 my-0 text-white">Eventos</h1>
    </header>
    <form class="w-75 mb-3 d-flex justify-content-end column-gap-3" action="index.php?page=buscarEventos" method="POST" class="formBuscaEventos">
        <div class="input-group">
            <input class="form-control w-75 form-control p-1" type="text" placeholder="Buscar Evento" name="chaveBusca">
            <button class="input-group-text w-auto btn btn-primary px-3 py-2" id="buscarEvento" type="submit">Buscar</button>
        </div>
        <button class="adicionarEventosButton btn btn-success   ">
            <a class="text-decoration-none text-white" href="index.php?page=adicionarEventos">Adicionar Evento</a>
        </button>
    </form>
    <div class="exibirEventos d-flex gap-5 w-75">
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
                            <a class="btn btn-primary" href="index.php?page=editarEventos&id=<?= $content['idEvento']?>">
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
    </div>
    <div class="paginasContatos d-flex justify-content-around align-items-center gap-4 bg-light-subtle p-3 w-75">
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
            <a class="paginaEvento text-decoration-none text-primary fs-6" href="index.php?page=eventos&idPaginaEvento=1">« Primeira Página</a>
            <a class="paginaEvento text-decoration-none text-primary fs-6" href="index.php?page=eventos&idPaginaEvento=<?= $paginaAnterior ?>">« Anterior</a>
        <?php endif; ?>

        <?php for ($i = $paginaInicio; $i <= $paginaFim; $i++): ?>
            <a class="paginaEvento text-decoration-none text-primary <?= $i == $paginaAtual ? 'paginaAtiva' : '' ?>" 
            href="index.php?page=eventos&idPaginaEvento=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($paginaFim < $quantidadePaginas): 
            $paginaProxima = $paginaFim + 1;
        ?>
            <a class="paginaEvento text-decoration-none text-primary" href="index.php?page=eventos&idPaginaEvento=<?= $paginaProxima ?>">Próximo »</a>
            <a class="paginaEvento text-decoration-none text-primary" href="index.php?page=eventos&idPaginaEvento=<?= $quantidadePaginas ?>">UltimaPagina »</a>
        <?php endif; ?>
</div>  
</section>
