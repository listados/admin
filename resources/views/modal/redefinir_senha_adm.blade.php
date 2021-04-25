<!-- Modal Editar Usuario-->
<div class="modal fade" id="redefinir_senha_adm_{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><Editar>Redefinir Senha</Editar> do Usuário {{$users->name}}</h4>
      </div>
      <div class="modal-body">
      <p>Deseja realmente redefinir a senha do Usuário?</p>
       {{Form::open(array('url' => '/redefinir-senha'))}}
           <div class="form-group">
           <input type="hidden"  name="id" value="{{$users->id}}">
            <button type="submit" class="btn btn-success">Sim</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>        
      </div>
      {{Form::close()}} 
    </div>
  </div>
</div>
         