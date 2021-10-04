<?php
require "conexion.php";
$sql = "SELECT * FROM v_platos";
$resultado = $mysqli->query($sql);

?>
<div class="content-wrapper" style="min-height: 1761.5px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de platos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver reportes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#crearPlato">
                                Nuevo registro
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaAdministradores" width="100%" id="TablaAdministradores">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Plato</th>
                                        <th>Precio</th>
                                        <th>Especialidad</th>
                                        <th>Tipo</th>
                                        <th>accion</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td><?php echo $row['codPlato'] ?></td>
                                            <td><?php echo $row['nombrePlato'] ?></td>
                                            <td><?php echo $row['precio'] ?></td>
                                            <td><?php echo $row['especialidad'] ?></td>
                                            <td><?php echo $row['tipo'] ?></td>

                                            <td>
                                                <button class='btn btn-primary btn-sm'><a href="modificarPlatos.php?codPlatos=<?php echo $row['codPlato']; ?>"><i class="far fa-edit text-white"></i></a></button>
                                                <button class='btn btn-danger btn-sm'><a href="#" data-href="eliminarPlatos.php?codPlatos=<?php echo $row['codPlato']; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fas fa-trash-alt text-white"></i></a></button>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Para la ventan modal de eliminar a las categorias -->
<div class="modal fade" tabindex="-1" id="confirm-delete" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <form action="eliminarPlatos.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminación de Registros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar el registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger btn-ok">Eliminar</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#confirm-delete').on('shown.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>


<!-- Para la venta modal de crear un nuevo plato -->
<div class="modal fade" id="crearPlato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear nuevo plato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Input plato -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-utensils"></span>
                        </div>
                        <input type="text" class="form-control" name="registroPlato" placeholder="Ingresa nombre del plato" required>
                    </div>
                    <!-- Input precio -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-money-bill-wave"></span>
                        </div>
                        <input type="text" min="0" class="form-control" name="precioPlato" placeholder="Ingresa precio del plato" required>
                    </div>
                    <!-- Seleccion de especialidad -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-medal"></span>
                        </div>
                        <select name="registroEspecialidad" id="" class="form-control" required>
                            <option value="" disabled selected>Seleccione especialidad</option>
                            <?php
                            $mostrarEspecialidad = new ControladorPlatos();
                            $mostrarEspecialidad->ctrMostrarEspecialidades();
                            ?>
                        </select>
                    </div>
                    <!-- Seleccion de tipo de plato-->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-leaf"></span>
                        </div>
                        <select name="registroTipoPlato" id="" class="form-control" required>
                            <option value="" disabled selected>Seleccione tipo de plato</option>
                            <?php
                            $mostrarTipoPlato = new ControladorPlatos();
                            $mostrarTipoPlato->ctrMostrarTipoPlatos();
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Para el registro de platos -->
                <?php
                $registroPlato = new ControladorPlatos();
                $registroPlato->ctrRegistroPlatos();
                ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>