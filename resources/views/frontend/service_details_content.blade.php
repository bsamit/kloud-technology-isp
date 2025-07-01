@extends('welcome')
@section('title')
    Services Details
@endsection
@section('site_content')
<section>
  <div class="banner_text">
      <img src="./include/img/about_banner.jpg" class="img-fluid" alt="img">
      <div class="banner_text_details">
        <h5>Digital Services</h5>
        <p>Kloud Technologies Limited provides Bangladesh with premium internet solutions for residential and commercial users."</p>
      </div>
  </div>
</section>
<section class="key_highlight_sec">
  <div class="container">
    <div class="key_highlight">
      <div class="">
        <div class="key_highlight_sec_img">
          <img src="{{asset($service->image)}}" class="img-fluid" alt="img">
        </div>
      </div>
      <div class="">
        <div class="key_highlight_sec_text">
          <h1>{{$service->title}}</h1>
          <p>{{$service->description}}</p>
        </div>
        @foreach($service->serviceDetails as $service_detail)
          <div class="key_highlight_sec_text">
            <h5>{{$service_detail->title}}</h5>
            <p>{{$service_detail->description}}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="feature_lists_sec single_service_lists">
  <div class="container">
    <div class="row">
      <div class="title_heading single_service_title">
        <h5> KloudNIX Digital Services</h5>
      </div>
    </div>
    <div class="feature_lists">
      <div class="feature_lists_details">
          <i class="fa-solid fa-handshake-angle feture_icon"></i>
          <h5>Expert Team</h5>
          <p>Our team consists of industry experts with extensive experience in digital services.</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-box-open feture_icon"></i>
        <h5>Customer-Centric Approach</h5>
        <p>We prioritize our clients’ needs and tailor our solutions to fit their objectives.</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-network-wired feture_icon"></i>
        <h5>Innovative Solutions:</h5>
        <p>We stay ahead of industry trends to provide cutting-edge services.</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-arrow-up-right-dots feture_icon"></i>
        <h5>24/7 Support</h5>
        <p>Our dedicated support team is available around the clock to assist you.</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-tower-broadcast"></i>
        <h5>Nationwide Connectivity</h5>
        <p>KloudNIX connects a diverse range of networks across the country, creating a robust peering ecosystem.</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-box-open feture_icon"></i>
        <h5>Quality Assurance</h5>
        <p>We prioritize the quality of service, ensuring that participants benefit from reliable and efficient data exchange.</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-handshake-angle feture_icon"></i>
        <h5>Community-Centric Approach</h5>
        <p>KloudNIX is dedicated to supporting local ISPs and fostering a collaborative environment that drives innovation and growth.</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-handshake-angle feture_icon"></i>
        <h5>Community-Centric Approach</h5>
        <p>KloudNIX is dedicated to supporting local ISPs and fostering a collaborative environment that drives innovation and growth.</p>
      </div>
      <div class="feature_lists_details">
        <i class="fa-solid fa-handshake-angle feture_icon"></i>
        <h5>Community-Centric Approach</h5>
        <p>KloudNIX is dedicated to supporting local ISPs and fostering a collaborative environment that drives innovation and growth.</p>
      </div>
    </div>
  </div>
</section>
<section class="services_section_three">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="single_service_point">
          <h4>Cloud Computing</h4>
          <h6>Description:</h6>
          <p>KloudNIX provides comprehensive cloud computing solutions that enable businesses to store, manage, and process data in the cloud. Our services include Infrastructure as a Service (IaaS), Platform as a Service (PaaS), and Software as a Service (SaaS).</p>
        </div>
        <div class="single_service_point">
          <h6>Key Features:</h6>
          <ul>
            <li>Scalable resources to meet business needs</li>
            <li>Secure data storage with advanced encryption</li>
            <li>Cost-effective pay-as-you-go pricing model</li>
            <li>24/7 support and monitoring</li>
          </ul>
        </div>
        <div class="single_service_point">
          <h6>Benefits:</h6>
          <ul>
            <li>Increased flexibility and accessibility</li>
            <li>Reduced IT costs and infrastructure maintenance</li>
            <li>Enhanced collaboration and productivity</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12">
        <div class="single_service_point">
          <h4>Digital Marketing</h4>
          <h6>Description:</h6>
          <p>Our digital marketing services are designed to enhance your online presence and drive traffic to your business. We utilize various strategies including search engine optimization (SEO), content marketing, social media marketing, and pay-per-click (PPC) advertising.</p>
        </div>
        <div class="single_service_point">
          <h6>Key Features:</h6>
          <ul>
            <li>Comprehensive SEO audits and implementation</li>
            <li>Targeted ad campaigns on platforms like Google and Facebook</li>
            <li>Content creation tailored to your audience </li>
            <li>Analytics and reporting to measure performance </li>
          </ul>
        </div>
        <div class="single_service_point">
          <h6>Benefits:</h6>
          <ul>
            <li>Increased brand visibility and awareness</li>
            <li>Higher conversion rates and customer engagement</li>
            <li>Data-driven strategies for better ROI</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="package_detail">
    <div class="package_detail_text">
      <h5>Not sure which solution fits your business needs?</h5>
      <p>If you have questions, feel free to contact our expert for assistance.</p>
    </div>
    <div>
      <div class="ht-plan-footer mt-55 text-center">
        <a class="ht-btn" href="{{route('register-customer')}}"><span>Sign Up</span></a>
      </div>
    </div>
  </div>
</section>
@endsection