<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    /**
     * Get school class relationship data.
     *
     * @return BelongsTo
     * @author Muhammad Rizki Maulidan <mrizkimaulidanx@gmail.com>
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    /**
     * Get school major relationship data.
     *
     * @return BelongsTo
     * @author Muhammad Rizki Maulidan <mrizkimaulidanx@gmail.com>
     */
    public function schoolMajor(): BelongsTo
    {
        return $this->belongsTo(SchoolMajor::class);
    }
}
