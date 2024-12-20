import { crud } from "../../../app/crud";
import { gSelector } from "../../../app/selector";
import { translate } from "../../../app/localisation";


const removeUserModal = function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    const $modal = $(gSelector.modal.delete).modal('show');
    const url = $(e.target).closest('a').attr('href');

    $modal.find(gSelector.modal.success.general).html("").hide();
    $modal.find(gSelector.modal.errors.general).html("").hide();

    $modal.find('.js_btn_modal_confirm').off('click').on('click', function (ev) {
        crud.delete(url)
            .done(function (response) {
                $modal.find(gSelector.modal.success.general).html(response.message).show();
                $modal.modal('hide');
                window.location.reload();
            })
            .fail(function (response) {
                let errorsHtml = '';
                if (response.hasOwnProperty('responseJSON')) {
                    if (response.responseJSON.hasOwnProperty('errors')) {
                        let errors = response.responseJSON.errors;
                        for (let prop in errors) {
                            if (errors.hasOwnProperty(prop)) {
                                errorsHtml += '<div>' + errors[prop] + '</div>';
                            }
                        }
                    } else if (response.responseJSON.hasOwnProperty('message')) {
                        errorsHtml = response.responseJSON.message;
                    } else {
                        errorsHtml = translate('error_general');
                    }
                } else {
                    if ($.parseJSON(response.responseText)){
                        errorsHtml = $.parseJSON(response.responseText).generalError;
                    } else {
                        errorsHtml = translate('error_general');
                    }
                }
                $modal.find(gSelector.modal.errors.general).html(errorsHtml).show();
            });
    });
}


export { removeUserModal };