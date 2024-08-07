<?php

namespace App\Models\Cfhens;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RuleModel extends Model
{
    use HasUuids;

    protected $table = 'rules';
    protected $fillable = [
        'code',
        'symptom_id',
        'disease_id',
    ];

    public function symptom() : HasOne
    {
        return $this->hasOne(SymptomModel::class, 'id', 'symptom_id');
    }

    public function disease(): HasOne
    {
        return $this->hasOne(DiseaseModel::class, 'id', 'disease_id');
    }
}
