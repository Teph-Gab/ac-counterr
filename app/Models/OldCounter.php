<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OldCounter extends Model
{
    use HasFactory;

    protected $fillable = ['completedacs', 'restartacs', 'duplicateacs', 'launchedacs'];
    
    protected $casts = [
        'completedacs' => 'array',
        'restartacs' => 'array',
        'launchedacs' => 'array',
        'duplicateacs' => 'array'
        ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
