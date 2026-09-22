<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Assistance extends Model
{
    /** @use HasFactory<\Database\Factories\AssistanceFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'type_or_value',
        'date',
        'notes',
        'proof_photo',
        'applicant_id',
        'association_id',
        'user_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
