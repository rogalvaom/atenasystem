<?php
    class TutoreController{
        function getTutores(){
            $tutores = new Tutore();
            return $tutores->getTutores();
        }

        function getTutore($data){
            $id = is_array($data) ? (isset($data['id']) ? $data['id'] : (isset($data['tutore']) ? $data['tutore'] : null)) : $data;
            if (!$id && isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            $tutore = new Tutore();
            return $tutore->getTutore($id);
        }

        function criarTutore($post){
            $tutore = new Tutore();
            $tutore->nome = $post['nome'] ?? '';
            $tutore->disciplina = $post['disciplina'] ?? null;
            $id = $tutore->criarTutore();
            return ["access" => true, "message" => "Salvo com sucesso!", "id" => $id];
        }

        function buscarTutore($post){
            $id = isset($post['tutore']) ? $post['tutore'] : (isset($post['id']) ? $post['id'] : null);
            return $this->getTutore($id);
        }

        function salvarTutore($post){
            $tutore = new Tutore();
            $tutore->nome = $post['nome'] ?? '';
            $tutore->disciplina = $post['disciplina'] ?? null;
            $tutore->salvar($post['id'] ?? null);
            return ["access" => true, "message" => "Atualizado com sucesso!"];
        }

        function excluirTutore($post){
            $tutore = new Tutore();
            $tutore->id = $post['id'] ?? null;
            $tutore->excluir();
            return ["access" => true, "message" => "Excluído com sucesso!"];
        }
    }
?>