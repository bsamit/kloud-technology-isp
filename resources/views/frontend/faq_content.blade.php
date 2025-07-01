@extends('welcome')
@section('title')
    FAQ
@endsection
@section('site_content')
  <section>
    <div class="banner_text">
        <img src="./include/img/about_banner.jpg" class="img-fluid" alt="img">
        <div class="banner_text_details">
          <h5>F&Q</h5>
          <p>Kloud Technologies Limited provides Bangladesh with premium internet solutions for residential and commercial users."</p>
        </div>
    </div>
  </section>
  <section>
    <div class="different_package_sec mt-5">
        <div class="row">
          <div class="service_head">
            <h5>Frequently Asked Questions</h5>
          </div>
        </div>
        <div class="container">
            <div class="accordion" id="accordionExample">
              @foreach ($faqs as $key => $faq)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne{{$faq->id}}">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$faq->id}}" aria-expanded="false" aria-controls="collapseOne{{$faq->id}}">
                      {{$faq->title}}
                    </button>
                  </h2>
                  <div id="collapseOne{{$faq->id}}" class="accordion-collapse collapse {{$key == 0 ? 'show' : ''}}" aria-labelledby="headingOne{{$faq->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>{{$faq->description}}</strong>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
        </div>
      </div>
  </section>
@endsection