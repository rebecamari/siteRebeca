<?php

    if( !array_key_exists('id', $_GET) ){
        http_response_code(400);
        die('ID não encontradio');
    }

    $id = $_GET[ 'id' ];
    $pdo = null;

    try{

        $pdo = new PDO(
            'mysql:dbname=livraria; host:127.0.0.1',
            'root',
            '',
            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] 
        );

        $ps = $pdo->prepare( 
            'DELETE FROM livros WHERE id = :id'
        );

        $ps->execute([
            'id' => $id
        ]);

        if($ps->rowCount() < 1){
            http_response_code( 404 ); // Not Found
            die( 'Id não encontrado' );
        }
        
        header( 'Location: listarLivro.php' );

    } catch (PDOException $e){
        echo 'Erro: ', $e->getMessage(), '<br />';
    }

?>