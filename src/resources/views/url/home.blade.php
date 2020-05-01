@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            @include('url.store_form')
        </div>
        
    </div>
    
    <div class="row">
        <div class="col">
            <h1>{{ __('url.recent') }}</h1>
            
            @foreach($latest as $urlElement)
            <x-url-element :url="$urlElement"></x-url-element>
            @endforeach
            
        </div>
    </div>
</div>
@endsection
