<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    public $timestamps = true;

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        $value = $setting->value;

        return match ($setting->type) {
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $value,
            'float' => (float) $value,
            'image' => $value ? asset('storage/' . $value) : $default,
            default => $value,
        };
    }

    public static function set(string $key, mixed $value, string $type = 'text'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => (string) $value, 'type' => $type]
        );
    }
}
