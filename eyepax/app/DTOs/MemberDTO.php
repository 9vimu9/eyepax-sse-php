<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class MemberDTO extends Data
{
    public int $id;
    public string $full_name;
    public string $email;
    public string $telephone;
    public string $joined_date;
    public string $current_route;
    public string $comments;
    public string $created_at;

}
