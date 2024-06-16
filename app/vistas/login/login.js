$(document).ready(function () {
    $("#formIniciarSesion").submit(function () {
        event.preventDefault();
        let usuario = {
            correo: $("#correo").val(),
            clave: $("#clave").val()
        }
        if (!(usuario.correo.length > 0 && usuario.clave.length > 0)) {
            Swal.fire({
                title: "Error",
                text: "Todos los campos son obligatorios",
                icon: "error"
            });
            return;
        }
        $.post('../../controladores/usuariosControlador.php', { accion: 'iniciar_sesion', usuario: usuario }).done(function (res) {
            let data = JSON.parse(res);
            let swal = {
                text: "",
                icon: "",
                title: ""
            };
            if (data.status == "ok") {
                if (data.mensaje == 0) {
                    Swal.fire({
                        title: "Error",
                        text: "Usuario o contraseña incorrecto",
                        icon: "error"
                    });
                } else {
                    Swal.fire({
                        title: "Éxito",
                        text: "Iniciando sesión",
                        icon: "success"
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "../../index.php"
                        }
                    });
                }
            }

        });
    });
});