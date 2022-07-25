<?php

    $id = isset($_POST['id']) ? $_POST['id'] : NULL;
    $nomeLivro = isset($_POST['nomeLivro']) ? $_POST['nomeLivro'] : '';
    $autorLivro = isset($_POST['autorLivro']) ? $_POST['autorLivro'] : '';
    $dataLancamento = isset($_POST['dataLancamento']) ? $_POST['dataLancamento'] : '';

    $pdo = null;

    try{

        $pdo = new PDO(
            'mysql:dbname=livraria; host:127.0.0.1',
            'root',
            '',
            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
        );
                            
        $ps = $pdo->prepare(
            'UPDATE livros SET nomeLivro = ?, autorLivro = ?, dataLancamento = ? WHERE id = ?'
        );
        
        $ps->execute([
            $nomeLivro, 
            $autorLivro, 
            $dataLancamento
        ]);
            
        $ps->fetchAll( PDO::FETCH_ASSOC );
        header('Location: listarLivro.php');

    } catch ( PDOException $e){
        echo 'Error', $e->getMessage(), '<br />';
    }
?>