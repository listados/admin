@extends('layouts.user_survey_template')
@section('content')

<div class="container container-xs-height">
<br><br><br>
    <div class="row row-xs-height">
        <div class="col-xs-12 col-md-12 col-lg-12 col-xs-height">
            <div class="item">
                <div class="content blocoDestaquePersonalizado container-fluid">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h1>Área do locatário</h1>
                        <span id="botoesTopo" class="pull-right"></span>
                        <div class="login_container col-lg-12">
                            <form id="Areadocliente_Forms_Auth_Entrar" action="{{ url('/portal/auth') }}" method="post" msgsucessoff="1" comportamentos="Form.submeterUsandoGet Form.collapsible" data='{&quot;email&quot;:&quot;&quot;}' titulo="" focar="1" class=" superlogica-form-horizontal superlogica-form-placeholder" msgsucesso="Salvou com sucesso" aposCarregar="Form.popularAoCarregar ">
                                <dl class="zend_form panel-body"> {{ csrf_field() }}
                                    <div class="item form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="formElement">
                                             <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" comportamentos="verificarCadastro" autofocus="autofocus" placeholder="Digite o seu e-mail">
                                              	@if ($errors->has('email'))
							                        <span class="help-block" style="color: #fff;">
							                        <strong>{{ $errors->first('email') }}</strong>
							                        </span>
						                        @endif
                                        </div>
                                    </div>
                                    <div class="item form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="formElement">
                                             <input type="text" class="form-control" name="cpf" id="cpf" value="{{ old('email') }}" comportamentos="verificarCadastro" autofocus="autofocus" placeholder="Digite o seu cpf">
                                             @if ($errors->has('password'))
					                        <span class="help-block"  style="color: #fff;">
					                        <strong>{{ $errors->first('password') }}</strong>
					                        </span>
					                        @endif
                                        </div>
                                    </div>

                                    <div class="formDisplayGroup clearFix botoesPadroes">
                                        <fieldset id="fieldset-BtsPadroes" class=" collapsible collapse_fixed ">
                                            <button type="submit" class="btn-form btn btn-primary-login"  id="salvar">
                        						<i class="fa fa-btn fa-sign-in"></i>Entrar
                        					</button>
                                        </fieldset>
                                    </div>
                                </dl>
                            </form>
                            <br clear="all">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
