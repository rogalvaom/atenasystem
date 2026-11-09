<?php
    class AluneController{
        function getAlunes(){
            $alunes = new Alune();
            return $alunes->getAlunes();
        }

        function getAlune($data){
            $id = is_array($data) ? (isset($data['id']) ? $data['id'] : (isset($data['alune']) ? $data['alune'] : null)) : $data;
            if (!$id && isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            $alune = new Alune();
            return $alune->getAlune($id);
        }

        function getAlunesSala($data = null){
            $sala = is_array($data) ? (isset($data['sala']) ? $data['sala'] : (isset($data['cod_sala']) ? $data['cod_sala'] : null)) : $data;
            if (!$sala && isset($_GET['sala'])) {
                $sala = $_GET['sala'];
            }
            $alunes = new Alune();
            $alunes->sala = $sala;
            return $alunes->getAlunesSala();
        }

        function criarAlune($post){
            $alune = new Alune();
            $alune->nome = $post['nome'] ?? '';
            $alune->sala = $post['sala'] ?? null;
            $id = $alune->criar();
            return ["access" => true, "message" => "Salvo com sucesso!", "id" => $id];
        }

        function buscarAlune($post){
            $id = isset($post['alune']) ? $post['alune'] : (isset($post['id']) ? $post['id'] : null);
            return $this->getAlune($id);
        }

        function salvarAlune($post){
            $alune = new Alune();
            $alune->nome = $post['nome'] ?? '';
            $alune->sala = $post['sala'] ?? null;
            $alune->salvar($post['id'] ?? null);
            return ["access" => true, "message" => "Atualizado com sucesso!"];
        }

        function excluirAlune($post){
            $id = $post['id'] ?? null;
            $PresencaController = new PresencaController();
            $PresencaController->deletaPresencaAlune($id);
            $alune = new Alune();
            $alune->id = $id;
            $alune->excluir();
            return ["access" => true, "message" => "Excluído com sucesso!"];
        }
    }
?>