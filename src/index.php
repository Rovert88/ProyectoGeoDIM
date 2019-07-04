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
        
        <link rel="stylesheet" href="../assets/css/system-style.css" />        
    </head>
    
    <body>
        
        <!--Header-part-->
             <div id="header-text">
                <h3><a href="index.php">ManagementGT</a></h3>
             </div>
        <!--close-Header-part-->        

	<!--sidebar-menu-->
        <div>
           <?php include('../assets/templates/sidebar.php'); ?> <!-- Plantilla del menu lateral-->
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
                              <div class="widget-content">
                                  <p>ManagementGT es un sistema que le permite consultar datos de temperaturas de las Sondas de Inspección y Bombas de Calor Geotérmico de diferentes 
                                  Sitios Geográficos.</p>
                                  
                                  <p>Para comenzar a subir archivos y generar gráficas debe registrar un Sitio Geográfico, así como su Sonda de Inspección y opcionalmente podrá 
                                  registrar una Bomba de Calor Geotérmico en el sistema, para ello diríjase al menú de la izquierda y haga clic sobre el botón <b>Sitios</b>, esto 
                                  abrirá  un submenú, haga clic sobre el botón <b>Registrar Sitios</b> a continuación se abrirá una interfaz con un formulario donde podrá llenar 
                                  los datos del SG, y la SI y opcionalmente los datos de la BCG del sitio. Al concluir de clic sobre el botón <b>Registrar</b> para concluir 
                                  con el registro.</p>
                                                                   
                                  <p>Puede cargar archivos CSV de registros de temperaturas de Sondas de Inspección, Bombas de Calor Geotérmico o voltajes de batería de CR800
                                  diríjase al menú de la izquierda y haga clic sobre el botón <b>Archivos</b>, esto desplegará un submenú y podrá dar clic en la opción <b>Cargar archivo</b>.
                                  En esta encontrará un formulario donde podrá elegir el tipo de archivo que desea subir (Sonda de Inspección, Bomba de Calor Geotérmico o Batería
                                  de CR800) y acontinuación mediante un botón podrá seleccionar un archivo de su sistema para que este sea almacenado en la base de datos de ManagementGT.</p>
                                  
                                  <p>Para consultar las gráficas de una sonda o bomba diríjase al menú de la izquierda y haga clic sobre el botón Gráficas de datos. Esto desplegará un 
                                  submenú para elegir el tipo de gráfica a mostrar (Gráficas de Sondas de Inspección o Graficas de Bombas de Calor Geotérmico). Al entrar en cualquiera 
                                  de las dos encontrará un pequeño formulario con las opciones para mostrar la gráfica, elija las opciones de como desea ver la gráfica y de haga clic 
                                  sobre el botón <b>Mostrar gráfica</b>, esto generará la gráfica que desea.</p>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
	<!--end-main-container-part-->

	<!--Footer-part-->
        <div>
            <?php include('../assets/templates/footer.php'); ?> <!-- Plantilla del pie de pagina-->
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
