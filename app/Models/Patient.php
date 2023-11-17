<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'mother_full_name',
        'birthday',
        'cpf',
        'cns',
        'photo',
        'address_id'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
