<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;

class Company extends Model
{
    use HasFactory;
    //protected $guarded = [];
    protected $fillable = ['name','address','email','website'];

    public function contacts() {
        return $this->hasMany(Contact::class);
    }
}
