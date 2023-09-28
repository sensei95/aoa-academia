<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commune extends Model
{
    use HasFactory;

    public $guarded = [];

    public function province() : BelongsTo {
        return $this->belongsTo(Province::class);
    }

    public function district() : BelongsTo {
        return $this->belongsTo(District::class);
    }
}
