<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'banks';
    protected $fillable = array(
        'id',
        'name',
        'bank_code',
        'location',
        'email',
        'phone',
        'is_active',
        'address',
        'website',
        'created_by',
        'updated_by'
    );
}
