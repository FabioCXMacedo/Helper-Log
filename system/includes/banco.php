<?php 
    $banco = new mysqli("localhost", "u290832752_root", "B@ruchH@shem04032024", "u290832752_transdell"); /*os parametros são: endereço do servidor, usuário, senha e nome do banco de dados. */

    if ($banco->connect_errno) {
        echo "<p>Encontrei um erro $banco->errno --> $banco->connect_error</p>";
        die();
    }

    /* Configuções para acentuação*/
    $banco->query("SET NAMES 'utf8'");
    $banco->query("SET character_set_connection=utf8");
    $banco->query("SET character_set_client=utf8");
    $banco->query("SET character_set_results=utf8");

    
?>