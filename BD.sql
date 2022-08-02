CREATE DATABASE livraria;

USE livraria;

CREATE TABLE livros(
    id int PRIMARY KEY NOT NULL AUTO-INCREMENT,
    nomeLivro VARCHAR(100),
    autorLivro VARCHAR(100),
    dataLancamento VARCHAR(10)
);
