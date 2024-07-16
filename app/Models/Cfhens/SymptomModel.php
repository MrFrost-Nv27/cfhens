<?php

namespace App\Models\Cfhens;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SymptomModel extends Model
{
    use HasUuids;

    protected $table = 'symptoms';
    protected $fillable = [
        "code",
        "name",
        "description",
    ];
}
