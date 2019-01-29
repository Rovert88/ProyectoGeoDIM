<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Registrar Sitios Geográficos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--stylesheets-->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../assets/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="../assets/css/fullcalendar.css" />
	<link rel="stylesheet" href="../assets/css/matrix-style.css" />
	<link rel="stylesheet" href="../assets/css/matrix-media.css" />
	<link rel="stylesheet" href="../assets/fonts/css/font-awesome.css" />
        <link rel="stylesheet" href="../assets/css/jquery.gritter.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    </head>
    
    <body>
        
        <!--Header-part-->
		  <div>
			<h1>GeoDIM</h1>
		  </div>
		  <!--close-Header-part-->


		  <!--top-Header-menu-->
		  <div id="user-nav" class="navbar navbar-inverse">
			<ul class="nav">
			  <li ><a><i class="icon icon-upload-alt"></i>  <span class="text">Cargar Archivo</span></a></li>
			  <li ><a><i class="icon icon-screenshot"></i> <span class="text">Registrar Sonda</span></a></li>
			  <li ><a><i class="icon icon-cogs"></i> <span class="text">Registrar Bomba</span></a></li>
			  <li ><a><i class="icon icon-info-sign"></i> <span class="text">Ayuda</span></a></li>
			  <li ><a href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Salir</span></a></li>
			</ul>
		  </div>
		  <!--close-top-Header-menu-->

		  <!--sidebar-menu-->
		  <div id="sidebar">
			<ul>
			  <li class="active"><a href="index.php"><i class="icon icon-home"></i> <span>Inicio</span></a> </li>
			  <li class="submenu"> <a href="#"><i class="icon-file"></i> <span>Archivos</span> </a>
				<ul>
				  <li><a href="SubirArchivos.php">Cargar archivo</a></li>
				  <li><a href="index.php">Historial de cargas</a></li>
				</ul>
			  </li>
			  <li class="submenu"> <a href="#"><i class="icon-table"></i> <span>Tablas de datos</span> </a>
				<ul>
				  <li><a href="#">Tablas de Sondas</a></li>
				  <li><a href="#">Tablas de Bombas</a></li>
				</ul>
			  </li>
			  <li class="submenu"><a href="#"><i class="icon-signal"></i><span>Gráficas de datos</span></a>
                              <ul>
                                  <li><a href="GraficasSondas.php">Gráficas de Sondas</a></li>
                                  <li><a href="#">Gráficas de Bombas</a></li>
                              </ul>
                          </li>
			  <li class="submenu"> <a href="#"><i class="icon-globe"></i> <span>Sitios</span> </a>
				<ul>
                                    <li><a href="RegistrarSitios.html">Registrar Sitios</a></li>
				  <li><a href="#">Editar Sitios</a></li>
				</ul>
			  </li>
			</ul>  
		  </div>
		  <!--sidebar-menu-close-->

		<!--main-container-part-->
                <div id="content">
                    <div class="container-fluid">  
                        <div class="row-fluid">     <!--Matrix-->
                            <div class="span6">
                                <div class="widget-box">
                                    <div class="widget-title"><span class="icon"><i class="icon-flag"></i></span>
                                        <h5>Registrar Sitios Geográficos</h5>                                        
                                    </div>
                                    <div class="widget-content nopadding">                                        
                                        <form action="../methods/InsertarDatosForms.php" method="post" class="form-horizontal">
                                                 
                                                <!--primer campo-->         
                                                <div class="control-group">
                                                    <label class="control-label">Nombre del Sitio</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="nombre_sitio" placeholder="Sitio Geográfico">
                                                    </div>
                                                </div>
                                                
                                                <!--segundo campo-->  
                                                <div class="control-group">
                                                    <label class="control-label">Ubicación del Sitio</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="ubicacion_sitio" placeholder="Nombre del lugar">
                                                    </div>
                                                </div>
                                                
                                                <!--tercer campo-->   
                                                <div class="control-group">
                                                    <label class="control-label">Localización del Sitio</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="coord_sitio" placeholder="Coordenadas del sitio">
                                                    </div>
                                                </div>    
                                                
                                                <!--cuarto campo-->    
                                                <div class="control-group">
                                                    <label class="control-label">Registrado por</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="reg_por" placeholder="Persona que registra el sitio">
                                                    </div>
                                                </div>
                                                    
                                                <!--quinto campo-->
                                                <div class="control-group">
                                                    <label class="control-label">Tipo de clima</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="clima_sitio" placeholder="Clima del sitio">
                                                    </div>
                                                </div> 
                                                
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success">Registrar</button>
                                                </div>
                                                                                             
                                        </form>
                                    </div>
                                </div>
                            </div>	
                        </div>      <!--Matrix-->
                    </div>   
                </div>    
		<!--end-main-container-part-->

		<!--Footer-part-->
		<div class="row-fluid">
		  <div id="footer" class="span12"> 2018 &copy; Instituto Nacional de Electricidad y Energías Limpias <a href="https://www.gob.mx/ineel" target="
			"><br />www.gob.mx/ineel</a> </div>
		</div>
		<!--end-Footer-part-->
        
        <!--js scripts-->
        <script src="../assets/js/excanvas.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.ui.custom.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/jquery.flot.min.js"></script>
	<script src="../assets/js/jquery.flot.resize.min.js"></script>
	<script src="../assets/js/jquery.peity.min.js"></script>
	<script src="../assets/js/fullcalendar.min.js"></script>
	<script src="../assets/js/matrix.js"></script>
	<script src="../assets/js/matrix.dashboard.js"></script>
	<script src="../assets/js/jquery.gritter.min.js"></script>
        <script src="../assets/js/matrix.interface.js"></script>
        <script src="../assets/js/matrix.chat.js"></script>
	<script src="../assets/js/jquery.validate.js"></script>
	<script src="../assets/js/matrix.form_validation.js"></script>
	<script src="../assets/js/jquery.wizard.js"></script>
	<script src="../assets/js/jquery.uniform.js"></script>
	<script src="../assets/js/select2.min.js"></script>
	<script src="../assets/js/matrix.popover.js"></script>
	<script src="../assets/js/jquery.dataTables.min.js"></script>
	<script src="../assets/js/matrix.tables.js"></script>
        
        <script type="text/javascript">
	  // This function is called from the pop-up menus to transfer to
	  // a different page. Ignore if the value returned is a null string:
	  function goPage (newURL) {

	  // if url is empty, skip the menu dividers and reset the menu selection to default
		  if (newURL != "") {

		  // if url is "-", it is this page -- reset the menu:
		  if (newURL == "-" ) {
			  resetMenu();
			  }
			  // else, send page to designated URL
		  else {
			document.location.href = newURL;
			  }
		  }
	  }

	// resets the menu selection upon entry to this page:
	function resetMenu() {
	   document.gomenu.selector.selectedIndex = 2;
	}
	</script>
    </body>
</html>
