<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status'];

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }
}
