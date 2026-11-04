<?php

$web = [
        // [ENDPOINT, VIEW (public/view)]

        // Raiz e Autenticação
        ['/', '/login/index.html'],
        ['/login', '/login/index.html'],

        // Home
        ['/home', '/home/index.html'],

        // Alune
        ['/alune', '/alune/index.html'],
        ['/alune/criar', '/alune/criar.html'],
        ['/alune/editar', '/alune/editar.html'],
        ['/alune/justificar', '/alune/justificar.html'],

        // Comissao
        ['/comissao', '/comissao/index.html'],
        ['/comissao/criar', '/comissao/criar.html'],
        ['/comissao/editar', '/comissao/editar.html'],

        // Disciplina
        ['/disciplina', '/disciplina/index.html'],
        ['/disciplina/criar', '/disciplina/criar.html'],
        ['/disciplina/editar', '/disciplina/editar.html'],

        // Monitore
        ['/monitore', '/monitore/index.html'],
        ['/monitore/criar', '/monitore/criar.html'],
        ['/monitore/editar', '/monitore/editar.html'],
        ['/monitore/presenca', '/monitore/editar_presenca.html'],

        // Presença
        ['/presenca', '/presenca/alune.html'],
        ['/presenca/alune', '/presenca/alune.html'],
        ['/presenca/monitore', '/presenca/monitore.html'],
        ['/presenca/reuniao', '/presenca/reuniao.html'],
        ['/presenca/tutore', '/presenca/tutore.html'],

        // Relatórios
        ['/relatorio', '/relatorio/alune.html'], 
        ['/relatorio/alune', '/relatorio/alune.html'], 
        ['/relatorio/monitore', '/relatorio/monitore.html'], 
        ['/relatorio/reuniao', '/relatorio/reuniao.html'], 
        ['/relatorio/tutore', '/relatorio/tutore.html'], 

        // Representante
        ['/representante', '/representante/index.html'],
        ['/representante/editar', '/representante/editar.html'],
        ['/representante/criar', '/representante/criar.html'],

        // Sala
        ['/sala', '/sala/index.html'],
        ['/sala/criar', '/sala/criar.html'],
        ['/sala/editar', '/sala/editar.html'],

        // Tutore
        ['/tutore', '/tutore/index.html'],
        ['/tutore/criar', '/tutore/criar.html'],
        ['/tutore/editar', '/tutore/editar.html'],
        ['/tutore/presenca', '/tutore/editar_presenca.html'],
        ['/tutore/justificar', '/tutore/justificar.html'],

        // Certificados
        ['/certificado', '/certificado/index.html'], 
        ['/certificado/tutore', '/certificado/tutore.html'],
    ];