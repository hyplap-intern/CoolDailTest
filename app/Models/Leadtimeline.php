<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Leadtimeline extends Model
{
    use HasFactory;
    protected $table = 'leadtimelines';

    // Specify the fillable attributes
    protected $fillable = [
        'lead_id',
        'title',
        'status',
        'message',
        'note',
        'badge_color',
        'message_color',
    ];

    // Optionally, define any relationships
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'lead_id'); // Assuming you have a Lead model
    }

}
