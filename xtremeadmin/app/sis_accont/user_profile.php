<?php
function user_info($info){
    include('conexao.php');
    try {   
            $pdo = NEW PDO($host,$user,$senha);
            $id = $_SESSION['us_id'];
            if (empty($id)) {
                echo "<script type='text/javascript'> document.location = 'erro.php'; </script>";
            }else{
                $searsh = $pdo->query("SELECT $info FROM sis_usuarios WHERE us_id = $id");
                $result = $searsh->fetch(PDO::FETCH_ASSOC);
                return $result[$info];
            }
    } catch (PDOException $e) {
        return "Falha no erro: ".$e->getMessage();
    }
}
?>