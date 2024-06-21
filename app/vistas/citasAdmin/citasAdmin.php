<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("Location: ../login/login.php");
} else {
    if ($_SESSION["admin"] != 1) {
        header("Location: ../../index.php");
    }
}
$nombreModulo = "Gestionar citas";
require_once("../../modelos/conexionMySQL.php");
require_once("../../modelos/citas.php");
require_once("../header/header.php");
$citasModelo = new citas();
$resCitas = $citasModelo->obtenerCitasConUsuario();
?>
<div class="row col-12 justify-content-end px-0">
    <button type="button" class="btn btn-primary mb-4 mx-0" id="btnModalNuevaCita" data-toggle="modal" data-target="#modalNuevaCita">
        <i class="fas fa-plus-circle mr-3"></i> Nueva cita
    </button>
</div>
<div class="col-md-12">
    <table class="table table-striped border bg-white rounded" id="tablaCitas">
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resCitas["citas"] as $key => $value) :
                $badge="";
                switch($value["estado"]):
                    case "AGENDADA":
                        $badge="success";
                        break;
                    case "CANCELADA":
                        $badge="secondary";
                        break;
                    case "REAGENDADA":
                        $badge="primary";
                        break;
                    case "RECHAZADA":
                        $badge="danger";
                        break;
                endswitch;
            ?>
                <tr>
                    <td><?php echo ($value["id"]); ?></td>
                    <td><?php echo ($value["nombres"]); ?></td>
                    <td><?php echo ($value["correo"]); ?></td>
                    <td><?php echo ($value["fecha"]); ?></td>
                    <td><h5><span class="badge badge-<?php echo($badge); ?>"><?php echo ($value["estado"]); ?></span></h5></td>
                    <th><button type="button" class="btn btn-outline-primary btnModalEditarCita" data-toggle="modal" data-target="#modalEditarCita" title="Editar cita" citaInfo='<?php echo(json_encode($resCitas["citas"][$key])); ?>'>
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

<!-- Modal Nueva Cita -->
<div class="modal fade" id="modalNuevaCita" tabindex="-1" aria-labelledby="modalNuevaCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNuevaCitaLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo ($_SESSION["id"]); ?>" name="idUsuario" id="idUsuario">
                    <input type="hidden" value="<?php echo ($_SESSION["correo"]); ?>" name="correo" id="correo">
                    <input type="hidden" value="<?php echo ($_SESSION["nombres"]); ?>" name="nombres" id="nombres">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="fecha">Fecha y hora</label>
                                <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btnSolicitarCita" name="btnSolicitarCita">Solicitar cita</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN Modal Nueva Cita -->

<!-- Modal Editar Cita -->
<div class="modal fade" id="modalEditarCita" tabindex="-1" aria-labelledby="modalEditarCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarCitaLabel">Editar cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditarCita">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo ($_SESSION["id"]); ?>" name="idUsuarioE" id="idUsuarioE">
                    <input type="hidden" value="" name="idE" id="idE">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="nombresE">Usuario</label>
                                <input type="text" disabled class="form-control" id="nombresE" name="nombresE" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="correoE">Correo Usuario</label>
                                <input type="text" disabled class="form-control" id="correoE" name="correoE" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="fechaE">Fecha y hora</label>
                                <input type="datetime-local" class="form-control" id="fechaE" name="fechaE" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="estadoE">Estado</label>
                                <select class="form-control" id="estadoE" name="estadoE" required>
                                    <option value="AGENDADA">AGENDADA</option>
                                    <option value="CANCELADA">CANCELADA</option>
                                    <option value="REAGENDADA">REAGENDADA</option>
                                    <option value="RECHAZADA">RECHAZADA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnEditarCita" name="btnEditarCita">Editar cita</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN Modal Editar Cita -->

<?php
$javascript = ['<script src="citas.js"></script>'];
require_once("../footer/footer.php");
?>