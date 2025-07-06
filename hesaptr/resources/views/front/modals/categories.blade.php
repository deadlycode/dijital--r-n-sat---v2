<div class="offcanvas offcanvas-start" style="width: 300px !important" tabindex="-1" id="offcanvasResponsive"
    aria-labelledby="offcanvasResponsiveLabel">
    <div class="offcanvas-header m-3">
        <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list-stars"
                viewBox="0 1 16 16">
                <path fill-rule="evenodd"
                    d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                <path
                    d="M2.242 2.194a.27.27 0 0 1 .516 0l.162.53c.035.115.14.194.258.194h.551c.259 0 .37.333.164.493l-.468.363a.277.277 0 0 0-.094.3l.173.569c.078.256-.213.462-.423.3l-.417-.324a.267.267 0 0 0-.328 0l-.417.323c-.21.163-.5-.043-.423-.299l.173-.57a.277.277 0 0 0-.094-.299l-.468-.363c-.206-.16-.095-.493.164-.493h.55a.271.271 0 0 0 .259-.194l.162-.53zm0 4a.27.27 0 0 1 .516 0l.162.53c.035.115.14.194.258.194h.551c.259 0 .37.333.164.493l-.468.363a.277.277 0 0 0-.094.3l.173.569c.078.255-.213.462-.423.3l-.417-.324a.267.267 0 0 0-.328 0l-.417.323c-.21.163-.5-.043-.423-.299l.173-.57a.277.277 0 0 0-.094-.299l-.468-.363c-.206-.16-.095-.493.164-.493h.55a.271.271 0 0 0 .259-.194l.162-.53zm0 4a.27.27 0 0 1 .516 0l.162.53c.035.115.14.194.258.194h.551c.259 0 .37.333.164.493l-.468.363a.277.277 0 0 0-.094.3l.173.569c.078.255-.213.462-.423.3l-.417-.324a.267.267 0 0 0-.328 0l-.417.323c-.21.163-.5-.043-.423-.299l.173-.57a.277.277 0 0 0-.094-.299l-.468-.363c-.206-.16-.095-.493.164-.493h.55a.271.271 0 0 0 .259-.194l.162-.53z" />
            </svg>
            <span class="ms-2">
                {{ __('Categories') }}
            </span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="d-flex flex-column align-items-center gap-2">
            @foreach($app_categories as $mobile_category)
            <a class="suggest-card text-break" href="{{route('category',['slug'=>$mobile_category->slug]) }}">
                <div class="d-flex" style="width:240px">
                    <img style="width: 64px" src="{{ asset($mobile_category->img) }}" alt="{{ $mobile_category->name }}">
                </div>
                <h5>
                    {{$mobile_category->name}}
                    <span>{{$mobile_category->products->count()}} {{__('Items ')}}</span>
                </h5>
            </a>
            @endforeach
        </div>
    </div>
</div>
