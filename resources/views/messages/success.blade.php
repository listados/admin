@if (session()->has('mensagem'))
    <div class="alert alert-success  alert-dismissible"  role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       {{ session('mensagem') }}
    </div>
@endif