import { selector } from './selector';

const PageAdminEditUser = (function ($) {

    function initEvents() {
    }

    function initialize() {
        var userId = $(selector.userId).val()
        var permissionsSelect = $(selector.ddl.permissions).select2({
            ajax: {
                url: `/api/users/${userId}/permissions`,
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }

                    return query;
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 10) < data.count_filtered
                        }
                    };

                },
                cache: true
            }
        });

        initEvents();
    }

    return {
        init: initialize
    }
})(jQuery);

export { PageAdminEditUser };