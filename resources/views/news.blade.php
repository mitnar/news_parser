@extends('layouts.app')

@section('title', 'News')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endsection

@section('content')
    <div>
        @foreach ($news as $article)
            <div class="article">
                <span class="col">{{ str_limit($article->name, 200) }}</span>
                <span class="col">{{ $article->date }}</span>
                <a class="col" href="{{ route('article', ['news' => $article]) }}">Подробнее</a>
            </div>
        @endforeach
    </div>
@endsection
