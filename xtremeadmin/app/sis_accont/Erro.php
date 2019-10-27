<?php
function div_erro($mensagem){
        $div_erro = "<div class=\"invalid-feedback\">".$mensagem."</div>";
        session_destroy();
        return $div_erro;
}

function class_erro(){
    if (isset($_SESSION['falha'])) {
        return "class=\"form-control form-control-lg is-invalid\"";
        session_destroy();
    }else {
        return "class=\"form-control form-control-lg\"";
    }
}
function senha_class_erro(){
    if (isset($_SESSION['falha_senha'])) {
        return "class=\"form-control form-control-lg is-invalid\"";
        session_destroy();
    }else {
        return "class=\"form-control form-control-lg\"";
    }
}

function email_class_erro(){
    if (isset($_SESSION['falha_email'])) {
        return "class=\"form-control form-control-lg is-invalid\"";
        session_destroy();
    }else {
        return "class=\"form-control form-control-lg\"";
    }
}
function usuario_class_erro(){
    if (isset($_SESSION['falha_usuario'])) {
        return "class=\"form-control form-control-lg is-invalid\"";
        session_destroy();
    }else {
        return "class=\"form-control form-control-lg\"";
    }
}


?>