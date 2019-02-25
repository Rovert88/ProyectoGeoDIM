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
        
        <link rel="stylesheet" type="text/css" href="../assets/alertifyjs/css/alertify.css">
        <link rel="stylesheet" type="text/css" href="../assets/alertifyjs/css/themes/default.css">

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
                <div class="row-fluid">     
                    <div class="span7">
                        <div class="widget-box">
                            <div class="widget-title"><span class="icon"><i class="icon-flag"></i></span>
                                <h5>Registrar Sitios Geográficos</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div name="form_registros" class="form-horizontal">                                

                                    <!-- INICIO REGISTRAR SITIOS GEOGRAFICOS-->

                                    <div class="control-group">
                                        <label style="text-align: center; font-size: 20px; color: #000;">Sitio Geográfico (SG)</label>
                                    </div>
                                    
                                    <!--Campo NombreSitio-->
                                    <div class="control-group">
                                        <label class="control-label">Nombre del Sitio: </label>
                                        <div class="controls">
                                            <input id="p1" onkeypress="return soloLetras(event)" type="text" class="form-control" name="nombre_sitio" placeholder="Ej. Cuernavaca INEEL" title="Sitio Geográfico">
                                        </div>
                                    </div>

                                    <!--Campo UbicacionSitio-->
                                    <div class="control-group">
                                        <label class="control-label">Ubicación del Sitio: </label>
                                        <div class="controls">
                                            <input id="p2" onkeypress="return soloLetras(event)" type="text" class="form-control" name="ubicacion_sitio" placeholder="Ej. Cuernavaca, Morelos" title="Nombre del lugar">
                                        </div>
                                    </div>

                                    <!--Campo LocalizacionSitio-->
                                    <div class="control-group">
                                        <label class="control-label">Localización del Sitio: </label>
                                        <div class="controls">
                                            <input id="p3" onkeypress="return soloNumeros(event)" type="text" class="form-control" name="coord_sitio" placeholder="Coordenadas del sitio">
                                        </div>
                                    </div>

                                    <!--Campo RegistradoPor-->
                                    <div class="control-group">
                                        <label class="control-label">Registrado por: </label>
                                        <div class="controls">
                                            <input id="p4" onkeypress="return soloLetras(event)" type="text" class="form-control" name="reg_por" placeholder="Persona que registra el sitio">
                                        </div>
                                    </div>

                                    <!--Campo TipoClimaSitio-->
                                    <div class="control-group">
                                        <label class="control-label">Tipo de clima: </label>
                                        <div class="controls">
                                            <input id="p5" onkeypress="return soloLetras(event)" type="text" class="form-control" name="clima_sitio" placeholder="Clima del sitio">
                                        </div>
                                    </div>

                                    <!-- FIN REGISTRAR SITIOS GEOGRAFICOS-->

                                    <!--INICIO REGISTRAR SONDAS DE INSPECCION-->

                                    <div class="control-group">
                                        <label style="text-align:center; font-size:20px; color:#000;">Sonda de Inspección (SI)</label>
                                    </div>

                                    <!--Campo NombreSonda-->
                                    <div class="control-group">
                                        <label class="control-label">Nombre de Sonda: </label>
                                        <div class="controls">
                                            <input id="p6" type="text" name="nombre_sonda" placeholder="Nombre de la SI" />
                                        </div>
                                    </div>

                                    <!--Campo DispositivoSonda-->
                                    <div class="control-group">
                                        <label class="control-label">Dispositivo: </label>
                                        <div class="controls">
                                            <input id="p7" type="text" name="nombre_sonda" placeholder="Tipo de dispositivo usado para la SI" />
                                        </div>
                                    </div>

                                    <!--Campo NoSerieDispSonda-->
                                    <div class="control-group">
                                        <label class="control-label">No. de serie del dispositivo: </label>
                                        <div class="controls">
                                            <input id="p8" type="text" name="no_serie_disp_sonda" placeholder="Número de serie de dispositivo de la SI" />
                                        </div>
                                    </div>

                                    <!--Campo VSODispSonda-->
                                    <div class="control-group">
                                        <label class="control-label">Versión de S.O. del dispositivo: </label>
                                        <div class="controls">
                                            <input id="p9" type="text" name="v_so_disp_sonda" placeholder="Sistema operativo de dispositivo de la SI" />
                                        </div>
                                    </div>

                                    <!--Campo FechaIniTrabSonda-->
                                    <div class="control-group">
                                        <label class="control-label">Fecha de inicio de trabajo:</label>
                                        <div class="controls">
                                            <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2014" class="input-append date dpYears">
                                                <input id="p10" type="text" readonly="" value="dd-mm-yyyy" size="16" name="f_ini_trab_sonda" class="form-control" />
                                                <span class="input-group-btn add-on">
                                                    <button class="btn btn-theme" type="button"><i class="icon-calendar"></i></button>
                                                </span>
                                            </div>
                                            <span class="help-block">Seleccionar fecha</span>
                                        </div>
                                    </div>

                                    <!--Campo HoraIniTrabSonda-->
                                    <div class="form-group">
                                        <label class="control-label">Hora de inicio de trabajo:</label>
                                        <div class="controls">
                                            <div class="input-group bootstrap-timepicker">
                                                <input id="p11" onkeypress="return horaVal(event)" type="time" class="form-control" name="h_ini_trab_sonda" />                                                
                                            </div>
                                        </div>
                                    </div>

                                    <!--Campo TipoAlimentDispSonda-->
                                    <div class="control-group">
                                        <label class="control-label">Tipo de alimentación: </label>
                                        <div class="controls">
                                            <input id="p12" onkeypress="return soloLetras(event)" type="text" name="alimentacion_disp_sonda" placeholder="Batería, CA, Panel solar" />
                                        </div>
                                    </div>

                                    <!--Campo ProfSonda-->
                                    <div class="control-group">
                                        <label class="control-label">Profundidad (m): </label>
                                        <div class="controls">
                                            <input id="p13"  onkeypress="return soloNumeros(event)" type="text" name="profundida_sonda" placeholder="Profundidad de la sonda" />
                                        </div>
                                    </div>

                                    <!--Campo NoSensoresSonda-->
                                    <div class="control-group">
                                        <label class="control-label">No. de sensores: </label>
                                        <div class="controls">
                                            <input id="p14" onkeypress="return soloNumeros(event)" type="text" name="no_sensores_sonda" placeholder="Total de sensores de la SI" title="Ejemplo: 6,4" />
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
                                                <input id="check" value="1" type="checkbox" name="activa_reg_bcg" onchange="javascript:showContent()" />
                                                Marcar para activar el registro de una BCG
                                            </label>
                                        </div>
                                    </div>

                                    <!--Seccion FormBCG -->
                                    <div id="contenido" style="display: none;">
                                        
                                        <!--Campo NombreBomba-->
                                        <div class="control-group">
                                            <label class="control-label">Nombre de Bomba: </label>
                                            <div class="controls">
                                                <input id="p15" type="text" name="nombre_bomba" placeholder="Nombre de la BCG" />
                                            </div>
                                        </div>

                                        <!--Campo DispositivoBomba-->
                                        <div class="control-group">
                                            <label class="control-label">Dispositivo: </label>
                                            <div class="controls">
                                                <input id="p16" type="text" name="disp_bomba" placeholder="Tipo de dispositivo usado para la BCG" />
                                            </div>
                                        </div>

                                        <!--Campo NoSerieDispBomba-->
                                        <div class="control-group">
                                            <label class="control-label">No. de serie del dispositivo: </label>
                                            <div class="controls">
                                                <input id="p17" type="text" name="no_serie_disp_bomba" placeholder="Número de serie de dispositivo de la BCG" />
                                            </div>
                                        </div>

                                        <!--Campo VSODispBomba-->
                                        <div class="control-group">
                                            <label class="control-label">Versión de S.O. del dispositivo: </label>
                                            <div class="controls">
                                                <input id="p18" type="text" name="v_so_disp_bomba" placeholder="Sistema operativo de dispositivo de la BCG" />
                                            </div>
                                        </div>

                                        <!--Campo FechaIniTrabBomba-->
                                        <div class="control-group">
                                            <label class="control-label">Fecha de inicio de trabajo:</label>
                                            <div class="controls">
                                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2014" class="input-append date dpYears">
                                                    <input id="p19" type="text" readonly="" value="dd-mm-yyyy" size="16" name="f_ini_trab_bomba" class="form-control" />
                                                    <span class="input-group-btn add-on">
                                                        <button class="btn btn-theme" type="button" name="btn_datepicker" ><i class="icon-calendar"></i></button>
                                                    </span>
                                                </div>
                                                <span class="help-block">Seleccionar fecha</span>
                                            </div>
                                        </div>

                                        <!--Campo HoraIniTrabBomba-->
                                        <div class="form-group">
                                            <label class="control-label">Hora de inicio de trabajo:</label>
                                            <div class="controls">
                                                <div class="input-group bootstrap-timepicker">
                                                    <input id="p20" onkeypress="return horaVal(event)" type="time" class="form-control" name="h_ini_trab_bomba" />                                                
                                                </div>
                                            </div>
                                        </div>

                                        <!--Campo TipoAlimenDispBomba-->
                                        <div class="control-group">
                                            <label class="control-label">Tipo de alimentación: </label>
                                            <div class="controls">
                                                <input id="p21" onkeypress="return soloLetras(event)" type="text" name="alimentacion_disp_bomba" placeholder="Batería, CA, Panel solar" />
                                            </div>
                                        </div>

                                        <!--Campo UbicacionSitioBomba-->
                                        <div class="control-group">
                                            <label class="control-label">Ubicación en el sitio: </label>
                                            <div class="controls">
                                                <input id="p22" type="text" name="ubicacion_bomba" placeholder="Ubicación de la BCG en el sitio" />
                                            </div>
                                        </div>

                                        <!--Campo NoVariablesBomba-->
                                        <div class="control-group">
                                            <label class="control-label">No. de variables: </label>
                                            <div class="controls">
                                                <input id="p23" onkeypress="return soloNumeros(event)" type="text" name="no_variables_bomba" placeholder="Total de variables de la BCG" />
                                            </div>
                                        </div>
                                    </div>
                                    <!--FIN REGISTRAR BOMBAS DE CALOR GEOTERMICO-->

                                    <div id="btn-ocultar" style="display: none;" class="form-actions">
                                        <button onclick="registrar()" class="btn btn-success">Registrar</button>
                                    </div>
                                    <div id="resultado"></div>

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
            <div id="footer" class="span12"> 2018 &copy; Instituto Nacional de Electricidad y Energías Limpias <a href="https://www.gob.mx/ineel" target=""><br />www.gob.mx/ineel</a> </div>
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

        <!--Alertify js-->
        <script src="../assets/alertifyjs/alertify.js"></script>

        <script type="text/javascript">
                                            // This function is called from the pop-up menus to transfer to
                                            // a different page. Ignore if the value returned is a null string:
                                            function goPage(newURL) {

                                                // if url is empty, skip the menu dividers and reset the menu selection to default
                                                if (newURL != "") {

                                                    // if url is "-", it is this page -- reset the menu:
                                                    if (newURL == "-") {
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

        <!--form validation script-->
        <!--soloLetras-->
        <script>
            function soloLetras(e) {
                key = e.which || e.keyCode;
                tecla = String.fromCharCode(key).toLowerCase();
                letras = "áéíóúabcdefghijklmnñopqrstuvwxyz , ";
                especiales = "8-37-39-46";
                tecla_especial = false

                for (var i in especiales) {
                    if (key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }
                
                if(key == 8){return true;}
                if(key == 32){return true;}
                if(key == 37){return true;}
                if(key == 38){return true;}
                if(key == 39){return true;}
                if(key == 40){return true;}
                if(key == 36){return true;}
                if(key == 35){return true;}
                if(key == 16){return true;}
                if(key == 46){return true;}
                if(key == 32){return true;}

                if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                    return false;
                }                
            }
        </script>
        <!--soloLetras-end-->
        <!--soloNumeros-->
        <script>
            function soloNumeros(e) {
                key = e.which || e.keyCode;
                tecla = String.fromCharCode(key).toLowerCase();
                numeros = "0123456789.,-";
                especiales = "p"
                tecla_especial = false;

                for (var i in especiales) {
                    if (key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }
                
                if(key == 8){return true;}
                if(key == 32){return true;}
                if(key == 37){return true;}
                if(key == 38){return true;}
                if(key == 39){return true;}
                if(key == 40){return true;}
                if(key == 36){return true;}
                if(key == 35){return true;}
                if(key == 16){return true;}
                if(key == 46){return true;}
                if(key == 9){return true;}

                if (numeros.indexOf(tecla) == -1 && !tecla_especial) {
                    return false;
                }
            }
        </script>
        <!--soloNumeros-end-->
        <!--horaVal-->
        <script>
            function horaVal(e) {
                key = e.which || e.keyCode;
                tecla = String.fromCharCode(key).toLowerCase();
                caracteres = "0123456789: amAM pmPM ";
                especiales = "c";
                tecla_especial = false;

                for (var i in especiales) {
                    if (key === especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }

                if (caracteres.indexOf(tecla) === -1 && !tecla_especial) {
                    return false;
                }
            }
        </script>
        <!--horaVal-end-->
        <!--form validation script-end-->

        <!--show bcg section-->
        <script>
            $(document).ready(function () {
                element = document.getElementById("contenido");
                check = document.getElementById("check");

                if (check.checked) {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            });

            $(document).ready(function () {
                element2 = document.getElementById("btn-ocultar");
                element2.style.display = 'block';
            });

            function showContent() {
                element = document.getElementById("contenido");
                check = document.getElementById("check");

                if (document.getElementById("check").checked) {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            }
        </script>
        <!--show bcg section-end-->

        <!--register-->
        <script>
            function registrar() {
               var check = document.getElementById("check");
                if(check.checked) {
                        var aceptado = "ok";
                        var p1 = $('#p1').val();
                        var p2 = $('#p2').val();
                        var p3 = $('#p3').val();
                        var p4 = $('#p4').val();
                        var p5 = $('#p5').val();
                        var p6 = $('#p6').val();
                        var p7 = $('#p7').val();
                        var p8 = $('#p8').val();
                        var p9 = $('#p9').val();
                        var p10 = $('#p10').val();
                        var p11 = $('#p11').val();
                        var p12 = $('#p12').val();
                        var p13 = $('#p13').val().replace(',', '.');
                        var p14 = $('#p14').val();
                        var p15 = $('#p15').val();
                        var p16 = $('#p16').val();
                        var p17 = $('#p17').val();
                        var p18 = $('#p18').val();
                        var p19 = $('#p19').val();
                        var p20 = $('#p20').val();
                        var p21 = $('#p21').val();
                        var p22 = $('#p22').val();
                        var p23 = $('#p23').val();
                        
                        form_datos = "ok=" + aceptado +
                        "&p1=" + p1 +
                        "&p2=" + p2 +
                        "&p3=" + p3 +
                        "&p4=" + p4 +
                        "&p5=" + p5 +
                        "&p6=" + p6 +
                        "&p7=" + p7 +
                        "&p8=" + p8 +
                        "&p9=" + p9 +
                        "&p10=" + p10 +
                        "&p10=" + p10 +
                        "&p11=" + p11 +
                        "&p12=" + p12 +
                        "&p13=" + p13 +
                        "&p14=" + p14 +
                        "&p15=" + p15 +
                        "&p16=" + p16 +
                        "&p17=" + p17 +
                        "&p18=" + p18 +
                        "&p19=" + p19 +
                        "&p20=" + p20 +
                        "&p21=" + p21 +
                        "&p22=" + p22 +
                        "&p23=" + p23;
                
                    if ($('#p1').val() == "" || $('#p2').val() == "" || $('#p3').val() == "" || $('#p4').val() == "" || $('#p5').val() == ""
                        || $('#p6').val() == "" || $('#p7').val() == "" || $('#p8').val() == "" || $('#p9').val() == "" || $('#p10').val() == ""
                        || $('#p11').val() == "" || $('#p12').val() == "" || $('#p13').val() == "" || $('#p14').val() == "" || $('#p15').val() == ""
                        || $('#p16').val() == "" || $('#p17').val() == "" || $('#p18').val() == "" || $('#p19').val() == "" || $('#p20').val() == ""
                        || $('#p21').val() == "" || $('#p22').val() == "" || $('#p23').val() == ""){
                                                
                        alertify.alert('Registro de Sitios Geograficos', 'Porfavor llene todos los campos');
                        return false;
                    }else{
                $.ajax({
                    async: true,
                    cache: false,
                    dataType: "html",
                    type: 'POST',
                    url:  '../methods/InsertarDatosForms.php',
                    data: form_datos,
                    success: function (r) {

                            alertify.success("Registro exitoso");
                            setTimeout("location.href= 'RegistrarSitios.php';", 3500);
                            element2.style.display = 'none';
                            $("#resultado").html("Registro Exitoso");
                    },
                    beforeSend: function () {
                       $("#resultado").html("Procesando, espere por favor...");

                    },
                    error: function (r) {
                         alertify.error("Registro fallido");
                    }
                });

                    }
                }else{
                    var aceptado = "";
                    var p1 = $('#p1').val();
                    var p2 = $('#p2').val();
                    var p3 = $('#p3').val();
                    var p4 = $('#p4').val();
                    var p5 = $('#p5').val();
                    var p6 = $('#p6').val();
                    var p7 = $('#p7').val();
                    var p8 = $('#p8').val();
                    var p9 = $('#p9').val();
                    var p10 = $('#p10').val();
                    var p11 = $('#p11').val();
                    var p12 = $('#p12').val();
                    var p13 = $('#p13').val().replace(',', '.');
                    var p14 = $('#p14').val();
                    
                    form_datos = "ok=" + aceptado +
                        "&p1=" + p1 +
                        "&p2=" + p2 +
                        "&p3=" + p3 +
                        "&p4=" + p4 +
                        "&p5=" + p5 +
                        "&p6=" + p6 +
                        "&p7=" + p7 +
                        "&p8=" + p8 +
                        "&p9=" + p9 +
                        "&p10=" + p10 +
                        "&p10=" + p10 +
                        "&p11=" + p11 +
                        "&p12=" + p12 +
                        "&p13=" + p13 +
                        "&p14=" + p14;
                
                    if($('#p1').val() == "" || $('#p2').val() == "" || $('#p3').val() == "" || $('#p4').val() == "" || $('#p5').val() == ""
                       || $('#p6').val() == "" || $('#p7').val() == "" || $('#p8').val() == "" || $('#p9').val() == "" || $('#p10').val() == ""
                       || $('#p11').val() == "" || $('#p12').val() == "" || $('#p13').val() == "" || $('#p14').val() == ""){
                       
                       alertify.alert('Registro de Sitios Geograficos', 'Porfavor llene todos los campos');
                       return false;
                    }else{
                $.ajax({
                    async: true,
                    cache: false,
                    dataType: "html",
                    type: 'POST',
                    url:  '../methods/InsertarDatosForms.php',
                    data: form_datos,
                    success: function (r) {

                            alertify.success("Registro exitoso");
                            setTimeout("location.href= 'RegistrarSitios.php';", 3500);
                            element2.style.display = 'none';
                            $("#resultado").html("Registro Exitoso");
                    },
                    beforeSend: function () {
                       $("#resultado").html("Procesando, espere por favor...");

                    },
                    error: function (r) {
                         alertify.error("Registro fallido");
                    }
                });
               


                    }
                }
            }
        </script>
        <!--register-end-->
    </body>
</html>
