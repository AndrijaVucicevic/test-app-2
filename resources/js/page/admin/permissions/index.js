import * as events from "./events";
import { gSelector } from "../../../app/selector";
import * as deleteModal from "../../../app/delete-modal";

const PageAdminPermissions = (function ($) {
    
    function initEvents() {
        $(document).on('click', gSelector.btn.delete, deleteModal.deleteModal);
        $(document).on('click', gSelector.btn.edit, events.editPermission);
    }

    function initialize() {
        initEvents();
    }

    return {
        init: initialize
    }
})(jQuery);

export {PageAdminPermissions};