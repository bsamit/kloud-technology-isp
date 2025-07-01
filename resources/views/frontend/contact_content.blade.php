@extends('welcome')
@section('title')
    Contact
@endsection
@section('site_content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<section>
  <div class="banner_text">
      <img src="./include/img/slider/5.png" class="img-fluid" alt="img">
      <div class="banner_text_details">
        <h5>Contact</h5>
        <p>Kloud Technologies Limited provides Bangladesh with premium internet solutions for residential and commercial users."</p>
      </div>
  </div>
</section>
<section class="contact_from">
  <div class="container">
    <div>
        <div class="contact-send-message">
            <h1><span>Send a</span> message</h1>
            
        </div>
        <div class="contact-send-message-form mt-3">

          <form method="POST" action="{{ route('contactStore') }}">
            @csrf
            <div class="contact-send-message-form_input">
                <input type="text" id="full-name" name="name" placeholder="Full name" required="">

                <input type="email" id="email-address" name="email" placeholder="Email address" required="">

                <input type="tel" id="phone-number" name="phone" placeholder="Phone number" required="">

            </div>
            <textarea id="message" name="message" placeholder="Write your message here..." rows="5" required=""></textarea>

            <div class="contact-send-message-form_button">
                <button type="submit" class="submit-button">Send Message</button>
            </div>
          </form>

        </div>
    </div>
</div>
</section>
<section class="helpdesk_sec">
  <div class="container">
    <div class="helpdesk_body">
      <div class="helpdesk_body_head">
        <h4>Helpdesk and Support</h4>
      </div>
      <div class="helpdesk_body_lists">
        <div>
          <h4>Helpdesk System</h4>
          <ul>
            <li> <i class="fa-solid fa-arrow-right"></i> Ticketing System: Members can submit technical issues. </li>
            <li> <i class="fa-solid fa-arrow-right"></i> Documentation: Policies, guides, and technical manuals. </li>
          </ul>
        </div>
        <div>
          <h4>Dedicated Support Team</h4>
          <ul>
            <li><i class="fa-solid fa-arrow-right"></i> Premium members get direct technical assistance.</li>
          </ul>
        </div>
      </div>
      
    </div>
     
  </div>
</section>
<section>
  <div class="container">
    <div class="contact_address">
      <div class="info-box2">
        <div class="icon">
          <i class="fa-solid fa-house"></i>
        </div>
        <div class="info-content">
          <h3 class="info-title">Dhaka Corporate Office</h3>
          <p>
            Shanta Western Tower, Suit # 904, Level 9, 186 Bir Uttam<br>
            Mir Sawkat Road, Tejgaon I/A, Dhaka – 1208, Bangladesh
          </P>
          <p><i class="fa-solid fa-phone"></i> +8809649161215</p>
          <p><a href="mailto:contact@kloud.com.bd"> <i class="fa-solid fa-envelope"></i> contact@kloud.com.bd</a></p>
        </div>
      </div>
      <div class="info-box2">
        <div class="icon">
          <i class="fa-solid fa-house-user"></i>
        </div>
        <div class="info-content">
          <h3 class="info-title">Dhaka Operation Center</h3>
          <p>
            DOM-INNO House (L-3), House 13, Road 07, Block F, Banani, Dhaka-1213,
          </P>
          <p><i class="fa-solid fa-phone"></i> +8809649161215</p>
          <p><a href="mailto:contact@kloud.com.bd"> <i class="fa-solid fa-envelope"></i> contact@kloud.com.bd</a></p>
        </div>
      </div>
      <div class="info-box2">
        <div class="icon">
          <i class="fa-solid fa-house-chimney"></i>
        </div>
        <div class="info-content">
          <h3 class="info-title">Chattogram Office</h3>
          <p>
            Saint Martin Hotel, 25-33, Sheikh Mujib Road, Chattogram-4100, Bangladesh
          </P>
          <p><i class="fa-solid fa-phone"></i> +8809649161215</p>
          <p><a href="mailto:contact@kloud.com.bd"> <i class="fa-solid fa-envelope"></i> contact@kloud.com.bd</a></p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="google_map">
  <div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8726.67147621366!2d90.3769469450342!3d23.94628211954125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c4add877baa1%3A0x1e9ccda020ea88dd!2sBoard%20Bazar!5e1!3m2!1sen!2sbd!4v1736352359418!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</section>
</section>
@endsection