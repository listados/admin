<!-- Modal -->
<div class="modal fade" id="modal_details_immobiles" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="clearInfoModal();"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titleImobile">Titulo do Imóvel</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label id="addressImmobile">Rua Centro, nº 0001, Centro, Fortaleza/CE - CEP: 60000000</label> - <a id="locationImmobile" target="_blank"> Localização</a>
                        </p>
                    </div>
                </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Informações</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Fotos/Chaves</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Mapa</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Mais Opções <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Rel. Avaliação Visita</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Informações básicas</strong></p>
                                <p>
                                    <div class="list-group list-cust">
                                        <ul class="list-group">
                                            <p  id="areaImmobile">50,00 área terreno</li>
                                                <p  id="salePriceImmobile">$ Venda: Não informado</li>
                                                    <p  id="rentalImmobile">$ Locação</li>
                                                        <p  id="iptuImmobile">IPTU:</li>
                                                            <p  id="condomiumImmobile">Condomínio:</li>
                                                                <p  id="packImmobile">Pacote loc.:</li>
                                                                </ul>
                                                            </div>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><strong>Mais Informações</strong></p>
                                                        <p> 
                                                            <div class="list-group">
                                                                <ul class="list-group">
                                                                    <p  id="nameCondominium">Nome do Cond: </li>
                                                                        <p  id="finalityImmobile">Finalidade:</li>
                                                                            <p  id="pointRefImmobile">Ponto de Ref:</li>
                                                                                <p  id="defaultImmobile">Padrão do Imóvel:</li>
                                                                                    <p >Tipos de garantia: Fiador, Caução</li>
                                                                                        <p  id="faceImmobile">Face do Imóvel</li>
                                                                                            <p  id="qtdToiletImmobile">Banheiros: </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <p><strong>Descrição</strong></p>
                                                                                    <p id="descriptionImmobile"></p>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <p>
                                                                                        <strong>Link do Site:</strong> <a id="linkImmobile" target="_blank">http://www.alugaemfortaleza.com/imovel-detalhes.aspx?ref=</a>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.tab-pane -->
                                                                        <div class="tab-pane" id="tab_2">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="col-md-9" >
                                                                                        <h3>Fotos</h3>
                                                                                        <div class="row">
                                                                                            
                                                                                        <div id="photos-immobiles"></div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <h3>Chaves</h3>
                                                                                                <ul class="list-group" id="infoKey">                      
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.tab-pane -->
                                                                        <div class="tab-pane" id="tab_3">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <h3>Tab Mapa</h3>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.tab-pane -->
                                                                    </div>
                                                                    <!-- /.tab-content -->
                                                                </div>
                                                                <!-- nav-tabs-custom -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"  onclick="clearInfoModal();" data-dismiss="modal">Sair</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.content-wrapper -->
