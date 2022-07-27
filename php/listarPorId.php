<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estiloButton.css" rel="stylesheet">
    <title>Atualizar</title>
</head>
<body>
    
    <header>
        <div>
            <a href="../html/cadastrarLivro.html">Cadastrar Livro</a>
            <h1>Atualizar</h1>
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

                <!-- COMEÇANDO PHP. -->
                <?php
                    
                    require_once 'conexao.php';

                    $id = $_GET[ 'id' ];
                    $pdo = null;
                    $livros = [];

                    try{

                        $pdo = conexaoPDO();

                        $ps = $pdo->prepare(
                            'SELECT * FROM livros WHERE id = :id'
                        );

                        $ps->execute([
                            'id' => $id
                        ]);

                        $livros = $ps->fetchAll( PDO::FETCH_ASSOC );

                    }catch ( PDOException $e){
                         echo 'Erro ao Connectar', $e->getMessage(), '<br />';
                    }


                    foreach ( $livros as $l ) {
                        echo <<<HTML
                            <form method="POST" action="atualizar.php">
                                <div class="container-btn">
                                    <tr>
                                        <td>${l['id']}
                                        <input type="hidden" id="idLivro" name="idLivro" value="${l['id']}"></td>
                                        <td><input type="text" id="nomeLivro" name="nomeLivro" value="${l['nomeLivro']}"></td>
                                        <td><input type="text" id="autorLivro" name="autorLivro" value="${l['autorLivro']}"></td>
                                        <td><input type="date" id="dataLancamento" name="dataLancamento" value="${l['dataLancamento']}"></td>
                                        <!-- <button type="submit">Atualizar</button> -->
                                    </tr>
                                    <button type="submit">Atualizar</button>
                                </div>
                            </form>
                            <!-- <div>
                                <button type="submit">Atualizar</button>
                            </div> -->
                        HTML;
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>