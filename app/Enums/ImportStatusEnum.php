<?php


namespace App\Enums;


enum ImportStatusEnum: int
{

    case IN_PROGRESS = 1;
    case SUCCESS = 3;
    case ERROR = 2;

    public function name(): string
    {
        return match ($this) {
            self::IN_PROGRESS => __('messages.franchiser_tag_import_in_progress'),
            self::SUCCESS => __('messages.franchiser_tag_import_uploaded'),
            self::ERROR => __('messages.franchiser_tag_import_download'),
        };
    }

    public function iconHtml(): string
    {
        return match ($this) {
            self::IN_PROGRESS => '<span class="fa fa-hourglass me-2 text-info"></span>',
            self::SUCCESS => '<span class="fa fa-check me-2 text-success"></span>',
            self::ERROR => '<span class="fa fa-warning me-2 text-danger"></span>',
        };
    }
}
