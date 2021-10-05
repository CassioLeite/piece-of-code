<div id="delete-modal-images" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Deseja deletar TODAS as imagens?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button id="delete-confirm-images" type="button" class="btn btn-danger">Deletar todas</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  
  @section('script')
  @parent
  <script>
    $(document).ready(function(){
        $(function(){
            $('.delete-button-images').on('click', function (event) {
                event.preventDefault();
                var id = $(this).attr('id');
  
                $('#delete-modal-images').modal('toggle');
                $('#delete-confirm-images').click(function() {
                    var form = $('#delete-form-' + id);
                    form.submit();
                });
            });
        });
    });
  </script>
  @endsection