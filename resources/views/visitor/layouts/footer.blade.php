	<footer class="footer-wrap bg-rock">
		<div class="container">
			<img src="assets/img/footer-shape-1.png" alt="Image" class="footer-shape-one">
			<img src="assets/img/footer-shape-2.png" alt="Image" class="footer-shape-two">
			<div class="row pt-100 pb-75">
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
					<div class="footer-widget">
						<a href="/" class="footer-logo">
							<span class="text-white">
								{{ env('SITE_NAME') }}
							</span>
						</a>
						<p class="comp-desc">
							On the other hand, we denounce whteous indig nation and dislike men wh beguiled moraized er hand consec teturus adipis iscing elit eiusmod tempordunt labore dolore magna aliqua consector tetur adip iscing.
						</p>
						<div class="social-link">
							<ul class="social-profile list-style style1">
								<li>
									<a target="_blank" href="https://facebook.com/">
										<i class="ri-facebook-fill"></i>
									</a>
								</li>
								<li>
									<a target="_blank" href="https://twitter.com/">
										<i class="ri-twitter-fill"></i>
									</a>
								</li>
								<li>
									<a target="_blank" href="https://linkedin.com/">
										<i class="ri-linkedin-fill"></i>
									</a>
								</li>
								<li>
									<a target="_blank" href="https://instagram.com/">
										<i class="ri-pinterest-fill"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h3 class="footer-widget-title">Our Company</h3>
						<ul class="footer-menu list-style">
							<li>
								<a href="/about">
									<i class="flaticon-next"></i>
									Company &amp; Team
								</a>
							</li>
							<li>
								<a href="/faq">
									<i class="flaticon-next"></i>
									FAQs
								</a>
							</li>
							<li>
								<a href="/contact">
									<i class="flaticon-next"></i>
									Contact Us
								</a>
							</li>
							<li>
								<a href="/privacy-policy">
									<i class="flaticon-next"></i>
									Privacy Policy
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h3 class="footer-widget-title">Links</h3>
						<ul class="footer-menu list-style">
							<li>
								<a href="/">
									<i class="flaticon-next"></i>
									Home
								</a>
							</li>
							<li>
								<a href="/terms">
									<i class="flaticon-next"></i>
									Terms & Conditions
								</a>
							</li>
							<li>
								<a href="/contact">
									<i class="flaticon-next"></i>
									Support
								</a>
							</li>
							<li>
								<a href="/contact">
									<i class="flaticon-next"></i>
									Help
								</a>
							</li>
							<li>
								<a href="/register">
									<i class="flaticon-next"></i>
									Register
								</a>
							</li>
							<li>
								<a href="/login">
									<i class="flaticon-next"></i>
									Login
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h3 class="footer-widget-title">Subscribe</h3>
						<p class="newsletter-text">
							Receive our weekly updates direct in your email, and be updated with our timely offers.
						</p>
						<form action="/" class="newsletter-form">
							<input type="email" placeholder="Your Email" name="email">
							<button type="button">Subscribe</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright-text">
			<p> 
				<i class="ri-copyright-line"></i>{{ date('m/Y') }} {{ env('SITE_NAME_SHORT') }}. All Rights Reserved By <a href="/">{{ env('SITE_NAME') }}</a></p>
		</div>
	</footer>

</div>


<a href="javascript:void(0)" class="back-to-top bounce">
	<i class="ri-arrow-up-s-line"></i>
</a>


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">

</script><script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/odometer.min.js') }}"></script>
<script src="{{ asset('assets/js/fancybox.js') }}"></script>
<script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
<script src="{{ asset('assets/js/tweenmax.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>