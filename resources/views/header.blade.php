<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="{{url('/')}}" class="logo">
    <span class="logo-mini"><img src="{{url('dist/img/inconeespindola.png')}}" alt=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"> <img src="{{url('dist/img/inconeespindola.png')}}" alt=""> <b>Espíndola</b></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
         
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">0</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">Você tem 0 Mensagem não lida</li>
            <li>
            
              <ul class="menu">
                <li>
                  <a href="#">
                    <div class="pull-left">
                     
                      <img src="{{ asset("http://mydigitalaccounts.com/wp-content/uploads/2015/06/user-default-avatar.jpg") }}" class="img-circle" alt="User Image"/>
                    </div>
                  
                    <h4>                            
                      Suporte
                      <small><i class="fa fa-clock-o"></i> 5 mins</small>
                    </h4>
                   
                    <p>Ficará mensagens</p>
                  </a>
                </li>                 
              </ul><!-- /.menu -->
            </li>
            <li class="footer"><a href="#">Ver todas mensagens</a></li>
          </ul>
        </li><!-- /.messages-menu -->

        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle"  id="drop-notif" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
          
               <span id="sum_notification" class="label label-warning">0</span>
          
           
          </a>
          <ul class="dropdown-menu">
            <li class="header" id="li-info-notif">você tem  notificações</li>
            <li>
              <!-- Inner Menu: contains the notifications -->
              <ul class="menu" id="notifi-menu">
                                  
              </ul>
            </li>
            <li class="footer"><a href="#">Ver todos</a></li>
          </ul>
        </li>

        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            @if(Auth::check())
              <img src="{{url('dist/img/upload/profile/'.Auth::user()->avatar)}}" class="user-image" alt="User Image"/>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">  {{ Auth::user()->nick }}</span>
              <input type="hidden" id="id_user" name="" value="{{Auth::user()->id}}" placeholder="">
            @else
              <script type="text/javascript">
                  window.location = "{{ url('/login') }}";//here double curly bracket
              </script>
            @endif
            
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{ asset("http://mydigitalaccounts.com/wp-content/uploads/2015/06/user-default-avatar.jpg") }}" class="img-circle" alt="User Image" />
             
              @if(Auth::check())
                <p>
                  {{ Auth::user()->name }}
                  <small>Data Cadastro: {{ date('d/m/Y', strtotime(Auth::user()->created_at)) }}</small>
                </p>
              @else
                <script type="text/javascript">
                    window.location = "{{ url('/login') }}";//here double curly bracket
                </script>
              @endif
            </li>
            <!-- Menu Body
            <li class="user-body">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </li> -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
              
                @if(Auth::check())
                  <?php $id_user = Auth::user()->id; ?>
                  <a href="{{url('admin/usuario/'.$id_user)}}" class="btn btn-default btn-flat">Editar Perfil</a>
                @else
                  <script type="text/javascript">
                      window.location = "{{ url('/login') }}";//here double curly bracket
                  </script>
                @endif
              </div>

              <div class="pull-right">
                <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Sair</a>
              </div>
            </li>
          </ul>
        </li>
        
         @if(Auth::check())
            @if(Auth::user()->adm == 1)
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
            @endif 
          @else
            <script type="text/javascript">
                window.location = "{{ url('/login') }}";//here double curly bracket
            </script>
          @endif 
      </ul>
    </div>
  </nav>

</header>