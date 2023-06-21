<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;


class Role extends SpatieRole
{
    use HasFactory;
    protected $guarded = [];

    // Relationships
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}