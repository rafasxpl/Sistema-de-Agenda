<?php 
    require_once __DIR__ . "../../../controllers/contatos/ControllerContatos.php";

    $chaveBusca = $_POST['chaveBusca'] ?? "";
    $chaveBusca = preg_match("/[0-9]/", $chaveBusca) ? (int) $chaveBusca : (string) $chaveBusca;

    $dadosContato = ControllerContatos::resgatarDadosContatos($chaveBusca);
?>
<section class="w-100 d-flex flex-column align-items-center">
    <header class="w-75 my-3 d-flex align-items-center gap-3">
        <span class="fs-2">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <h1 class="align-self-center fs-2 my-0    text-white">Buscar Contatos</h1>
    </header>
<table class="table table-dark table-striped w-75">
    <thead>
        <tr class="table-row">
            <th class="table-cell align-middle text-center">ID</th>
            <th class="table-cell align-middle text-center">Nome</th>
            <th class="table-cell align-middle text-center">E-mail</th>
            <th class="table-cell align-middle text-center">Telefone</th>
            <th class="table-cell align-middle text-center">Sexo</th>
            <th class="table-cell align-middle text-center">Nascimento</th>
            <th class="table-cell align-middle text-center">Telefone</th>
            <th class="table-cell align-middle text-center" colspan="2">Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dadosContato as $content):?>
            <tr class="table-row">
                <th class="table-cell align-middle text-center">
                    <button data-id="<?= $content['idContato'] ?>" id="<?= $content['flagFavoritoContato'] ?>" class="btn btnFavoritarContato">
                        <?=$content['flagFavoritoContato'] === 1 ? '<i class="fa-solid fa-star" style="color: #FFD43B;"></i>' : '<i class="fa-regular fa-star" style="color: #ffffff;"></i>'?>
                    </button>
                </th>
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
                    <?= $content['sexoContato'] ?>
                </th>
                <th class="table-cell align-middle text-center">
                    <?= $content['dataNascimentoContato']?>
                </th>
                <th class="table-cell align-middle text-center">
                    <?= $content['telefoneContato'] ?>
                </th>
                <th class="table-cell align-middle text-center">
                    <a class="btn btn-primary" href="index.php?page=editarContatos&id=<?= $content['idContato']?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </th>
                <th class="table-cell align-middle text-center">
                    <button class="excluirContatosButton btn btn-danger" data-id="<?= $content['idContato'] ?>">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </th>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="paginasContatos d-flex justify-content-between align-items-center gap-4 bg-light-subtle p-3 w-75 ">
<?php 
    $quantidadeRegistroContatos = ControllerContatos::resgatarQuantidadeContatos();
    $intervaloPaginas           = ControllerContatos::getLimiteContatosPagina();
    $paginaAtual                = ControllerContatos::getPaginaAtual();
    $quantidadePaginas          = ControllerContatos::getQuantidadePaginas();

    $blocoAtual = ceil($paginaAtual / $intervaloPaginas); 
    $paginaInicio = (($blocoAtual - 1) * $intervaloPaginas) + 1; 
    $paginaFim = min($paginaInicio + $intervaloPaginas - 1, $quantidadePaginas); 

    if ($blocoAtual > 1): 
        $paginaAnterior = $paginaInicio - 1;
    ?>
        <a class="paginaContato text-decoration-none text-primary fs-6" href="index.php?page=contatos&idPagina=1">« Primeira Página</a>
        <a class="paginaContato text-decoration-none text-primary fs-6" href="index.php?page=contatos&idPagina=<?= $paginaAnterior ?>">« Anterior</a>
    <?php endif; ?>

    <?php for ($i = $paginaInicio; $i <= $paginaFim; $i++): ?>
        <div>
            <a class="paginaContato text-decoration-none text-primary <?= $i == $paginaAtual ? 'paginaAtiva' : '' ?>"
            href="index.php?page=contatos&idPagina=<?= $i ?>">
                <?= $i ?>
            </a>
        </div>  
    <?php endfor; ?>

    <?php if ($paginaFim < $quantidadePaginas): 
        $paginaProxima = $paginaFim + 1;
    ?>
        <a class="paginaContato text-decoration-none text-primary" href="index.php?page=contatos&idPagina=<?= $paginaProxima ?>">Próximo »</a>
        <a class="paginaContato text-decoration-none text-primary" href="index.php?page=contatos&idPagina=<?= $quantidadePaginas ?>">UltimaPagina »</a>
    <?php endif; ?>
</div>  
</section>
