<?php
namespace App\DTOs;

class MemberDTO
{
    public function __construct(
        private readonly int    $id,
        private readonly string $full_name,
        private readonly string $email,
        private readonly string $telephone,
        private readonly string $joined_date,
        private readonly string $current_route,
        private readonly string $comments,
    )
    {
    }

}
