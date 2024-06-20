$(document).ready(function () {
    $("#formRegistrarse").submit(function () {
        event.preventDefault();
        let usuario = {
            nombres: $("#nombres").val(),
            correo: $("#correo").val(),
            clave: $("#clave").val()
        }
        if (!(usuario.nombres.length > 0 && usuario.correo.length > 0 && usuario.clave.length > 0)) {
            Swal.fire({
                title: "Error",
                text: "Todos los campos son obligatorios",
                icon: "error"
            });
            return;
        }
        $.post('../../controladores/usuariosControlador.php', { accion: 'registrarse', usuario: usuario }).done(function (res) {
            let data = JSON.parse(res);
            Swal.fire({
                title: (data.status == "ok") ? "Éxito" : "Error",
                text: data.mensaje,
                icon: (data.status == "ok") ? "success" : "error"
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = "../login/login.php"
                }
            });

        });
    });
});