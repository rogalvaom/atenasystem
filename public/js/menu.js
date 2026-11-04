function loadMenu(activeRoute) {
    var session = apiGet('/session');
    if (!session || !session.logged) {
        window.location.assign('/login');
        return;
    }

    var modo = session.modo;
    var path = activeRoute || window.location.pathname.replace(/^\//, '').split('?')[0];

    var navbarHtml = `
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/home"><span style="color:orange">Atena</span>System</a>
            </div>
        </div>
    </nav>
    `;

    var isRep = modo === 'representate';
    var isMon = modo === 'monitore';
    var isCom = modo === 'comissao';

    var sidebarHtml = `
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <ul class="nav menu">
            <h1 id="espaco-menu"></h1>
            ${isRep ? `
            <li class="parent"><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-user-plus" aria-hidden="true"></em> Representante <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>   
            </a>
                <ul class="children collapse ${path === 'representante' || path === 'representante/editar' ? 'in' : ''}" id="sub-item-1">
                    <li><a style="${path === 'representante' ? 'background-color:orange;' : ''}" href="/representante">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cadastro
                    </a></li>
                    <li><a style="${path === 'representante/editar' ? 'background-color:orange;' : ''}" href="/representante/editar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar
                    </a></li>
                </ul>
            </li>
            <li class="parent"><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-address-book" aria-hidden="true"></em> Comissão de Faltas  <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path === 'comissao' || path === 'comissao/editar' ? 'in' : ''}" id="sub-item-2">
                    <li><a style="${path === 'comissao' ? 'background-color:orange;' : ''}" href="/comissao">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cadastro
                    </a></li>
                    <li><a style="${path === 'comissao/editar' ? 'background-color:orange;' : ''}" href="/comissao/editar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar
                    </a></li>
                </ul>
            </li>
            <li class="parent"><a data-toggle="collapse" href="#sub-item-3">
                <em class="fa fa-user-circle-o" aria-hidden="true"></em> Monitore <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path === 'monitore' || path === 'monitore/editar' || path === 'monitore/presenca' ? 'in' : ''}" id="sub-item-3">
                    <li><a style="${path === 'monitore' ? 'background-color:orange;' : ''}" href="/monitore">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cadastro
                    </a></li>
                    <li><a style="${path === 'monitore/editar' ? 'background-color:orange;' : ''}" href="/monitore/editar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar
                    </a></li>
                    <li><a style="${path === 'monitore/presenca' ? 'background-color:orange;' : ''}" href="/monitore/presenca">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar Presença
                    </a></li>
                </ul>
            </li>` : ''}

            <li class="parent"><a data-toggle="collapse" href="#sub-item-4">
                <em class="fa fa-user-o" aria-hidden="true">&nbsp;</em> Tutore <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path === 'tutore' || path === 'tutore/editar' || path === 'tutore/justificar' || path === 'tutore/presenca' ? 'in' : ''}" id="sub-item-4">
                    ${(isRep || isMon) ? `
                    <li><a style="${path === 'tutore' ? 'background-color:orange;' : ''}" href="/tutore">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cadastro
                    </a></li>
                    <li><a style="${path === 'tutore/editar' ? 'background-color:orange;' : ''}" href="/tutore/editar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar
                    </a></li>` : ''}
                    ${(isRep || isCom) ? `
                    <li><a style="${path === 'tutore/justificar' ? 'background-color:orange;' : ''}" href="/tutore/justificar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Justificar Presença
                    </a></li>` : ''}
                    ${(isRep || isMon) ? `
                    <li><a style="${path === 'tutore/presenca' ? 'background-color:orange;' : ''}" href="/tutore/presenca">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar Presença
                    </a></li>` : ''}
                </ul>
            </li>

            ${(isRep || isMon) ? `
            <li class="parent"><a data-toggle="collapse" href="#sub-item-5">
                <em class="fa fa-graduation-cap" aria-hidden="true">&nbsp;</em> Alune <span data-toggle="collapse" href="#sub-item-5" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path === 'alune' || path === 'alune/editar' || path === 'alune/justificar' ? 'in' : ''}" id="sub-item-5">
                    <li><a style="${path === 'alune' ? 'background-color:orange;' : ''}" href="/alune">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cadastro
                    </a></li>
                    <li><a style="${path === 'alune/editar' ? 'background-color:orange;' : ''}" href="/alune/editar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar
                    </a></li>
                    <li><a style="${path === 'alune/justificar' ? 'background-color:orange;' : ''}" href="/alune/justificar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Justificar Presença
                    </a></li>
                </ul>
            </li>
            <li class="parent"><a data-toggle="collapse" href="#sub-item-6">
                <em class="fa fa-newspaper-o" aria-hidden="true">&nbsp;</em> Disciplina <span data-toggle="collapse" href="#sub-item-6" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path === 'disciplina' || path === 'disciplina/editar' ? 'in' : ''}" id="sub-item-6">
                    <li><a style="${path === 'disciplina' ? 'background-color:orange;' : ''}" href="/disciplina">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cadastro
                    </a></li>
                    <li><a style="${path === 'disciplina/editar' ? 'background-color:orange;' : ''}" href="/disciplina/editar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar
                    </a></li>
                </ul>
            </li>
            <li class="parent"><a data-toggle="collapse" href="#sub-item-7">
                <em class="fa fa-university" aria-hidden="true">&nbsp;</em> Sala <span data-toggle="collapse" href="#sub-item-7" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path === 'sala' || path === 'sala/editar' ? 'in' : ''}" id="sub-item-7">
                    <li><a style="${path === 'sala' ? 'background-color:orange;' : ''}" href="/sala">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cadastro
                    </a></li>
                    <li><a style="${path === 'sala/editar' ? 'background-color:orange;' : ''}" href="/sala/editar">
                        <span class="fa fa-arrow-right">&nbsp;</span> Editar
                    </a></li>
                </ul>
            </li>` : ''}

            <li class="parent"><a data-toggle="collapse" href="#sub-item-8">
                <em class="fa fa-calendar">&nbsp;</em> Presença <span data-toggle="collapse" href="#sub-item-8" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path.startsWith('presenca') ? 'in' : ''}" id="sub-item-8">
                    ${(isRep || isMon) ? `
                    <li><a style="${path === 'presenca' || path === 'presenca/alune' ? 'background-color:orange;' : ''}" href="/presenca/alune">
                        <span class="fa fa-arrow-right">&nbsp;</span> Aula Alune
                    </a></li>
                    <li><a style="${path === 'presenca/tutore' ? 'background-color:orange;' : ''}" href="/presenca/tutore">
                        <span class="fa fa-arrow-right">&nbsp;</span> Aula Tutore
                    </a></li>` : ''}
                    ${isRep ? `
                    <li><a style="${path === 'presenca/monitore' ? 'background-color:orange;' : ''}" href="/presenca/monitore">
                        <span class="fa fa-arrow-right">&nbsp;</span> Monitoria
                    </a></li>` : ''}
                    ${(isRep || isCom) ? `
                    <li><a style="${path === 'presenca/reuniao' ? 'background-color:orange;' : ''}" href="/presenca/reuniao">
                        <span class="fa fa-arrow-right">&nbsp;</span> Reunião
                    </a></li>` : ''}
                </ul>
            </li>

            ${(isRep || isMon) ? `
            <li class="parent"><a data-toggle="collapse" href="#sub-item-9">
                <em class="fa fa-file-pdf-o">&nbsp;</em> Certificado <span data-toggle="collapse" href="#sub-item-9" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path.startsWith('certificado') ? 'in' : ''}" id="sub-item-9">
                    <li><a style="${path === 'certificado/tutore' ? 'background-color:orange;' : ''}" href="/certificado/tutore">
                        <span class="fa fa-arrow-right">&nbsp;</span> Tutore
                    </a></li>
                    <li><a style="${path === 'certificado' ? 'background-color:orange;' : ''}" href="/certificado">
                        <span class="fa fa-arrow-right">&nbsp;</span> Monitore
                    </a></li>
                </ul>
            </li>` : ''}

            <li class="parent"><a data-toggle="collapse" href="#sub-item-10">
                <em class="fa fa-bar-chart">&nbsp;</em> Relatorio <span data-toggle="collapse" href="#sub-item-10" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse ${path.startsWith('relatorio') ? 'in' : ''}" id="sub-item-10">
                    ${(isRep || isMon) ? `
                    <li><a style="${path === 'relatorio' ? 'background-color:orange;' : ''}" href="/relatorio">
                        <span class="fa fa-arrow-right">&nbsp;</span> Presença Alune
                    </a></li>` : ''}
                    ${(isRep || isCom) ? `
                    <li><a style="${path === 'relatorio/reuniao' ? 'background-color:orange;' : ''}" href="/relatorio/reuniao">
                        <span class="fa fa-arrow-right">&nbsp;</span> Precença Reunião
                    </a></li>` : ''}
                    ${isRep ? `
                    <li><a style="${path === 'relatorio/monitore' ? 'background-color:orange;' : ''}" href="/relatorio/monitore">
                        <span class="fa fa-arrow-right">&nbsp;</span> Presença Monitore
                    </a></li>` : ''}
                    ${(isRep || isMon) ? `
                    <li><a style="${path === 'relatorio/tutore' ? 'background-color:orange;' : ''}" href="/relatorio/tutore">
                        <span class="fa fa-arrow-right">&nbsp;</span> Presença Tutore
                    </a></li>` : ''}
                </ul>
            </li>

            <li><a onclick="logout()"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>
    `;

    if ($('#menu-container').length) {
        $('#menu-container').html(navbarHtml + sidebarHtml);
    } else {
        $('body').prepend(navbarHtml + sidebarHtml);
    }
}

function logout(){
    var resp = apiPost('/logout');
    window.location.assign('/login');
}

