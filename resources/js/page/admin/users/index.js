import * as events from "./events";
import { gSelector } from "../../../app/selector";

const PageAdminUsers = (function ($) {
    
    function initEvents() {
        $(document).on('click', gSelector.btn.delete, events.removeUserModal);
    }

    function initialize() {
        initEvents();
    }

    return {
        init: initialize
    }
})(jQuery);

export {PageAdminUsers};