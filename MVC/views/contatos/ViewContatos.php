<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerContatos.php";
    
    $dadosContatos = ControllerContatos::resgatarDadosContatos(null);

//     if(!ControllerContatos::resgatarDadosContatos(null)) {
//         ControllerContatos::executarQuerySql("TRUNCATE TABLE contatos");
//     }
?>
<section class="containerContatos w-100 h-100 d-flex flex-column align-items-center ">
    <form class="formBuscaContatos w-75 my-3 d-flex justify-content-center column-gap-3" 
    action="index.php?page=buscarContatos" method="POST">
        <input class="w-75 form-control p-1" type="text" name="chaveBusca" placeholder="Buscar contato">
        <button class="w-auto btn btn-primary px-3 py-2" id="buscarContato" type="submit">Buscar</button>
        <button class="adicionarContatosButton btn btn-success">
            <a class="text-decoration-none text-white" href="index.php?page=adicionarContatos">Adicionar contato</a>
        </button>
    </form>
    
    <div class="exibirContatos w-75">
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
                <?php foreach($dadosContatos as $content):?>
                    <tr class="table-row">
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
                            <?= $content['telefoneContato'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['sexoContato'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['dataNascimentoContato']?>
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
    </div>
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
