<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashTransaction extends Model
{
    use HasFactory;

    /**
     * Get student relationship data.
     *
     * @return BelongsTo
     * @author Muhammad Rizki Maulidan <mrizkimaulidanx@gmail.com>
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the user relationship who created the data.
     *
     * @return BelongsTo
     * @author Muhammad Rizki Maulidan <mrizkimaulidanx@gmail.com>
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
