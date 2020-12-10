<?php
//var_dump($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Digital MTX Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" href="Assets/img/logo-rojo.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="Assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="Assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="Assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="Assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="Assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" /> 

    <!-- Bootstrap DatePicker Css -->
    <link href="Assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="Assets/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="Assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="Assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Sweet Alert Css -->
    <link href="Assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="Assets/css/styleAdmin.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="Assets/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Por favor espere...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
            </div>
            
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="Assets/img/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                            if ($_SESSION['user']->cargo == "Administrador") {
                                echo $_SESSION['user']->usuario;
                            } elseif ($_SESSION['user']->cargo == "Tecnico" || $_SESSION['user']->cargo == "Recepcion" ) {
                                echo $_SESSION['user']->nombre; 
                            }
                        ?>        
                    </div>
                    <div class="email">
                        <?php 
                            if ($_SESSION['user']->cargo == "Tecnico" || $_SESSION['user']->cargo == "Recepcion") {
                                 echo $_SESSION['user']->correo;
                            }
                        ?>        
                    </div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <?php if($_SESSION['user']->cargo == "Tecnico" || $_SESSION['user']->cargo == "Recepcion"){?>
                            <li><a href="?controller=person&method=profile&id=<?php echo $_SESSION['user']->id?>"><i class="material-icons">person</i>Perfil</a></li>
                            <?php } ?>
                            <li><a href="?controller=login&method=logout"><i class="material-icons">input</i>Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Menu de navegación</li>
                    <li class="active">
                        <a href="?controller=person&method=template">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <?php if ($_SESSION['user']->cargo == 'Administrador') { ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people</i>
                            <span>Personal</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=person&method=list" class="menu-toggle">
                                    <span>Registro personal</span>
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_circle</i>
                            <span>Clientes</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=client" class="menu-toggle">
                                    <span>Lista de clientes actuales</span>
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Garantias</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=garanty&method=listGaranty" class="menu-toggle">
                                    <span>Anexo garantias</span>
                                </a>  
                            </li>
                            <li>
                                <a href="?controller=garanty&method=solutionTechnical" class="menu-toggle">
                                    <span>Solución del tecnico a garantias pendientes</span>
                                </a> 
                            </li>
                            <li>
                                <a href="?controller=garanty&method=solutionPre" class="menu-toggle">
                                    <span>Pendientes de entrega a garantias prefinalizadas</span>
                                </a> 
                            </li>
                            <li>
                                <a href="?controller=garanty&method=storyGaranties" class="menu-toggle">
                                    <span>Historico de garantias finalizadas</span>
                                </a> 
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">build</i>
                            <span>Tecnico</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=technical&method=list" class="menu-toggle">
                                    <span>Gestion de garantias pendientes</span>
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_outline</i>
                            <span>Usuarios</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=user&method=list" class="menu-toggle">
                                    <span>Lista de usuarios actuales</span>
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">local_mall</i>
                            <span>Productos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=product&method=list" class="menu-toggle">
                                    <span>Lista de productos en el sistema</span>
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_paste</i>
                            <span>Facturas</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=bill" class="menu-toggle">
                                    <span>Carga masiva de facturas</span>
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    <?php }elseif ($_SESSION['user']->cargo == 'Tecnico' ) { ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">build</i>
                            <span>Tecnico</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=technical&method=list" class="menu-toggle">
                                    <span>Gestion de garantias pendientes</span>
                                </a>
                            </li>
                            <li>
                                <a href="?controller=technical&method=storyTechnical" class="menu-toggle">
                                    <span>Historicos de productos revisados por garantia</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">local_mall</i>
                            <span>Productos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=product&method=list" class="menu-toggle">
                                    <span>Lista de productos en el sistema</span>
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    <?php }elseif ($_SESSION['user']->cargo == 'Recepcion') { ?> 
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Garantias</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=garanty&method=listGaranty" class="menu-toggle">
                                    <span>Anexo garantias</span>
                                </a>
                                
                            </li>
                            <li>
                                <a href="?controller=garanty&method=solutionTechnical" class="menu-toggle">
                                    <span>Solución del tecnico a garantias pendientes</span>
                                </a> 
                            </li>
                            <li>
                                <a href="?controller=garanty&method=solutionPre" class="menu-toggle">
                                    <span>Pendientes de entrega a garantias prefinalizadas</span>
                                </a> 
                            </li>
                            <li>
                                <a href="?controller=garanty&method=storyGaranties" class="menu-toggle">
                                    <span>Historico de garantias finalizadas</span>
                                </a> 
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_paste</i>
                            <span>Facturas</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?controller=bill" class="menu-toggle">
                                    <span>Carga masiva de facturas</span>
                                </a>
                                
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; <?php echo date('Y');?> <a href="javascript:void(0);">Digital MTX</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <!-- #END# Right Sidebar -->
    </section>
</body>
</html>
