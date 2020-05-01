<?php declare(strict_types = 1);

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\UrlFinder as Finder;

class UrlFinder
{
    private Finder $finder;
    
    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }
    
    public function findLatestForUser(User $user): Collection
    {
        return $this->finder->findLatestForUser($user);
    }
}
