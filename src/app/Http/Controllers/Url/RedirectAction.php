<?php declare(strict_types = 1);

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use App\Models\Url;

class RedirectAction extends Controller
{
    private Redirector $redirector;
    
    public function __construct(Redirector $redirector)
    {
        $this->redirector = $redirector;
    }
    
    public function __invoke(Url $url)
    {
        $url->increment('views');
        
        return $this->redirector->away($url->url);
    }
}
