<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("Location: ../login/login.php");
} else {
    if ($_SESSION["admin"] != 1) {
        header("Location: ../../index.php");
    }
}
$nombreModulo = "Gestionar usuarios";
require_once("../../modelos/conexionMySQL.php");
require_once("../../modelos/usuarios.php");
require_once("../header/header.php");
$usuariosModelo = new usuarios();
$resUsuarios = $usuariosModelo->obtenerUsuarios();
?>
<div class="col-md-12">
    <table class="table table-striped border bg-white rounded" id="tablaUsuarios">
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Nombres</th>
                <th>Estado</th>
                <th>Admin</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($resUsuarios["usuarios"] as $key => $value) :
                $badge="";
                switch($value["activo"]):
                    case 1:
                        $badge="success";
                        break;
                    case 0:
                        $badge="danger";
                        break;
                endswitch;
            ?>
                <tr>
                    <td><?php echo($value["id"]); ?></td>
                    <td><?php echo($value["correo"]); ?></td>
                    <td><?php echo($value["nombres"]); ?></td>
                    <td><h5><span class="badge badge-<?php echo($badge); ?>"><?php echo(($value["activo"] == 1) ? "Activo" : "Inactivo"); ?></span></h5></td>
                    <td><?php echo(($value["admin"] == 1) ? '<p class="text-success"><i class="fas fa-check-circle"></i></p>' : '<p class="text-danger"><i class="fas fa-times-circle"></i></p>'); ?></td>
                    <th><button type="button" class="btn btn-outline-primary btnModalEditarUsuario" data-toggle="modal" data-target="#modalEditarUsuario" title="Editar usuario" usuarioInfo='<?php echo(json_encode($resUsuarios["usuarios"][$key])); ?>'>
                            <i class="fas fa-edit"></i>
                        </button>
                    </th>
                </tr>
            <?php
            endforeach
            ?>
        </tbody>
    </table>
</div>

<!-- Modal Editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditarUsuario">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo($_SESSION["id"]); ?>" name="idE" id="idE">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="correoE">Correo Usuario</label>
                                <input type="text" disabled class="form-control" id="correoE" name="correoE" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nombresE">Nombres</label>
                                <input type="text" class="form-control" id="nombresE" name="nombresE" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="activoE">Activo</label>
                                <select class="form-control" id="activoE" name="activoE" required>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="adminE">Admin</label>
                                <select class="form-control" id="adminE" name="adminE" required>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnEditarUsuario" name="btnEditarUsuario">Editar usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN Modal Editar Usuario -->
<?php
$javascript = ['<script src="usuarios.js"></script>'];
require_once("../footer/footer.php");
?>