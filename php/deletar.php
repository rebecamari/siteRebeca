<?php
    require_once 'conexao.php';
    
    if( !array_key_exists('id', $_GET) ){
        http_response_code(400);
        die('ID não encontradio');
    }

    $id = $_GET[ 'id' ];
    $pdo = null;

    try{

        $pdo = conexaoPDO();

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