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

        let settings = {
            ajax: "/api/orders/data",
            columns: [{
                data: 'orderDate',
                name: 'order_date',
                searchable: false,
                orderable: true
            },
            {
                data: 'channel',
                name: 'channel',
                searchable: true,
                orderable: true
            },
            {
                data: 'sku',
                name: 'sku',
                searchable: true,
                orderable: true
            },
            {
                data: 'itemDescription',
                name: 'item_description',
                searchable: false,
                orderable: false
            },
            {
                data: 'origin',
                name: 'origin',
                searchable: false,
                orderable: false
            },
            {
                data: 'soNum',
                name: 'so_num',
                searchable: true,
                orderable: false
            },
            {
                data: 'cost',
                name: 'cost',
                searchable: false,
                orderable: false
            },
            {
                data: 'shippingCost',
                name: 'shipping_cost',
                searchable: false,
                orderable: false
            },
            {
                data: 'totalPrice',
                name: 'total_price',
                searchable: false,
                orderable: false
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
                render: function (data, type, row) {
                    return `
                            <a href="/permissions/${data}/edit" class="btn btn-sm btn-primary" data-id="${data}"><i class="fa fa-eye"> </i></a>
                            <a href="/orders/${data}" class="btn btn-sm btn-danger js_action_delete"><i class="fa fa-trash"></i></a>
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

export { PageOrders };