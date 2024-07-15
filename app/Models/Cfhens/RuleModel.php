<?php

namespace App\Models\Cfhens;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class RuleModel extends Model
{
    use HasUuids;

    protected $table = 'rules';
    protected $fillable = [
        'symptom_id',
        'effect_id',
        "effect_type",
    ];
}
