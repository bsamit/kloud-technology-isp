@extends('welcome')
@section('title')
    Package
@endsection
@section('site_content')
<style>
  @media only screen and (max-width: 768px) {
    .package_lists {
     flex-direction: column;
    }
  }
</style>

<section>
  <div class="banner_text">
      <img src="./include/img/slider/2.png" class="img-fluid" alt="img">
      <div class="banner_text_details">
        <h5>Membership Plans</h5>
        <p>Kloud Technologies Limited provides Bangladesh with premium internet solutions for residential and commercial users."</p>
      </div>
  </div>
</section>
<section class="service_section_body">
  <div class="container-fluid">
    @if (count($packages) > 0)
      <div class="different_package_sec">
        <div class="row">
          <div class="service_head mb-5">
            <h5>Residentials Packages</h5>
          </div>
        </div>
        <div class=" package_lists justify-content-center align-items-center">
          @foreach ($packages->where('package_catgory_id', 1) as $package)
            <div class="">
              <div class="ht-plan mb-45">
                <div class="shape-holder">
                  <img src="./include/img/shape/shape-9.png" alt="shape">
                  <img class="icon" src="./include/img/shape/icon-9.svg" alt="icon">
                </div>
                <div class="ht-plan-inner">
                  <div class="ht-plan-header">
                    <h3 class="plan-title">{{$package->title}}</h3>
                    <h2 class="plan-price">৳{{$package->monthly_cost}}<span class="month d-none">/m</span></h2>
                    <p class="plan-desc">{{$package->plan_name}}</p>
                    <div class="price-border"></div>
                  </div>
                  <ul class="feature-list">
                    @foreach ($package->packageDetails as $feature)
                      <li class="price-available"><span class="check-mark"><i class="bi bi-check-lg"></i></span>
                          {{$feature->name}}
                      </li>
                    @endforeach
                  </ul>
                  <div class="ht-plan-footer mt-55 text-center">
                    <a class="ht-btn" href="{{ auth()->user() ?  route('manage-package.package.package-details', $package->uuid) : url('login') }}"><span>Purchase Now</span> <span><img src="./include/img/shape/arrow-2.svg" alt="arrow"></span></a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="different_package_sec">
        <div class="row">
          <div class="service_head mb-5">
            <h5>Business Packages</h5>
          </div>
        </div>
        
        <div class=" package_lists justify-content-center align-items-center">
          @foreach ($packages->where('package_catgory_id', 2) as $package)
          <div class="">
            <div class="ht-plan mb-45">
              <div class="shape-holder">
                <img src="./include/img/shape/shape-9.png" alt="shape">
                <img class="icon" src="./include/img/shape/icon-9.svg" alt="icon">
              </div>
              <div class="ht-plan-inner">
                <div class="ht-plan-header">
                  <h3 class="plan-title">{{$package->title}}</h3>
                  <h2 class="plan-price">৳{{$package->monthly_cost}}<span class="month d-none">/m</span></h2>
                  <p class="plan-desc">{{$package->title}}</p>
                  <div class="price-border"></div>
                </div>
                <ul class="feature-list">
                  @foreach ($package->packageDetails as $feature)
                    <li class="price-available"><span class="check-mark"><i class="bi bi-check-lg"></i></span>
                        {{$feature->name}}
                    </li>
                  @endforeach
                </ul>
                <div class="ht-plan-footer mt-55 text-center">
                  <a class="ht-btn" href="{{ auth()->user() ?  route('manage-package.package.package-details', $package->uuid) : url('login') }}"><span>Purchase Now</span> <span><img src="./include/img/shape/arrow-2.svg" alt="arrow"></span></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        </div>
      </div>
    @else
    <div class="different_package_sec">
      <div class="row">
        <div class="service_head mb-5">
          <h5>No Package Found</h5>
        </div>
      </div>
    </div>
    @endif

  </div>
</section>
<section>
  <div class="container">
    <div class="key_highlight mission_section">
      <div class="">
        <div class="key_highlight_sec_img">
          <img src="./include/img/Cost_Savings.jpg" class="img-fluid" alt="img">
        </div>
      </div>
      <div class="">
        <div class="key_highlight_sec_text">
          <h1>Cost Savings</h1>
          <p><b>Reduced need for transit ISPs.</b></p>
          <p>Welcome to Kloud Technologies Limited, Bangladesh’s premier Internet Exchange (IX) and CDN platform. As a subsidiary of Kloud Technologies Limited, we are dedicated to revolutionizing the digital ecosystem with seamless connectivity, reliable performance, and robust infrastructure.</p>
        </div>
      </div>
    </div>
    <div class="key_highlight mission_section">
      <div class="">
        <div class="key_highlight_sec_text">
          <h1>Reduced Latency</h1>
          <p><b>Faster data transfers improve end-user experience.</b></p>
          <p>Welcome to Kloud Technologies Limited, Bangladesh’s premier Internet Exchange (IX) and CDN platform. As a subsidiary of Kloud Technologies Limited, we are dedicated to revolutionizing the digital ecosystem with seamless connectivity, reliable performance, and robust infrastructure.</p>
        </div>
      </div>
      <div class="">
        <div class="key_highlight_sec_img">
          <img src="./include/img/Reduced.jpg" class="img-fluid" alt="img">
        </div>
      </div>
    </div>
    <div class="key_highlight mission_section">
      <div class="">
        <div class="key_highlight_sec_img">
          <img src="./include/img/Reliability.png" class="img-fluid" alt="img">
        </div>
      </div>
      <div class="">
        <div class="key_highlight_sec_text">
          <h1>Reliability</h1>
          <p><b>Redundant infrastructure for high availability.</b></p>
          <p>Welcome to Kloud Technologies Limited, Bangladesh’s premier Internet Exchange (IX) and CDN platform. As a subsidiary of Kloud Technologies Limited, we are dedicated to revolutionizing the digital ecosystem with seamless connectivity, reliable performance, and robust infrastructure.</p>
        </div>
      </div>
    </div>
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
        <a class="ht-btn" href="{{route('register-customer')}}"><span>Sign Up</span></a>
      </div>
    </div>
  </div>
</section>
<section class="feature_lists_sec">
  <div class="container">
    <div class="row">
      <div class="title_heading">
        <h5 class="text-center"> Billing Management</h5>
      </div>
    </div>
    <div class="feature_lists">
      <div class="feature_lists_details">
          <i class="fa-solid fa-tower-cell feture_icon"></i>
          <h5>Billing Integration</h5>
          <p>Manage invoices and payment records</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-hand feture_icon"></i>
        <h5>Custom Billing Cycles</h5>
        <p>Aligned with member preferences.</p>
      </div>
    </div>
  </div>
</section>
@endsection