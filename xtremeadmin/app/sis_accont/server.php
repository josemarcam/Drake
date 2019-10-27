<?php
 session_start();
 $username = "";
 $email = "";
 $senha_1 = "";
 $erros = 0;
use PHPMailer\PHPMailer\PHPMailer;
// conect to the database

 include('conexao.php');
 try {

 	$pdo = NEW PDO($host,$user,$senha);
 	
 	//if the register button is clicked

	if(isset($_POST["register"])){
		$username = addslashes($_POST["username"]);
		$email = addslashes($_POST["email"]);
		$senha_1 = addslashes($_POST["senha-1"]);
		$senha_2 = addslashes($_POST["senha-2"]);

		if ($senha_1 != $senha_2) {
			$erros = $erros + 1;
			$_SESSION['falha_senha'] = "As senhas não são iguais.";
		}

	//ensure that form fields are filled properly


		$dados_rc_us = filter_input_array(INPUT_POST,FILTER_DEFAULT);
		$dados_st_us = array_map('strip_tags', $dados_rc_us);
		$dados_us = array_map('trim', $dados_st_us);
		$select_us = $pdo->query( "SELECT us_us FROM sis_usuarios WHERE us_us = '".$dados_us['username']."'");
		$result_us = $select_us->fetch(PDO::FETCH_ASSOC);
		 

		if (!empty($result_us['us_us']) ) {
			$erros = $erros + 1;
			$_SESSION['falha_usuario'] = "Usuario ja em uso, por favor, escolha outro!";
		}


		$dados_rc_em = filter_input_array(INPUT_POST,FILTER_DEFAULT);
		$dados_st_em = array_map('strip_tags', $dados_rc_em);
		$dados_em = array_map('trim', $dados_st_em);
		$select_em = $pdo->query(
		 "SELECT us_email FROM sis_usuarios WHERE us_email = '".$dados_em['email']."'");
		$result_em = $select_em->fetch(PDO::FETCH_ASSOC);
		
		if (!empty($result_em['us_email']) ) {
			$erros = $erros + 1;
			$_SESSION['falha_email'] =  "E-mail ja em uso, por favor, escolha outro!";
		}

		//if there is no erros, just save user on database

		if($erros == 0){

				$senha = md5($senha_1);
					$sql =$pdo->query( "INSERT INTO  sis_usuarios(us_us,us_email,us_senha,us_status) VALUES ('$username','$email','$senha',1)");
				

				// include_once "PHPMailer/PHPMailer.php";

				// $mail = new PHPMailer();
				// // Escrevendo o email
				// $id = $pdo->lastInsertId();
				// $md5 = md5($id);
				// $link = "cobrancax.com.br/sis_accont/comp_perfil.php?h=".$md5;

                // $mail->setFrom('contato@cobrancax.com.br');
                // $mail->addAddress($email);
                // $mail->Subject = "Verifique seu email!";
                // $mail->isHTML(true);
                // $mail->Body ="<h3> Parabens! voce esta quase la!</h3><br>
                // <p> Para confirmar seu email e continuar seu cadastro, <a href='http://cobrancax.com.br/sis_accont/comp_perfil.php?h=$md5'> Clique aqui</a></p>
                // ";
				// $mail->send();

				// //Redirecionamento e captura de informações

				// $_SESSION['usuario'] = $username;
				// $_SESSION['sucesso'] = "Registro";
				// header('location: ../index.php');	

				echo "parabens kkj";

		}
	}	
	if (isset($_GET['h'])) {
		$h=$_GET['h'];
		$update =$pdo->query("SELECT * FROM sis_usuarios WHERE MD5(us_id)= '$h'");
		$result_em = $update->fetch(PDO::FETCH_ASSOC);
// 		var_dump($result_em);

		if ($result_em['cef'] == 1 && $result_em['bb'] == 0) {
			include("cef_comp_perfil.php");
		}if ($result_em['bb'] == 1 && $result_em['cef'] == 0) {
			include("bb_comp_perfil.php");
		}if ($result_em['bb'] == 1 && $result_em['cef'] == 1) {
			include("multi_banco_comp_perfil.php");
		}

	}
	if (isset($_POST['update'])) {
		if ($result_em['cef'] == 1) {
			$cnpj = addslashes($_POST['cnpj']);
			$identificacao = addslashes($_POST['identificacao']);
			$codigo_beneficiario =  addslashes($_POST['codigo_beneficiario']);
			$endereco =  addslashes($_POST['endereco']);
			$unidade =  addslashes($_POST['unidade']);
			$genero = addslashes($_POST['gender']);
			$tel =  addslashes($_POST['tel']);
			$pergunta =  addslashes($_POST['pergunta']);
			$resposta =  addslashes($_POST['resposta']);
		}
		if ($result_em['bb'] == 1) {
		
			$convenio = addslashes($_POST['convenio']);
			$carteira = addslashes($_POST['carteira']);
			$variacao_carteira =  addslashes($_POST['variacao_carteira']);
		}

		if (count($erros)==0) {
		$dados_rc_us = filter_input_array(INPUT_POST,FILTER_DEFAULT);
		$dados_st_us = array_map('strip_tags', $dados_rc_us);
		$dados_us = array_map('trim', $dados_st_us);

		$select_em = $pdo->query("SELECT us_us FROM sis_usuarios WHERE MD5(us_id) = '$h'");
		$result_us = $select_em->fetch(PDO::FETCH_ASSOC);
		$usuario = $result_us['us_us'] ;
		// Select para pegar o id
		$select_cl = $pdo->query("SELECT us_id FROM sis_usuarios WHERE us_us = '".$usuario."'");
		$result_cl = $select_cl->fetch(PDO::FETCH_ASSOC);
		$h = $result_cl['us_id'];
		
			if ($result_em['cef'] == 1) {
				$insert =$pdo->query( "INSERT INTO cef(codigo_beneficiario,unidade,identificacao,cnpj,endereco,us_id,tel,pergunta,resposta) VALUES ('$codigo_beneficiario','$unidade', '$identificacao',  '$cnpj',  '$endereco',$h,$tel,'$pergunta','$resposta')");
			}
			if ($result_em['bb'] == 1) {
				$insert =$pdo->query( "INSERT INTO bb(convenio,carteira,variacao_carteira,us_id) VALUES ('$convenio','$carteira','$variacao_carteira',$h)");
			}
			$update = $pdo->query("UPDATE sis_usuarios SET us_status = 2  WHERE MD5(us_id)= '$h'");
				// Redireciona para o dashboard
				echo "<script type='text/javascript'> document.location = 'login.php'; </script>";

				exit;
				
			}

		
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}
 ?>