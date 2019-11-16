@extends('layouts.app')

@section('title', $articleName)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endsection

@section('content')
    @if($article)
        {!! $article !!}
    @else
       <div>
           @lang('errors.image_not_found')
       </div>
    @endif
@endsection