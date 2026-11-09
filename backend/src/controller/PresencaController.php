<?php
    class PresencaController{
        function buscarSalaAluneJustifica($post){
            $id = isset($post['sala']) ? $post['sala'] : null;
            return ["access" => true, "sala" => $id];
        }

        function buscarPresencaAlune($post){
            $presenca = new Presenca();
            $presenca->cod_alune = $post['alune'] ?? 0;
            $presenca->cod_sala = $post['sala'] ?? 0;
            $presenca->aula = $post['aula'] ?? 0;
            $presenca->data = $post['data'] ?? '';
            $presente = $presenca->verificarPresenca();
            $val = (!empty($presente) && isset($presente[0]['presente'])) ? $presente[0]['presente'] : null;
            return ["access" => true, "presente" => $val, "data" => $presente];
        }

        function justificarPresencaAlune($post){
            $presenca = new Presenca();
            $presenca->cod_alune = $post['alune'] ?? 0;
            $presenca->cod_sala = $post['sala'] ?? 0;
            $presenca->aula = $post['aula'] ?? 0;
            $presenca->data =  $post['data'] ?? '';
            $presenca->presente =  $post['presente'] ?? '';
            $presenca->justificarPresenca();
            return ["access" => true, "message" => "Presença atualizada com sucesso!"];
        }

        function buscarPresencaReuniao($post){
            $presenca = new Presenca();
            $presenca->cod_tutore = $post['tutore'] ?? 0;
            $presenca->data = $post['data'] ?? '';
            $presente = $presenca->verificarPresenca();
            $val = (!empty($presente) && isset($presente[0]['presente'])) ? $presente[0]['presente'] : null;
            return ["access" => true, "presente" => $val, "data" => $presente];
        }

        function justificarPresencaReuniao($post){
            $presenca = new Presenca();
            $presenca->cod_tutore = $post['tutore'] ?? 0;
            $presenca->data =  $post['data'] ?? '';
            $presenca->presente =  $post['presente'] ?? '';
            $presenca->justificarPresenca();
            return ["access" => true, "message" => "Presença justificada com sucesso!"];
        }

        function buscarPresencaMonitore($post){
            $presenca = new Presenca();
            $presenca->cod_monitore = $post['monitore'] ?? 0;
            $presenca->cod_sala = $post['sala'] ?? 0;
            $presenca->data = $post['data'] ?? '';
            $presente = $presenca->verificarPresenca();
            $val = (!empty($presente) && isset($presente[0]['presente'])) ? $presente[0]['presente'] : null;
            return ["access" => true, "presente" => $val, "data" => $presente];
        }

        function editarPresencaMonitore($post){
            $presenca = new Presenca();
            $presenca->cod_monitore = $post['monitore'] ?? 0;
            $presenca->cod_sala = $post['sala'] ?? 0;
            $presenca->data =  $post['data'] ?? '';
            $presenca->presente =  $post['presente'] ?? '';
            $presenca->justificarPresenca();
            return ["access" => true, "message" => "Presença atualizada com sucesso!"];
        }

        function buscarPresencaTutore($post){
            $presenca = new Presenca();
            $presenca->cod_tutore = $post['tutore'] ?? 0;
            $presenca->cod_sala = $post['sala'] ?? 0;
            $presenca->aula = $post['aula'] ?? 0;
            $presenca->data = $post['data'] ?? '';
            $presente = $presenca->verificarPresenca();
            $val = (!empty($presente) && isset($presente[0]['presente'])) ? $presente[0]['presente'] : null;
            return ["access" => true, "presente" => $val, "data" => $presente];
        }

        function editarPresencaTutore($post){
            $presenca = new Presenca();
            $presenca->cod_tutore = $post['tutore'] ?? 0;
            $presenca->cod_sala = $post['sala'] ?? 0;
            $presenca->data =  $post['data'] ?? '';
            $presenca->aula = $post['aula'] ?? 0;
            $presenca->presente =  $post['presente'] ?? '';
            $presenca->justificarPresenca();
            return ["access" => true, "message" => "Presença atualizada com sucesso!"];
        }

        function buscarSalaAlune($post){
            $id = $post['sala'];
            header('Location: ../presenca_cadastro_alune.php?sala='.$id);
        }

        function criarPresencaAlune($post){
            $AluneController = new AluneController();
            $alunes = $AluneController->getAlunesSala($post['sala']);
            $presente = isset($post['presente']) ? $post['presente'] : [] ;
            $erroAlune = 0;
            foreach($alunes as $alune){
                if(in_array($alune['id'], $presente)){
                    $presenca = new Presenca();
                    $presenca->cod_alune = $alune['id'];
                    $presenca->cod_sala = $post['sala'];
                    $presenca->aula = $post['aula'];
                    $presenca->presente = 'S';
                    $presenca->data = $post['data'];
                    $verificarPresenca = $presenca->verificarPresenca();
                    if(count($verificarPresenca) > 0){
                        $erroAlune++;
                    }else{
                        $presenca->criarPresenca(); 
                    }
                }else{
                    $presenca = new Presenca();
                    $presenca->cod_alune = $alune['id'];
                    $presenca->cod_sala = $post['sala'];
                    $presenca->aula = $post['aula'];
                    $presenca->presente = 'N';
                    $presenca->data = $post['data'];
                    $verificarPresenca = $presenca->verificarPresenca();
                    if(count($verificarPresenca) > 0){
                        $erroAlune++;
                    }else{
                        $presenca->criarPresenca(); 
                    }
                }
            }
            if($erroAlune > 0){
                return ["access" => false, "message" => "Algumas presenças já estavam registradas."];
            }else{
                return ["access" => true, "message" => "Presença cadastrada com sucesso!"];
            }
        }

        function criarPresencaTutore($post){
            $presenca = new Presenca();
            $presenca->cod_tutore = $post['tutore'];
            $presenca->cod_sala = $post['sala'];
            $presenca->aula = $post['aula'];
            $presenca->presente = 'S';
            $presenca->data = $post['data'];
            $verificarPresenca = $presenca->verificarPresencaTutore();
            if(count($verificarPresenca) > 0){
                return ["access" => false, "message" => "Presença já cadastrada!"];
            }else{
                $presenca->criarPresenca();
                return ["access" => true, "message" => "Presença cadastrada com sucesso!"];
            }
        }

        function criarPresencaMonitore($post){
            $presenca = new Presenca();
            $presenca->cod_monitore = $post['monitore'];
            $presenca->cod_sala = $post['sala'];
            $presenca->presente = 'S';
            $presenca->data = $post['data'];
            $verificarPresenca = $presenca->verificarPresencaMonitore();
            if(count($verificarPresenca) > 0){
                return ["access" => false, "message" => "Presença já cadastrada!"];
            }else{
                $presenca->criarPresenca();
                return ["access" => true, "message" => "Presença cadastrada com sucesso!"];
            }
        }

        function criarPresencaReuniao($post){
            $TutoreController = new TutoreController();
            $tutores = $TutoreController->getTutores();
            $presente = isset($post['presente']) ? $post['presente'] : [] ;
            $erroTutore = 0;
            foreach($tutores as $tutore){
                if(in_array($tutore['id'], $presente)){
                    $presenca = new Presenca();
                    $presenca->cod_tutore = $tutore['id'];
                    $presenca->presente = 'S';
                    $presenca->data = $post['data'];
                    $verificarPresenca = $presenca->verificarPresenca();
                    if(count($verificarPresenca) > 0){
                        $erroTutore++;
                    }else{
                        $presenca->criarPresenca(); 
                    }
                }else{
                    $presenca = new Presenca();
                    $presenca->cod_tutore = $tutore['id'];
                    $presenca->presente = 'N';
                    $presenca->data = $post['data'];
                    $verificarPresenca = $presenca->verificarPresenca();
                    if(count($verificarPresenca) > 0){
                        $erroTutore++;
                    }else{
                        $presenca->criarPresenca(); 
                    }
                }
            }
            if($erroTutore > 0){
                return ["access" => false, "message" => "Algumas presenças já estavam cadastradas."];
            }else{
                return ["access" => true, "message" => "Presença cadastrada com sucesso!"];
            }
        }

        function relatorioPresencaAlune($post){
            $cod_sala = $post['cod_sala'] ?? 0;
            $data_inicial = $post['data_inicial'] ?? '';
            $data_final = $post['data_final'] ?? '';
            $AluneController = new AluneController();
            $alunes = $AluneController->getAlunesSala($cod_sala);
            $resultado = [];
            if (is_array($alunes)) {
                foreach($alunes as $alune){
                    $presencas = count($this->getPresencaPeriodo($cod_sala, $alune['id'], 0, 0, $data_inicial, $data_final));
                    $ausencias = count($this->getAusenciaPeriodo($cod_sala, $alune['id'], 0, 0, $data_inicial, $data_final));
                    $justificado = count($this->getJustificadoPeriodo($cod_sala, $alune['id'], 0, 0, $data_inicial, $data_final));
                    $total = $presencas + $ausencias + $justificado;
                    $resultado[] = [
                        "nome" => $alune['nome'],
                        "presencas" => $presencas,
                        "ausencias" => $ausencias,
                        "justificado" => $justificado,
                        "total" => $total
                    ];
                }
            }
            return $resultado;
        }

        function relatorioPresencaReuniao($post){
            $data_inicial = $post['data_inicial'] ?? '';
            $data_final = $post['data_final'] ?? '';
            $TutoreController = new TutoreController();
            $tutores = $TutoreController->getTutores();
            $resultado = [];
            if (is_array($tutores)) {
                foreach($tutores as $tutore){
                    $presencas = count($this->getPresencaPeriodo(0, 0, 0, $tutore['id'], $data_inicial, $data_final));
                    $ausencias = count($this->getAusenciaPeriodo(0, 0, 0, $tutore['id'], $data_inicial, $data_final));
                    $justificadas = count($this->getJustificadoPeriodo(0, 0, 0, $tutore['id'], $data_inicial, $data_final));
                    $resultado[] = [
                        "nome" => $tutore['nome'],
                        "presencas" => $presencas,
                        "ausencias" => $ausencias,
                        "justificadas" => $justificadas
                    ];
                }
            }
            return $resultado;
        }

        function relatorioPresencaMonitore($post){
            $cod_sala = $post['cod_sala'] ?? 0;
            $data_inicial = $post['data_inicial'] ?? '';
            $data_final = $post['data_final'] ?? '';
            $MonitoreController = new MonitoreController();
            $monitores = $MonitoreController->getMonitores();
            $resultado = [];
            if (is_array($monitores)) {
                foreach($monitores as $monitore){
                    $presencas = count($this->getPresencaPeriodo($cod_sala, 0, $monitore['id'], 0, $data_inicial, $data_final));
                    $resultado[] = [
                        "nome" => $monitore['nome'],
                        "presencas" => $presencas
                    ];
                }
            }
            return $resultado;
        }
        
        function relatorioPresencaTutore($post){
            $cod_sala = $post['cod_sala'] ?? 0;
            $data_inicial = $post['data_inicial'] ?? '';
            $data_final = $post['data_final'] ?? '';
            $TutoreController = new TutoreController();
            $tutores = $TutoreController->getTutores();
            $resultado = [];
            if (is_array($tutores)) {
                foreach($tutores as $tutore){
                    $presencas = count($this->getPresencaPeriodo($cod_sala, 0, 0, $tutore['id'], $data_inicial, $data_final));
                    $resultado[] = [
                        "nome" => $tutore['nome'],
                        "presencas" => $presencas
                    ];
                }
            }
            return $resultado;
        }
        
        function getPresenca(){
            $presenca = new Presenca();
            return $presenca->getPresenca();
        }

        function getPresencaMonitore($cod_monitore, $data_inicial, $data_final){
            $presenca = new Presenca();
            $presenca->cod_monitore = $cod_monitore;
            $presenca->data = $data_inicial;
            $presenca->data_final = $data_final;
            return $presenca->getPresencaMonitore();
        }

        function getPresencaPeriodo($cod_sala, $cod_alune, $cod_monitore, $cod_tutore, $data_inicial, $data_final){
            $presenca = new Presenca();
            $presenca->cod_sala = $cod_sala ;
            $presenca->cod_monitore = $cod_monitore ;
            $presenca->cod_tutore = $cod_tutore ;
            $presenca->cod_alune = $cod_alune ;
            $presenca->data = $data_inicial ;
            $presenca->data_final = $data_final ;
            return $presenca->getPresencaPeriodo();
        }

        function getAusenciaPeriodo($cod_sala, $cod_alune, $cod_monitore, $cod_tutore, $data_inicial, $data_final){
            $presenca = new Presenca();
            $presenca->cod_sala = $cod_sala ;
            $presenca->cod_monitore = $cod_monitore ;
            $presenca->cod_tutore = $cod_tutore ;
            $presenca->cod_alune = $cod_alune ;
            $presenca->data = $data_inicial ;
            $presenca->data_final = $data_final ;
            return $presenca->getAusenciaPeriodo();
        }

        function getJustificadoPeriodo($cod_sala, $cod_alune, $cod_monitore, $cod_tutore, $data_inicial, $data_final){
            $presenca = new Presenca();
            $presenca->cod_sala = $cod_sala ;
            $presenca->cod_monitore = $cod_monitore ;
            $presenca->cod_tutore = $cod_tutore ;
            $presenca->cod_alune = $cod_alune ;
            $presenca->data = $data_inicial ;
            $presenca->data_final = $data_final ;
            return $presenca->getJustificadoPeriodo();
        }

        function deletaPresencaAlune($cod_alune){
            $presenca = new Presenca();
            $presenca->cod_alune = $cod_alune;
            return $presenca->deletaPresencaAlune();
        }

    }
?>