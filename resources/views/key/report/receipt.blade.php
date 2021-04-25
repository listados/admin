

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pdf - Usuarios</title>
	<!-- Latest compiled and minified CSS -->
	<style type="text/css">
		.td_space{
			max-width: 1px;
			margin-right: 3px;
			padding: 3px;			
			color: #fff;
		}
		.td_data{
			border: 1px solid #c2c2c2; width: 330px; text-align: center;
			font-family: 'Calibri,Candara,Segoe,Segoe UI,Optima',Arial,sans-serif;
			padding: 5px;
		}
		.td_data_false{
			border: 1px solid #fff; width: 330px; text-align: center;
			font-family: 'Calibri,Candara,Segoe,Segoe UI,Optima',Arial,sans-serif;
			padding: 5px;
			color: #fff;
		}
	</style>
	<script>
		window.print();
	</script>
</head>
<body>
	
	<table style="width: 1010px;">
		<tr>
			@include('key.report.col_one')

		
			@include('key.report.col_two')
			
			
			@include('key.report.col_tree')
			
			<td class="td_space"> a</td>
		</tr>

	</table>

</body>

</html>