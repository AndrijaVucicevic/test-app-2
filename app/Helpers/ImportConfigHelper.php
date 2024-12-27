<?php


namespace App\Helpers;

use App\Models\DynamicConfig;

class ImportConfigHelper
{


    public static function getFiles()
    {

        $importTypes = DynamicConfig::all();
        foreach ($importTypes as $record) {
            $key = $record->key;
            $files = json_decode($record->value, true)['files'];

            foreach ($files as $fileKey => $fileInfo) {
                $data[] = [
                    'key' => $key,
                    'fileKey' => $fileKey,
                    'mainKey' => $key . '_' . $fileKey,
                    'label' => __('messages.import_types.' . $key) . ' - ' . $fileInfo['label'],
                    'required_headers' => implode(',', $fileInfo['required_headers']),
                ];
            }
        }
    }
}
