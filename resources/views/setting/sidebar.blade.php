<div class="col-md-2">
  	<div class="sidebar content-box" style="display: block;">
        <ul class="nav">
            <!-- Main menu -->
            <li class="current"><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Painel Adm </a></li>
            <li><a href="{{ url('configuracao/usuarios') }}"><i class="glyphicon glyphicon-user"></i> Usuário </a></li>
            <li class="submenu">
                 <a href="#">
                    <i class="glyphicon glyphicon-list"></i> Vistoria
                    <span class="caret pull-right"></span>
                 </a>
                 <!-- Sub menu -->
                 <ul>
                    <li><a href="{{ url('configuracao/conf-ascpectos-gerais') }}"> Aspactos Gerais</a></li>
                    <li><a href="{{ url('configuracao/conf-ressalva') }}"> Ressalva por ambiente</a></li>
                    <li><a href="{{ url('configuracao/conf-disposicoes') }}"> Disposições Gerais</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-stats"></i> Escollha Azul</a></li>
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-list"></i> Imobiliária</a></li>
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-record"></i> Notificações</a></li>
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
            
        </ul>
     </div>
  </div>
{{--   FIM SIDEBAR --}}