<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Payroll extends Model
{
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeInCompany($query): mixed
    {
        return $query->where('company_id', $this->company_id);
    }

    public function getMonthYearAttribute(): string
    {
        return $this->year . '-' .$this->month;
    }

    public function getMonthStringAttribute(): string
    {
        return Carbon::parse($this->month_year)->format('F Y');
    }

}
