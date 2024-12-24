import * as events from "./events";
import { gSelector } from "../../../app/selector";
import * as deleteModal from "../../../app/delete-modal";
import {datatableSettings} from "../../../app/datatable";
import { selector } from "./selector";

const PageAdminPermissions = (function ($) {
    
    function initEvents() {
        $(document).on('click', gSelector.btn.delete, deleteModal.deleteModal);
        $(document).on('click', gSelector.btn.edit, events.editPermission);
    }

    function initialize() {
        initEvents();

        let settings = {
            ajax: "/api/permissions/data",
            columns: [{
                data: 'name',
                name: 'name',
                searchable: true,
                orderable: true
            },
            {
                data: 'guardName',
                name: 'guard_name',
                searchable: true,
                orderable: true
            },
            {
                data: 'createdAt',
                name: 'created_at',
                orderable: true
            },
                {
                    data: 'id',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <a href="/permissions/${data}/edit" class="btn btn-sm btn-primary" data-id="${data}"><i class="fa fa-edit"> </i></a>
                            <a href="/permissions/${data}" class="btn btn-sm btn-danger js_action_delete"><i class="fa fa-trash"></i></a>
                        `;
                    }
                },
            ],
        };

        $(selector.table).DataTable($.extend({}, datatableSettings, settings));
    }

    return {
        init: initialize
    }
})(jQuery);

export {PageAdminPermissions};