<?php declare(strict_types = 1);

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use App\Services\UrlCreator as Service;
use App\Http\Requests\Url\StoreRequest as Request;
use App\Http\Mappers\UrlMapper as Mapper;
use Illuminate\Routing\Redirector;

class StoreAction extends Controller
{
    private Mapper $mapper;
    private Redirector $redirector;
    private Service $service;
    
    public function __construct(Mapper $mapper, Redirector $redirector, Service $service)
    {
        $this->mapper = $mapper;
        $this->redirector = $redirector;
        $this->service = $service;
    }
    
    public function __invoke(Request $request)
    {
        $url = $this->mapper->mapFromRequest($request);
        
        $this->service->createForUser($url, $request->user());
        
        return $this->redirector->route('home');
    }
}
