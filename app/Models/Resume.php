<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', // Assuming you have a user_id field in your resumes table
        'listing_id',
        'name',
        'email',
        'contact_no',
        'pdf',
        'status',
        // Add any other fields you want to be fillable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If you have a direct relationship with a job listing
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
