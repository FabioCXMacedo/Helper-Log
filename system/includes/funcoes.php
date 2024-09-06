<?php

    function voltar() {
        return "<div class='botao-mensagens'>
                    <a href = '../users/user_login_form.php'><button class='btn btn-outline-primary'>Voltar</button></a>
                </div>";
    }

    function msg_sucesso($m) {
        $resp = "<div class='container sucesso'>$m</div>";
        return $resp;
    }

    function msg_aviso($m) {
        $resp = "<div class='container aviso'>$m</div>";
        return $resp;
    }

    function msg_erro($m) {
        $resp = "<div class='container erro'>$m</div>";
        return $resp;
    }

?>