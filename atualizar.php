<?php

    $id = $_POST[ 'id' ];
    $nomeLivro= $_POST[ 'nomeLivro' ];
    $autorLivro = $_POST[ 'autorLivro' ];
    $dataLancamento = $_POST[ 'dataLancamento' ];

    $pdo = null;

    try{

        $pdo = new PDO(
            'mysql:dbname=livraria; host:127.0.0.1',
            'root',
            '',
            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
        );

        $ps = $pdo->prepare(
            'UPDATE livros SET nomeLivro = :nl, autorLivro = :ul, dataLancamento = :dl WHERE id = :id'
        );

        $ps->execute([
            'nl' => $nomeLivro,
            'ul' => $autorLivro,
            'dl' => $dataLancamento
        ]);

        $ps->rowCount();

        header('Location: listarLivro.php');

    } catch ( PDOException $e){
        echo 'Error', $e->getMessage(), '<br />';
    }
?>