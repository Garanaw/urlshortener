<?php declare(strict_types = 1);

namespace App\Repositories;

use App\Models\Url;
use App\Models\User;

class UrlCreator
{
    public function createForUser(Url $url, User $user): void
    {
        $user->urls()->save($url);
    }
    
    public function nextIndex(): int
    {
        $lastId = (new Url())->max('id');
        return $lastId ? $lastId + 1 : 1;
    }
}
