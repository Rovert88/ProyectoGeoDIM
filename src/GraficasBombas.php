<!DOCTYPE html>

<?php
    require '../classes/ConexionDB.php';
    require ("../assets/fusioncharts/fusioncharts.php");
?>

<html lang="es">
    <head>
        <title>Graficas de Bombas de Calor Geotérmico</title>
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
        
        <!--graphics js-->
        <script src="../assets/fusioncharts/fusioncharts.js"></script>
        <script src="../assets/fusioncharts/fusioncharts.theme.fint.js"></script>
    </head>
    <body>
        <?php
            //Conexion
            $connect = new DBConnection();
            $objData = $connect->GBCGConn()->find();
            
            //Convertir cursor Mongo en array
            $data=iterator_to_array($objData);
            asort($data);
            
            $categoryArray=array();
            $dataseries1=array();
            $dataseries2=array();
            $dataseries3=array();
            $dataseries4=array();
            $dataseries5=array();
            $dataseries6=array();
            $dataseries7=array();
            $dataseries8=array();
            $dataseries9=array();
            $dataseries10=array();
            $dataseries11=array();            
            
            foreach($data as $dataset){
                
                array_push($categoryArray, array(
                    "label"=>$dataset["Fecha_HoraRegistro"]
                ));
                
                array_push($dataseries1,array(
                    "value"=>$dataset["Bat_CR800"]
                ));
                
                array_push($dataseries2, array(
                    "value"=>$dataset["Temp_CR800"]
                ));
                
                array_push($dataseries3, array(
                    "value"=>$dataset["EAT_DegF"]
                ));
                
                array_push($dataseries4, array(
                    "value"=>$dataset["LAT_Degf"]
                ));
                
                array_push($dataseries5, array(
                    "value"=>$dataset["EWT_DegF"]
                ));
                
                array_push($dataseries6, array(
                    "value"=>$dataset["LWT_DegF"]
                ));
                
                array_push($dataseries7, array(
                    "value"=>$dataset["CT_Amp"]
                ));
                
                array_push($dataseries8, array(
                    "value"=>$dataset["EAT_DegC"]
                ));
                
                array_push($dataseries9, array(
                    "value"=>$dataset["LAT_DegC"]
                ));
                
                array_push($dataseries10, array(
                    "value"=>$dataset["EWT_DegC"]
                ));
                
                array_push($dataseries11, array(
                    "value"=>$dataset["LWT_DegC"]
                ));
            }
            
            $arrData = array(
                "chart"=> array(
                    "caption"=>"Comportamiento de las variables de proceso de la Bomba de Calor Geotérmico",
                    "xAxisname"=>"Periodo de muestra",
                    "yAxisname"=>"Variables de proceso",
                    "plotFillAlpha"=>"80",
                    "showValues"=>"0",
                    "bgColor"=>"#89C3C4",
                    "canvasColors"=>"#A0CBC2",
                    "paletteColors"=>"#ECF000, #63D41B, #FF6421",
                    "baseFont"=>"Open Sans",
                    "showPlotBorder"=>"1",
                    "theme"=>"fint"
                )
            );
            
            $arrData["categories"]=array(array("category"=>$categoryArray));
            //Crear objeto de dataset
            $arrData["dataset"]=array(
                array("seriesName"=>"Bat_CR800(volts)", "data"=>$dataseries1, "color"=>"#000000"),
                array("seriesName"=>"Temp_CR800", "data"=>$dataseries2, "color"=>"#C40000"),
                array("seriesName"=>"EAT_DegF", "data"=>$dataseries3, "color"=>"#1E00B5"),
                array("seriesName"=>"LAT_DegF", "data"=>$dataseries4, "color"=>"#008504"),
                array("seriesName"=>"EWT_DegF", "data"=>$dataseries5, "color"=>"#DEB500"),
                array("seriesName"=>"LWT_DegF", "data"=>$dataseries6, "color"=>"#0065B8"),
                array("seriesName"=>"CT_Amp", "data"=>$dataseries7, "color"=>"#DE7600"),
                array("seriesName"=>"EAT_DegF", "data"=>$dataseries8, "color"=>"#427500"),
                array("seriesName"=>"LAT_DegF", "data"=>$dataseries9, "color"=>"#FAFA28"),
                array("seriesName"=>"EWT_DegF", "data"=>$dataseries10, "color"=>"#CC1616"),
                array("seriesName"=>"LWT_DegF", "data"=>$dataseries11, "color"=>"#1FAB23"),
            );
            
            $jsonEncodedData = json_encode($arrData);
            //Crear grafica con caracteristicas
            $msChart = new FusionCharts("msline", "chart1", "100%", "400", "chart-container", "json", $jsonEncodedData);
            
            $msChart->render();
        ?>
        
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
		<div class="style-sidebar" id="content">
                    <h1 class="title-style">Gráficas de Sondas de Inspección</h1>
                    <div class="container-fluid">                        
                        <hr>
                        <div class="row-fluid">
                        <div class="span12">
                          <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-bookmark"></i> </span>
                              <h5>Generar gráfica</h5>
                            </div>
                              <div class="widget-content">
                                  <form class="form-horizontal" action="" method="post">
                                      
                                      <div class="control-group">
                                        <label class="control-label">Seleccionar Sitio Geográfico</label>
                                        <div class="controls">
                                          <select>
                                            <option>Temperatura-Tiempo</option>
                                            <option>Temperatura-Profundidad</option>
                                          </select>
                                        </div>
                                      </div>
                                      
                                      <div class="control-group">
                                          <label class="control-label">Intervalo</label>
                                          <div class="controls">
                                              <label>
                                                  <input type="radio" name="radios" /> 
                                              15 Minutos</label>
                                              <label>
                                                  <input type="radio" name="radios" />
                                              30 Minutos</label>
                                              <label>
                                                  <input type="radio" name="radios" />
                                              1 Día</label>
                                          </div>
                                      </div>
                                      
                                      <div class="control-group">
                                          <label class="control-label">Periodo</label>
                                          <div class="controls">
                                              <div class="input-group input-large" data-date="01/01/2014" data-date-format="mm-dd-yyyy" data-view-mode="years">
                                                <input type="text" class="form-control dpd1" name="from"/>
                                                <span class="input-group-addon">a</span>
                                                <input type="text" class="form-control dpd2" name="to" />
                                              </div>
                                              <span class="help-block">Seleccionar rango de fechas</span>
                                          </div>
                                      </div>
                                      
                                      <div class="form-actions">
                                          <button type="submit" class="btn btn-success">Mostrar gráfica</button>
                                      </div>
                                  </form>
                              </div>
                          </div>                                                                                    
                        </div>
                      </div>
                    </div>
                    
                    <div class="container-fluid">                        
                        <hr>
                        <div class="row-fluid">
                        <div class="span12">
                          <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-bookmark"></i> </span>
                                <h5>Gráfica Temperatura-Tiempo</h5>
                            </div>
                              <div class="widget-content">
                                  
                                  <div id="chart-container">Grafica aqui</div> <!--Div de la grafica-->
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