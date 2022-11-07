<?php

namespace App\Models;

use App\DTOs\MemberDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Member extends Model
{
    use HasFactory;
    use WithData;

    protected $dataClass = MemberDTO::class;

    protected $fillable = [
        'full_name', 'email', 'telephone', 'joined_date', 'current_route', 'comments'
    ];

}
