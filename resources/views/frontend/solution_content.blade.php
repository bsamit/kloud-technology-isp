@extends('welcome')
@section('title')
    Solution
@endsection
@section('site_content')
<section>
  <div class="banner_text">
      <img src="./include/img/slider/4.png" class="img-fluid" alt="img">
      <div class="banner_text_details">
        <h5>Solutions</h5>
        <p>“Kloud, operated by Kloud Technologies Limited, is Bangladesh’s premium internet service provider &
internet exchange.”</p>
      </div>
  </div>
</section>
<section class="key_highlight_sec">
  <div class="container">
      <div class="service_heading">
          <h4>Discover solutions at Kloud</h4>
          <p>Solve your business problems with products and services from Equinix and our partners. Get started with reference designs that match your needs.</p>
      </div>
  </div>
</section>

<section class="feature_lists_sec solution_sec">
  <div class="container">
    @foreach ($solutionCat as $solutionCategory)
      <div class="row">
        <div class="title_heading">
          <h5>{{$solutionCategory->title}}</h5>
        </div>
      </div>
        <div class="feature_lists">
          @foreach ($solutionCategory->solutions as $solution)
            <div class="feature_lists_details leadership_details">
                <img src="{{asset($solution->image)}}" class="img-fluid" alt="img">
                <h5>{{$solution->title}}</h5>
                <p>{{$solution->description}}</p>
            </div>
          @endforeach
        </div>
    @endforeach
  </div>
</section>
<section>
  <div class="package_detail">
    <div class="package_detail_text">
      <h5>Want to collaborate? Here's how we work.</h5>
      <p>If you have questions, feel free to contact our expert for assistance.</p>
    </div>
    <div>
      <div class="ht-plan-footer mt-55 text-center">
        <a class="ht-btn" href=""><span>Contact Us</span></a>
      </div>
    </div>
  </div>
</section>
@endsection