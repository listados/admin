@extends('layouts.admin_template')

@section('content')


<!-- Sidebar -->
@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Recibo de Chaves
      <small>Visita</small>
    </h1>
    <h1>Aqui</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Imóveis</a></li>
      <li class="active">Controle de Chaves</li>
      <li class="active">Nova Visita</li>       
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Imóvel</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <div class="box-body">
           <div class="row">

             <div class="col-xs-6">
              <div class="form-group">
                <label>Tipo de Imóvel</label>
                <select class="form-control" name="keys_type_immobile">
                  <option>Apartamento</option>
                  <option>Casa</option>
                  <option>Kitnet</option>
                  <option>Sala</option>
                  <option>Loja</option>
                  <option>Terreno</option>
                  <option>Galpão</option>
                  <option>Outros</option>
                </select>
              </div>
              <form role="form">
              </div>
              <div class="col-xs-6">
                <label for="">Ref. Imóvel</label>
                <input type="text" name="keys_ref_immobile" class="form-control" placeholder="AP0054">
              </div>

            </div>
            <div class="row">
              <div class="col-xs-3">
                <label for="">CEP</label>
                <input type="text" name="keys_cep" class="form-control" placeholder="60.000-000">
              </div>
              <div class="col-xs-7">
                <label for="">Endereço</label>
                <input type="text" name="keys_address" class="form-control"  placeholder="Rua/Av. Santos Dumont">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-4">
                <label for="">Número</label>
                <input type="number" name="keys_number" class="form-control"  placeholder="1010">
              </div>
              <div class="col-xs-5">
                <label for="">Complemento</label>
                <input type="text" name="keys_complements" class="form-control"  placeholder="Ap. 801, Bloco A">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-4">
                <label for="">Bairro</label>
                <input type="text" name="keys_district" class="form-control"  placeholder="Aldeota">
              </div>
              <div class="col-xs-4">
                <label for="">Cidade</label>
                <input type="text" name="keys_city" class="form-control"  placeholder="Fortaleza">
              </div>
              <div class="col-xs-3">
                <label for="">Estado</label>
                <input type="text" name="keys_state" class="form-control"  placeholder="CE">
              </div>
            </div>
            <br>
            <div class="form-group">
              <label>Ponto de referência</label>
              <input type="text" name="keys_point_reference" class="form-control" placeholder="Especificar...">
            </div>


          </form>
        </div>
      </div>
      <!-- /.box -->

      <!-- Form Element sizes -->

      <!-- /.box -->

      <!-- /.box -->

      <!-- Input addon -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Outras Informações</h3>
        </div>


        <div class="box-body">
         <div class="row">
          <div class="col-xs-4">
            <div class="form-group">
              <label>Atendente</label>
              <select class="form-control" name="">
                <option>Cristiano Espíndola</option>
                <option>Fabiano Barros</option>
                <option>Hannah Luar</option>
                <option>Yara Pereira</option>
                <option>Hellayne Cristina</option>
                <option>Mariangela Akemi</option>
                <option>Natana Holanda</option>
                <option>Outro:</option>
              </select>
            </div>
          </div>


          <div class="col-xs-4">
            <div class="form-group">
              <label>Finalidade</label>
              <select class="form-control" name="keys_finality">
                <option>Visita</option>
                <option>Reserva</option>
                <option>Manutenção</option>
              </select>
            </div>
          </div>

          <div class="col-xs-4">
            <div class="form-group">
              <label>Delivery</label>
              <select class="form-control" name="keys_delivery">
                <option>Não</option>
                <option>Antonio</option>
                <option>Welton</option>
                <option>Sim, com terceiros</option>
              </select>
            </div>
          </div>

        </div>  
             {{--  <div class="form-group">
                <label>Data da entrega e da devolução das chaves</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservationtime" name="" placeholder="02/05/17 08:00 - 02/05/17 11:00">
                </div>
                <!-- /.input group -->
              </div> --}}

              <div class="row">
              <div class="col-md-12"><label>Data da entrega e da devolução das chaves</label></div>
               <div class="col-xs-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    <input type="text"  name="keys_date_exit" class="form-control" placeholder="Retirada">
                  </div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    <input type="text" name="keys_date_devolution" class="form-control" placeholder="Devolução">
                  </div>
                </div>
              </div>
            </div> 

            <div class="row">
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input type="text"  name="keys_value_guarantee" class="form-control" placeholder="Caução">
                </div>
              </div>
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa  fa-key"></i></span>
                  <input type="text" name="keys_key_number" class="form-control" placeholder="Chaves nº">
                </div>
              </div>
            </div>           
            <br>  



          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
      <!--/.col (left) -->

      <!-- right column -->
      <div class="col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Dados do Visitante</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <div class="box-body">
            <div class="row">
              <div class="col-xs-7">
                <label for="">Nome</label>
                <input type="email" name="keys_visitor_name" class="form-control"  placeholder="Nome completo">
              </div>
              <div class="col-xs-4">
                <label for="keys_visitor_cep">CPF</label>
                <input type="email" name="keys_cpf" class="form-control"  placeholder="999.999.999-99">
              </div>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input type="email" name="keys_visitor_email" class="form-control" placeholder="E-mail">
            </div>
            <br>
            <div class="form-group">
              <label>Telefones</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </div>
                <input type="text" name="keys_visitor_phone_one" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </div>
                <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' name="keys_visitor_phone_two" data-mask>
              </div>

              <!-- /.input group -->
            </div>


            <div class="row">
              <div class="col-xs-3">
                <label for="">CEP</label>
                <input type="text" name="keys_visitor_cep" class="form-control"  placeholder="60.000-000">
              </div>
              <div class="col-xs-7">
                <label for="">Endereço</label>
                <input type="text" class="form-control" name="" placeholder="Rua/Av. Santos Dumont">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-4">
                <label for="">Número</label>
                <input type="number" class="form-control" name="" placeholder="1010">
              </div>
              <div class="col-xs-5">
                <label for="">Complemento</label>
                <input type="text" class="form-control" name="" placeholder="Ap. 801, Bloco A">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-4">
                <label for="">Bairro</label>
                <input type="text" class="form-control" name="">
              </div>
              <div class="col-xs-4">
                <label for="">Cidade</label>
                <input type="text" class="form-control" name="">
              </div>
              <div class="col-xs-3">
                <label for="">Estado</label>
                <input type="text" class="form-control" name="">
              </div>
            </div>
            <br>
            <div class="form-group">
              <label for="">Anexar Identidade</label>
              <input type="file" name="">
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-default">Voltar</button>
            <button type="submit" class="btn btn-info pull-right">Salvar e gerar recibo</button>
          </div>
          <!-- /.box-footer -->


        </form>

      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@push('scripts')

{{Html::script('public/plugins/input-mask/jquery.inputmask.js')}}
{{Html::script('public/plugins/input-mask/jquery.inputmask.date.extensions.js')}}
{{Html::script('public/plugins/input-mask/jquery.inputmask.extensions.js')}}
<!-- date-range-picker -->

{{Html::script('public/plugins/daterangepicker/daterangepicker.js')}}


@endpush

@endsection
