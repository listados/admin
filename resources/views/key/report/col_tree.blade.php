@if(isset($_GET['delivery']) && $_GET['delivery'] == 'on')
	@php
		$class_td = 'td_data';
	@endphp
@else
	@php
		$class_td = 'td_data_false';
	@endphp
@endif


<td class="{{ $class_td }}">
   
    <p style="font-size: 10px;">
       Emitido em {{date('d/m/Y H:i:s')}}
    </p>
   
   <p style="font-size: 12px;">
		-------------------------------------------- <br>
		<strong>RECIBO CHAVES - DELIVERY</strong>
		--------------------------------------------
	</p>
  <p style="font-size: 11px; text-align: left;">
		 <strong>Imóvel: {{$key[0]->keys_cod_immobile .' - '.$immobile[0]->immobiles_type_immobiles}} – {{$immobile[0]->immobiles_address.','}} {{(!empty($immobile[0]->immobiles_number) ? $immobile[0]->immobiles_number.',' : null)}} {{(!empty($immobile[0]->immobiles_complement) ? $immobile[0]->immobiles_complement.',' : '' )}} {{(!empty($immobile[0]->immobiles_district) ? $immobile[0]->immobiles_district.',' : null )}} {{(!empty($immobile[0]->immobiles_city) ? $immobile[0]->immobiles_city.',' : null )}} ({{$immobile[0]->immobiles_state}}) 
        CEP: {{$immobile[0]->immobiles_cep}}</strong><br>
        Visitante: <strong> {{$client[0]->clients_name}} </strong><br>
        CPF: {{$client[0]->clients_cpf}}<br>
        Telefones: 
        @foreach($phone as $phones)
            {{ $phones->phone_number }} 
        @endforeach<br>
        
        <strong>
        	Hora Visita: {{date('d/m/Y H:i' , strtotime($reserve[0]->reserves_date_exit) )}}<br>
			Previsão para devolução: {{date('d/m/Y H:i' , strtotime($reserve[0]->reserves_date_devolution) )}}
        </strong>
	</p>
	<br>
	<p  style="font-size: 11px;">
		Recebi da ESPÍNDOLA IMOBILIÁRIA as chaves do
imóvel especificado acima, para visitação do mesmo,
comprometendo-me a devolvê-las no prazo acima
previsto. Caso ocorra algum dano na mesma, tenho
ciência que terei que indenizar o proprietário.
	</p>
	 <p style="text-align: center; ">
        ______________________________
        <br>
        <label  style="font-size: 10px; text-align: center; ">
        Assinatura Despachante 	
        </label>
        <br>
        -----------------------------------------------------
    </p>
    <p  style="font-size: 12px;">
        <strong >DADOS DA VISTORIA</strong>
    </p>
     <p style="font-size: 10px;text-align: left; ">
        <strong>Imóvel: {{$key[0]->keys_cod_immobile .' - '.$immobile[0]->immobiles_type_immobiles}} – {{$immobile[0]->immobiles_address.','}} {{(!empty($immobile[0]->immobiles_number) ? $immobile[0]->immobiles_number.',' : null)}} {{(!empty($immobile[0]->immobiles_complement) ? $immobile[0]->immobiles_complement.',' : '' )}} {{(!empty($immobile[0]->immobiles_district) ? $immobile[0]->immobiles_district.',' : null )}} {{(!empty($immobile[0]->immobiles_city) ? $immobile[0]->immobiles_city.',' : null )}} ({{$immobile[0]->immobiles_state}}) 
        CEP: {{$immobile[0]->immobiles_cep}}</strong><br>
    </p>
    <P style="font-size: 10px;text-align: left; "">
    	Hora Visita:  {{date('d/m/Y H:i' , strtotime($reserve[0]->reserves_date_exit) )}}<br>
    	Visitante: <strong> {{$client[0]->clients_name}} </strong><br> 	
        Telefones:  {{$phone[0]->phone_number}}  /  {{$phone[0]->phone_number}} <br>
    </P>

    <p>
        <label  style="font-size: 10px;">Emitido em {{date('d/m/Y H:i:s')}}</label>
    </p>
</td>
