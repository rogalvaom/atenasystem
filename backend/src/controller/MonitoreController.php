<?php
    class MonitoreController{
        function getMonitores(){
            $monitores = new Monitore();
            return $monitores->getMonitores();
        }

        function getMonitore($data){
            $id = is_array($data) ? (isset($data['id']) ? $data['id'] : (isset($data['monitore']) ? $data['monitore'] : null)) : $data;
            if (!$id && isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            $monitore = new Monitore();
            return $monitore->getMonitore($id);
        }

        function buscarMonitore($post){
            $id = isset($post['monitore']) ? $post['monitore'] : (isset($post['id']) ? $post['id'] : null);
            return $this->getMonitore($id);
        }

        function criarMonitore($post){
            $monitore = new Monitore();
            $monitore->nome = $post['nome'] ?? '';
            $monitore->usuario = $post['usuario'] ?? '';
            $monitore->senha = $post['senha'] ?? '';
            $id = $monitore->criarMonitore();
            return ["access" => true, "message" => "Salvo com sucesso!", "id" => $id];
        }

        function salvarMonitore($post){
            $monitore = new Monitore();
            $monitore->nome = $post['nome'] ?? '';
            $monitore->usuario = $post['usuario'] ?? '';
            $monitore->senha = $post['senha'] ?? '';
            $monitore->salvarMonitore($post['id'] ?? null);
            return ["access" => true, "message" => "Atualizado com sucesso!"];
        }

        function excluirMonitore($post){
            $monitore = new Monitore();
            $monitore->id = $post['id'] ?? null;
            $monitore->excluir();
            return ["access" => true, "message" => "Excluído com sucesso!"];
        }
    }
?>