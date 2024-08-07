<?php

namespace App\Models\Cfhens;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiseaseModel extends Model
{
    use HasUuids;

    protected $table = 'diseases';
    protected $fillable = [
        "code",
        "name",
        "description",
    ];

    public function rules(): HasMany
    {
        return $this->hasMany(RuleModel::class, 'disease_id', 'id');
    }
}
