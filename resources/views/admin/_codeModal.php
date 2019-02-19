<!-- Modal -->
<div class="js-wxa-code-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="wxa-code-modal-label"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="wxa-code-modal-label">查看小程序码</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img class="js-wxa-code-image img-fluid" src="">
      </div>
      <div class="modal-footer">
        <a class="js-wxa-code-download btn btn-success">下载</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>

<?= $block->js() ?>
<script>
  $('body').on('click', '.js-wxa-code-show', function () {
    var url = $.url('admin/wxa-codes/show-image', {path: $(this).data('path')});
    $('.js-wxa-code-image').attr('src', url);
    $('.js-wxa-code-download').attr('href', $.appendUrl(url, {download: 1}));
    $('.js-wxa-code-modal').modal('show');
  });
</script>
<?= $block->end() ?>

