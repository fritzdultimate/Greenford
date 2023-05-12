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
<h2>Frequently Asked Questions</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="index.html">Home </a></li>
<li>FAQ</li>
</ul>
</div>
</div>
<div class="col-lg-5 col-md-4 col-sm-4 xs-none">
<div class="breadcrumb-img">
<img src="assets/img/breadcrumb/br-shape-5.png" alt="Image" class="br-shape-five animationFramesTwo">
<img src="assets/img/breadcrumb/br-shape-6.png" alt="Image" class="br-shape-six bounce">
<img src="assets/img/breadcrumb/breadcrumb-2.png" alt="Image">
</div>
</div>
</div>
</div>
</div>


<section class="faq-wrap ptb-100">
<div class="container">
<div class="row gx-5 align-items-center">
<div class="col-lg-6">
<div class="faq-img-wrap">
<img src="assets/img/faq-1.jpg" alt="Image">
</div>
</div>
<div class="col-lg-6">
<div class="accordion style2" id="accordionExample">
<div class="accordion-item">
<h2 class="accordion-header" id="headingOne">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<span>
<i class="ri-arrow-down-s-line plus"></i>
<i class="ri-arrow-up-s-line minus"></i>
</span>
What services does Greenford Credit Union offer?
</button>
</h2>
<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
<div class="accordion-body">
<div class="single-product-text">
<p>We offer a range of financial products and services, including savings accounts, checking accounts, loans, credit cards, and online banking. We also provide financial education and resources to help you manage your money.</p>
</div>
</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="headingTwo">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
<span>
<i class="ri-arrow-down-s-line plus"></i>
<i class="ri-arrow-up-s-line minus"></i>
</span>
How can I access my account online?
</button>
</h2>
<div id="collapseTwo" class="accordion-collapse collapse " aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
<div class="accordion-body">
<p>You can access your account online by logging in to our website using your username and password. From there, you can view your account balances, transfer funds, pay bills, and more.</p>
</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="headingThree">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
<span>
<i class="ri-arrow-down-s-line plus"></i>
<i class="ri-arrow-up-s-line minus"></i>
</span>
How do I apply for a loan?
</button>
</h2>
<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
<div class="accordion-body">
<p>You can apply for a loan online or in person at one of our branches. We offer a variety of loans, including auto loans, personal loans, and home equity loans. Our loan officers can help you determine which loan is right for you and guide you through the application process.</p>
</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="headingfour">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
<span>
<i class="ri-arrow-down-s-line plus"></i>
<i class="ri-arrow-up-s-line minus"></i>
</span>
Is my money insured at Greenford Credit Union?
</button>
</h2>
<div id="collapsefour" class="accordion-collapse collapse " aria-labelledby="headingfour" data-bs-parent="#accordionExample">
<div class="accordion-body">
<div class="single-product-text">
<p>Yes, your deposits are insured up to $250,000 by the National Credit Union Administration (NCUA), a federal agency.</p>
</div>
</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="headingfive">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
<span>
<i class="ri-arrow-down-s-line plus"></i>
<i class="ri-arrow-up-s-line minus"></i>
</span>
What are the fees for using Greenford Credit Union's services?
</button>
</h2>
<div id="collapsefive" class="accordion-collapse collapse " aria-labelledby="headingfive" data-bs-parent="#accordionExample">
<div class="accordion-body">
<div class="single-product-text">
<p>We strive to keep our fees low and transparent. Our fee schedule is available on our website and in our branches, and we are always happy to answer any questions you may have about our fees.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

</div>
@include('visitor.layouts.footer')