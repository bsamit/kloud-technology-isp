<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'solution_category_id',
        'title',
        'description',
        'image',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(SolutionCategory::class, 'solution_category_id');
    }
}
