import { crud } from "../../../app/crud";
import { gSelector } from "../../../app/selector";
import { translate } from "../../../app/localisation";
import { selector } from "./selector";


const editPermission = (e) => {
    e.preventDefault();

    const $modal = $(gSelector.modal.edit).modal('show');
    const permissionId = $(e.target).data('id');

    const url = $(e.target).attr('href');
    $modal.find(gSelector.modal.success.general).html("").hide();
    $modal.find(gSelector.modal.errors.general).html("").hide();
    API.service.permission.getPermission(url).done(function (response) {

        $modal.find(gSelector.modal.editFormFields).html(response.html)

        $modal.find(gSelector.btn.modal.confirm).off('click').on('click', {
            url: '/permissions/' + permissionId,
            modal: $modal,
        }, _updatePermission);

    })

}

const _updatePermission = (e) => {

    let guardName = $(selector.formFields.guardName).val()

    let $modal = e.data.modal;
    let data = new FormData()
    data.append('guard_name', guardName)

    crud.update(e.data.url, data)
        .done(function (response) {
            $modal.find(gSelector.modal.success.general).html(response.message).show();
            setTimeout(() => {
                $modal.modal('hide');
                window.location.reload();
            }, 3000)
        })
        .fail((jqXHR) => {
            const response = jqXHR.responseJSON
            if (response.generalError) {
                $modal.find(gSelector.modal.errors.general).html(response.generalError).show();
            } else if (response.errors) {
                let errors = response.errors;
                for (let prop in errors) {
                    if (errors.hasOwnProperty(prop)) {
                        let htmlAfter = '<div class="alert-danger">' + errors[prop] + '</div>';
                        $modal.find(gSelector.modal.errors.general).html(htmlAfter).show();
                    }
                }
            } else {
                $modal.find(gSelector.modal.errors.general).html(translate('error_general')).show();
            }
        }
        );
}

export { editPermission };