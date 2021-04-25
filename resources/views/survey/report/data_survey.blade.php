 @foreach($users as $user)
            @if($user->relation_survey_user_type == 'Locador')
            <tr style="margin: 5px;">
                <td colspan="3" class="participantes" >
                    <strong> Locador(a): </strong>{{$user->name }}, inscrito(a) no CPF/CNPJ sob o nº. {{$user->relation_survey_user_cpf }}                   
                </td>
            </tr>
            @endif
            @endforeach

            @foreach($users as $user)
            @if($user->relation_survey_user_type == 'Locatário')
            <tr>
                <td colspan="3" class="participantes" >
                    <strong> Locatário(a): </strong>{{$user->name }}, inscrito(a) no CPF/CNPJ sob o nº. {{$user->relation_survey_user_cpf }}                    
                </td>
            </tr>
            @endif
            @endforeach

            @foreach($users as $user)
            @if($user->relation_survey_user_type == 'Fiador')
            <tr>
                <td colspan="3" class="participantes" >
                    <strong> Fiador(a): </strong>{{$user->name }}, inscrito(a) no CPF/CNPJ sob o nº. {{$user->relation_survey_user_cpf }}                         
                </td>
            </tr>
            @endif
            @endforeach 
            <tr>
                <td colspan="3" class="participantes" >
                    <strong> Vistoriador(a): </strong>{{$survey[0]->survey_inspetor_name }}, inscrito(a) no CPF/CNPJ sob o nº.  {{$survey[0]->survey_inspetor_cpf }}                            
                </td>
            </tr>
            <tr>
                <td><strong>Data:</strong> {{ date("d/m/Y" , strtotime($survey[0]->survey_date)) }}</td>
                <td><strong>Código Vistoria: </strong>{{$survey[0]->survey_code }}</td>
                <td><strong>Tipo de Vistoria: </strong>{{$survey[0]->survey_type }} </td>
            </tr>