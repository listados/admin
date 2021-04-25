<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>E-mail de registro</title>
<style>

.container h2, p{
	padding: 20px;
}

p{
	color:#7E7B7B;
}

</style>
</head>
<body>
<div  style="border: 1px solid #c3c3c3;padding-right: 15px; padding-left: 15px;margin-right: auto;margin-left: auto;background: #fff; border-radius: 5px; width: 600px;">
	<table style="align: center;">
		
		
		<tr style="text-align: center;">
			<td><p>Olá, <strong> {{$user->name}}</strong> !</p>
				<p>Você foi convidado(a) a acessar o <b>Admin Espíndola imobiliária</b>.</p>
			</td>			
		</tr>
		<tr  style="text-align: center;">
			<td> <p></p>  </td>
		</tr>
		<tr  style="text-align: center;">
			<td><p>Para continuar, clique em confirmar.  <br/></td>
		</tr>

		<tr style="text-align: center;">
			<td><a href="{{url('/alterar-senha/'.$user->id)}}" style="width: 170px;min-height: 50px; background: #5cb85c;color: white;
    font-weight: none;  font-size: 18px;padding: 10px; border-radius: 5px; text-decoration: none;">Confirmar</a></p></td>
		</tr>
		<tr style="text-align: center;">
			<td><p>Atenciosamente. <br/> <b>Equipe Espíndola</b></p></td>
		</tr>
	</table>


	
	
	<hr>
	
</div>

</body>
</html>