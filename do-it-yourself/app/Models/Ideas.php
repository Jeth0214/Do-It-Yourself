<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ideas extends Model
{
    use HasFactory;

    public $guarded = [];

    public function User()
    {
        return   $this->belongsTo(User::class);
    }

    public function saves()
    {
        return $this->belongsToMany(User::class);
    }
}
