<?php

namespace App\Models\Customer\Entity;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'age', 'location'];

    public $timestamps = false;

}
