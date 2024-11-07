
<td class="td_data">
    <strong style="font-size: 12px;">ESPÍNDOLA IMOBILIÁRIA LTDA.</strong>
    <p style="font-size: 10px;">
        CNPJ 09.652.345/0001-02 <br>
        Av. Santos Dumont, nº 2828, Loja 12<br>
        FORTALEZA – CEARÁ – BRASIL CEP: 60.150-161<br>
        Tel. 85 3461.1166 | www.espindolaimobiliária.com.br
    </p>
    <hr>
    <p   style="font-size: 12px;">
        <strong>RECIBO CHAVES PARA VISITAÇÃO</strong>
    </p>
    <hr>
    <p style="font-size: 10px; text-align: left;">
        <strong>
            Imóvel: {{$key[0]->keys_cod_immobile .' - '.
            $immobile['immobiles_type_immobiles']}} –
            {{$immobile['immobiles_address'].','}}
            {{(!empty($immobile['immobiles_number']) ? $immobile['immobiles_number'].',' : null)}}
            {{(!empty($immobile['immobiles_complement']) ? $immobile['immobiles_complement'].',' : '' )}}
            {{(!empty($immobile['immobiles_district']) ? $immobile['immobiles_district'].',' : null )}}
            {{(!empty($immobile['immobiles_city']) ? $immobile['immobiles_city'].',' : null )}}
            ({{$immobile['immobiles_state']}})
        CEP: {{$immobile['immobiles_cep']}}</strong><br>
        Caução: {{number_format($reserve[0]->reserves_value_guarante, '2' , ',' , '.')}}<br>
        <strong>Previsão para devolução: {{date('d/m/Y H:i' , strtotime($reserve[0]->reserves_date_devolution) )}}</strong>
    </p>
    <p style="font-size: 11px;">
        Recebi da ESPÍNDOLA IMOBILIÁRIA as chaves do imóvel especificado acima, para visitação do mesmo,
        comprometendo-me a devolvê-las no prazo acima previsto. Caso ocorra atraso na devolução, perdas ou danos
        causados na mesma, a caução paga neste ato não será devolvida e ainda terei que indenizar o proprietário por eventual prejuízo causado a este.
    </p>
    <p style="text-align: center; ">
        __________________________________
        <br>
        <label  style="font-size: 10px; font-family: 'Calibri,Candara,Segoe,Segoe UI,Optima',Arial,sans-serif; text-align: center; ">
        Assinatura do Visitante
        </label>
    </p>
    {{-- DADOS DO VISITANTE --}}
    @include('key.report.visitor')
    {{-- DADOS DO VISITANTE --}}
    <p>
        <label style=" text-align: center; font-size: 10px; ">
        Horário Fuc.: Seg a Sex das 8h as 18h<br>
        Sabados das 9h as 13h<br>
        </label>
        --------------------------------------------------------
    </p>
    <p>
        <label  style="font-size: 10px;">Emitido em {{date('d/m/Y H:i:s')}}</label>
    </p>
</td>
<td class="td_space"> </td>
