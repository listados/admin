

<!DOCTYPE html>
<html lang="pt-br">
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Pdf - Usuarios</title>
       <!-- Latest compiled and minified CSS -->
	<style>
		.borda{
			border: 1px solid #333333;
		}
		table > tbody > tr > td{
			border: 1px solid #c3c3c3;
		}
		table > thead > tr > th{
			background: #c3c3c3;

		}
	</style>
   </head>
<body>
<div class="row">
  <div class="small-12 small-centered columns">
    <h3>Relatório de usuários do sistema</h3>
  </div>
</div>
    <table>
	 <thead class="borda" >
	 	<tr class="borda">
	 		<th>Codigo</th>
			<th>Nome</th>
			<th>Cadastro</th>
			<th>Adm</th>
			<th>E-mail</th>
			<th>Status</th>
			<th>Perfil</th>
	 	</tr>
	 </thead>
		<tbody class="borda">
			@foreach($users as $user)
				<tr >
					<td>{{$user->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->created_at}}</td>
					<td>{{($user->adm == 1) ? 'Adm' : 'Usu'}}</td>
					<td>{{$user->email}}</td>
					<td>{{($user->status == 1) ? 'Ativo' : 'Inativo'}}</td>
					<td>{{$user->profile_name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

   </body>

</html>