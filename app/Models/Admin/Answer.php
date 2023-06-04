<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable=['name','em', 'message', 'role', 'email_id'];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}
