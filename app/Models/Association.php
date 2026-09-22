<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    /** @use HasFactory<\Database\Factories\AssociationFactory> */
    use HasFactory;

    protected $fillable = ['name', 'contact_number', 'address', 'logo'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }
}
