<?php
    class Representante extends Model{
        protected $table = 'representante';
        public $id;
        public $nome;
        public $usuario;
        public $senha;

        function criarRepresentante(){
            $criarRepresentante = $this->connection->prepare('INSERT INTO representante (nome, usuario, senha) VALUES(:nome, :usuario, :senha)');
            $criarRepresentante->execute([
                ':nome' => $this->nome,
                ':usuario' => $this->usuario,
                ':senha' => md5($this->senha)
            ]);
            return $this->connection->lastInsertId();
        }

        function getRepresentantes(){
            $getRepresentantes =  $this->connection->prepare('SELECT id,nome,usuario,senha FROM representante ORDER BY nome ASC');
            $getRepresentantes->execute();
            return $getRepresentantes->fetchAll(PDO::FETCH_ASSOC);
        }

        function getRepresentante($id){
            $getRepresentante =  $this->connection->prepare('SELECT id,nome,usuario FROM representante WHERE id = :id ORDER BY nome ASC');
            $getRepresentante->execute([
                ':id' => $id,
            ]);
            return $getRepresentante->fetch(PDO::FETCH_ASSOC);
        }

        function salvarRepresentante($id){ 
            if (!empty($this->senha)) {
                $stmt = $this->connection->prepare('UPDATE representante SET nome = :nome, usuario = :usuario, senha = :senha WHERE id = :id');
                $stmt->execute([
                  ':id'   => $id,
                  ':nome' => $this->nome,
                  ':usuario' => $this->usuario,
                  ':senha' => md5($this->senha)
                ]);
            } else {
                $stmt = $this->connection->prepare('UPDATE representante SET nome = :nome, usuario = :usuario WHERE id = :id');
                $stmt->execute([
                  ':id'   => $id,
                  ':nome' => $this->nome,
                  ':usuario' => $this->usuario
                ]);
            }
        }

        function excluir(){
            $stmt = $this->connection->prepare('DELETE FROM representante where id = :id');
            $stmt->execute([
              ':id' => $this->id,
            ]);
        }
    }
?>