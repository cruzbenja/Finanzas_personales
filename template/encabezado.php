<?php
 $tipoUsuario = $_SESSION['idPersona'];
?>
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Escritorio
                        </a>


                        <?php if ($tipoUsuario == 2 || $tipoUsuario == 1) { ?>
                            <a class="nav-link" href="RegistroIngresos.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-cash-coin"></i></div>
                                Registro Ingresos
                            </a>
                        <?php } ?>



                        <?php if ($tipoUsuario == 2 || $tipoUsuario == 1) { ?>
                            <a class="nav-link" href="RegistroGastos.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-cart3"></i></div>
                                Registrar Gastos
                            </a>
                        <?php } ?>
                        


                          <?php if ($tipoUsuario == 2 || $tipoUsuario == 1) { ?>
                            <a class="nav-link" href="RegistroCategoria.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-tags"></i></div>
                                Agregar Categorias
                            </a>
                        <?php } ?>


                    
                        <a class="nav-link" href="ReporteGraficos.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Gráficos
                        </a>
                     
                    </div>
                </div>
            </nav>
        </div>       
  