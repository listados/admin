<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Vusialização Vistoria</title>
<style>
    .tr_title{
        text-align: center;background: #C5C5C5;
    }
</style>
</head>
<body>
	<table>
                    <tr>
                        <td style="width:45%;"><img src="{{ url('dist/img/logo_grande.jpg') }}" alt="" height="64"></td>
                        <td><h3>Termo de Vistoria</h3></td> 
                        <td></td>                      
                    </tr>
                    <tr>
                        <td class="tr_title" colspan="3" >Dados Vistoria</td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                           <strong> Locador(a): </strong>{{ $survey->survey_locator_name }} , CPF: {{ $survey->survey_locator_cpf }}                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            <strong> Locatário(a): </strong>{{ $survey->survey_occupant_name }} , CPF:  {{ $survey->survey_occupant_cpf }}                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            <strong> Fiador(a): </strong>{{ $survey->survey_guarantor_name }} , CPF:  {{ $survey->survey_guarantor_cpf }}                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            <strong> Vistoriador(a): </strong>{{ $survey->survey_inspetor_name }} , CPF:  {{ $survey->survey_inspetor_cpf }}                            
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Data:</strong> {{ date("d/m/Y" , strtotime($survey->_survey_date)) }}</td>
                        <td><strong>Código Vistoria: </strong>{{ $survey->survey_id }}</td>
                        <td><strong>Tipo de Vistoria: </strong>{{ $survey->survey_type }} </td>
                    </tr>

                    <tr >
                        <td class="tr_title"  colspan="3" class="text-center">Dados do Imóvel</td>
                    </tr>
                    <tr>
                        <td>
                           <strong> Endereço do Imóvel: </strong>{{ $survey->survey_address_immobile }}                           
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <strong> Tipo do imóvel: </strong>{{ $survey->survey_type_immobile }}                             
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <strong> Medidor de Energia: </strong>{{ $survey->survey_energy_meter }}                          
                        </td>                      
                        <td>
                           <strong> Leitura de Energia: </strong>{{ $survey->survey_energy_load }}     
                        </td>
                     </tr>
                    <tr>
                         <td>
                           <strong> Medidor de Água: </strong>{{ $survey->survey_water_meter }}                          
                        </td>
                        <td>
                           <strong> Leitura de Água: </strong>{{ $survey->survey_water_load }}     
                        </td>
                     </tr>
                     <tr>
                         <td>
                           <strong> Medidor de Gás: </strong>{{ $survey->survey_gas_meter }}                          
                        </td>
                        <td>
                           <strong> Leitura de Gás: </strong>{{ $survey->survey_gas_load }}     
                        </td>
                    </tr>

                    <tr>
                        <td class="tr_title"  colspan="3" class="text-center">Aspectos Gerais</td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            {!! $survey->survey_general_aspects !!}
                             
                        </td>
                    </tr>
                    <tr>
                        <td class="tr_title"  colspan="3" class="text-center">Ressalva por Ambiente / Cômodos</td>
                    </tr> 
                     <tr>
                        <td colspan="3">
                            {!! $survey->survey_reservation !!}
                             
                        </td>
                    </tr>
                     <tr>
                        <td style="background: #C5C5C5;" colspan="3" class="text-center">Disposições Gerais</td>
                    </tr> 
                    <tr>
                        <td colspan="3">
                            <p>O imóvel possui condições de uso e habitabilidade, e se encontra em perfeito estado de conservação com tudo funcionando, <u><strong>ressalvado</strong> eventuais defeitos existentes que estão expressos no presente termo.</u> </p>
                        </td>
                    </tr>
                    <tr>
                       <td colspan="3">
                            <p>As imagens comuns e as em 360º estão hospedadas no site do Google (Google Inc), todas publicadas até a presente data, são provas digitais aceitas por todas as partes e que servirão como principal fonte para esclarecer dúvidas que possam surgir ao final da locação, cabendo subsidiariamente a utilização do texto existente neste termo. Parágrafo Único – Caso a hospedagem venha a ser extinta, os arquivos poderão ser transferidos para outra hospedagem a critério do Locador.
                            </p>
                        </td> 
                    </tr>
                    <tr>                        
                        <td colspan="3">
                            <p>As imagens comuns e as em 360º estão hospedadas no site do Google (Google Inc), todas publicadas até a presente data, são provas digitais aceitas por todas as partes e que servirão como principal fonte para esclarecer dúvidas que possam surgir ao final da locação, cabendo subsidiariamente a utilização do texto existente neste termo. Parágrafo Único – Caso a hospedagem venha a ser extinta, os arquivos poderão ser transferidos para outra hospedagem a critério do Locador.
                            </p>
                        </td>
                    </tr>
                    <tr>                        
                        <td colspan="3">
                            <p>O(s) locatário(s) dispõe(m) de 05 (cinco) dias úteis, a partir desta data, para contestação, por escrito, do presente termo de vistoria, qual só terá efeito após reconhecimento por escrito pelo Locador(a) ou pela sua procuradora (imobiliária).
                            </p>
                        </td>
                    </tr>
                    <tr>                        
                        <td colspan="3">
                            <p>É vedado ao(s) LOCATÁRIO(S) realizar(em) qualquer tipo de furo nas cerâmicas do imóvel, sob pena de ter(em) que substituir as cerâmicas danificadas por novas da mesma cor e modelo.
                            </p>
                        </td>
                    </tr>
                    <tr>                        
                        <td colspan="3">
                            <p>Os locatários declaram que receberam neste ato as chaves e os demais itens móveis acima especificados, e que estão cientes de que o aluguel e encargos começam a ser cobrados a partir desta data.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"  colspan="3">
                        <br><br>
                        {{ $survey->data_extenso() }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 12px;">
                            <br><br><br>
                            @if($survey->survey_status == 'Finalizada')
                            <small>Vistoria Finalizada em: {{ $survey->survey_finalized_date }} </small>
                            @else
                            <small>Rascunho de Vistoria </small>
                            @endif
                        </td>
                    </tr>
                </table>  
</body>
</html>