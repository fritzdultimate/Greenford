<script src="//www.amcharts.com/lib/3/amcharts.js"></script>
<script src="//www.amcharts.com/lib/3/serial.js"></script>
<script src="//www.amcharts.com/lib/3/themes/light.js"></script>
<!--<script src="//www.amcharts.com/lib/3/amstock.js"></script>-->

<script src="{{ asset('dash/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('dash/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dash/js/modernizr.js') }}"></script>
<script src="{{ asset('dash/js/jquery.menu-aim.js') }}"></script>
<script src="{{ asset('dash/js/plugin.js') }}"></script>
<script src="{{ asset('dash/js/jquery.countTo.js') }}"></script>
<script src="{{ asset('dash/js/dropify.min.js') }}"></script>
<script src="{{ asset('dash/js/datatables.js') }}"></script>
<script src="{{ asset('dash/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('dash/js/jquery.inview.min.js') }}"></script>
<script src="{{ asset('dash/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('dash/js/owl.carousel.js') }}"></script>
<script src="{{ asset('dash/js/calculator.js') }}"></script>
<script src="{{ asset('dash/js/custom.js') }}"></script>
<script src="{{ asset('dash/js/main.js?nmm=1') }}"></script>





<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "{{ env('SITE_NUMBER') }}", // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = 'https:', host = "getbutton.io", url = proto + '//static.' + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
