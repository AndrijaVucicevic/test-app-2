<?php


namespace App\Services;


use App\Enums\Audit\TrackingAttributeEnum;
use App\Interfaces\AuditServiceInterface;
use App\Models\AuditLog;


class AuditService implements AuditServiceInterface
{
    private string $trackAttributesType;

    public function trackAttributes(string $type): AuditService
    {
        $this->trackAttributesType = $type;
        return $this;
    }

    public function getTrackAttributesChanges(array $before, array $after): array
    {
        $trackedAttributes = TrackingAttributeEnum::from($this->trackAttributesType)->attributes();
        $changes = [];

        foreach ($after as $attribute => $newValue) {

            if (array_key_exists($attribute, $before) && in_array($attribute, array_keys($trackedAttributes))) {
                $oldValue = $before[$attribute];

                if ($oldValue != $newValue) {
                    $changes[$trackedAttributes[$attribute]] = [
                        'before' => $oldValue,
                        'after' => $newValue,
                    ];
                }
            }
        }

        return $changes;
    }

    public function log(
        string      $type,
        array       $meta = [],
        int         $ownerId,
        int|null    $userId = null,
        int|null    $orderId = null,
        int|null    $importLogId = null,
    ): void {
        if (!empty($this->trackAttributesType)) {
            $before = $meta['before'] ?? null;
            $after = $meta['after'] ?? null;
            if ($before && $after) {
                $changes = $this->getTrackAttributesChanges($before, $after);
                if (!empty($changes)) {
                    $metaHtml = view('admin.logs.audit.meta-html', [
                        'changes' => $this->getTrackAttributesChanges($before, $after),
                    ])->render();
                }
            }
        }

        AuditLog::create([
            'action_type' => $type,
            'meta' => $meta,
            'meta_html' => $metaHtml ?? '',
            'owner' => $ownerId,
            'user_id' => $userId,
            'orderId' => $orderId,
        ]);
    }

    public function logBulk(string $type, array $data): void
    {
        $dataTimestamps = array_map(function (array $item) use ($type) {
            $item['action_type'] = $type;
            $item['created_at'] = 'now()';
            if (isset($item['meta']) && is_array($item['meta'])) {
                $item['meta'] = json_encode($item['meta']);
            }
            return $item;
        }, $data);

        AuditLog::insert($dataTimestamps);
    }

}
