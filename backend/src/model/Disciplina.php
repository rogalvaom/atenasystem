<?php
    class Disciplina extends Model{
        protected $table = 'disciplina';
        public $nome;
        public $disciplina;
        public $id;

        function criar(){
            $stmt = $this->connection->prepare('INSERT INTO disciplina (nome) VALUES(:nome)');
            $stmt->execute([
                ':nome' => $this->nome
            ]);
            return $this->connection->lastInsertId();
        }

        function getDisciplinas(){
            $getDisciplina =  $this->connection->prepare('SELECT id,nome FROM disciplina ORDER BY nome ASC');
            $getDisciplina->execute();
            return $getDisciplina->fetchAll(PDO::FETCH_ASSOC);
        }

        function getDisciplina($id){
            $getDisciplina =  $this->connection->prepare('SELECT id, nome FROM disciplina WHERE id = :id ORDER BY nome ASC');
            $getDisciplina->execute([
                ':id' => $id,
            ]);
            return $getDisciplina->fetch(PDO::FETCH_ASSOC);
        }

        function salvar($id){
            $stmt = $this->connection->prepare('UPDATE disciplina SET nome = :nome WHERE id = :id');
            $stmt->execute([
              ':id'   => $id,
              ':nome' => $this->nome,
            ]);
        }

        function excluir(){
            $stmt = $this->connection->prepare('DELETE FROM disciplina where id = :id');
            $stmt->execute([
              ':id' => $this->id,
            ]);
        }
    }
?>