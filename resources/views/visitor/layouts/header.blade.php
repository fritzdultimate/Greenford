<div class="loader js-preloader">
	<div></div>
	<div></div>
	<div></div>
</div>


<div class="page-wrapper">

	<header class="header-wrap style1">
		<div class="header-top">
			<button type="button" class="close-sidebar">
				<i class="ri-close-fill"></i>
			</button>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-8 col-md-12">
						<div class="header-top-left">
							<ul class="contact-info list-style">
								<li>
									<i class="flaticon-email-1"></i> 
									<a href="mailto:{{env('SUPPORT_EMAIL')}}">
										<span class="__cf_email__">
											{{env('SUPPORT_EMAIL')}}
										</span>
									</a>
								</li>
								<li>
									<i class="flaticon-pin"></i>
									<p>{{env('SITE_ADDRESS')}}</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-12">
						<div class="header-top-right">
							<ul class="header-top-menu list-style">
								<li><a href="/contact">Support</a></li>
								<li><a href="/contact">Help</a></li>
							</ul>
							<div>
								<a href="/login" class="nav-link">Login</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<div class="container">
				<nav class="navbar navbar-expand-md navbar-light">
					<a class="navbar-brand" href="/">
						<img src="{{ asset('assets/img/favicon.png') }}">
						<span>
							{{ env('SITE_NAME') }}
						</span>
					</a>

					<div class="collapse navbar-collapse main-menu-wrap" id="navbarSupportedContent">
						<ul class="navbar-nav ms-auto">
							<li class="nav-item  has-dropdown">
								<a href="/" class="nav-link active">
									Home
								</a>
							</li>


							<li class="nav-item">
								<a href="/about-us" class="nav-link">
									About Us
								</a>
							</li>

							<li class="nav-item has-dropdown">
								<a href="/terms" class="nav-link">
									Terms & Conditions
								</a>
							</li>


							<li class="nav-item has-dropdown">
								<a href="/privacy-policy" class="nav-link">
									Privacy Policy
								</a>
							</li>


							<li class="nav-item has-dropdown">
								<a href="/faq" class="nav-link">
									FAQs
								</a>
							</li>

							<li class="nav-item has-dropdown">
								<a href="/contact" class="nav-link">
									Help
								</a>
							</li>

							<li class="nav-item">
								<a href="/contact" class="nav-link">
									Contact Us
								</a>
							</li>

							<li class="nav-item xl-none">
								<a href="/register" class="btn style1">
									Register Now
								</a>
							</li>

						</ul>

						<div class="others-options  lg-none">
							<div class="header-btn lg-none">
								<a href="/register" class="btn style1">
									Register Now
								</a>
							</div>
						</div>
					</div>
				</nav>

				<div class="mobile-bar-wrap">
					<div class="mobile-sidebar">
						<i class="ri-menu-4-line"></i>
					</div>
					<div class="mobile-menu xl-none">
						<a href="javascript:void(0)">
							<i class="ri-menu-line"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>