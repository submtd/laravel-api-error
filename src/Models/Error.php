<?php

namespace Submtd\LaravelApiError\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Error extends Model
{
    /**
     * Fillable attributes.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'uri',
        'request',
        'request_headers',
        'message',
        'code',
    ];

    /**
     * Casts.
     * @var array
     */
    protected $casts = [
        'request' => 'json',
        'request_headers' => 'json',
    ];

    /**
     * Boot method.
     * - add uuid.
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    /**
     * Belongs to user.
     */
    public function user()
    {
        return $this->belongsTo(config('api-error.user_model', config('auth.providers.users.model', '\App\User')));
    }
}
