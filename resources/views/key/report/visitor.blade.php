<p  style="font-size: 11px; text-align: left; ">
    Visitante: <strong> {{$client[0]->clients_name}} </strong><br>
    CPF: {{$client[0]->clients_cpf}}<br>
    Telefones:
    @foreach($phone as $phones)
        {{ $phones->phone_number }}
    @endforeach<br>
    Endereço: {{$client[0]->clients_address}}, Nº. {{$client[0]->clients_address_number}}, comp. {{$client[0]->clients_address_complement}}, {{$client[0]->clients_district}}, {{$client[0]->clients_city}}, {{$client[0]->clients_state}}

    -------------------------------------------------------------------------------------
</p>