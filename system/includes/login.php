<?php
    ob_start();
    session_start();

    if (!isset($_SESSION['user'])) {  
        $_SESSION['user'] = "";
        $_SESSION['nome'] = "";
        $_SESSION['tipo'] = "";
    }
    

    function cripto($senha) {
        $c = ''; /*começa vazia*/
        for($pos = 0; $pos < strlen($senha); $pos++) { /*essa linha começa em zero e percorre a senha */
            $letra = ord($senha[$pos]) + 1 ; /*aqui mostra a posição de cada letra na tabela de códigos e muda uma posição acima*/
            $c .= chr($letra); /*pega a letra equivalente a posição e armazena em $c */
        }
        return $c;
    }
    
    function gerarHash($senha) {
    $txt = cripto($senha);
    $hash = password_hash($txt, PASSWORD_DEFAULT);
    return $hash;
    }

    function testarHash($senha, $hash) {
        $ok = password_verify(cripto($senha), $hash);
        return $ok;
    }
    
    function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['nome']);
        unset($_SESSION['tipo']);
    }

    function is_logado() {
        if (empty($_SESSION['user'])) {
            return false;
        }
        else {
            return true;
        }
    }

    function is_admin() {
        $t = $_SESSION['tipo'] ?? null;
        if (is_null($t)) {
            return false;
        }
        else {
            if ($t == 'Administrador') {
                return true;
            }
            else {
                return false;
            }
        }
    }

    function is_estrategico() {
        $t = $_SESSION['tipo'] ?? null;
        if (is_null($t)) {
            return false;
        }
        else {
            if ($t == 'Estrategico') {
                return true;
            }
            else {
                return false;
            }
        }
    }

    function is_operacional() {
        $t = $_SESSION['tipo'] ?? null;
        if (is_null($t)) {
            return false;
        }
        else {
            if ($t == 'Operacional') {
                return true;
            }
            else {
                return false;
            }
        }
    }

    
?>