<script type="text/javascript">
    $(function () {
        $("#send_file_upload").hide();
        $('[data-toggle="popover"]').popover();
        $('#icon-info').popover({ trigger: "hover" });
        $("#ambience_upload").change(function(){
            if( $("#ambience_upload").val() != "")
            {
                $("#send_file_upload").show();
            }else{
                $("#send_file_upload").hide();
            }
        });
    })
</script>
<!-- -->
<script type="text/javascript" src="../../../vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../../../vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
{{ Html::style('plugins/iCheck/flat/blue.css') }}
{{ Html::style('dist/css/upload_ambience.css') }}

{{ Html::script('dist/js/survey.min.js') }}

<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/key.min.css') }}">