<?php


namespace App\Data;

use Spatie\LaravelData\Data;

class LogItemData extends Data
{
    public string $metaDisplay;

    public function __construct(
        public int             $id,
        public string|null     $action_type,
        public string|null     $message,
        public int             $owner,
        public string|null     $created_at,
        public string|null     $update_at,
        public int|null        $user_id,
        public int|null        $import_log_id,
        public int|null        $order_id,
        public array|bool|null $content,
        public array|bool|null $meta,
        public string|null     $meta_html,
    ) {
        $this->metaDisplay = json_encode($meta, JSON_PRETTY_PRINT);
    }
}
