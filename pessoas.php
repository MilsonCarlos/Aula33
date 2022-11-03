<?php

class Pessoa{
    public $id_pessoa;
    public $nome;
    public $idade;
    public $data_registro;

    public function __construct($id_pessoa=false)
    //contrutor passando id como parâmetro , valor padrão do id é falso
    {
        if($id_pessoa){  //caso seja passado um id construtor
            $this->id_pessoa = $id_pessoa;
            //associa o id recebido ao parametro
            //ao id propriedade da classe
            $this->carregar();
        // e carrega o restante das propriedades
        }
    }
    public function carregar(){
        $query = "SELECT nome, idade, data_registro FROM pessoas WHERE id_pessoa = :id_pessoa";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_pessoa', $this->id_pessoa);
        $stmt->execute();

        $lista = $stmt->fetch();
        $this->nome = $lista['nome'];
        $this->idade = $lista['idade'];
        $this->data_registro = $lista['data_registro'];
    }

    public function inserir(){
        $query = "INSERT INTO pessoas (nome, idade) VALUE (:nome, :idade)";
        // insere usando query preparada
        $conexao = Conexao::conectar();
        // cria conexão
        $stmt = $conexao->prepare($query);
        // prepara a query
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':idade', $this->idade);
        // acima vincula os valores da query com as propriedades da classe
        $stmt->execute();
        // executa
    }

    public function listar(){  // lista todos os registros da tabela
        $query = "SELECT * FROM pessoas";
        // seleciona todos os registros da tabela
        $conexao = Conexao::conectar(); 
        // cria conexão
        $resultado = $conexao->query($query);
        // executa a query e guarda a coenxão na variavel
        $lista = $resultado->fetchAll();
        // transforma o resultado em um array associativo chave : valor
        return $lista;
        // reetorna a lista
    }

    public function atualizar(){
        $query = "UPDATE pessoas SET nome = :nome, idade = :idade WHERE id_pessoa = :id_pessoa";
        // atualiza o registro através do id
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":idade", $this->idade);
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        $stmt->execute();

    }

    public function deletar(){   // exclui um registro
        $query = "DELETE FROM pessoas WHERE id_pessoa = :id_pessoa";
        // deleta pelo id
        $conexao = Conexao::conectar();
        // cria conexao
        $stmt = $conexao->prepare($query);
        // prepara a query
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        // vincula valor
        $stmt->execute();
        // executa
    }

    public function listarPorNome($palavra){   // Lista por nome
        $palavra = '%' . $palavra . '%';
        $query = "SELECT * FROM pessoas WHERE nome LIKE :palavra";   // seleciona todas as colunas da tabela
        $conexao = Conexao::conectar();  // cria conexao
        $stmt = $conexao->prepare($query);  // executa a query e guarda o resultado na variável
        $stmt->bindValue(":palavra", $palavra);  // vincula o placeholder da palavra com a variável palavra do método
        $stmt->execute();  // executa
        $lista = $stmt->fetchAll(); // transforma o resultado em um array associativo (chave: valor)
        return $lista;
    }   
} 
        
?>


  





