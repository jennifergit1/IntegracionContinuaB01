$(document).ready(function () {
    console.log("%cHerramienta de desarrolladores", "font-size: 32px; color: red;");
    console.log("%cEsta pestaña está pensada para desarrolladores y personal de TI, por favor cerrar esta pestaña para evitar funcionamientos inadecuados de la aplicación", "font-size: 16px; color: red;")

    $("#btnEditarMiInfo").on("click", function () {
        let usuario = {
            id: $("#idMiInfo").val(),
            nombres: $("#nombresMiInfo").val(),
            clave: $("#claveMiInfo").val(),
            confirmarClave: $("#confirmarClaveMiInfo").val(),
        };
        if (usuario.clave != usuario.confirmarClave) {
            Swal.fire({
                title: "Error",
                text: "Las contraseñas no coinciden.",
                icon: "error"
            });
            return;
        }
        $.post('../../controladores/usuariosControlador.php', { accion: 'editar_mi_informacion', usuario: usuario }).done(function (res) {
            let data = JSON.parse(res);
            if (data.status == "ok") {
                Swal.fire({
                    title: "Éxito",
                    icon: "success",
                    text: data.mensaje,
                }).then(() => {
                    $.post('../../controladores/usuariosControlador.php', { accion: 'actualizar_sesion', nombres: usuario.nombres }).done(function () {
                        window.location.reload();
                    });
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