<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','phone','email','address','company_id'];

    function company() {
        return $this->belongsTo(Company::class);
    }
}
