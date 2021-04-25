<!-- Modal Editar Usuario-->
<div class="modal fade" id="deleteUser_{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><Editar>Excluir</Editar> Usuario {{$users->name}}</h4>
      </div>
      <div class="modal-body">
      <p>Deseja realmente excluir o Usuário?</p>
       {{Form::model($user,array('url'=>'/admin/destroy/'.$users->id , 'method' => 'delete'))}}
           <div class="form-group">
            <button type="submit" class="btn btn-danger">Sim</button>
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
         