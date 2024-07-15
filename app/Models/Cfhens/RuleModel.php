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
        'effect_id',
        "effect_type",
    ];

    public function symptom() : HasOne
    {
        return $this->hasOne(SymptomModel::class, 'id', 'symptom_id');
    }

    protected function effect(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->tapEffect($attributes['effect_type'], $attributes['effect_id']),
        );
    }

    public function tapEffect($type, $id)
    {
        return $type == "symptom" ? SymptomModel::find($id) : DiseaseModel::find($id);
    }
}
