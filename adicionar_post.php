<?php

require_once "pessoas.php";
require_once "conexao.php";


try {
    $nome = $_POST['Nome'];
    $idade = $_POST['Idade'];
    // o código acima recebe o que vem do post e guarda nas variaveis
    $pessoa = new Pessoa();
    // criar novo objeto da classe pessoa

    $pessoa->nome = $nome;
    $pessoa->idade = $idade;
    // vincular os atributos da classe com as variáveis

    $pessoa->inserir();
    // insere

    header("Location: index.php");
} catch (Exception $e) {
    echo $e->getMessage();
}


?>