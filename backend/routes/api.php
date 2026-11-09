<?php
    $api = [
        // [METODO, ENDPOINT, CONTROLLER, FUNCTION]
        
        // Autenticação
        ['POST', '/login', 'LoginController', 'login'],
        ['POST', '/logout', 'LoginController', 'logout'],
        ['GET', '/session', 'LoginController', 'getSession'],

        // Alune
        ['GET', '/alunes', 'AluneController', 'getAlunes'],
        ['GET', '/alune', 'AluneController', 'getAlune'],
        ['GET', '/alune/sala', 'AluneController', 'getAlunesSala'],
        ['POST', '/alune', 'AluneController', 'criarAlune'],
        ['POST', '/alune/buscar', 'AluneController', 'buscarAlune'],
        ['POST', '/alune/salvar', 'AluneController', 'salvarAlune'],
        ['POST', '/alune/excluir', 'AluneController', 'excluirAlune'],

        // Comissao
        ['GET', '/comissoes', 'ComissaoController', 'getComissoes'],
        ['GET', '/comissao', 'ComissaoController', 'getComissao'],
        ['POST', '/comissao', 'ComissaoController', 'criarComissao'],
        ['POST', '/comissao/buscar', 'ComissaoController', 'buscarComissao'],
        ['POST', '/comissao/salvar', 'ComissaoController', 'salvarComissao'],
        ['POST', '/comissao/excluir', 'ComissaoController', 'excluirComissao'],

        // Disciplina
        ['GET', '/disciplinas', 'DisciplinaController', 'getDisciplinas'],
        ['GET', '/disciplina', 'DisciplinaController', 'getDisciplina'],
        ['POST', '/disciplina', 'DisciplinaController', 'criarDisciplina'],
        ['POST', '/disciplina/buscar', 'DisciplinaController', 'buscarDisciplina'],
        ['POST', '/disciplina/salvar', 'DisciplinaController', 'salvarDisciplina'],
        ['POST', '/disciplina/excluir', 'DisciplinaController', 'excluirDisciplina'],

        // Monitore
        ['GET', '/monitores', 'MonitoreController', 'getMonitores'],
        ['GET', '/monitore', 'MonitoreController', 'getMonitore'],
        ['POST', '/monitore', 'MonitoreController', 'criarMonitore'],
        ['POST', '/monitore/buscar', 'MonitoreController', 'buscarMonitore'],
        ['POST', '/monitore/salvar', 'MonitoreController', 'salvarMonitore'],
        ['POST', '/monitore/excluir', 'MonitoreController', 'excluirMonitore'],

        // Representante
        ['GET', '/representantes', 'RepresentanteController', 'getRepresentantes'],
        ['GET', '/representante', 'RepresentanteController', 'getRepresentante'],
        ['POST', '/representante', 'RepresentanteController', 'criarRepresentante'],
        ['POST', '/representante/buscar', 'RepresentanteController', 'buscarRepresentante'],
        ['POST', '/representante/salvar', 'RepresentanteController', 'salvarRepresentante'],
        ['POST', '/representante/excluir', 'RepresentanteController', 'excluirRepresentante'],

        // Sala
        ['GET', '/salas', 'SalaController', 'getSalas'],
        ['GET', '/sala', 'SalaController', 'getSala'],
        ['POST', '/sala', 'SalaController', 'criarSala'],
        ['POST', '/sala/buscar', 'SalaController', 'buscarSala'],
        ['POST', '/sala/salvar', 'SalaController', 'salvarSala'],
        ['POST', '/sala/excluir', 'SalaController', 'excluirSala'],

        // Tutore
        ['GET', '/tutores', 'TutoreController', 'getTutores'],
        ['GET', '/tutore', 'TutoreController', 'getTutore'],
        ['POST', '/tutore', 'TutoreController', 'criarTutore'],
        ['POST', '/tutore/buscar', 'TutoreController', 'buscarTutore'],
        ['POST', '/tutore/salvar', 'TutoreController', 'salvarTutore'],
        ['POST', '/tutore/excluir', 'TutoreController', 'excluirTutore'],

        // Presenca
        ['GET', '/presenca', 'PresencaController', 'getPresenca'],
        ['POST', '/presenca/alune', 'PresencaController', 'criarPresencaAlune'],
        ['POST', '/presenca/tutore', 'PresencaController', 'criarPresencaTutore'],
        ['POST', '/presenca/monitore', 'PresencaController', 'criarPresencaMonitore'],
        ['POST', '/presenca/reuniao', 'PresencaController', 'criarPresencaReuniao'],
        ['POST', '/presenca/alune/buscar', 'PresencaController', 'buscarPresencaAlune'],
        ['POST', '/presenca/alune/justificar', 'PresencaController', 'justificarPresencaAlune'],
        ['POST', '/presenca/reuniao/buscar', 'PresencaController', 'buscarPresencaReuniao'],
        ['POST', '/presenca/reuniao/justificar', 'PresencaController', 'justificarPresencaReuniao'],
        ['POST', '/presenca/monitore/buscar', 'PresencaController', 'buscarPresencaMonitore'],
        ['POST', '/presenca/monitore/editar', 'PresencaController', 'editarPresencaMonitore'],
        ['POST', '/presenca/tutore/buscar', 'PresencaController', 'buscarPresencaTutore'],
        ['POST', '/presenca/tutore/editar', 'PresencaController', 'editarPresencaTutore'],
        ['POST', '/presenca/sala-alune/buscar', 'PresencaController', 'buscarSalaAlune'],
        ['POST', '/presenca/sala-alune-justifica/buscar', 'PresencaController', 'buscarSalaAluneJustifica'],
        ['POST', '/presenca/relatorio/alune', 'PresencaController', 'relatorioPresencaAlune'],
        ['POST', '/presenca/relatorio/reuniao', 'PresencaController', 'relatorioPresencaReuniao'],
        ['POST', '/presenca/relatorio/monitore', 'PresencaController', 'relatorioPresencaMonitore'],
        ['POST', '/presenca/relatorio/tutore', 'PresencaController', 'relatorioPresencaTutore'],

        // Certificados
        ['POST', '/certificado/tutore', 'CertificadoController', 'certificadoTutore'],
        ['POST', '/certificado/monitore', 'CertificadoController', 'certificadoMonitore'],
        ['GET', '/certificado/tutores', 'CertificadoController', 'certificadoGetTutores'],
        ['POST', '/certificado/tutore/buscar', 'CertificadoController', 'certificadoGetTutore'],
        ['GET', '/certificado/monitores', 'CertificadoController', 'certificadoGetMonitores'],
        ['POST', '/certificado/monitore/buscar', 'CertificadoController', 'certificadoGetMonitore'],
        ['GET', '/certificado/representantes', 'CertificadoController', 'certificadoGetRepresentantes'],
        ['POST', '/certificado/representante/buscar', 'CertificadoController', 'certificadoGetRepresentante'],
    ];
