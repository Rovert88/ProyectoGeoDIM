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
                            <form class="form-horizontal" enctype="multipart/form-data" action="../methods/CargarCSV.php" method="post" >

                                <div class="control-group">
                                    <label class="control-label">Seleccionar Sitio Geográfico</label>
                                    <div class="controls">
                                        <?php
                                        require "../classes/ConexionDB.php";
                                        $conn = new DBConnection();
                                        $collection = $conn->SGConn();

                                        $result = $collection->find();
                                        ?>
                                        <select id="select" onchange="mostrarInputs(this.value)">
                                            <option value="0">Seleccionar Sitio</option>
                                            
                                            <?php
                                            foreach ($result as $data) {
                                                echo "<option  value=" . $data['_id'] . ">" . $data['NombreSitio'] . "</option>";                                               
                                            }
                                            ?>    
                                            
                                        </select>
                                        <!--style="display:none;"-->
                                        <input type="text"  id="inp" name="inp"  value="" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Seleccionar tipo de archivo</label>
                                    <div class="controls">
                                        <label>
                                            <input type="radio" name="radios" value="f_si" id="radio1" />
                                            Sonda de Inspección</label>
                                        <label>
                                            <input type="radio" name="radios" value="f_bcg" id="radio2"/>
                                            Bomba de Calor Geotérmico</label>
                                        <label>
                                            <input type="radio" name="radios" value="f_bcr800" id="radio3"/>
                                            Batería CR800</label>
                                    </div>
                                </div>   

                                <!----->
                                <div class="control-group">
                                    <label class="control-label">Seleccionar archivo</label>
                                    <div class="controls">                                                
                                        <input type="file" name="archivo" id="fileInput"/>                                                                                                                                                    
                                    </div>
                                </div>                                                                                       
                                <!---->                                        

                                <div class="form-actions">
                                    <button type="submit" id="btn" disabled="disabled" name="cargar" class="btn btn-success" >Cargar</button>
                                </div>                                        
                            </form>
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

        <!--Metodo insertar
            Solo asi Robert solo id ya que es unico en mongodb y ya con eso hacemos la referencia, no importa si 
        le pones en _id un nombre como "los homeros" aparecera tal cual
        Pues yo creo que no, ese id no lo ocuparia para otra cosa, pero habria que aegurarse que sea unico, es decir cuando 
        se vaya a registrar otro sitio con ese nombre ya no lo dejaria
        si lees la doc de mongo db ya esta definido como llame primaria por asi decirlo el campo _id y no se puede repetir 
        Entonces no se puede asi, habria que buscar otroa forma no?
        no, para nosostrso es mejor porque es unico ese id o value que obtengas del select lo vas a agregar en el documento 
        donde guardas los datos en un campo llamado sitio, asi ya podra existir el id muchas veces en la coleccion de los datos es 
        como una relacion de uno a muchos,
        okey entonces cuando guarde un sitio el campo "_id" seria igual a lo que este en el campo 
        -->
        <script type="text/javascript">

            function enviar(url, data) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        //va el codigo de resultado
                        if (this.response) {
                            alert(this.response);
                            //setTimeout("location.href = 'index.php';",3500);
                            //element2.style.display='none';
                           

                        } else {
                            alert("REGISTRO FALLIDO");
                            
                        }
                    }
                };
                
                  xmlhttp.send(data);

            }
            function registrar() {
                var select = document.getElementById("select").value;
                var radio1 = document.getElementById("radio1");
                var radio2 = document.getElementById("radio2");
                var radio3 = document.getElementById("radio3");
                var file = document.getElementById("fileInput");
                var datos = new FormData();
                //INDEXAMOS LOS DATOS CLAVE : VALOR
                datos.append("excel", file.files[0]);
                datos.append("sitio", select)





                if (select != 0) {

                    if (radio1.checked) {
                        
                        enviar("../methods/CargarCSV.php", datos);
                    } else if (radio2.checked) {
                        enviar("url", datos);
                    } else if (radio3.checked) {
                       enviar("url", datos);
                    } else {
                        alert("selecciona el tipo de archivo!");
                    }
                } else {
                    alert("selecciona el sitio geografico!");

                }
            }

            $("#fileInput").change(function () {
                $("button").prop("disabled", this.files.length == 0);
            });
            
            function mostrarInputs(){
                var select = document.getElementById("select").value;
                document.getElementById("inp").value = select;
            }
        </script>

    </body>
</html>