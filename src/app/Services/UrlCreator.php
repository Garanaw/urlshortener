<?php declare(strict_types = 1);

namespace App\Services;

use App\Models\Url;
use App\Models\User;
use App\Repositories\UrlCreator as Creator;
use Illuminate\Cache\Repository as Cache;
use Illuminate\Http\Client\Factory as Http;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class UrlCreator
{
    private const URL = 'https://www.eff.org/files/2016/09/08/eff_short_wordlist_2_0.txt';
    
    private Cache $cache;
    private Http $http;
    private Creator $creator;

    public function __construct(Cache $cache, Creator $creator, Http $http)
    {
        $this->cache = $cache;
        $this->creator = $creator;
        $this->http = $http;
    }
    
    public function createForUser(Url $url, User $user): void
    {
        if ($url->hasKeyword() === false) {
            $url->setKeyword(
                $this->generateKeyword()
            );
        }
        
        $this->creator->createForUser($url, $user);
    }
    
    private function generateKeyword(): string
    {
        $readableWord = $this->generateReadableWord();
        $lastIndex = $this->creator->nextIndex();
        
        return $readableWord . '-' . $lastIndex;
    }
    
    private function generateReadableWord(): string
    {
        /** @var Collection $availableWords */
        $availableWords = $this->cache->rememberForever('available_words', function () {
            $response = $this->http->get(self::URL);
            return Str::of($response->body())
                ->replace("\t", ' ')
                ->explode("\n");
        });
        return Str::after($availableWords->random(), ' ');
    }
}
