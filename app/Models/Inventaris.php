<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'quantity',
        'condition_id',
        'is_active',
        'created_by',
    ];

    public function condition()
    {
        return $this->belongsTo(InventarisCondition::class, 'condition_id');
    }
}
