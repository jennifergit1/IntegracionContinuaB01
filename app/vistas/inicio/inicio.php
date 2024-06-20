<?php
require_once("../../modelos/conexionMySQL.php");
require_once("../../modelos/mensajes.php");
require_once("../header/header.php");
$mensajesModelo = new mensajes();
$mensajesLista = $mensajesModelo->getMensajes();
?>
<div class="col-md-12">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Mensajes</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($mensajesLista as $key => $value) :
                ?>
                <tr>
                    <td><?php echo($key+1); ?></td>
                    <td><?php echo($value["mensaje"]); ?></td>
                </tr>
                <?php
            endforeach
        ?>
    </tbody>
</table>
</div>
<?php
require_once("../footer/footer.php");
?>