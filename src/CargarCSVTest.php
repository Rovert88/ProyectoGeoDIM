<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Cargar archivos al sistema</title>
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
        <link rel="stylesheet" href="../assets/css/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" href="../assets/css/select2.css" />
        <link rel="stylesheet" href="../assets/css/uniform.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../assets/css/style-system.css" />
        <script languaje="javascript" src="../jquery-3.3.1.js"></script>
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
			  <li class="submenu"> <a href="#"><i class="icon-file style-icons-bar"></i> <span>Archivos</span> </a>
				<ul>
				  <li><a href="SubirArchivos.php">Cargar archivo</a></li>				  
				</ul>
			  </li>			  
			  <li class="submenu"><a href="#"><i class="icon-signal style-icons-bar"></i><span>Gráficas de datos</span></a>
                              <ul>
                                  <li><a href="GraficasSondas.php">Gráficas de Sondas</a></li>
                                  <li><a href="GraficasBombas.php">Gráficas de Bombas</a></li>
                              </ul>
                          </li>
			  <li class="submenu"> <a href="#"><i class="icon-globe style-icons-bar"></i> <span>Sitios</span> </a>
				<ul>
                                    <li><a href="RegistrarSitios.php">Registrar Sitios</a></li>
				  <li><a href="#">Editar Sitios</a></li>
				</ul>
			  </li>
			</ul>  
		  </div>
		  <!--sidebar-menu-close-->

                <!--main-container-part-->
                <div id="content">
                    <h1 class="title-style">Subir archivos al sistema</h1>
                    <div class="container-fluid">
                        <hr>
                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"> <i class="icon-upload-alt"></i> </span>
                                  <h5>Cargar archivo CSV</h5>                                  
                                </div>
                                <div class="widget-content nopadding">
                                    <div>
                                        
                                        <div class="control-group">
                                            <label class="control-label">Seleccionar Sitio Geográfico</label>
                                            <div class="controls" id="sitios_cbx" name="sitios_cbx">
                                              <select >
                                                <option value="0">Sitio geográfico...</option>
                                                <option>Sitio 1</option>
                                                <option>Sitio 2</option>
                                                <option>Sitio 3</option>                                            
                                              </select>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label">Seleccionar tipo de archivo</label>
                                            <div class="controls">
                                              <label>
                                                  <input type="radio" name="archivos" value="f_si" />
                                                Sonda de Inspección</label>
                                              <label>
                                                  <input type="radio" name="archivos" value="f_bcg" />
                                                Bomba de Calor Geotérmico</label>
<!--                                              <label>
                                                  <input type="radio" name="archivos" value="f_bcr800" />
                                                Batería CR800</label>-->
                                            </div>
                                        </div>   
                                        
                                        <!----->
                                        <div class="control-group">
                                            <label class="control-label">Seleccionar archivo</label>
                                            <div class="controls">                                                
                                                    <input type="file" name="archivo" id="archivo_csv" />                                                                                                                                                    
                                            </div>
                                        </div>                                                                                       
                                        <!---->                                        
                                        
                                        <div class="form-actions">
                                            <button type="submit" name="cargar" class="btn btn-success">Cargar</button>
                                        </div>
                                        
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
        <script src="../assets/js/bootstrap-wysihtml5.js"></script>
        <script src="../assets/js/jquery.peity.js"></script>
        <script src="../assets/js/jquery.ui.custom.js"></script>
        <script src="../assets/js/jquery.uniform.js"></script>
        <script src="../assets/js/masked.js"></script>
        <script src="../assets/js/matrix.form_common.js"></script>
        <script src="../assets/js/matrix.js"></script>
        <script src="../assets/js/select2.min.js"></script>
        <script src="../assets/js/wysihtml5-0.3.0.js"></script>
        
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
        <script>
            function obtenerSitios(){
                var sitio_select, tipo_archivo, valor_tipoarchivo, archivo;
                
                sitio_select = document.getElementById('sitios_cbx').value;
                tipo_archivo = document.getElementsByName('archivos');
                archivo = document.getElementById('archivo_csv').value;
                
                for(x=0;x<tipo_archivo.length;x++){
                    if($(tipo_archivo[x]).is(':checked')){
                        valor_tipoarchivo = tipo_archivo[x].value;
                    }
                }
                
                $.ajax({
                    async: true,
                    cache: false,
                    dataType: "html",
                    type: 'POST',
                    url: "../methods/CargarCSV.php",
                    data: "sitio=" + sitio_select + "&tipo_archivo=" + tipo_archivo + "&archivo=" + archivo,
                    success: function (response){
                        $()
                })
            }
        </script>
    </body>
</html>