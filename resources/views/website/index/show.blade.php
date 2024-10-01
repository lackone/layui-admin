@extends('layouts.detail')

@section('title')
    {{ $title }}
@endsection

@section('content_title')
    <h2>{{ $article['title'] }}</h2>
    <ul class="info-box">
        <li class="author">
            <figure class="thumb-box"><img src="{{ frontAsset('images/resource/author-1.png') }}" alt=""></figure>
            {{ $article['author'] ?: '小风浪' }}
        </li>
        <li><i class="flaticon-calendar"></i>{{ $article['created'] }}</li>
    </ul>
@endsection

@section('content')
    {!! $article['context'] !!}
@endsection

@section('sidebar')
    <ul>
        @foreach($sidebar as $val)
            <li><a href="{{ $val['url'] }}">{{ $val['title'] }} <span>》</span></a></li>
        @endforeach
    </ul>
@endsection
