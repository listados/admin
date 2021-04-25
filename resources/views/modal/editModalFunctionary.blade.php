<!-- Modal Mudar Status da Proposta-->
<div class="modal fade" id="editModalFunctionry_{{$name_users->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <Editar>Alterar</Editar>
                    Atendente da proposta nº {{ $proposta->proposal_id}}
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Atendente atual: {{ $name_users->name }}</label>
                </div>
                {{Form::open(array('url' => 'alterar-atendente-proposta'))}}
                <div class="container-fluid bd-example-row">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Escolha outro atendente</p>
                            <?php 
                                //$user_all = User::all(); 
                                $user_all = DB::table('users')->where('receive_proposal' , '=' , 1)->orderBy('name')->get();
                            ?>
                            <select name="proposal_id_user" id="" class="form-control selectpicker">
                            @foreach($user_all as $user_alls)
                                <option value="{{$user_alls->id}}">{{$user_alls->name}}</option>
                            @endforeach
                                
                            </select>
                          {{Form::hidden('proposal_id', $proposta->proposal_id)}}
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                <button type="submit" value="Alterar" id="alterar_status_proposta" class="btn btn-primary pull-right">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Alterar Atendente
                </button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
