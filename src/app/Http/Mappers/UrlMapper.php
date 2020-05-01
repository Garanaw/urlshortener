<?php declare(strict_types = 1);

namespace App\Http\Mappers;

use Illuminate\Http\Request;
use App\Models\Url;

class UrlMapper
{
    public function mapFromRequest(Request $request): Url
    {
        $url = new Url([
            'url' => $request->input('long_url')
        ]);
        
        $request->has('private') ? 
            $url->setPrivate() :
            $url->setPublic();
        
        if ($request->input('keyword') !== null) {
            $url->setKeyword($request->input('keyword'));
        }
        
        if ($request->input('description') !== null) {
            $url->setDescription($request->input('description'));
        }
        
        return $url;
    }
}
