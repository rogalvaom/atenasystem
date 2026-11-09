<?php
    class Utils{

        public $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro',
        ];

        public $dias_semana = [
            '1' => [
                'nome' => 'Domingo',
                'nome_ingles' => 'Sunday'
            ],
            '2' => [
                'nome' => 'Segunda-feira',
                'nome_ingles' => 'Monday'
            ],
            '3' => [
                'nome' => 'Terça-feira',
                'nome_ingles' => 'Tuesday'
            ],
            '4' => [
                'nome' => 'Quarta-feira',
                'nome_ingles' => 'Wednesday'
            ],
            '5' => [
                'nome' => 'Quinta-feira',
                'nome_ingles' => 'Thursday'
            ],
            '6' => [
                'nome' => 'Sexta-feira',
                'nome_ingles' => 'Friday'
            ],
            '7' => [
                'nome' => 'Sábado',
                'nome_ingles' => 'Saturday'
            ],
        ];

        function getMes($cod_mes){
            return $this->meses[$cod_mes];
        }

        function getCodDiaSemanaAtual(){
            $today = getdate();
            $weekday = $today['weekday'];
            foreach ($this->dias_semana as $cod => $dia) {
                if ($dia['nome_ingles'] == $weekday) {
                    return $cod;
                }
            }
        }

        function getNomeDiaSemana($cod_dia){
            return $this->dias_semana[$cod_dia]['nome'];
        }
    }
?>