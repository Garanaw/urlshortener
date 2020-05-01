<?php declare(strict_types = 1);

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use Illuminate\View\Factory as View;
use Illuminate\Http\Request;
use App\Services\UrlFinder as Finder;

class ListAction extends Controller
{
    private Finder $finder;
    private View $view;
    
    public function __construct(Finder $finder, View $view)
    {
        $this->finder = $finder;
        $this->view = $view;
    }
    
    public function __invoke(Request $request)
    {
        return $this->view->make('url.home', [
            'latest' => $this->finder->findLatestForUser($request->user())
        ]);
    }
}
