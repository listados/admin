        <!-- Modal avaliaçao do Imóvel-->
        <div class="modal fade" id="confirm_receipt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Avaliação da Visita</h4>
                    </div>
                    {{ Form::open(['url' => '', 'id' => 'form_confirm_receipt_key']) }}
                    <div class="modal-body">
                      
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="form-group has-feedback">
                                    <label for="happy" class="control-label">Imóvel Visitado?</label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_visited" id="evaluations_visited_sim" checked="true" value="Sim">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Sim
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_visited" id="evaluations_visited_nao" value="Não">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Não
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="form-group has-feedback">
                                    <label for="happy" class="control-label">Se interessou?</label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_interested" id="interesse_sim" checked="true" value="Sim">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Sim
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_interested" id="interesse_nao" value="Não">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Não
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group has-feedback">
                                    <label for="happy" class="control-label">Valor do Imóvel</label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_value_immobile" id="valor_ruim"  value="Ruim">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Ruim
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_value_immobile" id="valor_bom" checked="true" value="Bom">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Bom
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_value_immobile" id="valor_otimo" value="Ótimo">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Ótimo
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group has-feedback">
                                    <label for="happy" class="control-label">Conservação do Imóvel</label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_conservation" id="conser_ruim"  value="Ruim">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Ruim
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_conservation" id="conser_bom" checked="true"  value="Bom">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Bom
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_conservation" id="conser_otimo" value="Ótimo">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Ótimo
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group has-feedback">
                                    <label for="happy" class="control-label">Localização do Imóvel</label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_location" id="loc_nao_ruim"  value="Ruim">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Ruim
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_location" id="loc_nao_bom" checked="true" value="Bom">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Bom
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                        <input type="radio" name="reserves_location" id="loc_nao_otimo" value="Ótimo">
                                        </span>
                                        <div class="form-control form-control-static">
                                            Ótimo
                                        </div>
                                        <span class="glyphicon form-control-feedback "></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 form-group">
                                <label>Parecer</label>
                                <textarea class="form-control" name="reserves_feedback"></textarea>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Indicaria para um amigo?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="Nome" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="Telefone" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="E-mail" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ Form::hidden('reserves_id_user' , Auth::user()->id) }}
                        <input type="hidden" name="reserves_id" id="evaluations_id_reserve">
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                        <button type="button" class="btn btn-primary" id="save_receipt_key">Salvar Avaliação</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>