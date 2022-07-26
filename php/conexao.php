<?php

    function conexaoPDO(){  
        return new PDO('mysql:dbname=livraria;host:127.0.0.1',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    } 
?>