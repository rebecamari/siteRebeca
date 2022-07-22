<?php

    $nomeLivro = $_POST[ 'nomeLivro'];
    $autorLivro =  $_POST[ 'autorLivro' ];
    $dataLancamento = $_POST[ 'dataLancamento' ];

    $pdo = null;

    try{

        $pdo = new PDO(
            'mysql:dbname=livraria;host:127.0.0.1',
            'root',
            '',
            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
        );

        $ps = $pdo->prepare(
            'INSERT INTO livros ( nomeLivro, autorLivro, dataLancamento ) VALUES ( :nl, :al, :dl )' );

        $ps->execute( [
            'nl' => $nomeLivro,
            'al' => $autorLivro,
            'dl' => $dataLancamento
        ] );
        
        header('Location: listarLivro.php');

    } catch( PDOException $e ){
        echo 'Erro: ', $e->getMessage(), '<br />';
    }

?>