<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("Location: ../login/login.php");
}
$nombreModulo = "Barber AgendApp";
require_once("../../modelos/conexionMySQL.php");
require_once("../../modelos/mensajes.php");
require_once("../header/header.php");
$mensajesModelo = new mensajes();
$mensajesLista = $mensajesModelo->getMensajes();
?>
<div class="col-md-6">
    <h4>¡Agendar tu cita nunca fue tan fácil!</h4>
    <p>Con nuestra página web, puedes gestionar tus citas de barbería de forma rápida y sencilla.</p>
    <hr>
    <h5>¿Qué puedes hacer?</h5>
    <lu>
        <li>Agendar una nueva cita: Selecciona el día, la hora y el servicio que deseas, y nosotros nos encargaremos del resto.</li>
        <li>Cancelar una cita existente: Si necesitas cancelar tu cita, puedes hacerlo con solo unos pocos clics.</li>
        <li>Ver tus próximas citas: Consulta tu calendario de citas y visualiza todas tus citas futuras en un solo lugar.</li>
    </lu>
    <hr>
    <h5>¿Cómo funciona?</h5>
    <lu>
        <li>Accede a nuestra página web</li>
        <li>Registrate y/o inicia sesión.</li>
        <li>Selecciona "Gestionar mis citas"</li>
        <li>Elige la fecha y la hora que deseas.</li>
        <li>Confirma tu cita.</li>
    </lu>
    <p>También puedes cancelar tus citas existentes o ver tus próximas citas siguiendo los mismos pasos.</p>
    <hr>
    <h5>Beneficios de usar nuestra página web:</h5>
    <lu>
        <li>Ahorra tiempo: Evita tener que llamar a la barbería para agendar o cancelar tu cita.</li>
        <li>Disponibilidad 24/7: Agenda o cancela tu cita en cualquier momento, incluso fuera del horario de atención de la barbería.</li>
        <li>Fácil de usar: Nuestra página web es fácil de usar y navegar, incluso para usuarios que no están familiarizados con la tecnología.</li>
    </lu>
</div>
<div class="col-md-6">
    <div class="d-flex justify-content-center">
    <img src="../../dist/img/img_barberia_inicio.jpg" alt="" style="width: 90% !important;">
    </div>
    <br>
    <small><a href="https://www.freepik.es/foto-gratis/herramientas-profesion-peluquero_58397970.htm#fromView=search&page=1&position=24&uuid=d7d5db14-8a85-4bce-8ae3-17a7617196d9">Imagen de freepik</a></small>
</div>
<?php
require_once("../footer/footer.php");
?>