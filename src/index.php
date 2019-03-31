<!DOCTYPE html>

<html lang="es">
    <head>
        <title>GeoDIM</title>
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
        <link rel="stylesheet" href="../assets/css/style-system.css" />
    </head>
    
    <body>
        
        <!--Header-part-->
		  <div>
			<h3><a href="index.php">ManagementGT</a></h3>
		  </div>
        <!--close-Header-part-->

        <!--top-Header-menu-->
		  <div id="user-nav" class="navbar navbar-inverse">
			<ul class="nav">
			  <li ><a><i class="icon icon-upload-alt style-icons-bar"></i>  <span class="text">Cargar Archivo</span></a></li>
			  <li ><a><i class="icon icon-screenshot style-icons-bar"></i> <span class="text">Registrar Sonda</span></a></li>
			  <li ><a><i class="icon icon-cogs style-icons-bar"></i> <span class="text">Registrar Bomba</span></a></li>
			  <li ><a><i class="icon icon-info-sign style-icons-bar"></i> <span class="text">Ayuda</span></a></li>
			  <li ><a href="login.html"><i class="icon icon-share-alt style-icons-bar"></i> <span class="text">Salir</span></a></li>
			</ul>
		  </div>
		  <!--close-top-Header-menu-->

		  <!--sidebar-menu-->
		  <div class="style-sidebar" id="sidebar">
			<ul>
                            <li class="active"><a href="index.php"><i class="icon icon-home style-icons-bar"></i> <span>Inicio</span></a> </li>
			  <li class="submenu"> <a href="#"><i class="icon-file style-icons-bar"></i> <span>Archivos CSV</span> </a>
				<ul>
				  <li><a href="SubirArchivosCSV.php">Cargar Archivo</a></li>				  
				</ul>
			  </li>
			  
                          <li class="submenu"><a href="#"><i class="icon-signal style-icons-bar"></i><span>Gráficas de Datos</span></a>
                              <ul>
                                  <li><a href="GraficasSondasInspeccion.php">Gráficas de Sondas de Inspección</a></li>
                                  <li><a href="GraficasBombasCalorGeotermico.php">Gráficas de Bombas de Calor Geotérmico</a></li>
                                  <li><a href="GraficasBateriaCR800.php">Gráficas de Bateria de CR800</a></li>
                              </ul>
                          </li>
			  <li class="submenu"> <a href="#"><i class="icon-globe style-icons-bar"></i> <span>Sitios Geográficos</span> </a>
				<ul>
                                    <li><a href="RegistrarSitiosGeograficos.php">Registrar Sitios</a></li>
				  <li><a href="#">Editar Sitios</a></li>
				</ul>
			  </li>
			</ul>  
		  </div>
		  <!--sidebar-menu-close-->

		<!--main-container-part-->
		<div id="content">
                    <h1 class="title-style">Bienvenido a ManagementGT</h1>
                    <div class="container-fluid">                        
                        <hr>
                        <div class="row-fluid">
                        <div class="span12">
                          <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-bookmark"></i> </span>
                              <h5></h5>
                            </div>
                              <div class="widget-content" align="justify">
                                  ManagementGT es un sistema que le permite consultar datos de temperaturas de las Sondas de Inspección y Bombas de Calor Geotérmico de diferentes 
                                  Sitios Geográficos así como consultar los datos de los propios sitios y las sondas de inspección y bombas de calor geotérmico con las que 
                                  cuente cada uno de ellos.<br /> <br />
                                  
                                  Para comenzar a subir archivos y generar gráficas debe registrar un Sitio Geográfico, así como su Sonda de Inspección y opcionalmente podrá 
                                  registrar una Bomba de Calor Geotérmico en el sistema, para ello diríjase al menú de la izquierda y haga clic sobre el botón "Sitios", esto 
                                  abrirá  un submenú, haga clic sobre el botón “Registrar Sitios” a continuación se abrirá una interfaz con un formulario donde podrá llenar 
                                  los datos del SG, y la SI y opcionalmente los datos de la BCG del sitio. Al concluir de clic sobre el botón “Registrar” para concluir 
                                  con el registro.<br /> <br />
                                                                   
                                  Puede cargar archivos CSV de registros de temperaturas de Sondas de Inspección, Bombas de Calor Geotérmico o voltajes de batería de CR800
                                  diríjase al menú de la izquierda y haga clic sobre el botón "Archivo"s, esto desplegará un submenú y podrá dar clic en la opción "Cargar archivo".
                                  En esta encontrará un formulario donde podrá elegir el tipo de archivo que desea subir (Sonda de Inspección, Bomba de Calor Geotérmico o Batería
                                  de CR800) y acontinuación mediante un botón podrá seleccionar un archivo de su sistema para que este sea almacenado en la base de datos de ManagementGT.<br /> <br />
                                  
                                  Para consultar las gráficas de una sonda o bomba diríjase al menú de la izquierda y haga clic sobre el botón Gráficas de datos. Esto desplegará un 
                                  submenú para elegir el tipo de gráfica a mostrar (Gráficas de Sondas de Inspección o Graficas de Bombas de Calor Geotérmico). Al entrar en cualquiera 
                                  de las dos encontrará un pequeño formulario con las opciones para mostrar la gráfica, elija las opciones de como desea ver la gráfica y de haga clic 
                                  sobre el botón “Mostrar gráfica”, esto generará la gráfica que desea.
                              </div>
                          </div>
                        </div>
                      </div>
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
