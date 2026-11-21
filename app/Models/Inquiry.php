<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'father_name',
        'age',
        'cnic',
        'phone',
        'qualification',
        'course_name',
        'source',
        'email',
        'user_id',
    ];
}
