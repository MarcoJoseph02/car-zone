<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        "fname",
        "lname",
        "phone_no",
        "address"
    ];

    public function name() :Attribute
    {
        return new Attribute(
            get: fn () => $this->name .' ' . $this->surname
        );
    }
}
