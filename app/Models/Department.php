<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Department extends Model
{
    use HasFactory;
    use LaratrustUserTrait;

    protected $fillable=[
        'name',
        'description'

    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);

    }

}
