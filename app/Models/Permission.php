<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function user_role()
    {
        return $this->belongsToMany(UserRole::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
