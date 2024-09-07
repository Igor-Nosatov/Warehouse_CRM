<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Inventory;

class ProductImageDto
{
    public function __construct(
        public string $name,
        public string $fileName,
        public string $mimeType,
        public string $path,
        public string $disk,
        public string $url,
        public int $size,
        public int $productId
    ) {}

    /**
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'file_name' => $this->fileName,
            'mime_type' => $this->mimeType,
            'path' => $this->path,
            'disk' => $this->disk,
            'url' => $this->url,
            'size' => $this->size,
            'product_id' => $this->productId,
        ];
    }
}
