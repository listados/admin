<!-- /.box -->
<div class="modal fade" id="upload" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload de Arquivos</h4>
            </div>
            <div class="modal-body">
                <input id="new_files" name="new_files[]" type="file" multiple class="file-loading">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" ><a href="{{ url('download-arquivo/'.$id_survey.'/proposta-pf') }}">Sair</a></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->