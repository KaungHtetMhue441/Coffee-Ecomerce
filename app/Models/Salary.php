<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'description', 'amount', 'incurred_at'];
    protected function casts(): array
    {
        return [
            'incurred_at' => 'datetime',
        ];
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
