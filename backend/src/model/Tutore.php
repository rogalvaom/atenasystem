<?php
    class Tutore extends Model{
        protected $table = 'tutore';
        public $id;
        public $nome;
        public $disciplina;

        function criarTutore(){
            $stmt = $this->connection->prepare('INSERT INTO tutore (nome, cod_disciplina) VALUES(:nome, :cod_disciplina)');
            $stmt->execute([
                ':nome' => $this->nome,
                ':cod_disciplina' => $this->disciplina
            ]);
            return $this->connection->lastInsertId();
        }
        
        function getTutores(){
            $getTutores =  $this->connection->prepare('SELECT id,nome,cod_disciplina FROM tutore ORDER BY nome ASC');
            $getTutores->execute();
            return $getTutores->fetchAll(PDO::FETCH_ASSOC);
        }

        function getTutore($id){
            $getTutore =  $this->connection->prepare('
                SELECT tutore.id, tutore.nome, tutore.cod_disciplina, disciplina.nome as nome_disciplina
                FROM tutore 
                INNER JOIN disciplina 
                ON tutore.cod_disciplina = disciplina.id
                WHERE tutore.id = :id
            ');
            $getTutore->execute([
                ':id' => $id,
            ]);
            return $getTutore->fetch(PDO::FETCH_ASSOC);
        }


        function salvar($id){
            $stmt = $this->connection->prepare('UPDATE tutore SET nome = :nome, cod_disciplina = :cod_disciplina WHERE id = :id');
            $stmt->execute(array(
              ':id'   => $id,
              ':nome' => $this->nome,
              ':cod_disciplina' => $this->disciplina,
            ));
        }
        
        function excluir(){
            $stmt = $this->connection->prepare('DELETE FROM tutore where id = :id');
            $stmt->execute([
              ':id' => $this->id,
            ]);
        }
    }
?>