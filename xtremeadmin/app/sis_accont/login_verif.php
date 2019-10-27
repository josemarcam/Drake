<?php 
session_start();
$username = "";
$senha = "";
$erro = array();
$erro_status = array();

include('conexao.php');

try {
	$pdo = NEW PDO($host,$user,$senha);
} catch (PDOException $e) {
	echo "Falha no erro: ".$e->getMessage();
}

if (isset($_POST['teste'])) {

	$username = addslashes($_POST['username']);
	$senha = addslashes($_POST['senha']);
}

if (isset($_POST['login'])) {

	$username = addslashes($_POST['username']);
	$senha = addslashes($_POST['senha']);

	if (count($erro)==0) {
		$senha = md5($senha);
		$query =$pdo->query( "SELECT us_id FROM sis_usuarios WHERE us_us = '$username' AND us_senha = '$senha'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if (!empty($result)) {
			$query =$pdo->query( "SELECT us_status FROM sis_usuarios WHERE us_us = '$username' AND us_senha = '$senha'");
		$result_status = $query->fetch(PDO::FETCH_ASSOC);
		if ($result_status['us_status'] == "2") {
			$_SESSION['us_id'] = $result['us_id'];
			$_SESSION['usuario'] = $username;
			realocate();
			
			
		}else{
			$_SESSION['falha'] = "Antes de poder acessar sua conta, voce precisa verificar seu email.";
		}
    		
		}else{
			$_SESSION['falha'] =  "Usuario ou senha inexistentes! Por Favor, tente novamente.";
		}
		
	}
}

function realocate(){
	ob_start();
	header('Location:dashboard.php');
	exit();
}
 ?>