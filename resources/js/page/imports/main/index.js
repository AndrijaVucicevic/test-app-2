import * as events from "./events";
import { selector } from "./selector";

const PageImportLogs = (function ($) {
    
    function initEvents() {
        $(document).on('click', selector.btnModalAction, events.showConfig);
    }

    function initialize() {
        initEvents();

    }

    return {
        init: initialize
    }
})(jQuery);

export { PageImportLogs };