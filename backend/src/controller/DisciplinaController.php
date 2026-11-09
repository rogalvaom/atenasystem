<?php
    class DisciplinaController{
        function getDisciplinas(){
            $disciplinas = new Disciplina();
            return $disciplinas->getDisciplinas();
        }

        function getDisciplina($data){
            $id = is_array($data) ? (isset($data['id']) ? $data['id'] : (isset($data['disciplina']) ? $data['disciplina'] : null)) : $data;
            if (!$id && isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            $disciplina = new Disciplina();
            return $disciplina->getDisciplina($id);
        }

        function buscarDisciplina($post){
            $id = isset($post['disciplina']) ? $post['disciplina'] : (isset($post['id']) ? $post['id'] : null);
            return $this->getDisciplina($id);
        }

        function criarDisciplina($post){
            $disciplina = new Disciplina();
            $disciplina->nome = $post['nome'] ?? '';
            $id = $disciplina->criar();
            return ["access" => true, "message" => "Salvo com sucesso!", "id" => $id];
        }

        function salvarDisciplina($post){
            $disciplina = new Disciplina();
            $disciplina->nome = $post['nome'] ?? '';
            $disciplina->salvar($post['id'] ?? null);
            return ["access" => true, "message" => "Atualizado com sucesso!"];
        }

        function excluirDisciplina($post){
            $disciplina = new Disciplina();
            $disciplina->id = $post['id'] ?? null;
            $disciplina->excluir();
            return ["access" => true, "message" => "Excluído com sucesso!"];
        }
    }
?>