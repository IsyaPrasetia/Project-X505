<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag', 'title', 'date', 'time', 'flyer', 'platform', 'duration', 'skp',
        'price', 'price2', 'has_two_prices', 'register_link', 'lms_link', 'professions',
        'admin_left_name', 'admin_left_link', 'admin_right_name', 'admin_right_link',
        'health_channel_text', 'health_channel_link', 'health_channel_btn_text',
        'speakers', 'is_active', 'register_closed', 'wa_message',
        'bank_name', 'bank_account_no', 'bank_account_name', 'bank_logo',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'has_two_prices' => 'boolean',
            'is_active' => 'boolean',
            'register_closed' => 'boolean',
            'speakers' => 'array',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function isPast(): bool
    {
        return $this->date && $this->date->isPast();
    }
}
