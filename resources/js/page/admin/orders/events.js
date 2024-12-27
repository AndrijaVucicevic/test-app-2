import { crud } from "../../../app/crud";
import { gSelector } from "../../../app/selector";
import { translate } from "../../../app/localisation";
import { selector } from "./selector";

const editPermission = (e) => {
    e.preventDefault();

    const $modal = $(gSelector.modal.edit).modal('show');
    const permissionId = $(e.target).data('id');


}



export { editPermission };