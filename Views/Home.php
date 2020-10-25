<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>BIENVENIDO 
                    <?php 
                        if($_SESSION['user']->cargo == 'Administrador'){
                            echo  $_SESSION['user']->usuario;
                        }
                        elseif($_SESSION['user']->cargo == 'Recepcion'){
                            echo  $_SESSION['user']->nombre;
                        }
                    ?>
                </h2>
            </div>
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text">Cantidad de clientes actuales</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $totalClients; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">Garantias pendientes</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $totalGaranties;  ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">mood</i>
                        </div>
                        <div class="content">
                            <div class="text">Personal existente</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo $totalPersons;  ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Ultimos clientes</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Correo</th>
                                </thead>
                                <tbody>
                                  <?php foreach ($limitClients as $limitClient) {?>
                                       <tr>
                                           <td><?php echo $limitClient->id ?></td>
                                           <td><?php echo $limitClient->nombre ?></td>
                                           <td><?php echo $limitClient->correo ?></td>
                                       </tr>
                                  <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Garantias pendientes</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Producto</th>
                                </thead>
                                <tbody>
                                  <?php foreach ($limitGaranties as $limitGaranty) {?>
                                       <tr>
                                           <td><?php echo $limitGaranty->No_garantia ?></td>
                                           <td><?php echo $limitGaranty->Nombre_Cliente ?></td>
                                           <td><?php echo $limitGaranty->Fecha_ingreso ?></td>
                                       </tr>
                                  <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Personal</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <tbody>
                                  <?php foreach ($limitPersons as $limitPerson) {?>
                                       <tr>
                                           <td><?php echo $limitPerson->id ?></td>
                                           <td><?php echo $limitPerson->nombre ?></td>
                                           <td><?php echo $limitPerson->correo ?></td>
                                       </tr>
                                  <?php } ?>

                                </tbody>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>