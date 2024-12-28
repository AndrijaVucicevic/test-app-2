<div class="modal fade m-auto" id="modal_show_config" tabindex="-1" role="dialog" aria-labelledby="modal_show_config">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning" id="modal_show_config_label">
                    {{ __('messages.import_config') }}
                </h5>
                <button type="button" class="close js_modal_show_config_cancel" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <pre class="show-config"></pre>
                <div class="alert alert-danger js_modal_general_error" style="display: none;"></div>
                <div class="alert alert-success js_modal_general_success" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold js_modal_show_config_cancel" data-dismiss="modal">
                    {{ __('messages.btn_cancel') }}
                </button>
            </div>
        </div>
    </div>
</div>