<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key): ?string
        {
            return static::where('key', $key)->value('value'); // returns null if not found
        }
        public static function set(string $key, string $value): void
{
    static::updateOrCreate(
        ['key' => $key],
        ['value' => $value]
    );
}
}
