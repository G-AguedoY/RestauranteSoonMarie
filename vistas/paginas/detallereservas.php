<?php
require "conexion.php";
$sql = "SELECT * FROM v_detalleReservas";
$resultado = $mysqli->query($sql);

?>
<div class="content-wrapper" style="min-height: 1761.5px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de detalle reservas</h1>
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
                            <h3 class="card-title">Totas las reservas realizadas</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">

                                <thead>

                                    <tr>
                                        <th>Id</th>
                                        <th>Código de reserva</th>
                                        <th>Cantidad de comensales</th>
                                        <th>Pago</th>
                                        <th>Cliente</th>
                                        <th>Dirección</th>
                                        <th>Turno</th>
                                        <th>Horario</th>
                                        <th>Plato</th>
                                    </tr>

                                </thead>

                                <tbody id="myTable">
                                    <?php
                                    while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td><?php echo $row['idDetalles'] ?></td>
                                            <td><?php echo $row['codReserva'] ?></td>
                                            <td><?php echo $row['numComensales'] ?></td>
                                            <td><?php echo $row['precioPagar'] ?></td>
                                            <td><?php echo $row['Cliente'] ?></td>
                                            <td><?php echo $row['direccion'] ?></td>
                                            <td><?php echo $row['Turno'] ?></td>
                                            <td><?php echo $row['Horario'] ?></td>
                                            <td><?php echo $row['nombrePlato'] ?></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Todos los detalles de las reservas en una sola sección
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>