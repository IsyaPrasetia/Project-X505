<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'inst', 'avatar', 'gender', 'sort_order', 'is_active', 'date',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'date' => 'date',
        ];
    }
}
