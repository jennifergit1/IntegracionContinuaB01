<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("Location: ../login/login.php");
}
require_once("../../modelos/conexionMySQL.php");
require_once("../header/header.php");
?>
<div class="col-md-12">
    <table class="table table-striped border bg-white rounded" id="tablaUsuarios">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombres</th>
                <th>Estado</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>usuarioTest</td>
                <td>nombresTest</td>
                <td>Activo</td>
                <th><button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button></th>
            </tr>
        </tbody>
    </table>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php
$javascript = ['<script src="usuarios.js"></script>'];
require_once("../footer/footer.php");
?>