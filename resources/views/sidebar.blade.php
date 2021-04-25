<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        
        @if(Auth::check())
          <img src="{{url('dist/img/upload/profile/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image" />
        @else
          <script type="text/javascript">
              window.location = "{{ url('/login') }}";//here double curly bracket
          </script>
        @endif
      </div>
      <div class="pull-left info">
        @if(Auth::check())
          <p>  {{ Auth::user()->nick }}</p>
        @else
          <script type="text/javascript">
              window.location = "{{ url('/login') }}";//here double curly bracket
          </script>
        @endif
        
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
        <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">Menu Principal</li>
      <!-- Optionally, you can add icons to the links -->
      

      <li class="treeview"><a href="#"><i class="fa fa-home"></i> <span>Imóveis</span> <i class="fa fa-angle-left pull-right"></i> </a>

          <ul class="treeview-menu">
            <li><a href="{{url('/imovel')}}"><i class="fa fa-home"></i> Imóveis</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-plus"></i> Add. Imóvel</a></li>
            <li><a href="{{url('/chaves')}}"><i class="fa fa-key"></i>Controle de Chaves/Visitas</a></li>
            <li><a href="{{url('/vistoria')}}"><i class="fa fa-pencil-square-o"></i>Vistoria</a></li>
            {{-- <li><a href="{{url('/tour')}}"><i class="fa fa-street-view"></i>Tour Virtual</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-building-o"></i>Condomínio</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-map-o"></i>IPTU</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-fire-extinguisher"></i>Seguro Incêndio</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-bolt"></i>Água e Energia</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-th"></i>Garantias Locatícias</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-pencil-square-o"></i>O.S.</a></li> --}}
          </ul>
      </li>
      


      <li class="treeview"><a href="#"><i class="fa fa-user"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i> </a>

          <ul class="treeview-menu">
            <li><a href="{{url('/clientes')}}"><i class="fa fa-user"></i>Clientes</a></li>
            
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-users"></i> Interessados</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-users"></i> Inquilinos</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-users"></i>Proprietários</a></li>
            {{-- <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-users"></i>Fiadores</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-pencil-square-o"></i>O.S.</a></li> --}}
          </ul>
      </li>


      {{-- <li class="treeview"><a href="#"><i class="fa fa-file-text-o"></i> <span>Contratos</span> <i class="fa fa-angle-left pull-right"></i> </a>

          <ul class="treeview-menu">
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-file-text-o"></i>Contratos</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-plus"></i>Add. Contrato</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-trash-o"></i>Inativos</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-pencil-square-o"></i>O.S.</a></li>
          </ul>
      </li> --}}


      {{-- <li class="treeview"><a href="#"><i class="fa fa-bar-chart"></i> <span>Financeiro</span> <i class="fa fa-angle-left pull-right"></i> </a>

          <ul class="treeview-menu">
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-bar-chart"></i>Extrato</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-file-powerpoint-o"></i>Contas a pagar</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-file-powerpoint-o"></i>Contas a receber</a></li>
            <li><a href="#"><i class="fa fa-pie-chart"></i>Relatórios</a></li>
          </ul>
      </li> --}}




       <li class="treeview"><a href="#"><i class="fa fa-files-o"></i>
            <span>Escolha Azul</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/proposta-pf')}}"><i class="fa fa-file-powerpoint-o"></i> Proposta PF</a></li>
            <li><a href="{{url('/proposta-pj')}}"><i class="fa fa-file-powerpoint-o"></i> Proposta PJ</a></li>
            <li><a href="{{url('/cadastro-pf')}}"><i class="fa fa-pencil-square-o"></i> Cadastro PF</a></li>
            <li><a href="{{url('/cadastro-pf')}}"><i class="fa fa-pencil-square-o"></i> Cadastro PJ</a></li>
            <li><a href="https://servicos.spc.org.br/spc/controleacesso/autenticacao/entry.action" target="_blank"><i class="fa fa-check"></i> SPC</a></li>
            <li><a href="http://www.tjce.jus.br/institucional/consulta-de-processo/" target="_blank">
            <i class="fa fa-balance-scale" aria-hidden="true"></i>
             TJCE</a></li>
           
          </ul>
        </li>

      <li class="treeview"><a href="#"><i class="fa fa-pie-chart"></i> <span>Relatórios</span> <i class="fa fa-angle-left pull-right"></i> </a>

          <ul class="treeview-menu">
            <li><a href="{{url('reserva')}}"><i class="fa fa-money"></i>Avaliação</a></li>
            <li><a href="{{url('/report')}}"><i class="fa fa-pie-chart"></i>Relatórios</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-line-chart"></i>Desempenho Corretores</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-bar-chart"></i>Relatórios Financeiros</a></li>
            
          </ul>
      </li>

      {{-- <li class="treeview"><a href="#"><i class="fa fa-gift"></i> <span>Apps</span> <i class="fa fa-angle-left pull-right"></i> </a>

          <ul class="treeview-menu">
            
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-files-o"></i>Escolha Azul</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-calculator"></i>Cálculo Imob.</a></li>
            <li><a href="{{url('/tangerino')}}"><i class="fa fa-clock-o"></i>Tangerino</a></li>
           
          </ul>
      </li> --}}

<li class="header">Ferramentas</li>

        <li>
          <a href="{{url('/em_desenvolvimento')}}">
            <i class="fa fa-envelope"></i> <span>E-mail</span>
            <small class="label pull-right bg-yellow">12</small>
          </a>
        </li>


        <li>
          <a href="{{url('/em_desenvolvimento')}}">
            <i class="fa fa-calendar"></i> <span>Calendário</span>
            <small class="label pull-right bg-red">3</small>
          </a>
        </li>

        <li>
          <a href="{{url('/em_desenvolvimento')}}">
            <i class="fa fa-tasks"></i> <span>Tarefas</span>
            <small class="label pull-right bg-blue">3</small>
          </a>
        </li>
        <li>
          <a href="{{url('/em_desenvolvimento')}}">
            <i class="fa fa-comments"></i> <span>Chat</span>
            <small class="label pull-right bg-green">3</small>
          </a>
        </li>





<li class="header">UEN'S</li>

       <li class="treeview"><a href="#"><i class="fa fa-circle-o text-white"></i>
            <span>Gestão</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Documentos</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Manual</a></li>
          </ul>
        </li>



       <li class="treeview"><a href="#"><i class="fa fa-circle-o text-yellow"></i>
            <span>Comercial</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Documentos Comercial</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Controle de Comissões</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Manual Comercial</a></li>
          </ul>
        </li>
      
       <li class="treeview"><a href="#"><i class="fa fa-circle-o text-aqua"></i>
            <span>Locação</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i> Documentos Adm.I.</a></li>
            
          </ul>

       </li>
      
       <li class="treeview"><a href="#"><i class="fa fa-circle-o text-green"></i>
            <span>Adm./Financeiro</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Documentos Adm.Fin.</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i> Manual Adm.Financeiro</a></li>
            <li><a href="{{url('/tangerino')}}"><i class="fa fa-clock-o"></i>Tangerino</a></li>
          </ul>
        </li>
     

     <li class="treeview"><a href="#"><i class="fa fa-circle-o text-red"></i>
            <span>Jurídico</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Documentos Comercial</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Controle de Comissões</a></li>
            <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-circle-o"></i>Manual Comercial</a></li>
          </ul>
        </li>



     <li class="header">Mais...</li>   
     
      <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-cog"></i> <span>Configurações</span> </a>
      </li>


      <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-graduation-cap"></i> <span>Treinamento</span> </a>
      </li>

      <li><a href="{{url('/em_desenvolvimento')}}"><i class="fa fa-question-circle"></i> <span>Dúvidas Frequentes</span> </a>
      </li>



    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>