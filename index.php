<?php
    header( 'Content-Type: text/plain; charset=UTF-8' );
    http_response_code( 400 ); // Bad Request
    date_default_timezone_set( 'America/Sao_Paulo' );
    echo 'Bem-vindo, Ao Semi CRUD da Rebeca Mari.  ', date('d/M/Y H:i:s');
?>