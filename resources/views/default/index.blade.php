@extends('default.layouts.layouts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="{{asset('/data/a_img/1.jpg')}}" alt="1" style="width:100%;"></div>
                    <div class="swiper-slide"><img src="{{asset('/data/a_img/2.jpg')}}" alt="2" style="width:100%;"></div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            <script>
                $(function(){
                    var swiper = new Swiper('.swiper-container', {
                        pagination: '.swiper-pagination',
                        paginationClickable: true,
                        loop: true
                    });
                });
            </script>
        </div>
    </div>
@endsection