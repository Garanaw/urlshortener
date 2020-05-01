<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Url;

class UrlElement extends Component
{
    private Url $url;
    
    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function render()
    {
        return view('url.url-element');
    }
    
    public function realUrl(): string
    {
        return $this->url->url;
    }
    
    public function redirector(): string
    {
        return route('url.show', $this->url);
    }
    
    public function keyword(): string
    {
        return $this->url->keyword;
    }
    
    public function description(): string
    {
        return $this->url->description;
    }
    
    public function views(): int
    {
        return (int) $this->url->views;
    }
}
