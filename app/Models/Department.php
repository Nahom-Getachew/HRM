<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function Livewire\Volt\with;

class Department extends Model
{
    protected $fillable = [
        'name',
        'company_id',
    ];

    public function Company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function designations(): HasMany
    {
        return $this->hasMany(Designation::class);
    }

    public function employees(): mixed
    {
        return $this->throughDesignations()->hasEmployee();
    }

    public function scopeInCompany($query): mixed
    {
        return $query->where('company_id', session('company_id'));
    }
}
