<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = [
        'tender_id',
        'supplier_id',
    ];

    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}