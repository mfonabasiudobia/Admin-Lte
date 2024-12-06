<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Concerns\{HasUuids, HasUlids};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{

    use HasFactory, HasUuids;

    public $guard_name = 'api';

    protected $primaryKey = "id";

    protected $keyType = 'string';

    public $incrementing = false;
}
