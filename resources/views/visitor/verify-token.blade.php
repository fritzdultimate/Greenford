<html lang="zxx" class="js">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="{{ env("SITE_NAME") }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="title" content="{{ env("SITE_NAME") }} is all about trading, investment, mining, and lending. the company specialises in crypto trading, investment and mining in which they train professional traders and make them experts who trades with the help of a api trading robot to yield and mine huge profits for investors.">
        <meta name="description" content="We engage in best practice to provide our users/investors platform to perform their investment, we have highly trained professionals which are available on demand, to guide investors on best practices.">
        <meta name="keywords" content="best, investment, websites, crypto, investment, website, legit, investment, website, trading, secured, cryptocurrency, wallet, bitcoin, btc, ethereum, eth, dodge, bitcoin, cash, bhc, ">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ Request::getSchemeAndHttpHost() }}">
        <meta property="og:title" content="{{ env("SITE_NAME") }} is all about trading, investment, mining, and lending. the company specialises in crypto trading, investment and mining in which they train professional traders and make them experts who trades with the help of a api trading robot to yield and mine huge profits for investors.">
        <meta property="og:description" content="We engage in best practice to provide our users/investors platform to perform their investment, we have highly trained professionals which are available on demand, to guide investors on best practices.">
        <meta property="og:image" content="https://GoldGlobalTrade.com/images/social.png">
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ Request::getSchemeAndHttpHost() }}">
        <meta property="twitter:title" content="{{ env("SITE_NAME") }} is all about trading, investment, mining, and lending. the company specialises in crypto trading, investment and mining in which they train professional traders and make them experts who trades with the help of a api trading robot to yield and mine huge profits for investors.">
        <meta property="twitter:description" content="We engage in best practice to provide our users/investors platform to perform their investment, we have highly trained professionals which are available on demand, to guide investors on best practices.">
        <meta property="twitter:image" content="https://GoldGlobalTrade.com/images/social.png">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">
        <meta name="revisit-after" content="1 days">
        <link rel="shortcut icon" href="/visitor/images/favicon.png" />
        <title>{{ $page_title }}</title>
        <link rel="stylesheet" href="/assets/css/v/vendor.bundle2453.css?ver=1" />
        <link rel="stylesheet" href="/assets/css/v/style-dark.css?g=1" id="changeTheme" />
        <link rel="stylesheet" href="/assets/css/v/theme.css?ver=1" />
        <link rel="stylesheet" type="text/css" href="{{ asset('dash/plugins/lobibox/css/lobibox.min.css?ref=0') }}">
    </head>
    <body class="nk-body body-wider bg-theme">
        <div class="nk-wrap">
            <header class="nk-header page-header is-transparent is-sticky is-dark" id="header">
                <div class="header-banner bg-theme-grad has-ovm">
                    <div class="nk-banner">
                        <div class="banner banner-page">
                            <div class="banner-wrap">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-9">
                                            <div class="banner-caption cpn tc-light text-center">
                                                <div class="cpn-head">
                                                    <h2 class="title ttu">Verify Token</h2>
                                                    <p>Verify The Token Sent To Your Email Address</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .nk-banner -->
                    <div class="nk-ovm shape-a-sm"></div>
                </div>

            </header>
            <main class="nk-pages tc-light">
               <section>
                   <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="">
                                    
                                    <div class="login_form_wrapper">
                                    <p>Enter Token Sent To Your Email Address</p>
                                        <form class="page-form pass-form">
                                            <div class="form-group icon_form comments_form">
                                                <input required type="text" class="input-bordered require" name="token" placeholder="Enter Token">
                                            </div>
                                            <div class="form-group icon_form comments_form">
                                                <input required type="hidden" class="form-control require" name="email" value="{{ session('email') }}">
                                            </div>
                                            <div>
                                                <button class="btn btn-warning w-100 input-rounded" type="submit">
                                                    <span class="form-loading d-none px-5">
                                                        <i class="fa fa-sync fa-spin"></i>
                                                    </span>
                                                    <span class='submit-text'>
                                                        Submit
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                        <div class="dont_have_account float_left">
                                            <p>back to login? <a href="/login">Login</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </section>
            </main>
            <script src="/assets/js/v/jquery.bundle2453.js?ver=1"></script>
    <script src="/assets/js/v/scripts2453.js?ver=1"></script>
    <script src="/assets/js/v/charts2453.js?ver=1"></script>
    <script src="/assets/js/v/footer-plugins.js?ref=4"></script>
    <script src="{{ asset('dash/plugins/lobibox/js/lobibox.js') }}"></script>
    <script src="{{ asset('dash/js/fn.js') }}"></script>
           <script src="{{ asset('js/verify-token.js') }}"></script>
    </body>
</html>
