<?php
require_once 'conexao.php';
require_once 'pessoas.php';

/*
$nome_servidor = "localhost";
$usuario = "root";
$senha = "";
$nome_banco = "meuPDO";

//abrindo conexão
try{
    $conn = new PDO("mysql:host=$nome_servidor;", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
    echo "Conexao com sucesso <br>";
} catch (PDOException $e) {
    echo "Conexao falhou: " . $e->getMessage();
}

$conn = null; //fechando conexao
*/
//------------------------------------------

//Criando Banco DE Dados
try {
    $conn = Conexao::conectar();
    $sql = "CREATE DATABASE IF NOT EXISTS meuPDO";
    $conn->exec($sql);
    echo "Banco de Dados Criado com Sucesso <br>";

} catch(PDOException $e) {
    echo $e->getMessage();
}
$conn = null; //fechando conexao

//------------------------------------------
//Criando Tabela
try {
    $conn = Conexao::conectar();
    $sql = "CREATE TABLE IF NOT EXISTS pessoas ( 
        id_pessoa INT(6) AUTO_INCREMENT PRIMARY KEY, 
        Nome VARCHAR(255), Idade INT(3), data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ON UPDATE CURRENT_TIMESTAMP)";

    $conn->exec($sql);

    echo "Tabela Pessoas Criada com Sucesso <br>";
} catch(PDOException $e) {
    echo $e->getMessage();
}
$conn = null;

//------------------------------------------

//listando via classe
if(isset($_GET['busca'])){
    $palavra = $_GET['busca'];
    try{
        $pessoa = new Pessoa();
        $lista = $pessoa->listarPorNome($palavra);
} catch (Exception $e){
    echo $e->getMessage();
}
} else {
    try {
        $pessoa = new Pessoa();
        $lista = $pessoa->listar();
    } catch (Exception $e){
        echo $e->getMessage();
}
}


/*
try {
    $conn = new PDO("mysql:host=$nome_servidor; dbname=$nome_banco", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM pessoas";
    $resultado = $conn->query($query);
    $lista = $resultado->fetchAll();
    echo "Lista de Pessoas Criada com Sucesso <br>";
 }
 catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null; 

*/


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="toast.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>

<div id="exibe"></div>

    <div class="flex-container space-between">
        <div> 
        <button id="btn_criar"><a href="criar_pessoa.php"><span class="material-symbols-outlined">person_add</span></a></button>
        </div>
        <div> 
        <form action="index.php" class="flex-container">
            <input type="search" name="busca" id="busca">
            <button id= "btn_pesquisa" type="submit"><span class="material-symbols-outlined">search</span></button>
        </form>
        </div>
        
    </div>


<?php if(count($lista)>0): ?>
<div class="flex-container">
    <table>
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>idade</th>
            <th>registro</th>
        </tr>

        <?php foreach($lista as $item): ?> <!-- foreach para percorer cada elemento da lista gerada e criar a TR abaixo para cada um deles -->
            <tr>
            <td><?= $item['id_pessoa']?></td> <!-- preenchendo o valor de cada ID da tabela com o valor referente ao item atual indicando sua chave -->
            <td><?= $item['Nome']?></td>
            <td><?= $item['Idade']?></td>
            <td><?= $item['Data_Registro']?></td>
            <td><a href="editar.php?id_pessoa=<?= $item['id_pessoa'] ?>"><span class="material-symbols-outlined" id="btn_edit">edit</span></a></td>
            <td><a href="delete.php?id_pessoa=<?= $item['id_pessoa'] ?>"><span class="material-symbols-outlined" id="delete">delete</span></a></td>

        </tr>
        <?php endforeach ?> <!-- devemos finalizar o laço foreach -->

        
    </table>
</div>

    <?php else: ?>
        <p>Não tem pessoas cadastradas</p>

<?php endif ?>

<script src="script.js"></script>


</body>

</html>