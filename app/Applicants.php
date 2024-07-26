<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    protected $table = 'applicants';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'nationality',
        'cv',
    ];
    public function Coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator', 'id');
    }
    public function HrManager()
    {
        return $this->belongsTo(User::class, 'manager', 'id');
    }
}
