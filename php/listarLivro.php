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
    <title>Listagem dos Livros Cadastrados</title>
    <script src="https://kit.fontawesome.com/2e1125801e.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
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
    <main>
        <h1>Livros Cadastrados</h1>
        </br>
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

                    try {

                        $pdo = conexaoPDO();

                        $ps = $pdo->prepare(
                            'SELECT * FROM livros'
                        );

                        $ps->execute();

                        $livros = $ps->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo 'Erro ao Connectar', $e->getMessage(), '<br />';
                    }

                    foreach ($livros as $l) {
                        echo <<<HTML
                            <div class="container-btn">
                                <tr>
                                    <td>${l['id']}</td>
                                    <td>${l['nomeLivro']}</td>
                                    <td>${l['autorLivro']}</td>
                                    <td>${l['dataLancamento']}</td>
                                    <td><button type="submit"><a href="deletar.php?id=${l['id']}">Deletar</a></button> </td>
                                    <td><button type="submit"><a href="atualizarListar.php?id=${l['id']}">Atualizar</a></button></td>
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