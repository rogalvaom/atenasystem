<?php
    class RepresentanteController{
        function getRepresentantes(){
            $representantes = new Representante();
            return $representantes->getRepresentantes();
        }

        function getRepresentante($data){
            $id = is_array($data) ? (isset($data['id']) ? $data['id'] : (isset($data['representante']) ? $data['representante'] : null)) : $data;
            if (!$id && isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            $representante = new Representante();
            return $representante->getRepresentante($id);
        }

        function buscarRepresentante($post){
            $id = isset($post['representante']) ? $post['representante'] : (isset($post['id']) ? $post['id'] : null);
            return $this->getRepresentante($id);
        }

        function criarRepresentante($post){
            $representante = new Representante();
            $representante->nome = $post['nome'] ?? '';
            $representante->usuario = $post['usuario'] ?? '';
            $representante->senha = $post['senha'] ?? '';
            $id = $representante->criarRepresentante();
            if(isset($_FILES['assinatura']) && !empty($_FILES['assinatura']['tmp_name'])){
                $dest = $_SERVER['PROJECT_ROOT'] . '/public/assinatura/' . $id . '.png';
                move_uploaded_file($_FILES['assinatura']['tmp_name'], $dest);
            }
            return ["access" => true, "message" => "Salvo com sucesso!", "id" => $id];
        }

        function salvarRepresentante($post){
            $representante = new Representante();
            $representante->nome = $post['nome'] ?? '';
            $representante->usuario = $post['usuario'] ?? '';
            $representante->senha = $post['senha'] ?? '';
            $id = $post['id'] ?? null;
            $representante->salvarRepresentante($id);
            if(isset($_FILES['assinatura']) && !empty($_FILES['assinatura']['tmp_name'])){
                $dest = $_SERVER['PROJECT_ROOT'] . '/public/assinatura/' . $id . '.png';
                move_uploaded_file($_FILES['assinatura']['tmp_name'], $dest);
            }
            return ["access" => true, "message" => "Atualizado com sucesso!"];
        }

        function excluirRepresentante($post){
            $representante = new Representante();
            $representante->id = $post['id'] ?? null;
            $representante->excluir();
            return ["access" => true, "message" => "Excluído com sucesso!"];
        }
    }
?>