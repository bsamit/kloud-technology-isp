@extends('welcome')
@section('title')
    Services
@endsection
@section('site_content')

<section>
  <div class="banner_text">
      <img src="./include/img/slider/3.png" class="img-fluid" alt="img">
      <div class="banner_text_details">
        <h5>Services</h5>
        <p>Kloud Technologies Limited provides Bangladesh with premium internet solutions for residential and commercial users."</p>
      </div>
  </div>
</section>

<section class="our_journey">
  <div class="container">
    <div class="row">
      <div class="title_heading ">
        <h5> Our Journey</h5>
      </div>
      <div>
        <p>Kloud is dedicated to helping businesses navigate the complexities of cloud technology and network management. With our innovative solutions and commitment to excellence, we empower our clients to achieve their goals and drive growth in a digital-first world.</p>
        <p>Contact us today to learn more about how Kloud can support your business!</p>
      </div>
      <div class="title_heading ">
        <h5> Why Choose Kloud? </h5>
      </div>
      <div>
        <p><b>Expertise:</b> With years of experience in the industry, we have the knowledge and skills to deliver effective solutions tailored to your specific needs.</p>
        <p><b>Customization:</b> We understand that every business is unique, and we offer customized solutions that align with your goals and objectives.</p>
        <p><b>Reliability:</b> Our solutions are designed to be robust and secure, ensuring that your business can operate smoothly and efficiently.</p>
        <p><b>Customer Support:</b> We pride ourselves on our exceptional customer service, providing ongoing support and guidance to our clients.</p>
      </div>
    </div>
  </div>
</section>

<section class="service_section_body">
  <div class="container-fluid">
    <div class="custome_service_section">
      @if (count($services) > 0)
        @foreach ($services as $service)
          <div class="service_page_details">
            <img class="icon" src="{{asset($service->image)}}" alt="icon">
            <h6>{{$service->title}}</h6>
            <p>{{ Str::limit($service->description, 00, '...') }}</p>
            <div class="customer_section_details_more">
              <a href="{{route('service-details',$service->uuid)}}"><button class="btn readmore_btn">Read More <i class="fa-solid fa-arrow-right"></i></button></a>
            </div>
          </div>
        @endforeach
      @else
        <div class="service_page_details">
            <h6>No Service Found</h6>
        </div>
      @endif
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
        <a class="ht-btn" href=""><span>Contact Us</span></a>
      </div>
    </div>
  </div>
</section>
@endsection
