<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'job_category',
        'salary' ,
        'vacancies_available' ,
        'email' ,
        'picture' ,
        'contact_no' ,
        'description' ,
        'address',
    ];
}
