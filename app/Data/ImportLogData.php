<?php


namespace App\Data;



class ImportLogData
{
    public function __construct(
        public string $status,
        public string|null $file_csv,
        public string|null $file_error_csv,
        public string $import_type,
        public int $user_id,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            status: $data['status'],
            file_csv: $data['file_csv'] ?? null,
            file_error_csv: $data['file_error_csv'] ?? null,
            import_type: $data['import_type'],
            user_id: user()->id
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
