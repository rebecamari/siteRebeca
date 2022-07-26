<?php
    require_once 'conexao.php';
    
    if( !array_key_exists('idLivro', $_POST) ){
        http_response_code(400);
        die('ID não encontradio');
    }
    
    $id = $_POST['idLivro'];
    $nomeLivro = $_POST['nomeLivro'];
    $autorLivro = $_POST['autorLivro'];
    $dataLancamento = $_POST['dataLancamento'];

    echo $dataLancamento;

    $pdo = null;
    try{

        $pdo = conexaoPDO();

        $ps = $pdo->prepare(
            'UPDATE livros SET nomeLivro = :nl, autorLivro = :al, dataLancamento = :dt WHERE id = :id'
        );
        
        $ps->execute([
            'id' => $id,
            'nl' => $nomeLivro, 
            'al' => $autorLivro, 
            'dt' => $dataLancamento
        ]);
            
        
        $ps->rowCount();
        
        header('Location: listarLivro.php');

    } catch ( PDOException $e){
        echo 'Error', $e->getMessage(), '<br />';
    }
?>