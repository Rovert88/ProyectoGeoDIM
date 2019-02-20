<?php

require "../classes/Modelos/ModeloSitiosGeograficos.php";
require "../classes/Modelos/ModeloSondasInspeccion.php";
require "../classes/Modelos/ModeloBombasCalorG.php";
require "../classes/GeneralOp.php";

$objSG = new ModeloSitiosGeograficos($_POST["p1"], $_POST["p2"], $_POST["p3"], $_POST["p4"], $_POST["p5"]);
$objSI = new ModeloSondasInspeccion($_POST["p6"], $_POST["p7"], $_POST["p8"], $_POST["p9"], $_POST["p10"], $_POST["p11"], $_POST["p12"], $_POST["p13"], $_POST["p14"]);
$objBCG = new ModeloBombasCalorG($_POST["p15"], $_POST["p16"], $_POST["p17"], $_POST["p18"], $_POST["p19"], $_POST["p20"], $_POST["p21"], $_POST["p22"], $_POST["p23"]);

$registrar = GeneralOp::insertarSitios($objSG, $objSI, $objBCG);
