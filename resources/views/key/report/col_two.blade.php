@if(isset($_GET['auto']) && $_GET['auto'] == 'on')
	@php
		$class_td = 'td_data';
	@endphp
@else
	@php
		$class_td = 'td_data_false';
	@endphp
@endif


<td class="{{ $class_td }}">
    <strong style="font-size: 12px;">ESPÍNDOLA IMOBILIÁRIA LTDA.</strong>
    <p style="font-size: 10px;">
        CNPJ 09.652.345/0001-02 <br>
        Av. Santos Dumont, nº 2828, Loja 12<br>
        FORTALEZA – CEARÁ – BRASIL CEP: 60.150-161<br>
        Tel. 85 3461.1166 | www.espindolaimobiliária.com.br
    </p>
   
    <p  style="font-size: 12px;">
        <strong >AUTORIZAÇÃO PARA VISITAÇÃO</strong>
    </p>
  
    <p style="font-size: 11px;text-align: left; ">
         <strong>Imóvel: {{$key[0]->keys_cod_immobile .' - '.$immobile[0]->immobiles_type_immobiles}} – {{$immobile[0]->immobiles_address.','}} {{(!empty($immobile[0]->immobiles_number) ? $immobile[0]->immobiles_number.',' : null)}} {{(!empty($immobile[0]->immobiles_complement) ? $immobile[0]->immobiles_complement.',' : '' )}} {{(!empty($immobile[0]->immobiles_district) ? $immobile[0]->immobiles_district.',' : null )}} {{(!empty($immobile[0]->immobiles_city) ? $immobile[0]->immobiles_city.',' : null )}} ({{$immobile[0]->immobiles_state}}) 
         CEP: {{$immobile[0]->immobiles_cep}}</strong>
      
    </p>
    <p  style="font-size: 11px; text-align: left; ">
        Visitante: <strong> {{$client[0]->clients_name}} </strong><br>
        CPF: {{$client[0]->clients_cpf}}<br>
        Telefones:         
        @foreach($phone as $phones)
            {{ $phones->phone_number }} 
        @endforeach<br>
       
    </p>
    <p style="font-size: 11px;text-align: justify; ">
        A Espíndola Imobiliária autoriza o visitante acima a visitar o imóvel acima especificado, o qual encontra-se sob nossa administração. 
    </p>
    <br>
    <p style="text-align: center; ">
        ______________________________
        <br>
        <label  style="font-size: 10px; text-align: center; ">
        Assinatura Espíndola Imobiliária	
        </label>
        <br>
        -----------------------------------------------------
    </p>
    <p style="font-size: 10px;text-align: left; ">
        <strong>* ATENÇÃO *</strong><br>
        - Não liberar visitas após às 19h00. <br>
        - Não liberar a retirada de bens do imóvel sem expressa autorização do proprietário.  <br>
        - Em caso de dúvida entrar em contato conosco.<br>
        
        <br>
    </p>

    <p>
    @if(isset($_GET['auto']) && $_GET['auto'] == 'true')
        <img src="{{url('dist/img/logo_grande.jpg')}}" width="110" height="54" >	
    @endif    
    </p>
    <p>
        <label  style="font-size: 10px;">Emitido em {{date('d/m/Y H:i:s')}}</label>
    </p>
</td>
<td class="td_space"> </td>

