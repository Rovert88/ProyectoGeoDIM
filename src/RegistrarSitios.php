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
        <link rel="stylesheet" href="../assets/css/colorpicker.css" />
        <link rel="stylesheet" href="../assets/css/datepicker.css" />
        <link rel="stylesheet" href="../assets/css/uniform.css" />
        <link rel="stylesheet" href="../assets/css/select2.css" />
        <link rel="stylesheet" href="../assets/css/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" href="../assets/css/style-system.css" />
        <link rel="stylesheet" href="../assets/css/timepicker.css" />
	<link rel="stylesheet" href="../assets/css/personal-style.css" />

        <!--script habilitar campos de form-->
		<script type="text/javascript">
			function habilitar(){
				if(document.form_registros.activa_reg_bcg.checked == true){
					document.form_registros.nombre_bomba.disabled = false;
					document.form_registros.disp_bomba.disabled = false;
					document.form_registros.no_serie_disp_bomba.disabled = false;
					document.form_registros.v_so_disp_bomba.disabled = false;
					document.form_registros.btn_datepicker.disabled = false;
					document.form_registros.btn_timepicker.disabled = false;
					document.form_registros.alimentacion_disp_bomba.disabled = false;
					document.form_registros.ubicacion_bomba.disabled = false;
					document.form_registros.no_variables_bomba.disabled = false;
				}else{
					document.form_registros.nombre_bomba.disabled = true;
					document.form_registros.disp_bomba.disabled = true;
					document.form_registros.no_serie_disp_bomba.disabled = true;
					document.form_registros.v_so_disp_bomba.disabled = true;
					document.form_registros.btn_datepicker.disabled = true;
					document.form_registros.btn_timepicker.disabled = true;
					document.form_registros.alimentacion_disp_bomba.disabled = true;
					document.form_registros.ubicacion_bomba.disabled = true;
					document.form_registros.no_variables_bomba.disabled = true;
				}
			}
		</script>

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
                                    <li><a href="RegistrarSitios.html">Registrar Sitios</a></li>
				  <li><a href="#">Editar Sitios</a></li>
				</ul>
			  </li>
			</ul>
		  </div>
		  <!--sidebar-menu-close-->

		<!--main-container-part-->
                <div id="content">
                    <h1 class="title-style">Registro de Sitios Geográficos, Sondas de Inspección y Bombas de Calor Geotérmico</h1>
                    <div class="container-fluid">
                        <div class="row-fluid">     <!--Matrix-->
                            <div class="span7">
                                <div class="widget-box">
                                    <div class="widget-title"><span class="icon"><i class="icon-flag"></i></span>
                                        <h5>Registrar Sitios Geográficos</h5>
                                    </div>
                                    <div class="widget-content nopadding">
                                        <form action="../methods/InsertarDatosForms.php" method="post" class="form-horizontal" name="form_registros">
                                            
                                            <!-- INICIO REGISTRAR SITIOS GEOGRAFICOS-->
                                            
                                                <div class="control-group">
                                                    <label style="text-align: center; font-size: 20px; color: #000;">Sitio Geográfico (SG)</label>
                                                </div>
                                                <!--primer campo-->
                                                <div class="control-group">
                                                    <label class="control-label">Nombre del Sitio: </label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="nombre_sitio" placeholder="Sitio Geográfico">
                                                    </div>
                                                </div>

                                                <!--segundo campo-->
                                                <div class="control-group">
                                                    <label class="control-label">Ubicación del Sitio: </label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="ubicacion_sitio" placeholder="Nombre del lugar">
                                                    </div>
                                                </div>

                                                <!--tercer campo-->
                                                <div class="control-group">
                                                    <label class="control-label">Localización del Sitio: </label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="coord_sitio" placeholder="Coordenadas del sitio">
                                                    </div>
                                                </div>

                                                <!--cuarto campo-->
                                                <div class="control-group">
                                                    <label class="control-label">Registrado por: </label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="reg_por" placeholder="Persona que registra el sitio">
                                                    </div>
                                                </div>

                                                <!--quinto campo-->
                                                <div class="control-group">
                                                    <label class="control-label">Tipo de clima: </label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="clima_sitio" placeholder="Clima del sitio">
                                                    </div>
                                                </div>

                                            <!-- FIN REGISTRAR SITIOS GEOGRAFICOS-->

                                            <!--INICIO REGISTRAR SONDAS DE INSPECCION-->

                                            <div class="control-group">
						<label style="text-align:center; font-size:20px; color:#000;">Sonda de Inspección (SI)</label>
						</div>

                                            <div class="control-group">
                          			<label class="control-label">Nombre de Sonda: </label>
                          		        <div class="controls">
                                                    <input type="text" name="nombre_sonda" placeholder="Nombre de la SI" />
                          		        </div>
					    </div>
                                            
					    <div class="control-group">
                          			<label class="control-label">Dispositivo: </label>
						<div class="controls">
                                                    <input type="text" name="disp_sonda" placeholder="Tipo de dispositivo usado para la SI" />
						</div>
                                            </div>
                                            
                                            <div class="control-group">
						<label class="control-label">No. de serie del dispositivo: </label>
						<div class="controls">
                                                    <input type="text" name="no_serie_disp_sonda" placeholder="Número de serie de dispositivo de la SI" />
						</div>
                                            </div>
                                            
                                            <div class="control-group">
                                            	<label class="control-label">Versión de S.O. del dispositivo: </label>
                                                <div class="controls">
                                                    <input type="text" name="v_so_disp_sonda" placeholder="Sistema operativo de dispositivo de la SI" />
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label">Fecha de inicio de trabajo:</label>
                                                <div class="controls">
                                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2014" class="input-append date dpYears">
                                                        <input type="text" readonly="" value="dd-mm-yyyy" size="16" name="f_ini_trab_sonda" class="form-control" />
                                                        <span class="input-group-btn add-on">
                                                            <button class="btn btn-theme" type="button"><i class="icon-calendar"></i></button>
							</span>
                                                    </div>
                                                        <span class="help-block">Seleccionar fecha</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Hora de inicio de trabajo:</label>
                                                <div class="controls">
                                                    <div class="input-group bootstrap-timepicker">
                                                        <input type="text" class="form-control timepicker-default" name="h_ini_trab_sonda" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-theme04" type="button"><i class="icon-time"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
						<label class="control-label">Tipo de alimentación: </label>
						<div class="controls">
                                                    <input type="text" name="alimentacion_disp_sonda" placeholder="Batería, CA, Panel solar" />
						</div>
	 				    </div>

                                            <div class="control-group">
                                                <label class="control-label">Profundidad (m): </label>
                                                <div class="controls">
                                                    <input type="number" name="profundida_sonda" placeholder="Profundidad de la sonda" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">No. de sensores: </label>
                                                <div class="controls">
                                                    <input type="number" name="no_sensores_sonda" placeholder="Total de sensores de la SI" />
                                                </div>
                                            </div>

                                            <!--FIN REGISTRAR SONDAS DE INSPECCION-->

                                            <!--INICIO REGISTRAR BOMBAS DE CALOR GEOTERMICO-->

                                            <div class="control-group">
                                                <label style="text-align:center; font-size:20px; color:#000;">Bombas de Calor Geotérmico (BCG)</label>
                                            </div>

                                            <div class="control-group">
						<label class="control-label">Registrar BCG</label>
						<div class="controls">
                                                    <label>
                                                    <input type="checkbox" name="activa_reg_bcg" onclick="habilitar()" />
                                                    Marcar para activar el registro de una BCG
                                                    </label>
						</div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Nombre de Bomba: </label>
						<div class="controls">
                                                    <input type="text" name="nombre_bomba" placeholder="Nombre de la BCG" disabled />
						</div>
                                            </div>

                                            <div class="control-group">
						<label class="control-label">Dispositivo: </label>
                                                <div class="controls">
                                                    <input type="text" name="disp_bomba" placeholder="Tipo de dispositivo usado para la BCG" disabled />
                                                </div>
                                            </div>

                                            <div class="control-group">
						<label class="control-label">No. de serie del dispositivo: </label>
						<div class="controls">
                                                    <input type="text" name="no_serie_disp_bomba" placeholder="Número de serie de dispositivo de la BCG" disabled />
                                                </div>
                                            </div>

                                            <div class="control-group">
						<label class="control-label">Versión de S.O. del dispositivo: </label>
						<div class="controls">
                                                    <input type="text" name="v_so_disp_bomba" placeholder="Sistema operativo de dispositivo de la BCG" disabled />
						</div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Fecha de inicio de trabajo:</label>
                                                <div class="controls">
						<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2014" class="input-append date dpYears">
                                                    <input type="text" readonly="" value="dd-mm-yyyy" size="16" name="f_ini_trab_sonda" class="form-control" disabled />
                                                    <span class="input-group-btn add-on">
                                                    <button class="btn btn-theme" type="button" name="btn_datepicker" disabled><i class="icon-calendar"></i></button>
                                                    </span>
						</div>
						<span class="help-block">Seleccionar fecha</span>
						</div>
                                            </div>

                                            <div class="form-group">
                          			<label class="control-label">Hora de inicio de trabajo:</label>
                                                <div class="controls">
						<div class="input-group bootstrap-timepicker">
                                                    <input type="text" class="form-control timepicker-default" name="h_ini_trab_sonda" disabled />
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-theme04" type="button" name="btn_timepicker" disabled><i class="icon-time"></i></button>
                                                    </span>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Tipo de alimentación: </label>
						<div class="controls">
                                                    <input type="text" name="alimentacion_disp_bomba" placeholder="Batería, CA, Panel solar" disabled />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Ubicación en el sitio: </label>
						<div class="controls">
                                                    <input type="text" name="ubicacion_bomba" placeholder="Ubicación de la BCG en el sitio" disabled />
						</div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">No. de variables: </label>
						<div class="controls">
                                                    <input type="text" name="no_variables_bomba" placeholder="Total de variables de la BCG" disabled />
						</div>
                                            </div>

                                            <!--FIN REGISTRAR BOMBAS DE CALOR GEOTERMICO-->

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

        <!--JS scripts-->
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

  <script src="../assets/js/bootstrap-colorpicker.js"></script>
  <script src="../assets/js/bootstrap-datepicker.js"></script>
  <script src="../assets/js/jquery.toggle.buttons.js"></script>
  <script src="../assets/js/masked.js"></script>
  <script src="../assets/js/matrix.form_common.js"></script>
  <script src="../assets/js/wysihtml5-0.3.0.js"></script>
  <script src="../assets/js/bootstrap-wysihtml5.js"></script>

        <!--Date-Time picker js-->
	<!-- js placed at the end of the document so the pages load faster -->
        <script src="../assets/lib/jquery/jquery.min.js"></script>
        <script src="../assets/lib/bootstrap/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../assets/lib/jquery.dcjqaccordion.2.7.js"></script>
        <script src=../"assets/lib/jquery.scrollTo.min.js"></script>
        <script src="../assets/lib/jquery.nicescroll.js" type="text/javascript"></script>
	<!--common script for all pages-->
        <script src="../assets/dashio-assets/lib/common-scripts.js"></script>
	<!--script for this page-->
        <script src="../assets/dashio-assets/lib/jquery-ui-1.9.2.custom.min.js"></script>
        <script type="text/javascript" src="../assets/lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
        <script type="text/javascript" src="../assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../assets/lib/bootstrap-daterangepicker/date.js"></script>
        <script type="text/javascript" src="../assets/lib/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="../assets/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script type="text/javascript" src="../assets/lib/bootstrap-daterangepicker/moment.min.js"></script>
        <script type="text/javascript" src="../assets/lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script src="../assets/lib/advanced-form-components.js"></script>
	<!--Date-Time picker FIN-->

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
