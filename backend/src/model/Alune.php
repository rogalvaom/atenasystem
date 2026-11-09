<?php
    class Alune extends Model{
        protected $table = 'alune';
        public $id;
        public $nome;
        public $sala;

        function criar(){
            $stmt = $this->connection->prepare('INSERT INTO alune (nome, cod_sala) VALUES(:nome, :cod_sala)');
            $stmt->execute([
                ':nome' => $this->nome,
                ':cod_sala' => $this->sala,
            ]);
            return $this->connection->lastInsertId();
        }

        function getAlunes(){
            $getAlunes =  $this->connection->prepare('SELECT id,nome,cod_sala FROM alune ORDER BY nome ASC');
            $getAlunes->execute();
            return $getAlunes->fetchAll(PDO::FETCH_ASSOC);
        }

        function getAlunesSala(){
            $getAlunes =  $this->connection->prepare('SELECT id,nome FROM alune WHERE cod_sala = :cod_sala ORDER BY nome ASC');
            $getAlunes->execute([
                ':cod_sala' => $this->sala
            ]);
            return $getAlunes->fetchAll(PDO::FETCH_ASSOC);
        }

        function getAlune($id){
            $getAlune =  $this->connection->prepare('SELECT id,nome,cod_sala FROM alune WHERE id = :id ');
            $getAlune->execute([
                ':id' => $id,
            ]);
            return $getAlune->fetch(PDO::FETCH_ASSOC);
        }

        function salvar($id){
            $stmt = $this->connection->prepare('UPDATE alune SET nome = :nome, cod_sala = :cod_sala WHERE id = :id');
            $stmt->execute(array(
              ':id'   => $id,
              ':nome' => $this->nome,
              ':cod_sala' => $this->sala
            ));
        }

        function excluir(){
            $stmt = $this->connection->prepare('DELETE FROM alune where id = :id');
            $stmt->execute([
              ':id' => $this->id,
            ]);
        }
    }
?>