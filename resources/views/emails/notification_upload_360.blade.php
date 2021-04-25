@include('emails.header_email')

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
			<td><p>Olá!</p>
				<p>Uma nova foto em 360º foi adicionado na vistoria de número:  <b>{{$survey->survey_id}}</b></p>
			</td>			
		</tr>
		<tr  style="text-align: center;">
			<td> <p> Acesse o painel para fazer a imagem</p>  </td>
		</tr>
		
		<tr style="text-align: center;">
			<td><a href="{{ url('/'.base64_encode($survey->survey_id)) }}" style="width: 170px;min-height: 50px; background: #5cb85c;color: white;font-weight: none;  font-size: 18px;padding: 10px; border-radius: 5px; text-decoration: none;">Acessar</a></p></td>
		</tr>
		<tr style="text-align: center;">
			<td>
			<p>Atenciosamente. <br/> <b>Equipe Espíndola</b>  <br>
			<img src="{{ url('public\dist\img/logo_grande.jpg') }}" alt="">

			</p>
			</td>
		</tr>
	</table>


	
	
	<hr>
	
</div>

@include('emails.footer_email')