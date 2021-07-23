<?php

namespace Takshak\Logging\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logging extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'user'  =>  'array',
        'data'  =>  'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
