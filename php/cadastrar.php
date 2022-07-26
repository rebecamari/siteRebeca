<?php    
    $nomeLivro = $_POST[ 'nomeLivro'];
    $autorLivro =  $_POST[ 'autorLivro' ];
    $dataLancamento = $_POST[ 'dataLancamento' ];

    require_once 'conexao.php';
    $pdo = null;
    
    try{

        $pdo = conexaoPDO();

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