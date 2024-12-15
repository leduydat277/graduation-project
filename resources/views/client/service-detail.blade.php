@extends('client.layouts.master')

@section('title')
    Chi tiết tiện nghi
@endsection

@section('content')
    @include('client.layouts.banner.banner')
    <div class="padding-small">
        <div class="container-fluid padding-side">
            <div class="row g-lg-5">
                <main class="post-grid col-lg-9">
                    <div class="row">
                        <article class="post-item">
                            <h3 class="display-3 fw-normal mb-5">{{ $assetType->name }}</h3>
                            <p>{{ $assetType->description }}</p>

                            <div class="hero-image mt-5">
                                <img src="{{ Storage::url($assetType->image) }}" width="100%" alt="bài đăng đơn"
                                    class="img-fluid mt-3 mb-3">
                            </div>

                            <p>{{ $assetType->description }}</p>
                        </article>
                    </div>
                </main>
                <aside class="col-lg-3">
                    <div class="post-sidebar">
                        <div class="widget sidebar-recent-post mb-5">
                            <h4 class="widget-title fw-normal border-bottom pb-3 mb-3">Các tiện nghi khác</h4>
                            @foreach ($assetTypes as $assetType)
                                <div class="sidebar-post-item d-flex justify-content-center">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <div class="image-holder">
                                                <a href="{{ route('client.services-detail', $assetType->id)}}"><img src="{{ Storage::url($assetType->image)}}" alt="blog"
                                                        class="img-fluid"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="sidebar-post-content">
                                                <h5 class="post-title fs-5"><a href="{{ route('client.services-detail', $assetType->id)}}">{{ $assetType->name }}</a></h5>
                                                <p class=" m-0 lh-base" style="font-size: 14px;">
                                                    {{ $assetType->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
