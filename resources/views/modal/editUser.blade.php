<!-- Modal Editar Usuario-->
<div class="modal fade" id="editUser_{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Usuario {{$users->name}}</h4>
      </div>
      <div class="modal-body">
       {{Form::model($user,array('url'=>'/admin/update/'.$users->id))}}
           <div class="form-group">
           <label for="nome">Nome:</label>
          <input type="text" id="name_user" name="name" class="form-control" value="{{$users->name}}">
        </div>
         <div class="form-group">
         <label for="email">E-mail:</label>
          <input type="text" name="email" id="name_user" class="form-control" value="{{$users->email}}">
        </div>
         <div class="form-group">
 
         <label for="">Tornar Administrador</label><br>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-primary ">
              <input type="radio" name="adm" id="option1" value="1" autocomplete="off" > Sim
            </label>
            <label class="btn btn-primary active">
              <input type="radio" name="adm" id="option2" value="0" autocomplete="off" checked> Não
            </label>          
          </div>          
        </div>
         <div class="form-group">
         <label for="">Ativar usuário</label><br>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-primary ">
              <input type="radio" name="status" id="option1" value="1" autocomplete="off" > Sim
            </label>
            <label class="btn btn-primary active">
              <input type="radio" name="status" id="option2" value="0" autocomplete="off" checked> Não
            </label>          
          </div>          
        </div>
        
        <div class="form-group">
          <label for="">Perfil</label>        
            {{-- <select name="id_profile" id="" class="form-control">
              <option value="{{$users->id_profile}}">{{$users->id_profile}}</option>
              @foreach($profile as $user_profile)
                  <option value="{{$user_profile->profile_id}}">{{$user_profile->id_profile}}</option>
              @endforeach
            </select> --}}
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Alterar</button>
      </div>
      {{Form::close()}} 
    </div>
  </div>
</div>
