<?php
    class Comissao extends Model{
        protected $table = 'comissao';
        public $id;
        public $nome;
        public $usuario;
        public $senha;

        function criarComissao(){
            $stmt = $this->connection->prepare('INSERT INTO comissao (nome, usuario, senha) VALUES(:nome, :usuario, :senha)');
            $stmt->execute([
                ':nome' => $this->nome,
                ':usuario' => $this->usuario,
                ':senha' => md5($this->senha)
            ]);
            return $this->connection->lastInsertId();
        }

        function getComissoes(){
            $getComissoes =  $this->connection->prepare('SELECT id,nome,usuario,senha FROM comissao ORDER BY nome ASC');
            $getComissoes->execute();
            return $getComissoes->fetchAll(PDO::FETCH_ASSOC);
        }

        function getComissao($id){
            $getComissao =  $this->connection->prepare('SELECT id,nome,usuario,senha FROM comissao WHERE id = :id ORDER BY nome ASC');
            $getComissao->execute([
                ':id' => $id,
            ]);
            return $getComissao->fetch(PDO::FETCH_ASSOC);
        }

        function salvarComissao($id){
            if (!empty($this->senha)) {
                $stmt = $this->connection->prepare('UPDATE comissao SET nome = :nome, usuario = :usuario, senha = :senha WHERE id = :id');
                $stmt->execute([
                  ':id'   => $id,
                  ':nome' => $this->nome,
                  ':usuario' => $this->usuario,
                  ':senha' => md5($this->senha)
                ]);
            } else {
                $stmt = $this->connection->prepare('UPDATE comissao SET nome = :nome, usuario = :usuario WHERE id = :id');
                $stmt->execute([
                  ':id'   => $id,
                  ':nome' => $this->nome,
                  ':usuario' => $this->usuario
                ]);
            }
        }

        function excluir(){
            $stmt = $this->connection->prepare('DELETE FROM comissao where id = :id');
            $stmt->execute([
              ':id' => $this->id,
            ]);
        }
    }
?>