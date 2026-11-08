<?php
    class Monitore extends Model{
        protected $table = 'monitore';
        public $id;
        public $nome;
        public $usuario;
        public $senha;

        function criarMonitore(){
            $stmt = $this->connection->prepare('INSERT INTO monitore (nome, usuario, senha) VALUES(:nome, :usuario, :senha)');
            $stmt->execute([
                ':nome' => $this->nome,
                ':usuario' => $this->usuario,
                ':senha' => md5($this->senha)
            ]);
            return $this->connection->lastInsertId();
        }

        function getMonitores(){
            $getMonitores =  $this->connection->prepare('SELECT id,nome, usuario, senha FROM monitore ORDER BY nome ASC');
            $getMonitores->execute();
            return $getMonitores->fetchAll(PDO::FETCH_ASSOC);
        }

        function getMonitore($id){
            $getMonitore =  $this->connection->prepare('SELECT id,nome,usuario,senha FROM monitore WHERE id = :id ORDER BY nome ASC');
            $getMonitore->execute([
                ':id' => $id,
            ]);
            return $getMonitore->fetch(PDO::FETCH_ASSOC);
        }

        function salvarMonitore($id){
            if (!empty($this->senha)) {
                $stmt = $this->connection->prepare('UPDATE monitore SET nome = :nome, usuario = :usuario, senha = :senha WHERE id = :id');
                $stmt->execute([
                  ':id'   => $id,
                  ':nome' => $this->nome,
                  ':usuario' => $this->usuario,
                  ':senha' => md5($this->senha)
                ]);
            } else {
                $stmt = $this->connection->prepare('UPDATE monitore SET nome = :nome, usuario = :usuario WHERE id = :id');
                $stmt->execute([
                  ':id'   => $id,
                  ':nome' => $this->nome,
                  ':usuario' => $this->usuario
                ]);
            }
        }

        function excluir(){
            $stmt = $this->connection->prepare('DELETE FROM monitore where id = :id');
            $stmt->execute([
              ':id' => $this->id,
            ]);
        }
    }
?>