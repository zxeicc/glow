<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Override;

class Invitation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'role',
        'token',
        'expires_at',
        'accepted_at',
        'invited_at',
        'invited_by'
    ];
    #[Override]
    protected function casts()
    {
        return [
            'expires_at'=>'datetime',
            'accepted_at'=>'datetime'
        ];
    }
    public function inviter(){
        return $this->belongsTo(User::class,'invited-by');
    }
}
