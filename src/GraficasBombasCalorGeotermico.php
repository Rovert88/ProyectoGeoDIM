<!DOCTYPE html>

<?php
require '../classes/ConexionDB.php';
require ("../assets/fusioncharts/fusioncharts.php");
?>

<html lang="es">
    <head>
        <title>Gráficas de Bombas de Calor Geotérmico</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--stylesheets-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="../assets/chartist-zoom-master/dist/chartist-plugin-zoom.js"></script>
        <script src="../assets/chartist-zoom-master/dist/chartist-plugin-zoom.min.js"></script>

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

        <link rel="stylesheet" type="text/css" href="../assets/alertifyjs/css/alertify.css">
        <link rel="stylesheet" type="text/css" href="../assets/alertifyjs/css/themes/default.css">
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
        <div class="style-sidebar" id="content">
            <h1 class="title-style">Gráficas de Bombas de Calor Geotérmico</h1>
            <div class="container-fluid">                        
                <hr>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-bookmark"></i> </span>
                                <h5>Generar gráfica</h5>
                            </div>
                            <div class="widget-content">
                                <div>
                                    
                                    <!--Select para Nombre de los Sitios Geograficos-->
                                    <div class="control-group">
                                        <label class="control-label">Seleccionar Sitio Geográfico</label>
                                        <div class="controls">
                                            <?php                                           

                                            $connection = new DBConnection();
                                            $traerColl = $connection->ConectarBD();
                                            $collection = $traerColl->SitiosGeograficos;
                                            $result = $collection->find();
                                            
                                            ?>                 
                                            <select id="sitio" onchange="selectSitioGeografico()">
                                                <option value=0>Selecciona el Sitio</option>
                                                <?php
                                                foreach ($result as $r) {
                                                    echo "<option value=" . $r['_id'] . ">" . $r['NombreSitio'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!--Mostrar primer y ultimo registro de la coleccion-->
                                    <div class="control-group">
                                        <label class="control-label">Primer dato almacenado</label>
                                        <div class="controls">                                                           
                                            <?php
                                                $connect = new DBConnection();
                                                $traerColl = $connect->ConectarBD();
                                                $collection = $traerColl->Registros_Bombas_Calor_Geotermico;                                   
                                                $result = $collection->find([],['sort' => ['_id' => 1],'limit' => 1, 'skip' => 1]);
                                            ?>  
                                            <label> 
                                                <?php 
                                                foreach($result as $doc){
                                                    $fecha = $doc['TIMESTAMP']->toDateTime();
                                                    $format = $fecha->format('d-m-Y\ - H:i:s');
                                                    echo "<label value=" . $doc['_id'] . ">" . $format . "</label>";
                                                }
                                                ?>
                                            </label>                                               
                                        </div>
                                        
                                         <label class="control-label">Último dato almacenado</label>
                                        <div class="controls">                                                           
                                            <?php                                
                                                $result = $collection->find([],['sort' => ['_id' => -1],'limit' => 1]);
                                            ?>  
                                            <label> 
                                                <?php 
                                                foreach($result as $doc){
                                                    $fecha = $doc['TIMESTAMP']->toDateTime();
                                                    $format = $fecha->format('d-m-Y\ - H:i:s');
                                                    echo "<label value=" . $doc['_id'] . ">" . $format . "</label>";
                                                }
                                                ?>
                                            </label>                                               
                                        </div>
                                    </div>
                                    
                                    <!--Seleccion de intervalo de tiempo a mostrar-->
                                    <div class="control-group">
                                        <label class="control-label">Intervalo de tiempo</label>
                                        <div class="controls">
                                            <label>
                                                <input type="radio" name="intervalo" value="2min" checked id="rd1" /> 
                                                Mostrar todos los datos (Cada 2 minutos)</label>
                                            <label>
                                                <input type="radio" name="intervalo" value="1dia" id="rd2" />
                                                1 Día</label>
                                            <label>Intervalo libre (Multiplos de 2)</label>
                                            <input type="text" id="lib" onkeypress="return soloNumeros(event)" placeholder="Ej. 4, 6, 10, etc" disabled />
                                            <label>
                                                <input type="checkbox" id="act" onchange="comprobar(this);" />
                                                Activar intervalo libre
                                            </label>    
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Periodo (Formato MM-DD-AAAA)</label>
                                        <div class="controls">
                                            <div class="input-group input-large" data-date="01/01/2014" data-date-format="dd-mm-yyyy" data-view-mode="years">
                                                <input type="text" class="form-control dpd1" id="inicio"/>
                                                <span class="input-group-addon">a</span>
                                                <input type="text" class="form-control dpd2" id="fin" />
                                            </div>
                                            <span class="help-block">Seleccionar rango de fechas</span>
                                        </div>
                                    </div>
                                    
                                    <!--Boton generar grafica-->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success" onclick="graficaAJAX()">Mostrar gráfica</button>
                                    </div>
                                </div>
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
                                <h5>Gráfica Generada</h5>
                            </div>
                            <div class="widget-content">

                                <div id="chart-container"></div> <!--Div de la grafica-->
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
        
        <!--Alertify js-->
        <script src="../assets/alertifyjs/alertify.js"></script>
        
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
               
        <script type="text/javascript">
            
            //Validar que el campo Intervalo libre solo contenga numeros
            function soloNumeros(e){
                key = e.wich || e.keyCode;
                tecla = String.fromCharCode(key).toLowerCase();
                numeros = "0123456789";
                especiales = "p";
                tecla_especial = false;
                
                for(var i in especiales){
                    if(key == especiales[i]){
                        tecla_especial = true;
                        break;
                    }
                }
                
                if (key == 8) {
                    return true;
                }
                if (key == 32) {
                    return true;
                }
                if (key == 37) {
                    return true;
                }
                if (key == 38) {
                    return true;
                }
                if (key == 39) {
                    return true;
                }
                if (key == 40) {
                    return true;
                }
                if (key == 36) {
                    return true;
                }
                if (key == 35) {
                    return true;
                }
                if (key == 16) {
                    return true;
                }
                if (key == 46) {
                    return true;
                }
                if (key == 9) {
                    return true;
                }
                
                if(numeros.indexOf(tecla) == -1 && !tecla_especial){
                    return false;
                }
            }
            
            //Ejecutar acciones al marcar/desmarcar el checkbox de intervalo libre
            function comprobar(obj){
                if(obj.checked){ //Si se marca el checkbox
                    document.getElementById('rd1').disabled = true;
                    document.getElementById('rd2').disabled = true;
                    document.getElementById('rd1').checked = false;
                    document.getElementById('rd2').checked = false;
                    document.getElementById('lib').disabled = false;
                }else{ //Si se desmarca el checkbox
                    document.getElementById('rd1').disabled = false;
                    document.getElementById('rd2').disabled = false;
                    document.getElementById('lib').disabled = true;
                    document.getElementById('lib').value = "";
                }
            }
            
            //Select Sitio Geografico
            var idSitio = 0;
                        
            function selectSitioGeografico(){
                idSitio = document.getElementById("sitio").value;
            }
            
            //Obtener valor de los radios
            var radios = document.getElementsByName('intervalo');
            //Obtener valor del checkbox
            var check = document.getElementById('act');
            
            //AJAX grafica
            function graficaAJAX(){
                //Validar sitio seleccionado
                if(idSitio === 0){                    
                    alertify.alert('Generación de graficas de datos de Bombas de Calor Geotérmico', 
                        'Seleccione un sitio porfavor');
                }else{
                    
                    //Obtener Datos del Formulario
                    var f_ini, f_fin, valor_intervalo, int_lib;
                    f_ini = document.getElementById('inicio').value;
                    f_fin = document.getElementById('fin').value;
                    int_lib = document.getElementById("lib").value;                                                         

                    //Recuperar el valor de los radio buttons o el campo de texto
                    if(check.checked == true){
                        //Valida si el campo intervalo libre esta vacio
                        if(int_lib == null || int_lib == 0){
                            alertify.alert('Generación de graficas de datos de Bombas de Calor Geotérmico',
                            'Campo vacío, porfavor escriba un intervalo de tiempo válido');
                        }else{
                            //Asigna el valor del campo de texto a la variable "valor_intervalo"
                            var valor_intervalo = document.getElementById('lib').value;
                        }
                    }else{
                        var seleccionado = false; //Variable auxiliar para radio buttons desmarcados
                        for(i = 0; i < radios.length; i++){
                            //Valida si hay un radio button marcado
                            if(radios[i].checked == true){
                                seleccionado = true; //Vuelve true a la variable auxiliar
                                var valor_intervalo = radios[i].value;
                                break; //Asigna el valor del radio button marcado a la variable "valor_intervalo"
                            }
                        }
                    }

                    //Validar fecha inicio o fin vacias
                    if(f_ini.length === 0 || f_fin.length === 0){                    
                        alertify.alert('Generación de graficas de datos de Bombas de Calor Geotérmico', 
                            'Llene el campo de fecha de inicio o fecha final');
                    }

                    $.ajax({
                        async: true,
                        cache: false,
                        dataType: "html",
                        type: 'POST',
                        url: "grafBCG.php",
                        data: "inter=" + valor_intervalo + "&ini=" + f_ini + "&fin=" +f_fin + "&sitio=" + idSitio,
                        success: function(response){
                            $("#chart-container").html(response);
                        },
                        beforeSend: function(){
                            $("#chart-contanier").html("Procesando...");
                        },
                        error: function(objXMLHttpResponse){}
                    });                    
                }                                
            }            
        </script>
    </body>
</html>
