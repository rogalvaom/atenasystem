<?php
    class Presenca extends Model{
        protected $table = 'presenca';
        public $cod_alune;
        public $cod_sala;
        public $cod_tutore;
        public $cod_monitore;
        public $aula;
        public $presente;
        public $data;
        public $data_final;

        function criarPresenca(){
            $stmt = $this->connection->prepare('
                INSERT INTO presenca (cod_alune, cod_sala, cod_tutore, cod_monitore, aula, presente, data)
                VALUES(:cod_alune, :cod_sala, :cod_tutore, :cod_monitore, :aula, :presente, :data)
            ');
            $stmt->execute([
                ':cod_sala' => isset($this->cod_sala) ? $this->cod_sala : 0,
                ':cod_monitore' => isset($this->cod_monitore) ? $this->cod_monitore : 0,
                ':cod_tutore' => isset($this->cod_tutore) ? $this->cod_tutore : 0,
                ':cod_alune' => isset($this->cod_alune) ? $this->cod_alune : 0,
                ':aula' => isset($this->aula) ? $this->aula : 0,
                ':presente' => $this->presente,
                ':data' => $this->data,
            ]);
        }

        function justificarPresenca(){
            $stmt = $this->connection->prepare('
                UPDATE presenca
                SET presente = :presente 
                WHERE 
                    cod_sala = :cod_sala 
                    AND cod_monitore = :cod_monitore 
                    AND cod_tutore = :cod_tutore 
                    AND cod_alune = :cod_alune
                    AND data = :data
                    AND aula = :aula
            ');
            $stmt->execute([
                ':cod_sala' => isset($this->cod_sala) ? $this->cod_sala : 0,
                ':cod_monitore' => isset($this->cod_monitore) ? $this->cod_monitore : 0,
                ':cod_tutore' => isset($this->cod_tutore) ? $this->cod_tutore : 0,
                ':cod_alune' => isset($this->cod_alune) ? $this->cod_alune : 0,
                ':aula' => isset($this->aula) ? $this->aula : 0,
                ':presente' => $this->presente,
                ':data' => $this->data,
            ]);
        }

        function getPresencaMonitore(){
            $getPresencaMonitore =  $this->connection->prepare('
                SELECT *
                FROM presenca
                WHERE 
                    cod_monitore = :cod_monitore
                    AND data BETWEEN :data AND :data_final 
                    AND presente = \'S\'
            ');
            $getPresencaMonitore->execute([
                ':cod_monitore' => $this->cod_monitore,
                ':data' => $this->data,
                ':data_final' => $this->data_final,
            ]);
            return $getPresencaMonitore->fetchAll(PDO::FETCH_ASSOC);
        } 

        function getPresencaPeriodo(){
            $getPresencaPeriodo =  $this->connection->prepare('
                SELECT *
                FROM presenca
                WHERE 
                    cod_sala = :cod_sala 
                    AND cod_monitore = :cod_monitore 
                    AND cod_tutore = :cod_tutore 
                    AND cod_alune = :cod_alune 
                    AND data BETWEEN :data AND :data_final 
                    AND presente = \'S\'
            ');
            $getPresencaPeriodo->execute([
                ':cod_sala' => $this->cod_sala,
                ':cod_monitore' => $this->cod_monitore,
                ':cod_tutore' => $this->cod_tutore,
                ':cod_alune' => $this->cod_alune,
                ':data' => $this->data,
                ':data_final' => $this->data_final,
            ]);
            return $getPresencaPeriodo->fetchAll(PDO::FETCH_ASSOC);
        } 

        function getAusenciaPeriodo(){
            $getAusenciaPeriodo =  $this->connection->prepare('
                SELECT *
                FROM presenca
                WHERE 
                    cod_sala = :cod_sala 
                    AND cod_monitore = :cod_monitore 
                    AND cod_tutore = :cod_tutore 
                    AND cod_alune = :cod_alune 
                    AND data BETWEEN :data AND :data_final 
                    AND presente = \'N\'
            ');
            $getAusenciaPeriodo->execute([
                ':cod_sala' => $this->cod_sala,
                ':cod_monitore' => $this->cod_monitore,
                ':cod_tutore' => $this->cod_tutore,
                ':cod_alune' => $this->cod_alune,
                ':data' => $this->data,
                ':data_final' => $this->data_final,
            ]);
            return $getAusenciaPeriodo->fetchAll(PDO::FETCH_ASSOC);
        } 
        
        function getJustificadoPeriodo(){
            $getJustificadoPeriodo =  $this->connection->prepare('
                SELECT *
                FROM presenca
                WHERE 
                    cod_sala = :cod_sala 
                    AND cod_monitore = :cod_monitore 
                    AND cod_tutore = :cod_tutore 
                    AND cod_alune = :cod_alune 
                    AND data BETWEEN :data AND :data_final 
                    AND presente = \'J\'
            ');
            $getJustificadoPeriodo->execute([
                ':cod_sala' => $this->cod_sala,
                ':cod_monitore' => $this->cod_monitore,
                ':cod_tutore' => $this->cod_tutore,
                ':cod_alune' => $this->cod_alune,
                ':data' => $this->data,
                ':data_final' => $this->data_final,
            ]);
            return $getJustificadoPeriodo->fetchAll(PDO::FETCH_ASSOC);
        }

        function verificarPresenca(){
            $verificarPresencaAlune =  $this->connection->prepare('
                SELECT * 
                FROM presenca 
                WHERE 
                    cod_sala = :cod_sala 
                    AND cod_monitore = :cod_monitore 
                    AND cod_tutore = :cod_tutore 
                    AND cod_alune = :cod_alune
                    AND data = :data
                    AND aula = :aula
            ');
            $verificarPresencaAlune->execute([
                ':cod_sala' => isset($this->cod_sala) ? $this->cod_sala : 0,
                ':cod_monitore' => isset($this->cod_monitore) ? $this->cod_monitore : 0,
                ':cod_tutore' => isset($this->cod_tutore) ? $this->cod_tutore : 0,
                ':cod_alune' => isset($this->cod_alune) ? $this->cod_alune : 0,
                ':aula' => isset($this->aula) ? $this->aula : 0,
                ':data' => $this->data,
            ]);
            return $verificarPresencaAlune->fetchAll(PDO::FETCH_ASSOC);
        } 

        function verificarPresencaMonitore(){
            $verificarPresencaMonitore =  $this->connection->prepare('
                SELECT * 
                FROM presenca 
                WHERE 
                    cod_sala = :cod_sala
                    AND data = :data
                    AND cod_monitore > 0
            ');
            $verificarPresencaMonitore->execute([
                ':cod_sala' => isset($this->cod_sala) ? $this->cod_sala : 0,
                ':data' => $this->data,
            ]);
            return $verificarPresencaMonitore->fetchAll(PDO::FETCH_ASSOC);
        } 

        function verificarPresencaTutore(){
            $verificarPresencaTutore =  $this->connection->prepare('
                SELECT * 
                FROM presenca 
                WHERE 
                    cod_sala = :cod_sala
                    AND data = :data
                    AND aula = :aula
                    AND cod_tutore > 0
            ');
            $verificarPresencaTutore->execute([
                ':cod_sala' => isset($this->cod_sala) ? $this->cod_sala : 0,
                ':aula' => isset($this->aula) ? $this->aula : 0,
                ':data' => $this->data,
            ]);
            return $verificarPresencaTutore->fetchAll(PDO::FETCH_ASSOC);
        } 

        function deletaPresencaAlune(){
            $stmt = $this->connection->prepare('DELETE FROM presenca where cod_alune = :cod_alune');
            $stmt->execute([
              ':cod_alune' => $this->cod_alune,
            ]);
        }
    }
?>