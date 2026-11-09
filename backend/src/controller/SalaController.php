<?php
    class SalaController{
        function getSalas(){
            $salas = new Sala();
            return $salas->getSalas();
        }

        function getSala($data){
            $id = is_array($data) ? (isset($data['id']) ? $data['id'] : (isset($data['sala']) ? $data['sala'] : null)) : $data;
            $sala = new Sala();
            return $sala->getSala($id);
        }

        function criarSala($post){
            $sala = new Sala();
            $sala->nome = $post['nome'];
            $id = $sala->criar();
            return ["access" => true, "message" => "Salvo com sucesso!", "id" => $id];
        }

        function buscarSala($post){
            $id = isset($post['sala']) ? $post['sala'] : (isset($post['id']) ? $post['id'] : null);
            return $this->getSala($id);
        }

        function salvarSala($post){
            $sala = new Sala();
            $sala->nome = $post['nome'];
            $sala->salvar($post['id']);
            return ["access" => true, "message" => "Atualizado com sucesso!"];
        }

        function excluirSala($post){
            $sala = new Sala();
            $sala->id = $post['id'];
            $sala->excluir();
            return ["access" => true, "message" => "Excluído com sucesso!"];
        }
    }
?>