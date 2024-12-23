import { gSelector } from "../../../app/selector";
import { selector } from './selector';
import * as deleteModal from "../../../app/delete-modal";

const PageAdminUsers = (function ($) {

    function initEvents() {
        $(document).on('click', gSelector.btn.delete, deleteModal.deleteModal);
    }

    function initialize() {

        initEvents();
    }

    return {
        init: initialize
    }
})(jQuery);

export { PageAdminUsers };