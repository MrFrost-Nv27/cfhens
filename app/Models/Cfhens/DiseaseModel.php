<?php

namespace App\Models\Cfhens;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DiseaseModel extends Model
{
    use HasUuids;

    protected $table = 'diseases';
    protected $fillable = [
        "code",
        "name",
        "description",
    ];
}
