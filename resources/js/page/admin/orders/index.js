import { gSelector } from "../../../app/selector";
import * as deleteModal from "../../../app/delete-modal";
import { datatableSettings } from "../../../app/datatable";
import { selector } from "./selector";

const PageOrders = (function ($) {

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

export { PageOrders };