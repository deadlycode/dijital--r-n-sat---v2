@extends('front.layouts.app')
@push('title',Cache::get('homepage_title',__('Homepage')))
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/zuck.js/1.3.0/zuck.min.css"
    integrity="sha512-uMQwakS6MojpJv2SmOA2P5EeR+1wbJNUsrr6MyKxdWencgXyM1CgF2BvgouRcNAgSJPoJG9t9Orhvcsp+GKPkg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/zuck.js/1.3.0/skins/snapgram.min.css"
    integrity="sha512-fpV02bQH+r8Qd7UCtU8+eDy3I9VbKyG6UJr/F1xIFsC52hpUC/6AEzWBzsBo+fKfyj2Aj5Fh+4P+m6X8r7w24Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    @if($sliders->count() > 0)
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    @endif
@endpush
@section('content')
<section class="py-3">
    <div class="container text-center">
        <div class="row mb-2">
            <div id="stories" class="storiesWrapper stories user-icon carousel snapgram"></div>
        </div>
    </div>
    @if($sliders->count() > 0)
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mx-auto">
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach($sliders as $slider)
                        <div class="swiper-slide">
                            @if($slider->url)
                            <a href="{{$slider->url}}">
                                <img class="img-fluid rounded-3" src="{{asset($slider->img)}}" alt="Slider">
                            </a>
                            @else
                            <img class="img-fluid rounded-3" src="{{asset($slider->img)}}" alt="Slider">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container py-3">
        <div class="d-flex justify-content-center text-center">
            <div class="d-flex align-items-center gap-2 scrollable-x pb-2">
                @foreach($categories as $category)
                <a class="suggest-card text-break" href="{{route('category',['slug'=>$category->slug])}}" title="{{$category->name}}">
                    <div class="m-2 d-flex" style="width:220px">
                        <img style="width: 64px" src="{{ asset($category->img) }}" alt="{{$category->name}}">
                    </div>
                    <h5>
                        {{$category->name}}
                        <span>{{$category->products->count()}} {{__('Items')}}</span>
                    </h5>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container py-3">
        @include('front.partials.product')

    </div>
</section>
@if($articles->count() > 0)
<section class="py-3 blog">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="h1 mark rounded-3 bg-white">
                {{__('Our Latest')}}
                <span class="mark p-3">
                    {{ __('News') }}
                </span>
            </h2>
        </div>
        <div class="row">
            @foreach($articles as $article)
            <div class="col-lg-4">
                <div class="card" style="background-image: url('{{asset($article->img)}}'); background-size:cover;">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{route('article',$article->slug)}}">
                                {{$article->name}}
                            </a>
                        </h4>
                        <p class="card-text">
                            {{$article->description}}
                        </p>
                        <div class="read-more">
                            <a href="{{route('article',$article->slug)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right" viewBox="0 1 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                                    </path>
                                </svg>
                                {{ __('Read More') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
            autoplay: {
                delay: 4000,
            },
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
             // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zuck.js/1.3.0/zuck.min.js"
    integrity="sha512-u3hckQeObqe8vtmYB5uzJ434ef8sn8au8OREiR7DTQB1bdtXbpMVpz+gNoATogzkB8+PwivV3sOJ//lGIzHi0w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let stories = new Zuck('stories', {
  skin: 'snapgram',
  avatars: true,
  list: false,
  openEffect: true,
  cubeEffect: false,
  autoFullScreen: false,
  backButton: true,
  backNative: false,
  previousTap: true,
  localStorage: true,
  stories: [
    @foreach($stories as $story_key => $story)
    {
      id: '{{$story_key}}',
      photo: '{{asset($story->img)}}',
      name: '{{$story->name}}',
      link: '{{$story->url}}',
      lastUpdated: {{ $story->updated_at->timestamp }},
      seen: false,
      items: [
        {
          id: '{{$story_key}}',
          type: 'photo',
          src: '{{asset($story->img)}}',
          time: {{ $story->updated_at->timestamp }},
          link: '{{$story->url}}',
          text: '{{$story->name}}',
        },
      ],
    },
    @endforeach
  ],
  language: { // if you need to translate :)
    unmute: '{{__('Touch to unmute')}}',
    keyboardTip: '{{__('Press space to see next')}}',
    visitLink: '{{__('Visit Link')}}',
    time: {
      ago:'{{__('ago')}}',
      hour:'{{__('hour')}}',
      hours:'{{__('hours')}}',
      minute:'{{__('minute')}}',
      minutes:'{{__('minutes')}}',
      fromnow: '{{__('from now')}}',
      seconds: '{{__('seconds')}}',
      yesterday: '{{__('yesterday')}}',
      tomorrow: '{{__('tomorrow')}}',
      days: '{{__('days')}}',
    }
  },
});
</script>
@endpush
