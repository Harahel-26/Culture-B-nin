<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageContact extends Model
{
    protected $fillable = ['name', 'email', 'message'];
}
