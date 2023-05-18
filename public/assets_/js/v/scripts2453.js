var NioApp = (function (a, l, e) {
    "use strict";
    var s = { AppInfo: { name: "ICOCrypto", package: "1.9.2", version: "1.0.4", author: "Softnio" } },
        i = { docReady: [], docReadyDefer: [], winLoad: [], winLoadDefer: [] };
    function t(l) {
        (l = void 0 === l ? a : l),
            i.docReady.concat(i.docReadyDefer).forEach(function (a) {
                a(l);
            });
    }
    function o(l) {
        (l = "object" == typeof l ? a : l),
            i.winLoad.concat(i.winLoadDefer).forEach(function (a) {
                a(l);
            });
    }
    return a(e).ready(t), a(l).on("load", o), (s.components = i), (s.docReady = t), (s.winLoad = o), s;
})(jQuery, window, document);

var NioApp = (function (w, k, o, d) {
    "use strict";
    var P = k(o),
        m = k(d),
        r = k("body"),
        h = k(".header-main"),
        // v = "menu-mobile",
        e = "has-fixed",
        s = "is-shrink",
        a = "nk-block",
        l = "nio-theme",
        g = o.location.href,
        u = o.location.hostname,
        i = h.innerHeight() - 2,
        p = g.split("#");
    (k.fn.exists = function () {
        return 0 < this.length;
    }),
        (w.Win = {}),
        (w.Win.height = k(o).height()),
        (w.Win.width = k(o).width()),
        (w.getStatus = {}),
        (w.getStatus.isRTL = !(!r.hasClass("has-rtl") && "rtl" !== r.attr("dir"))),
        (w.getStatus.isTouch = "ontouchstart" in d.documentElement),
        (w.getStatus.isMobile = !!navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|/i)),
        (w.getStatus.asMobile = w.Win.width < 768),
        P.on("resize", function () {
            (w.Win.height = k(o).height()), (w.Win.width = k(o).width()), (w.getStatus.asMobile = w.Win.width < 768);
        }),
        (w.Util = {}),
        (w.Util.classInit = function () {
            function a() {
                !0 === w.getStatus.asMobile ? r.addClass("as-mobile") : r.removeClass("as-mobile");
            }
            !0 === w.getStatus.isTouch ? r.addClass("has-touch") : r.addClass("no-touch"), a(), "rtl" === r.attr("dir") && (r.addClass("has-rtl"), (w.getStatus.isRTL = !0)), r.addClass("nk-" + l), k(o).on("resize", a);
        }),
        w.components.docReady.push(w.Util.classInit),
        (w.Util.preLoader = function () {
            var a = k(".preloader"),
                l = k(".spinner");
            a.exists() && (r.addClass("page-loaded"), l.addClass("load-done"), l.hasClass("spinner-alt") || l.fadeOut(300), a.delay(600).fadeOut(300));
        }),
        w.components.winLoad.push(w.Util.preLoader),
        (w.Util.backTop = function () {
            var a = k(".backtop");
            if (a.exists()) {
                800 < P.scrollTop() ? a.fadeIn("slow") : a.fadeOut("slow"),
                    a.on("click", function (a) {
                        k("body,html").stop().animate({ scrollTop: 0 }, 1500, "easeInOutExpo"), a.preventDefault();
                    });
            }
        }),
        w.components.docReady.push(w.Util.backTop),
        (w.Util.browser = function () {
            var a = -1 !== navigator.userAgent.indexOf("Chrome") ? 1 : 0,
                l = -1 !== navigator.userAgent.indexOf("Firefox") ? 1 : 0,
                e = -1 !== navigator.userAgent.indexOf("Safari"),
                s = -1 !== navigator.userAgent.indexOf("MSIE") || d.documentMode ? 1 : 0,
                i = !s && !!o.StyleMedia,
                t = navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf("OPR") ? 1 : 0;
            a ? r.addClass("chrome") : l ? r.addClass("firefox") : s ? r.addClass("ie") : i ? r.addClass("edge") : t ? r.addClass("opera") : e && r.addClass("safari");
        }),
        w.components.winLoad.push(w.Util.browser),
        (w.Util.headerSticky = function () {
            var l = k(".is-sticky"),
                a = {
                    hasFixed: function () {
                        if (l.exists()) {
                            var a = l.offset();
                            P.on("scroll", function () {
                                P.scrollTop() > a.top ? l.hasClass(e) || l.addClass(e) : l.hasClass(e) && l.removeClass(e);
                            });
                        }
                    },
                    hasShrink: function () {
                        l.hasClass(s) && (i = h.height() + 16 - 2);
                    },
                };
            a.hasFixed(),
                a.hasShrink(),
                P.on("resize", function () {
                    i = l.hasClass(s) ? h.height() + 16 - 2 : h.outerHeight() - 2;
                });
        }),
        w.components.docReady.push(w.Util.headerSticky),
        (w.Util.imageBG = function () {
            var a = k(".bg-image");
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.parent(),
                        e = a.data("overlay"),
                        s = a.data("opacity"),
                        i = a.children("img").attr("src"),
                        t = !(void 0 === e || !e) && e,
                        o = !(void 0 === s || !s) && s;
                    void 0 !== i &&
                        "" !== i &&
                        (l.hasClass("has-bg-image") || l.addClass("has-bg-image"),
                        t ? a.hasClass("overlay-" + t) || (a.addClass("overlay"), a.addClass("overlay-" + t)) : a.hasClass("overlay-fall") || a.addClass("overlay-fall"),
                        o && a.addClass("overlay-opacity-" + o),
                        a.css("background-image", 'url("' + i + '")').addClass("bg-image-loaded"));
                });
        }),
        w.components.docReady.push(w.Util.imageBG),
        (w.Util.Ovm = function () {
            var a = k(".nk-ovm"),
                l = k(".nk-ovm[class*=mask]"),
                e = k("[class*=ui-mask]");
            a.exists() &&
                a.each(function () {
                    k(this).parent().hasClass("has-ovm") || k(this).parent().addClass("has-ovm");
                }),
                l.exists() &&
                    l.each(function () {
                        k(this).parent().hasClass("has-mask") || k(this).parent().addClass("has-mask");
                    }),
                e.exists() &&
                    e.each(function () {
                        k(this).parent().hasClass("has-ovm") || k(this).parent().addClass("has-ovm");
                    });
        }),
        w.components.docReady.push(w.Util.Ovm),
        (w.Util.progressBar = function () {
            var a = k("[data-percent]"),
                l = k("[data-point]");
            a.exists() &&
                a.each(function () {
                    k(this).css("width", k(this).data("percent") + "%");
                }),
                l.exists() &&
                    l.each(function () {
                        k(this).css("left", k(this).data("point") + "%");
                    }),
                l.exists() &&
                    !0 === w.getStatus.isRTL &&
                    l.each(function () {
                        k(this).css("right", k(this).data("point") + "%"), k(this).css("left", "auto");
                    });
        }),
        w.components.docReady.push(w.Util.progressBar),
        (w.Util.inputAnimate = function () {
            var a = k(".input-line");
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.val(),
                        e = "input-focused";
                    l && a.parent().addClass(e),
                        a.on("focus", function () {
                            k(this).parent().addClass(e);
                        }),
                        a.on("blur", function () {
                            k(this).parent().removeClass(e), k(this).val() && k(this).parent().addClass(e);
                        });
                });
        }),
        w.components.docReady.push(w.Util.inputAnimate),
        (w.Util.toggler = function () {
            var s = ".toggle-tigger",
                i = ".toggle-class";
            k(s).exists() &&
                m.on("click", s, function (a) {
                    var l = k(this);
                    k(s).not(l).removeClass("active"), k(i).not(l.parent().children()).removeClass("active"), l.toggleClass("active").parent().find(i).toggleClass("active"), a.preventDefault();
                }),
                m.on("click", "body", function (a) {
                    var l = k(s),
                        e = k(i);
                    e.is(a.target) || 0 !== e.has(a.target).length || l.is(a.target) || 0 !== l.has(a.target).length || (e.removeClass("active"), l.removeClass("active"));
                });
        }),
        w.components.docReady.push(w.Util.toggler),
        (w.Util.accordionActive = function () {
            var a = k(".accordion-item"),
                l = k(".accordion-title");
            a.exists() &&
                a.each(function () {
                    var a = k(this);
                    a.find(".accordion-title").hasClass("collapsed") ? a.removeClass("current") : a.addClass("current");
                }),
                l.exists() &&
                    l.on("click", function () {
                        var a = k(this);
                        a.parent().siblings().removeClass("current"), a.parent().addClass("current");
                    });
        }),
        w.components.docReady.push(w.Util.accordionActive),
        (w.Util.scrollAnimation = function () {
            var a = k(".animated");
            k().waypoint &&
                a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.data("animate"),
                        e = a.data("duration"),
                        s = a.data("delay");
                    a.waypoint(
                        function () {
                            a.addClass("animated " + l).css("visibility", "visible"), e && a.css("animation-duration", e + "s"), s && a.css("animation-delay", s + "s");
                        },
                        { offset: "95%" }
                    );
                });
        }),
        w.components.winLoad.push(w.Util.scrollAnimation),
        (w.MainMenu = function () {
            var l = k(".navbar-toggle"),
                e = k(".header-navbar"),
                s = k(".header-navbar-classic"),
                i = k(".menu-toggle"),
                a = k(".menu-link"),
                t = ".menu-drop",
                o = "open-nav",
                d = "menu-shown",
                n = "navbar-active",
                c = {
                    Overlay: function () {
                        e.exists() && e.append('<div class="header-navbar-overlay"></div>');
                    },
                    navToggle: function () {
                        l.exists() &&
                            l.on("click", function (a) {
                                var l = k(this),
                                    e = l.data("menu-toggle");
                                l.toggleClass(n),
                                    s.exists()
                                        ? k("#" + e)
                                              .slideToggle()
                                              .toggleClass(d)
                                        : k("#" + e)
                                              .parent()
                                              .toggleClass(d),
                                    r.toggleClass("overlay-" + d),
                                    a.preventDefault();
                            });
                    },
                    navClose: function () {
                        k(".header-navbar-overlay").on("click", function () {
                            l.removeClass(n), e.removeClass(d), r.removeClass("overlay-" + d);
                        }),
                            a.on("click", function () {
                                k(this).hasClass("menu-toggle") || (l.removeClass(n), e.removeClass(d), r.removeClass("overlay-" + d));
                            }),
                            m.on("click", "body", function (a) {
                                !i.is(a.target) &&
                                    0 === i.has(a.target).length &&
                                    !h.is(a.target) &&
                                    0 === h.has(a.target).length &&
                                    P.width() < 992 &&
                                    (l.removeClass(n), s.find(".header-menu").slideUp(), e.removeClass(d), r.removeClass("overlay-" + d));
                            });
                    },
                    menuToggle: function () {
                        i.exists() &&
                            i.on("click", function (a) {
                                var l = k(this).parent();
                                P.width() < 992 && (l.children(t).slideToggle(400), l.siblings().children(t).slideUp(400), l.toggleClass(o), l.siblings().removeClass(o)), a.preventDefault();
                            });
                    },
                    mobileNav: function () {
                        P.width() < 992 ? e.delay(500).addClass('menu-mobile') : (e.delay(500).removeClass('menu-mobile'), e.removeClass(d));
                    },
                    currentPage: function () {
                        a.exists() &&
                            a.each(function () {
                                g === this.href && "" !== p[1] && k(this).closest("li").addClass("active").parent().closest("li").addClass("active"), (void 0 !== g && void 0 !== u) || r.addClass("d-nonest");
                            });
                    },
                };
            c.Overlay(),
                c.navToggle(),
                c.navClose(),
                c.menuToggle(),
                c.mobileNav(),
                c.currentPage(),
                P.on("resize", function () {
                    c.mobileNav();
                });
        }),
        w.components.docReady.push(w.MainMenu),
        (w.OnePageScroll = function () {
            k('a.menu-link[href*="#"]:not([href="#"])').on("click", function () {
                if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
                    var a = this.hash,
                        l = !!this.hash.slice(1) && k("[name=" + this.hash.slice(1) + "]"),
                        e = a.length ? k(a) : l;
                    if (e.length)
                        return (
                            k(".navbar-toggle").removeClass("active"),
                            k(".header-navbar").removeClass("menu-shown"),
                            k("html, body")
                                .delay(150)
                                .animate({ scrollTop: e.offset().top - i }, 1e3, "easeInOutExpo"),
                            !1
                        );
                }
            });
        }),
        w.components.docReady.push(w.OnePageScroll),
        (w.scrollAct = function () {
            var a = k(".header-menu").attr("id");
            r.scrollspy({ target: "#" + a, offset: i + 2 });
        }),
        w.components.docReady.push(w.scrollAct),
        (w.modalFix = function () {
            k(".modal").on("shown.bs.modal", function () {
                r.hasClass("modal-open") || r.addClass("modal-open");
            });
        }),
        w.components.docReady.push(w.modalFix),
        (w.Plugins = {}),
        (w.Plugins.countdown = function () {
            var a = k(".countdown");
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.attr("data-date"),
                        e = a.data("day-text") ? a.data("day-text") : "Days",
                        s = a.data("hour-text") ? a.data("hour-text") : "Hours",
                        i = a.data("min-text") ? a.data("min-text") : "Min",
                        t = a.data("sec-text") ? a.data("sec-text") : "Sec";
                    a.countdown(l).on("update.countdown", function (a) {
                        k(this).html(
                            a.strftime(
                                '<div class="countdown-item"><span class="countdown-time countdown-time-first">%D</span><span class="countdown-text">' +
                                    e +
                                    '</span></div><div class="countdown-item"><span class="countdown-time">%H</span><span class="countdown-text">' +
                                    s +
                                    '</span></div><div class="countdown-item"><span class="countdown-time">%M</span><span class="countdown-text">' +
                                    i +
                                    '</span></div><div class="countdown-item"><span class="countdown-time countdown-time-last">%S</span><span class="countdown-text">' +
                                    t +
                                    "</span></div>"
                            )
                        );
                    });
                });
        }),
        w.components.docReady.push(w.Plugins.countdown),
        (w.Plugins.carousel = function () {
            var a = k(".has-carousel");
            function C(a) {
                var l = k(a);
                !l.hasClass("blank-added") && 575 < P.width()
                    ? (l.trigger("add.owl.carousel", ['<div class="item-blank"></div>']), l.addClass("blank-added").removeClass("blank-removed"), l.trigger("refresh.owl.carousel"))
                    : !l.hasClass("blank-removed") && P.width() < 576 && l.hasClass("blank-added") && (l.trigger("remove.owl.carousel", -1), l.addClass("blank-removed").removeClass("blank-added"), l.trigger("refresh.owl.carousel"));
            }
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.data("items") ? a.data("items") : 4,
                        e = a.data("items-desk") ? a.data("items-desk") : l,
                        s = a.data("items-tab-l") ? a.data("items-tab-l") : 3 < l ? l - 1 : l,
                        i = a.data("items-tab-p") ? a.data("items-tab-p") : 2 < s ? s - 1 : s,
                        t = a.data("items-mobile") ? a.data("items-mobile") : 1 < i ? i - 1 : i,
                        o = a.data("items-mobile-s") ? a.data("items-mobile-s") : t,
                        d = a.data("timeout") ? a.data("timeout") : 6e3,
                        n = !!a.data("auto") && a.data("auto"),
                        c = a.data("auto-speed") ? a.data("auto-speed") : 600,
                        m = !!a.data("loop") && a.data("loop"),
                        r = !!a.data("dots") && a.data("dots"),
                        h = !!a.data("custom-dots") && "." + a.data("custom-dots"),
                        v = !!a.data("navs") && a.data("navs"),
                        g = !!a.data("center") && a.data("center"),
                        u = a.data("margin") ? a.data("margin") : 30,
                        p = a.data("margin-tab-l") ? a.data("margin-tab-l") : u,
                        f = a.data("margin-tab-p") ? a.data("margin-tab-p") : p,
                        x = a.data("margin-mob") ? a.data("margin-mob") : f,
                        b = !!a.data("animate-out") && a.data("animate-out"),
                        y = !!a.data("animate-in") && a.data("animate-in");
                    l <= 1 && (l = e = s = i = t = 1),
                        a.addClass("owl-carousel").owlCarousel({
                            navText: ["", ""],
                            items: l,
                            loop: m,
                            nav: v,
                            dots: r,
                            dotsContainer: h,
                            margin: u,
                            center: g,
                            autoplay: n,
                            autoplayTimeout: d,
                            autoplaySpeed: c,
                            animateOut: b,
                            animateIn: y,
                            rtl: w.getStatus.isRTL,
                            autoHeight: !1,
                            responsive: { 0: { items: o, margin: x }, 576: { items: o, margin: x }, 768: { items: i, margin: p }, 992: { items: e, margin: p }, 1200: { items: l, margin: u }, 1600: { items: e, margin: u } },
                            onInitialized: function () {
                                k().waypoint && Waypoint.refreshAll();
                            },
                        }),
                        !0 === a.data("blank") &&
                            (C(a),
                            P.on("resize", function () {
                                C(a);
                            }));
                });
        }),
        w.components.docReady.push(w.Plugins.carousel),
        (w.Plugins.flexslider = function () {
            var a = k(".gfx-slider");
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.data("slide-speed") ? a.data("slide-speed") : 3e3,
                        e = !!a.data("slide-show") && a.data("slide-show"),
                        s = !!a.data("anim-loop") && a.data("anim-loop"),
                        i = a.data("anim-speed") ? a.data("anim-speed") : 600,
                        t = !!a.data("pause") && a.data("pause");
                    a.flexslider({ animation: "fade", animationLoop: s, animationSpeed: i, slideshow: e, slideshowSpeed: l, directionNav: !1, controlNav: !0, pauseOnAction: t });
                });
        }),
        w.components.docReady.push(w.Plugins.flexslider),
        (w.Plugins.select2 = function () {
            var a = k(".select");
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.data("select2-theme") ? a.data("select2-theme") : "bordered",
                        e = a.data("select2-placehold") ? a.data("select2-placehold") : "Select an option";
                    a.select2({ placeholder: e, theme: "default select-" + l });
                });
        }),
        w.components.docReady.push(w.Plugins.select2),
        (w.Plugins.validform = function () {
            var a = k(".form-validate");
            if (!k().validate) return console.log("jQuery Form Validate not Defined."), !0;
            a.exists() &&
                a.each(function () {
                    var a = k(this);
                    a.validate(),
                        a.find(".select").on("change", function () {
                            k(this).valid();
                        });
                });
        }),
        w.components.docReady.push(w.Plugins.validform),
        (w.Plugins.submitform = function () {
            var a = k(".nk-form-submit");
            if (!k().validate && !k().ajaxSubmit) return console.log("jQuery Form and Form Validate not Defined."), !0;
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        s = a.find(".form-results");
                    a.validate({
                        ignore: [],
                        invalidHandler: function () {
                            s.slideUp(400);
                        },
                        submitHandler: function (e) {
                            s.slideUp(400),
                                k(e).ajaxSubmit({
                                    target: s,
                                    dataType: "json",
                                    success: function (a) {
                                        var l = "error" === a.result ? "alert-danger" : "alert-success";
                                        s
                                            .removeClass("alert-danger alert-success")
                                            .addClass("alert " + l)
                                            .html(a.message)
                                            .slideDown(400),
                                            "error" !== a.result && k(e).clearForm().find("input").removeClass("input-focused");
                                    },
                                });
                        },
                    }),
                        a.find(".select").on("change", function () {
                            k(this).valid();
                        });
                });
        }),
        w.components.docReady.push(w.Plugins.submitform),
        (w.Plugins.parallax = function () {
            var a = k("[data-parallax]");
            a.exists() &&
                a.each(function () {
                    var a = k(this);
                    !0 === a.data("parallax") && (a.addClass("plx-bg"), a.parent().addClass("has-plx"));
                });
        }),
        w.components.docReady.push(w.Plugins.parallax),
        (w.Plugins.popup = function () {
            var a = k(".content-popup"),
                l = k(".video-popup"),
                e = k(".image-popup"),
                s = {
                    content_popup: function () {
                        a.exists() &&
                            a.each(function () {
                                var a = k(this).data("overlay"),
                                    l = void 0 !== a && a ? a : "";
                                k(this).magnificPopup({ type: "inline", preloader: !0, removalDelay: 400, mainClass: "mfp-fade content-popup " + l });
                            });
                    },
                    video_popup: function () {
                        l.exists() &&
                            l.each(function () {
                                k(this).magnificPopup({
                                    type: "iframe",
                                    removalDelay: 160,
                                    preloader: !0,
                                    fixedContentPos: !1,
                                    callbacks: {
                                        beforeOpen: function () {
                                            (this.st.image.markup = this.st.image.markup.replace("mfp-figure", "mfp-figure mfp-with-anim")), (this.st.mainClass = this.st.el.attr("data-effect"));
                                        },
                                    },
                                });
                            });
                    },
                    image_popup: function () {
                        e.exists() &&
                            e.each(function () {
                                k(this).magnificPopup({ type: "image", mainClass: "mfp-fade image-popup" });
                            });
                    },
                };
            s.content_popup(), s.video_popup(), s.image_popup();
        }),
        w.components.docReady.push(w.Plugins.popup),
        (w.Plugins.particles = function () {
            var a = k(".particles-bg");
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.attr("id"),
                        e = a.data("pt-base") ? a.data("pt-base") : "#fff",
                        s = a.data("pt-base-op") ? parseFloat(a.data("pt-base-op")) : 0.1,
                        i = a.data("pt-shape") ? a.data("pt-shape") : "#fff",
                        t = a.data("pt-shape-op") ? parseFloat(a.data("pt-shape-op")) : 0.1,
                        o = a.data("pt-line") ? a.data("pt-line") : "#fff",
                        d = a.data("pt-line-op") ? parseFloat(a.data("pt-line-op")) : 0.2;
                    particlesJS(l, {
                        particles: {
                            number: { value: 30, density: { enable: !0, value_area: 800 } },
                            color: { value: e },
                            shape: { type: "circle", opacity: t, stroke: { width: 0, color: i }, polygon: { nb_sides: 5 } },
                            opacity: { value: s, random: !1, anim: { enable: !1, speed: 1, opacity_min: 0.12, sync: !1 } },
                            size: { value: 6, random: !0, anim: { enable: !1, speed: 40, size_min: 0.08, sync: !1 } },
                            line_linked: { enable: !0, distance: 150, color: o, opacity: d, width: 1.3 },
                            move: { enable: !0, speed: 6, direction: "none", random: !1, straight: !1, out_mode: "out", bounce: !1, attract: { enable: !1, rotateX: 600, rotateY: 1200 } },
                        },
                        interactivity: {
                            detect_on: "canvas",
                            events: { onhover: { enable: !0, mode: "repulse" }, onclick: { enable: !0, mode: "push" }, resize: !0 },
                            modes: {
                                grab: { distance: 400, line_linked: { opacity: 1 } },
                                bubble: { distance: 400, size: 40, duration: 2, opacity: 8, speed: 3 },
                                repulse: { distance: 200, duration: 0.4 },
                                push: { particles_nb: 4 },
                                remove: { particles_nb: 2 },
                            },
                        },
                        retina_detect: !0,
                    });
                });
        }),
        w.components.docReady.push(w.Plugins.particles),
        (w.Plugins.videoBG = function () {
            var a = k(".bg-video");
            a.exists() &&
                a.each(function () {
                    var a = k(this),
                        l = a.parent(),
                        e = a.data("overlay"),
                        s = a.data("opacity"),
                        i = a.data("video"),
                        t = a.data("cover"),
                        o = !(void 0 === e || !e) && e,
                        d = !(void 0 === s || !s) && s,
                        n = !(void 0 === t || !t) && t;
                    l.hasClass("has-bg-video") || l.addClass("has-bg-video"),
                        o ? a.hasClass("overlay-" + o) || (a.addClass("overlay"), a.addClass("overlay-" + o)) : a.hasClass("overlay-fall") || a.addClass("overlay-fall"),
                        d && a.addClass("overlay-opacity-" + d),
                        n && w.Win.width < 768 && (a.addClass("cover-enabled"), a.append('<div class="bg-video-cover" style="background-image:url(' + n + ')"></div>')),
                        a.hasClass("bg-video-youtube") &&
                            !a.hasClass("cover-enabled") &&
                            a.YTPlayer({
                                fitToBackground: !0,
                                videoId: i,
                                callback: function () {
                                    console.clear();
                                },
                            });
                });
        }),
        w.components.docReady.push(w.Plugins.videoBG),
        P.on("resize", function () {
            w.components.docReady.push(w.Plugins.videoBG);
        }),
        (w.Plugins.dataTable = function () {
            var a = k(".dt-filter-init");
            if (a.exists()) {
                var l = a.DataTable({ ordering: !0, autoWidth: !1, dom: "<'row'<'col-sm-6 col-mb-6'f><'col-sm-6'<'dt-short'>>><'table-wrap't>", language: { search: '<em class="ti ti-search"></em>', searchPlaceholder: "Search" } });
                k(".dt-shorter").on("change", function () {
                    var a = k(this).val();
                    l.columns("." + a)
                        .order("asc")
                        .draw();
                });
            }
        }),
        w.components.docReady.push(w.Plugins.dataTable);
    var t = u.split("."),
        n = l.slice(-5) + l.slice(0, 3),
        c = t.indexOf(n);
    return (
        (w.demoPanel = function () {
            var a = w.getStatus.isRTL ? "./../visitor/images" : "./visitor/images",
                l = "./",
                e = (w.getStatus.isRTL, w.getStatus.isRTL ? "../../ico-user/" : "../ico-user/"),
                s = w.getStatus.isRTL ? "../" : "./rtl/",
                i = w.getStatus.isRTL ? "LTR" : "RTL";
            
            var t = k(".demo-themes,.demo-close"),
                o = k(".demo-content"),
                d = k(".demo-color"),
                n = k(".demo-color-palette"),
                c = k(".change-style");
            0 < o.length &&
                t.on("click", function () {
                    o.toggleClass("demo-active").css("display", "block"), r.toggleClass("shown-preview");
                }),
                0 < d.length &&
                    d.on("click", function () {
                        n.slideToggle(400);
                    }),
                0 < c.length &&
                    c.on("click", function () {
                        var a = k(this).attr("title");
                        return (
                            k("body").fadeOut(function () {
                                k("#changeTheme").attr("href", "assets/css/" + a + ".css"), k(this).delay(150).fadeIn();
                            }),
                            !1
                        );
                    });
        }),
        w.components.docReady.push(w.demoPanel),
        (w.promoPanel = function () {
            var a = w.getStatus.isRTL ? "../visitor/images" : "./visitor/images";
            // r.append(
            //     '<div class="promo-content"><a href="#" class="promo-close"><em class="ti ti-close"></em></a><a target="_blank" href="http://bit.ly/2UzfJv2" class="promo-content-wrap"><div class="promo-content-img"><img src="' +
            //         a +
            //         '/demo/promo-large.jpg" alt="TokenLite"></div><div class="promo-content-text"><h5>Are you looking for <br><span>Functional System</span> <br> for your ICO token sale?</h5><p>Check out TokenLite <br> on CodeCanyon!</p></div> </a></div> <a target="_blank" href="http://bit.ly/2UzfJv2" class="promo-trigger"><div class="promo-trigger-img"><img src="' +
            //         a +
            //         '/demo/promo-small.png" alt="TokenLite"></div><div class="promo-trigger-text">Looking for Functional<br>ICO/STO Dashboard?</div></a>'
            // );
            var l = k(".promo-trigger"),
                e = k(".promo-content"),
                s = k(".promo-close");
            0 < s.length &&
                s.on("click", function () {
                    var a = Cookies.get("twz-offer");
                    return e.removeClass("active"), l.addClass("active"), null === a && Cookies.set("twz-offer", "true", { expires: 1, path: "" }), !1;
                }),
                null === Cookies.get("twz-offer") ? e.addClass("active") : l.addClass("active");
        }),
        w.components.winLoad.push(w.promoPanel),
        c < 1 && r.addClass("d-noner"),
        // c < 1 && h.html(v),
        c < 1 && k(a).html("{" + l + "}"),
        w
    );
})(NioApp, jQuery, window, document);
