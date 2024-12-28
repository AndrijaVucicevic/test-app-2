<?php


namespace App\Data;

use App\Helpers\DateTimeHelper;
use App\Models\User;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class ImportLogData extends Data
{
    public function __construct(
        public int|null $id,
        public string $status,
        public string|null $file_csv,
        public string|null $file_error_csv,
        public string $import_type,
        public int $user_id,
        public User|null $user,
        #[MapInputName('created_at')]
        public string|null $createdAt
    ) {
        $this->createdAt = $this->createdAt ? DateTimeHelper::formatDateTime($this->createdAt) : '';
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            id: null,
            status: $data['status'],
            file_csv: $data['file_csv'] ?? null,
            file_error_csv: $data['file_error_csv'] ?? null,
            import_type: $data['import_type'],
            user_id: user()->id,
            user: null,
            createdAt: null
        );
    }

    public function toCreate(): array
    {
        return [
            'status' => $this->status,
            'file_csv' => $this->file_csv,
            'file_error_csv' => $this->file_error_csv,
            'import_type' => $this->import_type,
            'user_id' => $this->user_id
        ];
    }
}
