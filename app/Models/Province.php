<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    public $guarded = [];

    public function cities() : HasMany {
        return $this->hasMany(City::class);
    }

    public function territories() : HasMany {
        return $this->hasMany(Territory::class);
    }

    public function districts() : HasMany {
        return $this->hasMany(District::class);
    }

    public function communes() : HasMany {
        return $this->hasMany(Commune::class);
    }
}
