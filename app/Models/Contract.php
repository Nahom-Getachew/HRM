<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Contract extends Model
{
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    public function scopeInCompany($query): mixed
    {
        return $query->whereHas('designation', function ($q): void {
            $q->inCompany();
        });
    }

    public function getDurationAttribute(): mixed
    {
        return Carbon::parse($this->start_date)->diffForHumans($this->end_date);
    }

    public function scopeSearchByEmployee($query, $name): mixed
    {
        return $query->whereHas('employee', function ($q) use($name): void {
            $q->where('name', 'like', "%$name%");
        });
    }

    //check company policy for earnings calculation
    //also include bonuses and deductions if any
    //also include tax calculations if applicable
    //include days present if rate type is daily
    public function getEarnings($monthYear): mixed
    {
        return $this->rate_type == 'monthly' ? $this->rate : $this->rate * Carbon::parse($monthYear)->daysInMonth;
    }
}
