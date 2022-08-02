<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;900&display=swap" rel="stylesheet">
    <link href="../css/reset.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <title>Editar Livros Cadastrados</title>
    <script src="https://kit.fontawesome.com/2e1125801e.js" crossorigin="anonymous"></script>
</head>
<body>
    </header>

    <header>
        <div>
            <h1><a href="../html/cadastrarLivro.html">Cadastrar Livro</a></h1>
            <h1>Editar Livros Cadastrados</h1>
        </div>
        <nav>
            <h1><i class="fa-solid fa-book-open"></i> Biblioteca</h1>
            <!-- <button><i class="fa-solid fa-plus"></i><a class="cadastro" href="../html/cadastrarLivro.html"> Cadastrar novo livro</a></button> -->
            <a href="../html/cadastrarLivro.html"><button class="cssbuttons-io-button"> Cadastrar novo livro
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z" />
                    </svg>
                </div>
            </button>
            </a>
        </nav>
    </header>

    <div>         
        <table>

            <thead>
                <tr>
                    <th>Id</th><th>Nome do Livro</th><th>Autor do Livro</th><th>Data de Lançamento</th>
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
                                        <td><button type="submit">Atualizar</button></td>
                                    </tr>
                                </div>
                            </form>
                            
                        HTML;
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>