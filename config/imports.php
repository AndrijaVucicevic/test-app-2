<?php

return [
    'orders' => [
        'labels' => 'Import Orders',
        'permission_required' => 'imports_order',
        'files' => [
            'file1' => [
                'label' => 'File 1',
                'required_headers' => ['Order Data', 'Channel', 'SKU', 'Origin', 'SO#', 'Cost', 'Shipping Cost', 'Total Price'],
                'headers_to_db' => [
                    'order_date' => 'Order Data',
                    'channel'   => 'Channel',
                    'sku'       => 'SKU',
                    'item_description' => 'Item description',
                    'origin'    => 'Origin',
                    'so_num'    => 'SO#',
                    'cost'      => 'Cost',
                    'shipping_cost' => 'Shipping Cost',
                    'total_price' => 'Total Price'
                ],
                'validation' => [
                    'order_date' => ['required', 'date'],
                    'channel'   => ['required', 'in:PT,Amazon', 'string'],
                    'sku'       => ['required', 'exists:products,sku', 'string'],
                    'item_description' => ['nullable', 'string'],
                    'origin'    => ['required', 'string'],
                    'so_num'    => ['required', 'string'],
                    'cost'      => ['reuired', 'numeric'],
                    'shipping_cost' => ['required', 'numeric'],
                    'total_price' => ['required', 'numberic']
                ],
                'update_or_create' => ['so_num', 'sku'],
            ]
        ]
    ],
];
