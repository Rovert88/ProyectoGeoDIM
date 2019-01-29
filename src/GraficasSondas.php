<!DOCTYPE html>

<?php
    require '../classes/ConexionDB.php';
    require ("../assets/fusioncharts/fusioncharts.php");
?>

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
        <!--graphics js-->
        <script src="../assets/fusioncharts/fusioncharts.js"></script>
        <script src="../assets/fusioncharts/fusioncharts.theme.fint.js"></script>
    </head>
    
    <body>
        
        <?php
            
                                    //Conexion
                                    $connect = new DBConnection();
                                    $objData = $connect->GSConn()->find();            

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
                                    $dataseries12=array();
                                    $dataseries13=array();
                                    $dataseries14=array();
                                    $dataseries15=array();
                                    $dataseries16=array();
                                    $dataseries17=array();
                                    $dataseries18=array();
                                    $dataseries19=array();
                                    $dataseries20=array();
                                    $dataseries21=array();
                                    $dataseries22=array();
                                    $dataseries23=array();
                                    $dataseries24=array();
                                    $dataseries25=array();
                                    $dataseries26=array();
                                    $dataseries27=array();
                                    $dataseries28=array();

                                    foreach ($data as $dataset) {

                                        array_push($categoryArray, array(
                                            "label" => $dataset["Fecha_HoraRegistro"]
                                        ));

                                        array_push($dataseries1, array(
                                            "value" => $dataset["Temp_Amb"]
                                            ));

                                        array_push($dataseries2, array(
                                            "value" => $dataset["T0_avg"]
                                            ));

                                        array_push($dataseries3, array(
                                            "value" => $dataset["T0_max"]
                                            ));

                                        array_push($dataseries4, array(
                                            "value" => $dataset["T0_min"]
                                            ));

                                        array_push($dataseries5, array(
                                            "value" => $dataset["T1_avg"]
                                            ));

                                        array_push($dataseries6, array(
                                            "value" => $dataset["T1_max"]
                                            ));

                                        array_push($dataseries7, array(
                                            "value" => $dataset["T1_min"]
                                            ));

                                        array_push($dataseries8, array(
                                            "value" => $dataset["T2_avg"]
                                            ));

                                        array_push($dataseries9, array(
                                            "value" => $dataset["T2_max"]
                                            ));

                                        array_push($dataseries10, array(
                                            "value" => $dataset["T2_min"]
                                            ));

                                        array_push($dataseries11, array(
                                            "value" => $dataset["T3_avg"]
                                            ));

                                        array_push($dataseries12, array(
                                            "value" => $dataset["T3_max"]
                                            ));

                                        array_push($dataseries13, array(
                                            "value" => $dataset["T3_min"]
                                            ));

                                        array_push($dataseries14, array(
                                            "value" => $dataset["T4_avg"]
                                            ));

                                        array_push($dataseries15, array(
                                            "value" => $dataset["T4_max"]
                                            ));

                                        array_push($dataseries16, array(
                                            "value" => $dataset["T4_min"]
                                            ));

                                        array_push($dataseries17, array(
                                            "value" => $dataset["T5_avg"]
                                            ));

                                        array_push($dataseries18, array(
                                            "value" => $dataset["T5_max"]
                                            ));

                                        array_push($dataseries19, array(
                                            "value" => $dataset["T5_min"]
                                            ));

                                        array_push($dataseries20, array(
                                            "value" => $dataset["T6_avg"]
                                            ));

                                        array_push($dataseries21, array(
                                            "value" => $dataset["T6_max"]
                                            ));

                                        array_push($dataseries22, array(
                                            "value" => $dataset["T6_min"]
                                            ));

                                        array_push($dataseries23, array(
                                            "value" => $dataset["T7_avg"]
                                            ));

                                        array_push($dataseries24, array(
                                            "value" => $dataset["T7_max"]
                                            ));

                                        array_push($dataseries25, array(
                                            "value" => $dataset["T7_min"]
                                            ));

                                        array_push($dataseries26, array(
                                            "value" => $dataset["T75_avg"]
                                            ));

                                        array_push($dataseries27, array(
                                            "value" => $dataset["T75_max"]
                                            ));

                                        array_push($dataseries28, array(
                                            "value" => $dataset["T75_min"]
                                            ));

                                    }
                        $arrData = array(
                          "chart" => array(      
                                        "caption" => "Comportamiento de temperaturas de la Sonda de Inspeccion",
                                        "xAxisname" => "Periodo de muestra",
                                        "yAxisname" => "Temperatura °C",
                                        "plotFillAlpha" => "80",
                                        "showValues" => "0",
                                        "bgColor" => "#89C3C4",
                                        "canvasColors" => "#A0CBC2",                   
                                        "paletteColors" => "#ECF000, #63D41B, #FF6421",
                                        "baseFont" => "Open Sans",
                                        "showPlotBorder" => "1",
                                        "theme" => "fint"
                            )
                        );


                            $arrData["categories"]=array(array("category"=>$categoryArray));
                                    //Crear objeto de dataset
                            $arrData["dataset"] = array(
                                array("seriesName"=> "Temp_Amb", "data"=>$dataseries1, "color" => "#000000"), 
                                array("seriesName"=> "T0_avg", "data"=>$dataseries2),
                                array("seriesName"=> "T0_max", "data"=>$dataseries3),
                                array("seriesName"=> "T0_min", "data"=>$dataseries4),
                                array("seriesName"=> "T1_avg", "data"=>$dataseries5),
                                array("seriesName"=> "T1_max", "data"=>$dataseries6),
                                array("seriesName"=> "T1_min", "data"=>$dataseries7),
                                array("seriesName"=> "T2_avg", "data"=>$dataseries8),
                                array("seriesName"=> "T2_max", "data"=>$dataseries9),
                                array("seriesName"=> "T2_min", "data"=>$dataseries10),
                                array("seriesName"=> "T3_avg", "data"=>$dataseries11),
                                array("seriesName"=> "T3_max", "data"=>$dataseries12),
                                array("seriesName"=> "T3_min", "data"=>$dataseries13),
                                array("seriesName"=> "T4_avg", "data"=>$dataseries14),
                                array("seriesName"=> "T4_max", "data"=>$dataseries15),
                                array("seriesName"=> "T4_min", "data"=>$dataseries16),
                                array("seriesName"=> "T5_avg", "data"=>$dataseries17),
                                array("seriesName"=> "T5_max", "data"=>$dataseries18),
                                array("seriesName"=> "T5_min", "data"=>$dataseries19),
                                array("seriesName"=> "T6_avg", "data"=>$dataseries20),
                                array("seriesName"=> "T6_max", "data"=>$dataseries21),
                                array("seriesName"=> "T6_min", "data"=>$dataseries22),
                                array("seriesName"=> "T7_avg", "data"=>$dataseries23),
                                array("seriesName"=> "T7_max", "data"=>$dataseries24),
                                array("seriesName"=> "T7_min", "data"=>$dataseries25),
                                array("seriesName"=> "T75_avg", "data"=>$dataseries26),
                                array("seriesName"=> "T75_max", "data"=>$dataseries27),
                                array("seriesName"=> "T75_min", "data"=>$dataseries28)
                                );

                            $jsonEncodedData = json_encode($arrData);
                                    //Crear grafica con caracteristicas
                            $msChart = new FusionCharts("msline","chart1" , "100%", "400", "chart-container", "json", $jsonEncodedData);

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
				  <li><a href="index.html">Historial de cargas</a></li>
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
                                    <li><a href="RegistrarSitios.php">Registrar Sitios</a></li>
				  <li><a href="#">Editar Sitios</a></li>
				</ul>
			  </li>
			</ul>  
		  </div>
		  <!--sidebar-menu-close-->

		<!--main-container-part-->
		<div id="content">
                    <h1 align="center">Graficas Sondas</h1>
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
                                <h5></h5>
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
