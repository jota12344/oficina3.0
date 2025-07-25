<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    
    protected $fillable = ['budget_datetime', 'client', 'seller', 'description', 'estimated_value'];
}
