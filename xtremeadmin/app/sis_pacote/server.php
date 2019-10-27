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

class pacote{ 

    function consulta(){
        $conexao = NEW conexao();
        $select_us = $conexao->conexao()->query( "SELECT * FROM sis_pacote");
        $result_us = $select_us->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result_us as $key) {
            echo "<div class=\"col-lg-3 col-md-6\">".$key."</div>";

        }

    }
    function consulta_card(){
        $conexao = NEW conexao();
        $select_us = $conexao->conexao()->query( "SELECT * FROM sis_pacote");
        $result_us = $select_us->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result_us as $key) {
            $id = $key['pac_id'];
            echo "<div class=\"col-lg-3 col-md-6\">
                        <div class=\"card\">
                            <div class=\"el-card-item\">
                                <div class=\"el-card-avatar el-overlay-1\"> <img src=\"xtreme-admin/assets/images/big/img5.jpg\" alt=\"user\" />
                                    <div class=\"el-overlay\">
                                        <ul class=\"list-style-none el-info\">

                                            <li class=\"el-item\"><a data-toggle=\"modal\" data-target=\"#exampleModal$id\" data-whatever=\"@mdo\" class=\"btn default btn-outline el-link\"><i class=\"icon-magnifier\"></i></a></li>
                                            <li class=\"el-item\"><a class=\"btn default btn-outline el-link\" href=\"javascript:void(0);\"><i class=\"icon-link\"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class=\"el-card-content\">
                                    <h4 class=\"mb-0\">".$key['pac_nome']."</h4> <span class=\"text-muted\">".$key['pac_data_saida']."</span><br><span class=\"text-muted\">".$key['pac_data_volta']."</span>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class=\"modal fade\" id=\"exampleModal$id\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel1\">
                <div class=\"modal-dialog modal-dialog-centered\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h4 class=\"modal-title\" id=\"grid-title\">Modal Heading</h4>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                        </div> 
                        <div class=\"modal-body\">
                            <div class=\"container-fluid\">
                                <div class=\"col-md-12 form-group row\">
                                    <label for=\"cono1\" class=\" text-right control-label col-form-label\"> Nome de Publicação</label>
                                    <input type=\"text\" name=\"tel\" disabled class=\"form-control\" id=\"cono1\" value='".$this->consulta_unitaria('pac_nome',md5($id))."'>
                                    <div class=\"col-sm-9\">
                                    </div>
                                </div>
                                <div class=\"col-md-12 form-group row\">
                                    <label for=\"cono2\" class=\"text-right control-label col-form-label\">Rota da Excursão</label>
                                    <input type=\"text\" name=\"tel\" disabled disabled class=\"form-control\" id=\"cono2\" value='".$this->consulta_unitaria('pac_rota',md5($id))."'>
                                    <div class=\"col-sm-9\">
                                    </div>
                                </div>
                                <div class=\"col-md-6 form-group row\">
                                    <label for=\"cono3\" class=\"text-right control-label col-form-label\">Numero Máximo de Vagas</label>
                                    <input type=\"text\" name=\"tel\" disabled class=\"form-control\" id=\"cono3\" value='".$this->consulta_unitaria('pac_maximo_vagas',md5($id))."'>
                                    <div class=\"col-sm-9\">
                                    </div>
                                </div>
                                <div class=\"col-md-6 form-group \">
                                    <label for=\"cono4\" class=\"text-right control-label col-form-label\">Valor Unitário</label>
                                    <input type=\"text\" name=\"tel\" disabled class=\"form-control\" id=\"cono4\" value='".$this->consulta_unitaria('pac_valor',md5($id))."'>
                                    <div class=\"col-sm-9\">
                                    </div>
                                </div>
                                <div class=\"form-group row\">
                                    <label for=\"cono5\" class=\"text-right control-label col-form-label\">Responsavel pela excursão</label>
                                    <input type=\"text\" name=\"tel\" disabled class=\"form-control\" id=\"cono5\" value='".$this->consulta_unitaria('pac_responsaveis',md5($id))."'>
                                    <div class=\"col-sm-9\">
                                    </div>
                                </div>
                                <div class=\"form-group row\">
                                    <label for=\"cono1\" class=\"col-sm-3 text-right control-label col-form-label\">Data de saida</label>
                                    <input type=\"text\" name=\"tel\" disabled class=\"form-control\" id=\"cono1\" value='".$this->consulta_unitaria('pac_data_saida',md5($id))."'>
                                    <div class=\"col-sm-9\">
                                    </div>
                                </div>
                                <div class=\"form-group row\">
                                    <label for=\"cono1\" class=\"col-sm-3 text-right control-label col-form-label\">Data de volta</label>
                                    <input type=\"text\" name=\"tel\" disabled class=\"form-control\" id=\"cono1\" value='".$this->consulta_unitaria('pac_data_volta',md5($id))."'>
                                    <div class=\"col-sm-9\">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"modal-footer\">
                            <a href=\"pacote_edit.php?h=".md5($id)."\" class=\"btn btn-info waves-effect\">Editar</a>
                            <a href=\"#\" alt=\"alert\" id=\"sa-warning\" class=\"btn btn-danger waves-effect\">Excluir</a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            ";
            

        }

    }

    function consulta_unitaria($info,$id){
        $conexao = NEW conexao();
        
        $select_us = $conexao->conexao()->query("SELECT $info FROM sis_pacote WHERE MD5(pac_id) = '$id' ");
        $result_us = $select_us->fetch(PDO::FETCH_ASSOC);
        if ($info == "pac_local_saida" || $info == "pac_local_volta") {
            $array = explode(" ",$result_us[$info]);
            return $array;
        }
        return $result_us[$info];

    }

    function adicionar(){
        $conexao = NEW conexao();
        $id = $_SESSION['us_id'];
        $pac_nome = $_POST['pac_nome'];
        $pac_data_saida = $_POST['data_saida'];
        $pac_data_volta = $_POST['data_volta'];

        $cep_saida = $_POST['cep_saida'];

        $cidade_saida = $_POST['cidade_saida'];
        $cidade_saida = preg_replace('/[ -]+/' , '_' , $cidade_saida);

        $estado_saida = $_POST['estado_saida'];
        $estado_saida = preg_replace('/[ -]+/' , '_' , $estado_saida);

        $endereco_saida = $_POST['endereco_saida'];
        $endereco_saida = preg_replace('/[ -]+/' , '_' , $endereco_saida);

        $pac_local_saida = $cep_saida." ".$cidade_saida." ".$estado_saida." ".$endereco_saida;

        $cep_volta = $_POST['cep_volta'];

        $cidade_volta = $_POST['cidade_volta'];
        $cidade_volta = preg_replace('/[ -]+/' , '_' , $cidade_volta);

        $estado_volta = $_POST['estado_volta'];
        $estado_volta = preg_replace('/[ -]+/' , '_' , $estado_volta);

        $endereco_volta = $_POST['endereco_volta'];
        $endereco_volta = preg_replace('/[ -]+/' , '_' , $endereco_volta);

        $pac_local_volta = $cep_volta." ".$cidade_volta." ".$estado_volta." ".$endereco_volta;

        $pac_rota = $_POST['pac_rota'];
        $pac_responsaveis = $_POST['pac_responsaveis'];
        $pac_maximo_vagas = $_POST['pac_maximo_vagas'];
        $pac_valor = $_POST['pac_valor']; 
        
        
        $insert_cli = $conexao->conexao()->query("INSERT INTO  sis_pacote(us_id,pac_nome,pac_responsaveis,pac_maximo_vagas,pac_data_saida,pac_data_volta,pac_local_saida,pac_local_volta,pac_rota,pac_valor) VALUES ($id,'$pac_nome','$pac_responsaveis','$pac_maximo_vagas','$pac_data_saida','$pac_data_volta','$pac_local_saida','$pac_local_volta','$pac_rota','$pac_valor')");
        return $insert_cli;
    }

    function update(){
        $conexao = NEW conexao();
        $us_id = $_SESSION['us_id'];
        $id = $_GET['h'];

        $pac_nome = $_POST['pac_nome'];
        $pac_data_saida = $_POST['data_saida'];
        $pac_data_volta = $_POST['data_volta'];

        $cep_saida = $_POST['cep_saida'];

        $cidade_saida = $_POST['cidade_saida'];
        $cidade_saida = preg_replace('/[ -]+/' , '_' , $cidade_saida);

        $estado_saida = $_POST['estado_saida'];
        $estado_saida = preg_replace('/[ -]+/' , '_' , $estado_saida);

        $endereco_saida = $_POST['endereco_saida'];
        $endereco_saida = preg_replace('/[ -]+/' , '_' , $endereco_saida);

        $pac_local_saida = $cep_saida." ".$cidade_saida." ".$estado_saida." ".$endereco_saida;

        $cep_volta = $_POST['cep_volta'];

        $cidade_volta = $_POST['cidade_volta'];
        $cidade_volta = preg_replace('/[ -]+/' , '_' , $cidade_volta);

        $estado_volta = $_POST['estado_volta'];
        $estado_volta = preg_replace('/[ -]+/' , '_' , $estado_volta);

        $endereco_volta = $_POST['endereco_volta'];
        $endereco_volta = preg_replace('/[ -]+/' , '_' , $endereco_volta);

        $pac_local_volta = $cep_volta." ".$cidade_volta." ".$estado_volta." ".$endereco_volta;

        $pac_rota = $_POST['pac_rota'];
        $pac_responsaveis = $_POST['pac_responsaveis'];
        $pac_maximo_vagas = $_POST['pac_maximo_vagas'];
        $pac_valor = $_POST['pac_valor']; 
        $update_cli = $conexao->conexao()->query("UPDATE sis_pacote SET pac_nome = '$pac_nome', pac_data_saida = '$pac_data_saida', pac_data_volta = '$pac_data_volta', pac_local_saida = '$pac_local_saida',pac_local_volta = '$pac_local_volta', pac_rota = '$pac_rota', pac_responsaveis = '$pac_responsaveis', pac_maximo_vagas = $pac_maximo_vagas, pac_valor = '$pac_valor' WHERE MD5(pac_id) = '$id' ");
        return $update_cli;
    }
}

?>