<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';
    protected $fillable = [
        'student_name',
        'email',
        'gender',
        'enrollment_date',
        'description',
        'dept_id'
    ];

    // Belong-to Relationship
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'dept_id');
    }

    // Accessor for calculation displayed in UI (Years Enrolled)
    public function getYearsEnrolledAttribute()
    {
        if (!$this->enrollment_date) return 'N/A';
        $enrollDate = Carbon::parse($this->enrollment_date);
        $diffInDays = $enrollDate->diffInDays(now());
        return number_format($diffInDays / 365.25, 4) . ' years';
    }
}