<?php declare(strict_types = 1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UrlFinder
{
    private const LATEST_LIMIT = 10;
    
    public function findLatestForUser(User $user): Collection
    {
        return $user->urls()->orderByDesc('created_at')->take(5)->get();
    }
}
