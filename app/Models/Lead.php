<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'leads'; 
    // protected $primaryKey = 'id';
    protected $fillable = [
        'vendor_uid',
        'cp_uid',
        'assigned_to',
        'status',
        'next_followup_date',
        'trx_uid',
    ];

    public function leadtimeline()
    {
        return $this->hasMany(Leadtimeline::class, 'lead_id', 'lead_id');
    }

}
