@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{"Vistoria"}}
            
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-pencil-square-o"></i> Menu</a></li>
                <li>Proposta</li>
                 <li class="active">Vistoria</li>
            </ol>
        </section>

          <!-- Main content -->


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Buscar Vistoria</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Imóvel</th>
                  <th>Data</th>
                  <th>Tipo</th>
                  <th>Vistoriador</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>V0001</td>
                  <td>Rua Nunes Valente, 2700, Ap. 801
                  </td>
                  <td>05/05/2016</td>
                  <td>Entrada</td>
                  <td>Renan Barros</td>
                  <td>Ícones</td>
                </tr>

                <tr>
                  <td>V0002</td>
                  <td>Rua Dr. José Lourenço, 555
                  </td>
                  <td>05/10/2016</td>
                  <td>Saída</td>
                  <td>Fabiano Barros</td>
                  <td>Ícones</td>
                </tr>
                <tr>
                  <td>V0003</td>
                  <td>Av. Santos Dumont, 2828, Sl.1108
                  </td>
                  <td>05/01/2016</td>
                  <td>Manutenção</td>
                  <td>Yara Pereira</td>
                  <td>Ícones</td>
                </tr>
                <tr>
                  <td>V0001</td>
                  <td>Rua Nunes Valente, 2700, Ap. 801
                  </td>
                  <td>05/05/2016</td>
                  <td>Entrada</td>
                  <td>Renan Barros</td>
                  <td>Ícones</td>
                </tr>

                <tr>
                  <td>V0002</td>
                  <td>Rua Dr. José Lourenço, 555
                  </td>
                  <td>05/10/2016</td>
                  <td>Saída</td>
                  <td>Fabiano Barros</td>
                  <td>Ícones</td>
                </tr>
                <tr>
                  <td>V0003</td>
                  <td>Av. Santos Dumont, 2828, Sl.1108
                  </td>
                  <td>05/01/2016</td>
                  <td>Manutenção</td>
                  <td>Yara Pereira</td>
                  <td>Ícones</td>
                </tr>

                </tbody>
                <tfoot>
                <tr>
                  <th>Código</th>
                  <th>Imóvel</th>
                  <th>Data</th>
                  <th>Tipo</th>
                  <th>Vistoriador</th>
                  <th>Ações</th>
                </tr>
                </tfoot>
              </table>
            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->



        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <section> </section>
  </div>
</div><!-- /.content-wrapper -->





@endsection
