<?php

namespace App\Console\Commands;

use App\Enums\SettingsEnum;
use App\Models\DynamicConfig;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mail = json_decode(DB::table('settings')->where('key', SettingsEnum::IMPORT_ERROR_MAIL->value)->first()->value)->mail;
        dd($mail->to);

        DynamicConfig::create([
            'key' => 'orders',
            'value' => json_encode([
                'labels' => 'Import Orders',
                'permission_required' => 'imports_order',
                'files' => [
                    'file1' => [
                        'label' => 'File 1',
                        'required_headers' => ['Order Date', 'Channel', 'SKU', 'Item description', 'Origin', 'SO#', 'Cost', 'Shipping Cost', 'Total Price'],
                        'headers_to_db' => [
                            'order_date' => 'Order Date',
                            'channel'   => 'Channel',
                            'sku'       => 'SKU',
                            'item_description' => 'Item description',
                            'origin'    => 'Origin',
                            'so_num'    => 'SO',
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
                            'cost'      => ['required', 'numeric'],
                            'shipping_cost' => ['required', 'numeric'],
                            'total_price' => ['required', 'numeric']
                        ],
                        'update_or_create' => ['so_num', 'sku'],
                    ],
                    'file2' => [
                        'label' => 'File 2',
                        'required_headers' => ['Order Date', 'Channel', 'SKU', 'Origin', 'SO#', 'Cost', 'Shipping Cost', 'Total Price'],
                        'headers_to_db' => [
                            'order_date' => 'Order Date',
                            'channel'   => 'Channel',
                            'sku'       => 'SKU',
                            'item_description' => 'Item description',
                            'origin'    => 'Origin',
                            'so_num'    => 'SO',
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
                            'cost'      => ['required', 'numeric'],
                            'shipping_cost' => ['required', 'numeric'],
                            'total_price' => ['required', 'numeric']
                        ],
                        'update_or_create' => ['so_num', 'sku'],
                    ]
                ]
            ])
        ]);
    }
}
