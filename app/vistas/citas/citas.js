$(document).ready(function () {
    $("#tablaCitas").DataTable({
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

    $(".btnModalEditarCita").click(function () {
        limpiarModalEditar();
        let cita = JSON.parse($(this).attr("citaInfo"));
        console.log(cita);
        $("#idE").val(cita.id);
        $("#idUsuarioE").val(cita.idUsuario);
        $("#fechaE").val(cita.fecha);
        $("#estadoE").val(cita.estado);
        $("#modalEditarCitaLabel").text("Editar cita del " + cita.fecha);
    });

    $("#btnEditarCita").on("click", function () {
        let cita = {
            id: $("#idE").val(),
            idUsuario: $("#idUsuarioE").val(),
            fecha: $("#fechaE").val(),
            estado: ($("#estadoE").val() == "AGENDADA") ? "REAGENDADA" : $("#estadoE").val()
        };
        $.post('../../controladores/citasControlador.php', { accion: 'editar_cita', cita: cita }).done(function (res) {
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

    $("#btnSolicitarCita").on("click", function () {
        let cita = {
            idUsuario: $("#idUsuario").val(),
            fecha: $("#fecha").val(),
        };
        $.post('../../controladores/citasControlador.php', { accion: 'registrar_cita', cita: cita }).done(function (res) {
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
    $("#idUsuarioE").val("");
    $("#fechaE").val("");
    $("#estadoE").val("");
}