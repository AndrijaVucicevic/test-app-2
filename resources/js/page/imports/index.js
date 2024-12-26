import * as events from "./events";
import { selector } from "./selector";

const PageImports = (function ($) {
    
    function initEvents() {
        $(document).on('change', selector.selectType, events.editHeaders);
    }

    function initialize() {
        initEvents();

    }

    return {
        init: initialize
    }
})(jQuery);

export {PageImports};