<?php

namespace Database\Seeders;

use App\Enums\SettingsEnum;
use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $value = ['mail' => ['to' => 'test@gmail.com', 'cc' => 'cc@gmail.com']];
        Settings::firstOrCreate(
            ['key' => SettingsEnum::IMPORT_ERROR_MAIL->value],
            ['value' => json_encode($value)]
        );
    }
}
