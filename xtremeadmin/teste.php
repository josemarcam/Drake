<?php
include("app/sis_pacote/server.php");
$consult = NEW pacote(); 
$consult->consulta();

$var = $consult->consulta_unitaria('pac_local_volta',7);

print_r($var);


?>