<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'course_name', 'academic_year', 'in_charge', 'assigned_classroom',
    ];

    protected $table = 'courses';
}
