import { gSelector } from "../../../app/selector";
import { selector } from './selector';
import * as deleteModal from "../../../app/delete-modal";
import {datatableSettings} from "../../../app/datatable";


const PageAdminUsers = (function ($) {

    function initEvents() {
        $(document).on('click', gSelector.btn.delete, deleteModal.deleteModal);

        let settings = {
            ajax: "/api/users/data",
            columns: [{
                    data: 'firstName',
                    name: 'first_name',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'lastName',
                    name: 'last_name',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'email',
                    name: 'email',
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
                            <a href="/users/${data}/edit" class="btn btn-sm btn-primary"><i class="fa fa-edit"> </i></a>
                            <a href="/users/${data}" class="btn btn-sm btn-danger js_action_delete"><i class="fa fa-trash"></i></a>
                        `;
                    }
                },
            ],
        };
        $(selector.table).DataTable($.extend({}, datatableSettings, settings));

    }

    function initialize() {

        initEvents();
    }

    return {
        init: initialize
    }
})(jQuery);

export { PageAdminUsers };