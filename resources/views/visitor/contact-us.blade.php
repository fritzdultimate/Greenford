@include('visitor.layouts.head')
@include('visitor.layouts.header')

<div class="content-wrapper">

<div class="breadcrumb-wrap bg-spring">
<img src="assets/img/breadcrumb/br-shape-1.png" alt="Image" class="br-shape-one xs-none">
<img src="assets/img/breadcrumb/br-shape-2.png" alt="Image" class="br-shape-two xs-none">
<img src="assets/img/breadcrumb/br-shape-3.png" alt="Image" class="br-shape-three moveHorizontal sm-none">
<img src="assets/img/breadcrumb/br-shape-4.png" alt="Image" class="br-shape-four moveVertical sm-none">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-7 col-md-8 col-sm-8">
<div class="breadcrumb-title">
<h2>Contact Us</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="index.html">Home </a></li>
 <li>Contact</li>
</ul>
</div>
</div>
<div class="col-lg-5 col-md-4 col-sm-4 xs-none">
<div class="breadcrumb-img">
<img src="assets/img/breadcrumb/br-shape-5.png" alt="Image" class="br-shape-five animationFramesTwo">
<img src="assets/img/breadcrumb/br-shape-6.png" alt="Image" class="br-shape-six bounce">
<img src="assets/img/breadcrumb/breadcrumb-1.png" alt="Image">
</div>
</div>
</div>
</div>
</div>


<section class="contact-wrap pt-100">
<div class="container">
<div class="row justify-content-center pb-75">
<div class="col-lg-4 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="flaticon-map"></i>
</span>
<div class="contact-info">
<h3>Our Location</h3>
<p>{{ env('SITE_ADDRESS') }}
</p>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="flaticon-email-2"></i>
</span>
<div class="contact-info">
<h3>Email Us</h3>
<a href="mailto:{{ env('SUPPORT_EMAIL') }}"><span class="__cf_email__">{{ env('SUPPORT_EMAIL') }}</span></a>
</div>
</div>
</div>
<!-- <div class="col-lg-4 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="flaticon-phone-call"></i>
</span>
<!-- <div class="contact-info">
<h3>WhatsApp us</h3>
<a href="https://wa.me/{{ env('SITE_NUMBER') }}">{{ env('SITE_NUMBER') }}</a>
</div> -->
</div>
</div> -->
</div>
<div class="comp-map pb-100">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.191600377094!2d-0.35615212409993785!3d51.52804550919577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487612bd811a8c63%3A0xf99c988e0ed2f28c!2s28%20The%20Broadway%2C%20Greenford%2C%20UK!5e0!3m2!1sen!2sng!4v1683678024763!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>
<div class="contact-form-area ptb-100 bg-albastor">
<img src="assets/img/contact-shape-1.png" alt="Image" class="contact-shape-one animationFramesTwo">
<img src="assets/img/contact-shape-2.png" alt="Image" class="contact-shape-two bounce">
 <div class="container">
<div class="row">
<div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
<div class="content-title style1 text-center mb-40">
<span>Send Us A Message</span>
<h2>Do You have Any Questions?</h2>
</div>
<div class="contact-form">
<form class="form-wrap" id="contactForm">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<input type="text" name="name" placeholder="Your Name*" id="name" required data-error="Please enter your name">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="email" name="email" id="email" required placeholder="Your Email*" data-error="Please enter your email*">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="number" name="phone" id="phone" required placeholder="Phone Number" data-error="Please enter your phone number">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="text" name="msg_subject" placeholder="Subject" id="msg_subject" required data-error="Please enter your subject">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-12">
<div class="form-group v1">
<textarea name="message" id="message" placeholder="Your Messages.." cols="30" rows="10" required data-error="Please enter your message"></textarea>
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-12 text-center">
<button type="submit" class="btn style1 w-100 d-block">Send Message </button>
<div id="msgSubmit" class="h3 text-center hidden"></div>
<div class="clearfix"></div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</section>

</div>

@include('visitor.layouts.footer')