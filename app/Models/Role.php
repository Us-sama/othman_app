<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;


// class Role extends Model
// {
//     use HasFactory;

//     public function users()
//     {
//         return $this->hasMany(User::class);
//     }
// }
class Role extends SpatieRole
{
    // ...
}
