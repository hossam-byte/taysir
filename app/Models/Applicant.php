<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Applicant extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicantFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'national_id',
        'age',
        'gender',
        'address',
        'social_status',
        'id_photo',
        'proof_photos',
        'association_id'
    ];

    protected $casts = [
        'proof_photos' => 'array'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }
}
