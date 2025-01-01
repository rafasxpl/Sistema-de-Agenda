$(document).ready(() => {
    $("#form-alterar-foto").hide()
    $("#btn-foto-usuario").on("click", () => {
        $("#form-alterar-foto").toggle()
    })
})