<div class="modal fade m-auto" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modal_delete_label">
                    {{ __('messages.modal_delete_title') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <h4 class="text-danger">{{ __('messages.confirm_delete_message') }}</h4>
                </div>
                <div class="alert alert-danger js_modal_general_error" style="display: none;"></div>
                <div class="alert alert-success js_modal_general_success" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-ok font-weight-bold js_btn_modal_confirm">
                    {{ __('messages.btn_confirm') }}
                </a>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                    {{ __('messages.btn_cancel') }}
                </button>
            </div>
        </div>
    </div>
</div>