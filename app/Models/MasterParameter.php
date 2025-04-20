<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterParameter extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'created_by', 'updated_by'];
}
