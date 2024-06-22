$(document).ready(function(){
    $("#tablaUsuarios").DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
    
    $(".btnModalEditarUsuario").click(function () {
        limpiarModalEditar();
        let usuario = JSON.parse($(this).attr("usuarioInfo"));
        console.log(usuario);
        $("#idE").val(usuario.id);
        $("#correoE").val(usuario.correo);
        $("#nombresE").val(usuario.nombres);
        $("#activoE").val(usuario.activo);
        $("#adminE").val(usuario.admin);
        $("#modalEditarUsuarioLabel").text("Editar usuario - Id: " + usuario.id);
    });

    $("#btnEditarUsuario").on("click", function () {
        let usuario = {
            id: $("#idE").val(),
            nombres: $("#nombresE").val(),
            activo: $("#activoE").val(),
            admin: $("#adminE").val(),
        };
        $.post('../../controladores/usuariosControlador.php', { accion: 'editar_usuario', usuario: usuario }).done(function (res) {
            let data = JSON.parse(res);
            if (data.status == "ok") {
                Swal.fire({
                    title: "Éxito",
                    icon: "success",
                    text: data.mensaje,
                }).then(() => {
                        window.location.reload();
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: data.mensaje,
                    icon: "error"
                }).then(() => {
                    console.log(data.message);
                });
            }
        });
    });
});

function limpiarModalEditar() {
    $("#idE").val("");
    $("#correoE").val("");
    $("#nombresE").val("");
}