$(document).ready(function() {
    $(".btnLogout").on("click", function() {
        let logOut = true;
        $.ajax({
            url: 'http://localhost:81/Sistema-de-Agenda/acount/logout.php',
            type: 'POST',
            data: { logOut: logOut },
            success: function() {
                location.reload();
            },
            error: function(_, __, error) {
                console.log('Erro ao excluir evento: ' + error);
            }
        });
    })
})