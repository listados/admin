<!-- Modal GERAR RELATORIO DELIVERY-->
<div class="modal fade" id="modal_rel_delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Relatório</h4>
            </div>
            {{ Form::open(['url' => 'delivery/report'] , ['class' => 'form-control' ]) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            {{ Form::label('mes' , 'Mês') }}
                            {{ Form::select('month_delivery', 
                            [ 1 => 'Janeiro',
                            2 => 'Fevereiro',
                            3 => 'Março',
                            4 => 'Abril',
                            5 => 'Maio',
                            6 => 'Junho',
                            7 => 'Julho',
                            8 => 'Agosto',
                            9 => 'Setembro',
                            10 => 'Outubro',
                            11 => 'Novembro',
                            0 => 'Dezembro'
                            ]  
                            , $mes_anterior, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('ano' , 'Ano') }}
                            {{ Form::selectRange('year_delivery', 2000, 2040, 2017,['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="funkyradio">
                                <div class="funkyradio-primary">
                                    <input type="radio" name="type_delivery_report" value="0" id="radio1" />
                                    <label for="radio1">Analítico</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="funkyradio">
                                <div class="funkyradio-primary">
                                    <input type="radio" name="type_delivery_report" value="1" id="radio2" checked/>
                                    <label for="radio2">Sintético</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
