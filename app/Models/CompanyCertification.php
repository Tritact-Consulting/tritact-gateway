<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCertification extends Model
{

    // Status
    // 0 - Assigned
    // 1 - Discontinued
    // 2 - In-Progress
    // 3 - Completed

    use HasFactory;

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function certificate(){
        return $this->hasOne(CertificationCategory::class, 'id', 'certifications_id');
    }

    public function auditor(){
        return $this->hasOne(Auditor::class, 'id', 'auditor_id');
    }
    
    public function body(){
        return $this->hasOne(CertificationBody::class, 'id', 'certification_body_id');
    }

    public function getRemainingDays(){
        $date = $this->next_audit_due_date ?? $this->expire_date;

        $remaining = \Carbon\Carbon::now()->diffInDays($date, false);
        $remaining = $remaining + 2;

        if ($remaining <= 30) {
            return 'alert alert-red ' . $remaining;
        } elseif ($remaining > 30 && $remaining <= 90) {
            return 'alert alert-warning ' . $remaining;
        } else {
            return 'alert alert-success ' . $remaining;
        }
    }

    public function previous(){
        return $this->belongsTo(CompanyCertification::class, 'previous_certification');
    }

    public function next(){
        return $this->hasOne(CompanyCertification::class, 'previous_certification');
    }

    // CompanyCertification.php
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->status === null) {
            return null;
        }

        $map = [
            0 => ['label' => 'Assigned',     'class' => 'badge bg-primary'],
            1 => ['label' => 'Discontinued', 'class' => 'badge bg-danger'],
            2 => ['label' => 'In-Progress',  'class' => 'badge bg-warning text-dark'],
            3 => ['label' => 'Completed',    'class' => 'badge bg-success'],
        ];

        return $map[$this->status] ?? null;
    }

}
