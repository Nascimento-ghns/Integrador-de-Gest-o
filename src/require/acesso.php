<?php

    session_start();
    if(!array_key_exists('logado', $_SESSION)){
        header('Location: login.php');
    }

?>