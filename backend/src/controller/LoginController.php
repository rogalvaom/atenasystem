<?php
class LoginController{
    function login($post){
        $usuario = $post['usuario'];
        $senha = $post['senha'];
        $validado = false;

        $RepresentanteController = new RepresentanteController();
        $representates = $RepresentanteController->getRepresentantes();

        foreach($representates as $representate){
            if($usuario == $representate['usuario'] && $senha == $representate['senha']){
                $usuarioValidado = $representate['usuario'];
                $modoValidado = 'representate';
                $validado = true;
            }
        }

        $ComissaoController = new ComissaoController();
        $comissoes = $ComissaoController->getComissoes();
        foreach($comissoes as $comissao){
            if($usuario == $comissao['usuario'] && $senha == $comissao['senha']){
                $usuarioValidado = $comissao['usuario'];
                $modoValidado = 'comissao';
                $validado = true;
            }
        }

        $MonitoreController = new MonitoreController();
        $monitores = $MonitoreController->getMonitores();
        foreach($monitores as $monitore){
            if($usuario == $monitore['usuario'] && $senha == $monitore['senha']){
                $usuarioValidado = $monitore['usuario'];
                $modoValidado = 'monitore';
                $validado = true;
            }
        }

        if($validado){
            if(!isset($_SESSION)) {
                session_start();
            }
            
            $_SESSION['usuario'] =  $usuarioValidado;
            $_SESSION['modo'] = $modoValidado;
            echo json_encode([
                "access" => true,
                "message" => "Login realizado com sucesso!"
            ]);
        }else{
            echo json_encode([
                "access" => false,
                "message" => "Usuário ou senha incorretos."
            ]);
        }
    }

    function logout(){
        if(!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['usuario'] = "";
        $_SESSION['modo'] = "";
        session_destroy();
        echo json_encode([
            "access" => true,
            "message" => "Logout realizado com sucesso!"
        ]);
    }

    function getSession(){
        $modo = isset($_SESSION['modo']) ? $_SESSION['modo'] : null;
        $modulos = [];

        if ($modo) {
            // Definição das features e seus modos permitidos (equivalente ao permissions.js)
            $features = [
                ['id' => 'home', 'modes' => ['representate', 'monitore', 'comissao']],
                ['id' => 'representante', 'modes' => ['representate']],
                ['id' => 'comissao', 'modes' => ['representate']],
                ['id' => 'monitore', 'modes' => ['representate']],
                ['id' => 'tutore', 'modes' => ['representate', 'monitore']],
                ['id' => 'tutore-justificar', 'modes' => ['representate', 'comissao']],
                ['id' => 'tutore-presenca', 'modes' => ['representate', 'monitore']],
                ['id' => 'alune', 'modes' => ['representate', 'monitore']],
                ['id' => 'alune-justificar', 'modes' => ['representate', 'monitore']],
                ['id' => 'disciplina', 'modes' => ['representate', 'monitore']],
                ['id' => 'sala', 'modes' => ['representate', 'monitore']],
                ['id' => 'presenca-alune', 'modes' => ['representate', 'monitore']],
                ['id' => 'presenca-tutore', 'modes' => ['representate', 'monitore']],
                ['id' => 'presenca-monitore', 'modes' => ['representate']],
                ['id' => 'presenca-reuniao', 'modes' => ['representate', 'comissao']],
                ['id' => 'certificado-monitore', 'modes' => ['representate', 'monitore']],
                ['id' => 'certificado-tutore', 'modes' => ['representate', 'monitore']],
                ['id' => 'relatorio-alune', 'modes' => ['representate', 'monitore']],
                ['id' => 'relatorio-tutore', 'modes' => ['representate', 'monitore']],
                ['id' => 'relatorio-monitore', 'modes' => ['representate']],
                ['id' => 'relatorio-reuniao', 'modes' => ['representate', 'comissao']]
            ];

            foreach ($features as $feature) {
                if (in_array($modo, $feature['modes'])) {
                    $modulos[] = $feature['id'];
                }
            }
        }

        return [
            "logged" => !empty($_SESSION['usuario']),
            "usuario" => isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null,
            "modo" => $modo,
            "modulos" => $modulos
        ];
    }
}
?>