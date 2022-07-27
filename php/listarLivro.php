<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/reset.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <title>Listagem dos Livros Cadastrados</title>
</head>

<body>
    <header>
        <nav>
            <h1>Biblioteca da Rebeca</h1>
            <a href="../html/cadastrarLivro.html">Cadastrar Livro</a>
        </nav>
    </header>
    <main>
        <h1>Livros Cadastrados</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Livro</th>
                    <th>Autor do Livro</th>
                    <th>Data de Lançamento</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    
                    require_once 'conexao.php';
                    $pdo = null;
                    $livros = [];

                    try{

                        $pdo = conexaoPDO();

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
                            <div class="container-btn">
                                <tr>
                                    <td>${l['id']}</td>
                                    <td>${l['nomeLivro']}</td>
                                    <td>${l['autorLivro']}</td>
                                    <td>${l['dataLancamento']}</td>
                                    <td><button type="submit"><a href="deletar.php?id=${l['id']}">Deletar</a></button> </td>
                                    <td><button type="submit"><a href="listarPorId.php?id=${l['id']}">Atualizar</a></button></td>
                                </tr>
                            </div>
                        HTML;
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>