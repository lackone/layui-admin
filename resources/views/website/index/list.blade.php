@extends('layouts.page')

@section('title')
    {{ $title }}
@endsection

@section('list')
    <div class="row">
        @foreach($list as $value)
            <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                <div class="news-block-one wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><a href="{{ route('detail', $value['id']) }}"><img src="{{ $value['banner'] ?: frontAsset('images/resource/news-25.jpg') }}"
                                                                                   alt=""></a></figure>
                        <div class="lower-content">
                            <h4><a href="{{ route('detail', $value['id']) }}">{{ $value['title'] }}</a></h4>
                            <div class="post-date"><i class="flaticon-calendar"></i>{{ $value['created'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @include('common.pagination', ['results' => $list])
@endsection
