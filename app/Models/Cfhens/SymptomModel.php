<?php

namespace App\Models\Cfhens;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
