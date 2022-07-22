<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem dos Livros Cadastrados</title>
</head>
<body>
    
    <header>
        <div>
            <a href="cadastrarLivro.html">Cadastrar Livro</a>
            <h1>Livros Cadastrados</h1>
        </div>
    </header>

    <div>         
        <table>

            <thead>
                <tr>
                    <th>ID</th><th>Nome do Livro</th><th>Autor do Livro</th><th>Data de Lançamento</th>
                </tr>
            </thead>

            <tbody> 
                
                <?php
                    $pdo = null;
                    $livros = [];

                    try{

                        $pdo = new PDO(
                            'mysql:dbname=livraria;host:127.0.0.1',
                            'root',
                            '',
                            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
                        );

                        $ps = $pdo->prepare(
                            'SELECT * FROM livros'
                        );

                        $ps->execute();

                        $livros = $ps->fetchAll( PDO::FETCH_ASSOC );

                    }catch ( PDOException $e){
                         echo 'Erro ao Connectar', $e->getMessage(), '<br />';
                    }


                    foreach ( $livros as $l ) {
                        echo <<<HTML
                            <tr>
                                <td>${l['id']}</td>
                                <td>${l['nomeLivro']}</td>
                                <td>${l['autorLivro']}</td>
                                <td>${l['dataLancamento']}</td>
                                <td><a href="deletar.php?id=${l['id']}">Deletar</a> </td>
                                <td><a href="atualizar.php?id=${l['id']}">Atualizar</a> </td>
                            </tr>
                        HTML;
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>