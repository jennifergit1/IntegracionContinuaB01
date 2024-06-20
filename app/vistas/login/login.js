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
            if (data.status == "ok") {
                $("#login-box").hide();
                if (data.mensaje == 0) {
                    Swal.fire({
                        title: "Error",
                        text: "Usuario o contraseña incorrecto",
                        icon: "error"
                    }).then(() => {
                        $("#login-box").show(1000);
                    });
                } else {
                    $("#login-box").hide();
                    Swal.fire({
                        title: "Éxito",
                        icon: "success",
                        html: "Iniciando sesión...",
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "../../index.php"
                        }
                    });

                }
            }

        });
    });
});