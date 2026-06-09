<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'text', 'stars', 'avatar', 'gender', 'sort_order', 'is_active', 'date',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'date' => 'date',
        ];
    }
}
