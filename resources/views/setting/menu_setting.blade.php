	<div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             
              <p class="text-muted text-center">Menu Configuração</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <div class="dropdown">
               
                  <a href="#" class="dropdown-toggle btn btn-default btn-block" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Clientes <span class="caret"></span> </a>

                  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="drop3">
                    <li><a href="{{ url('configuracao/cadastrar-cliente') }}" class="text-light-blue">Cadastrar</a></li>
                    <li><a href="#" class="text-light-blue">Atendimento Automático</a></li>
                    <li><a href="#" class="text-light-blue">E-mails de Feedback ao Proprietario</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="text-light-blue">Chaves</a></li>
                  </ul>
                </div>
                </li>
                <li class="list-group-item">
                  
                  <a href="{{ url('delivery') }}" class="btn btn-default btn-flat btn-block">Delivery</a>
                </li>
                <li class="list-group-item">
             
                  <a href="{{ url('configuracao/imovel') }}" class="btn btn-default btn-flat btn-block">Imóveis</a>
                </li>
                <li class="list-group-item">
                    <div class="dropdown">
               
                  <a href="#" class="dropdown-toggle btn btn-default btn-block" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Vistoria <span class="caret"></span> </a>

                  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="drop3">
                    <li><a href="{{ url('configuracao/conf-ressalva') }}" class="text-light-blue">Configurar Ressalva</a></li>
                    <li><a href="{{ url('configuracao/conf-ascpectos-gerais') }}" class="text-light-blue">Configurar Aspectos Gerais</a></li>
                    <li><a href="{{ url('configuracao/conf-disposicoes') }}" class="text-light-blue">Configurar Disposição Geral</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('configuracao/conf-chaves') }}" class="text-light-blue">Chaves</a></li>
                  </ul>
                </div>
                </li>
                <li class="list-group-item">
                  <button type="button" class="btn btn-default btn-flat btn-block">Escolha Azul</button>
                </li>
                <li class="list-group-item">
                  <button type="button" class="btn btn-default btn-block">Relatórios</button>
                </li>
              </ul>

            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
    </div>