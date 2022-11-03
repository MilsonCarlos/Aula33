<?php
require_once "pessoas.php";
require_once "conexao.php";

$id_pessoa = $_POST['id_pessoa'];
$nome = $_POST['Nome'];
$idade = $_POST['Idade'];

try {
    $pessoa = new Pessoa($id_pessoa);
    $pessoa->nome = $nome;
    $pessoa->idade = $idade;

    $pessoa->atualizar();
    setcookie("atualizado", true);
    
    header("Location: index.php");
}

 catch(PDOException $e) {
    echo $e->getMessage();
}



?>