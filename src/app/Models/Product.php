<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $sku
 * @property string $description
 * @property string $size
 * @property string $photo
 * @property string $updated_at
 */
final class Product extends Model
{
    public const string FIELD_ID = 'id';
    public const string FIELD_SKU = 'sku';
    public const string FIELD_DESCRIPTION = 'description';
    public const string FIELD_TAGS = 'tags';
    public const string FIELD_STOCKS = 'stocks';

    public $timestamps = false;

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
