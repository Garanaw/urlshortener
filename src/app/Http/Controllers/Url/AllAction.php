<?php declare(strict_types = 1);

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use Illuminate\View\Factory as View;
use Illuminate\Http\Request;

class AllAction extends Controller
{
    private View $view;
    
    public function __construct(View $view)
    {
        $this->view = $view;
    }
    
    public function __invoke(Request $request)
    {
        return $this->view->make('url.list', [
            'urls' => $request->user()->urls()->paginate()
        ]);
    }
}
