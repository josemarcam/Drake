<?php
class conexao{
    
    private $host = "mysql:dbname=Drake_dev;host=localhost";
    private $user = "root";
    private $senha = "root";
    
    public function get_host(){
        return $this->host;
    }
    public function get_user(){
        return $this->user;
    }
    public function get_senha(){
        return $this->senha;
    }
        public function conexao(){
            $pdo = NEW PDO($this->get_host(),$this->get_user(),$this->get_senha());
            return $pdo;
        }
}

class client{

    function consulta(){
        $conexao = NEW conexao();
        $select_us = $conexao->conexao()->query( "SELECT * FROM sis_cliente");
        $result_us = $select_us->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result_us as $key) {
            echo "<tr>
            <td class=\"title\"><a class=\"link\" href=\"client_profile.php?h=".md5($key['cli_id'])."\">".$key['cli_nome']."</a></td>
            <td>".$key['cli_email']."</td>
            <td>".$key['cli_cpf']."</td>
            <td>".$key['cli_tel']."</td>
        </tr>";
        }

    }

    function consulta_unitaria($info){
        $conexao = NEW conexao();
        $select_us = $conexao->conexao()->query( "SELECT $info FROM sis_cliente WHERE MD5(cli_id) = '".$_GET['h']."'");
        $result_us = $select_us->fetch(PDO::FETCH_ASSOC);
        echo $result_us[$info];

    }

    function adicionar(){
        $conexao = NEW conexao();
        $id = $_SESSION['us_id'];
        $nome_completo = $_POST['nome']." ".$_POST['sobrenome'];
        $cpf = $_POST['cpf'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $insert_cli = $conexao->conexao()->query(  "INSERT INTO  sis_cliente(us_id,cli_nome,cli_cpf,cli_tel,cli_email) VALUES ($id,'$nome_completo','$cpf','$tel','$email')");
        return $insert_cli;
    }

    function update(){
        $conexao = NEW conexao();
        $us_id = $_SESSION['us_id'];
        $id = $_GET['h'];
        $cli_nome = $_POST['nome'];
        $cli_cpf = $_POST['cpf'];
        $cli_tel = $_POST['tel'];
        $cli_email = $_POST['email'];
        $cli_obs = $_POST['obs'];
        $cli_endereco = $_POST['endereco'];
        $update_cli = $conexao->conexao()->query("UPDATE sis_cliente SET us_id = $us_id , cli_nome = '$cli_nome' , cli_cpf = '$cli_cpf' , cli_tel = '$cli_tel' , cli_email = '$cli_email' , cli_obs = '$cli_obs' , cli_endereco = '$cli_endereco' WHERE MD5(cli_id) = '$id' ");
        return $update_cli;
    }
}




?>