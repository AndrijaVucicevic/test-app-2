<div class="modal fade m-auto" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning" id="modal_edit_label">
                    {{ __('messages.modal_form_edit_title') }}
                </h5>
                <button type="button" class="close js_modal_edit_cancel" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="modal_edit_form" method="POST">
                    @csrf
                    <div class="col-10" id="modal_edit_form_fields">

                    </div>
                </form>
                <div class="alert alert-danger js_modal_general_error" style="display: none;"></div>
                <div class="alert alert-success js_modal_general_success" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-warning btn-ok font-weight-bold js_btn_modal_confirm">
                    {{ __('messages.btn_confirm') }}
                </a>
                <button type="button" class="btn btn-light-primary font-weight-bold js_modal_edit_cancel" data-dismiss="modal">
                    {{ __('messages.btn_cancel') }}
                </button>
            </div>
        </div>
    </div>
</div>