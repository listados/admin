@extends('layouts.admin_template')

@section('content')

@push('style')
{{  Html::script('public/plugins/daterangepicker/daterangepicker-bs3.css') }}
@endpush

<!-- Sidebar -->
@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
  	<div id="result">
    Nome: <span id="nome"></span>
</div>
  </section>

  </div>
@push('script')

<script src="//irql.bipbop.com.br/js/jquery.bipbop.min.js"></script>
<script>
	$(document).bipbop("SELECT FROM 'BIPBOPJS'.'CPFCNPJ'", BIPBOP_FREE, {
    data: {
        "documento": "06990590000123"
    },
    
    success: function (ret) {
        $("#result #nome").text($(ret).find("body nome").text());
    }
});
</script>
@endpush
  @endsection
