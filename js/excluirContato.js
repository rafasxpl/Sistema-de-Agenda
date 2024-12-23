$(".excluirContatosButton").click(function() {
    let contatoId = $(this).data("id");
    $.ajax({
        url: 'http://localhost:81/Sistema-de-Agenda/MVC/views/contatos/ViewExcluirContatos.php',
        type: 'POST',
        data: { id: contatoId }, // Envia o ID do contato para o servidor
    });

    location.reload();
});
