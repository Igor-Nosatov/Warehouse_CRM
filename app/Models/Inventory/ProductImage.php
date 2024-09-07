<?php

declare (strict_types = 1);

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductImage
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $file_name
 * @property string $mime_type
 * @property string $path
 * @property string $disk
 * @property string|null $collection
 * @property int $product_id
 */
class ProductImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'path',
        'disk',
        'url',
        'size',
        'product_id',
    ];

    protected $casts = [
        'name' => 'string',
        'file_name' => 'string',
        'mime_type' => 'string',
        'path' => 'string',
        'disk' => 'string',
        'url' => 'string',
        'size' => 'string',
        'product_id' => 'integer',
    ];

    /**
     * Get the product that owns the image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}


