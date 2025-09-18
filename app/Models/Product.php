<?php

namespace App\Models;

use Brick\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /** @var array<int,string> */
    protected $fillable = [
        'title',
        'description',
        'price',
        'featured_photo',
    ];

    /** @var array<int,string> */
    protected $hidden = [];

    /** @var array<string,string> */
    protected $casts = [
        //'price' => MoneyCast::class,
    ];

    /** @var array<int,string> */
    protected $dates = [];

    /** @var array<int,string> */
    protected $appends = [
        'price_human',
        'featured_photo_url',
    ];

    /** @var array<int,string> */
    protected $with = [];

    /**
    |--------------------------------------------------------------------------
    | Class Constants
    |--------------------------------------------------------------------------
    |
    */

    //

    /**
    |--------------------------------------------------------------------------
    | Custom/Private Methods
    |--------------------------------------------------------------------------
    |
    */

    //

    /**
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Give the full URL of a featured product photo.
     *
     * @package App\Models\Product
     * @since 1.0.0
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function featuredPhotoUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => secure_url("storage/images/{$this->featured_photo}"),
        );
    }

    /**
     * Convert the product price to a human-friendly format.
     *
     * @package App\Models\Product
     * @since 1.0.0
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function priceHuman(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Money::ofMinor($this->price, 'USD')->formatTo('en_US'),
        );
    }

    /**
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    |
    */

    //

    /**
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    */

    //

    /**
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    */

    //
}
