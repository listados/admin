<footer class="main-footer">

<div id="dialog_load" title="Execultando">
  Aguarde <img src="{{url('dist/img/load.gif')}}" alt="">
</div>

<div id="dialog_success" title="Cadastrado">
  <div class="alert alert-success">
    <label for="">Vistoria <strong>CADASTRADA</strong> com sucesso</label>
  </div>
</div>


@include('modal/profile')
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Versão: 1.08.05
    </div>
    <!-- Default to the left -->
    <strong>Copyright © 2016 Desenvolvido por <a href="#">Excellence Soft</a>.</strong>Todos os direitos para Escolha Azul.
</footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    
      <li class="active"><a href="#control-sidebar-settings-tab" title="Configuração Geral" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
     
      <!-- Settings tab content -->
      <div class="tab-pane active in" id="control-sidebar-settings-tab">
        <form method="post">
         

          <div class="form-group">
            <a href="{{url('configuracao/usuarios')}}" title="Manutenção de Usuários">Usuários</a>
          </div>
          <div class="form-group">
            <a href="{{url('configuracao')}}" title="Configurações Vistoria" >Configuração</a>
          </div>
          
          <div class="form-group">
             <a href="{{url('/logout')}}"> <i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a>
          </div>
          
          <!-- /.form-group -->

        </form>
      </div>
      <!-- /.tab-pane -->

      {{-- <div class="tab-pane" id="control-sidebar-survey-tab">
        <div class="form-group">
           {{link_to('vistoria/conf-ascpectos-gerais', 'Aspectos Gerais' )}}  
        </div>
        <div class="form-group">
           {{link_to('vistoria/conf-ressalva', 'Ressalva por ambiente' )}}  
        </div>
        <div class="form-group">
           {{link_to('vistoria/conf-disposicoes', 'Disposiçoes Gerais' )}}  
        </div>
         
      </div> --}}
    </div>
  </aside>

  <!-- /.control-sidebar -->