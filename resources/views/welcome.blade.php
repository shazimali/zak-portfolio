<!doctype html>
<!-- Last Published: Tue Feb 03 2026 16:19:29 GMT+0000 (Coordinated Universal Time) -->
<html data-wf-domain="www.designjoy.co" data-wf-page="65da23fdb371c78225345308" data-wf-site="5837424ae11409586f837994">

<head>
    <meta charset="utf-8" />
    <title>Designjoy - Design as a Subscription</title>
    <meta content="The #1 design subscription service for agencies, startups, and entrepreneurs." name="description" />
    <meta content="DesignJoy - Unlimited Design &amp; Revisions" property="og:title" />
    <meta content="The #1 unlimited product design subscription service for agencies, startups, and entrepreneurs."
        property="og:description" />
    <meta content="assets/images/61202d82c8b80c726b521a34_Frame_12.png" property="og:image" />
    <meta content="DesignJoy - Unlimited Design &amp; Revisions" property="twitter:title" />
    <meta content="The #1 unlimited product design subscription service for agencies, startups, and entrepreneurs."
        property="twitter:description" />
    <meta content="assets/images/61202d82c8b80c726b521a34_Frame_12.png" property="twitter:image" />
    <meta property="og:type" content="website" />
    <meta content="summary_large_image" name="twitter:card" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="{{ asset('assets/css/designjoy.shared.d3c8c2815.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        @media (min-width: 992px) {
            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733fb1"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733f7f"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733f71"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733f78"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733f6a"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733fb9"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733f99"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733f86"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733fa1"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733fa9"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733f8d"] {
                opacity: 0;
            }

            html.w-mod-js:not(.w-mod-ix) [data-w-id="4bf06ab7-87fa-09aa-0827-163070733fc1"] {
                opacity: 0;
            }
        }
    </style>
    <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>
    <script type="text/javascript">
        !(function (o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            ((n.className += t + "js"),
                ("ontouchstart" in o ||
                    (o.DocumentTouch && c instanceof DocumentTouch)) &&
                (n.className += t + "touch"));
        })(window, document);
    </script>
    <link href="{{ asset('assets/images/5e2fb217d4837e75854462c9_Small.png') }}" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset('assets/images/5e2fb219ca409a4a31ab607d_large.png') }}" rel="apple-touch-icon" />



    <style>
        .class-name {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
    </style>






    <style>
        body {
            overflow-x: hidden;
        }
    </style>


    <!-- <script>
        $.noConflict();
        jQuery(document).ready(function ($) {
            $.typer.options.highlightColor = "rgba(9,127,255,100)";
            $.typer.options.typerOrder = "sequential";
            $("[data-typer-targets]").typer();
        });
    </script> -->


    <link href="https://calendly.com/assets/external/widget.css" rel="stylesheet" />
    <script src="https://calendly.com/assets/external/widget.js" type="text/javascript"></script>
    <!-- Calendly link widget end -->
    @livewireStyles
</head>

<body>
    <div>
        <div class="hero">
            <div class="container hero-container">
                <div class="inner-container">
                    <div class="hero__flex">
                        <div class="hero__left">
                            <div class="hero__left-top">
                                <div class="hero__logo-block w-inline-block">
                                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733e8c" data-is-ix2-target="1"
                                        class="lottie-animation-4 _33" data-animation-type="lottie"
                                        data-src="{{ asset('assets/lottie/65df60bd9c030c56a272ea68_Comp_1_(1).json') }}" data-loop="0"
                                        data-direction="1" data-autoplay="0" data-renderer="svg"
                                        data-default-duration="0.8341674668578307" data-duration="0"></div>
                                    <livewire:editable-logo />
                                </div>
                                <div class="hero__buttons-flex">
                                    @auth
                                        <form method="POST" action="{{ route('logout') }}" class="inline" style="display: inline-block;">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="button-outline w-inline-block">
                                                <div>Logout</div>
                                            </a>
                                        </form>
                                    @else
                                        <a href="#" onclick="Livewire.dispatch('open-login-modal'); return false;" class="button-outline w-inline-block">
                                            <div>Login</div>
                                        </a>
                                    @endauth
                                    <a href="#book" class="button-outline w-inline-block"><img loading="lazy"
                                            src="{{ asset('assets/images/678548430d58f4cbecec19bf_Phone--Streamline-Ultimate_(1).svg') }}"
                                            alt="" class="image" />
                                        <div>Book a call</div>
                                    </a><a href="#pricing" class="button-filled w-inline-block">
                                        <div>See pricing</div>
                                    </a>
                                </div>
                            </div>
                            <div class="hero__left-bottom">
                                <livewire:editable-hero-heading />
                                <p class="hero__left-bottom-p">
                                    <span class="text-span _3">Pause or cancel anytime.</span>
                                </p>
                            </div>
                        </div>
                        <div class="div-block-37">
                            <div class="hero__member-card">
                                <div class="hero__member-card-badge">
                                    <div class="lottie-animation-5" data-w-id="4bf06ab7-87fa-09aa-0827-163070733ea4"
                                        data-animation-type="lottie"
                                        data-src="{{ asset('assets/lottie/67840672d2c7cd35037e445d_Main_Scene.json') }}" data-loop="1"
                                        data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg"
                                        data-default-duration="0" data-duration="1.8333333333333333"></div>
                                    <div>Start today</div>
                                </div>
                                <div class="hero__member-card-splash">
                                    <livewire:editable-member-card-text />
                                    <a data-w-id="4bf06ab7-87fa-09aa-0827-163070733eae" style="opacity: 0"
                                        href="#pricing" class="button w-button">See pricing</a>
                                </div>
                                <a data-w-id="4bf06ab7-87fa-09aa-0827-163070733eb0" style="opacity: 0" href="#book"
                                    class="hero__member-card-call w-inline-block">
                                    <div class="hero__member-card-call-left">
                                        <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec196f_Group_11.png') }}"
                                            alt="" class="image-2" />
                                        <div>
                                            <div>Book a 15-min intro call</div>
                                            <div class="hero__member-card-call-schedule">
                                                Schedule now
                                            </div>
                                        </div>
                                    </div>
                                    <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec196a_arrow.svg') }}" alt="" />
                                </a><img data-w-id="4bf06ab7-87fa-09aa-0827-163070733eb9"
                                    sizes="(max-width: 688px) 100vw, 688px" alt=""
                                    src="{{ asset('assets/images/678548430d58f4cbecec196c_card.png') }}" loading="lazy" srcset="{{ asset('assets/images/678548430d58f4cbecec196c_card-p-500.png') }} 500w, {{ asset('assets/images/678548430d58f4cbecec196c_card.png') }}       688w" class="hero__member-card-mockup" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
        <div class="hiw">
            <div class="container mmmm">
                <div class="inner-container">
                    <livewire:editable-hiw-header />
                    <div class="w-layout-grid hiw__grid">
                        <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733ec6" style="opacity: 0" class="hiw__card">
                            <div class="hiw__card-gradient">
                                <div class="hiw__card-header">Subscribe</div>
                                <p class="hiw__card-p text-black _2">
                                    Subscribe to a plan &amp; request as many designs as you’d
                                    like.
                                </p>
                            </div>
                            <livewire:editable-subscribe-image />
                        </div>
                        <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733ecd" style="opacity: 0" class="hiw__card _2">
                            <div class="hiw__card-gradient _2">
                                <div class="hiw__card-header">Request</div>
                                <p class="hiw__card-p">
                                    Request whatever you&#x27;d like, from mobile apps to logos.
                                </p>
                            </div>
                            <div class="receive__image-wrapper">
                                <div class="marquees">
                                    <div class="marquee-1 _2">
                                        <div class="marquee-1-inner">
                                            <div class="marquee-1-element">
                                                <div class="service-pill">
                                                    <div>Mobile apps</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Presentations</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Logos</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Social Media</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Email</div>
                                                </div>
                                            </div>
                                            <div class="marquee-1-element">
                                                <div class="service-pill">
                                                    <div>Mobile apps</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Presentations</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Logos</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Social Media</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Email</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="marquee-1 _2 _4455">
                                        <div class="marquee-1-inner _6886">
                                            <div class="marquee-1-element">
                                                <div class="service-pill">
                                                    <div>Webflow</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Print design</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Packaging</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Ad creative</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Landing pages<br /></div>
                                                </div>
                                            </div>
                                            <div class="marquee-1-element">
                                                <div class="service-pill">
                                                    <div>Webflow</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Print design</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Packaging</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Ad creative</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Landing pages<br /></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="marquee-1 _2">
                                        <div class="marquee-1-inner">
                                            <div class="marquee-1-element">
                                                <div class="service-pill">
                                                    <div>Branding</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Email</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Display ads</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Packaging</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>User interface</div>
                                                </div>
                                            </div>
                                            <div class="marquee-1-element">
                                                <div class="service-pill">
                                                    <div>Branding</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Email</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Display ads</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>Packaging</div>
                                                </div>
                                                <div class="service-pill">
                                                    <div>User interface</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f3b" style="
                        -webkit-transform: translate3d(-50px, -50px, 0)
                          scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                          skew(0, 0);
                        -moz-transform: translate3d(-50px, -50px, 0)
                          scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                          skew(0, 0);
                        -ms-transform: translate3d(-50px, -50px, 0)
                          scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                          skew(0, 0);
                        transform: translate3d(-50px, -50px, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                      " class="request__block">
                                        <img style="opacity: 0" data-w-id="4bf06ab7-87fa-09aa-0827-163070733f3c" alt=""
                                            src="{{ asset('assets/images/678548430d58f4cbecec197e_Smile.png') }}" loading="lazy"
                                            class="image-7" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f3d" style="opacity: 0" class="hiw__card _3">
                            <div class="hiw__card-gradient _3">
                                <div class="hiw__card-header">Receive</div>
                                <p class="hiw__card-p">
                                    Receive your design within two business days on average.
                                </p>
                            </div>
                            <div class="div-block-2">
                                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f44" style="opacity: 0" class="stack">
                                    <div style="
                        -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(9deg) skew(0, 0);
                        -moz-transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(9deg) skew(0, 0);
                        -ms-transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(9deg) skew(0, 0);
                        transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(9deg) skew(0, 0);
                      " class="front-design"></div>
                                    <div class="middle-design"></div>
                                    <div style="
                        -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(-23deg) skew(0, 0);
                        -moz-transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(-23deg) skew(0, 0);
                        -ms-transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(-23deg) skew(0, 0);
                        transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
                          rotateX(0) rotateY(0) rotateZ(-23deg) skew(0, 0);
                      " class="bottom-design"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <livewire:editable-logos-row />
                </div>
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
        <div class="services">
            <div class="container p-b-0">
                <div class="inner-container">
                    <div class="div-block-32">
                        <livewire:editable-story-text />
                    </div>
                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f5c" style="opacity: 0"
                        class="hiw__header-wrapper">
                        <div class="eyebrow">Membership benefits</div>
                        <livewire:editable-benefits-heading />
                        <livewire:editable-benefits-para />
                    </div>
                </div>
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
        <div class="services__list">
            <div class="container p-b-0">
                <div class="services__row">
                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f6a" class="services__col">
                        <div class="services__block _1">
                            <img style="
                    -webkit-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    -moz-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    -ms-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                  " data-w-id="4bf06ab7-87fa-09aa-0827-163070733f6c" alt=""
                                src="{{ asset('assets/images/678548430d58f4cbecec1999_Trello-Logo--Streamline-Logos.png') }}"
                                loading="lazy" class="image-8" />
                        </div>
                        <div class="services__header">Design board</div>
                        <p class="services__p">
                            Easily manage your design queue with a Trello board.
                        </p>
                    </div>
                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f71" class="services__col">
                        <div class="services__block _3">
                            <img loading="lazy"
                                src="{{ asset('assets/images/678548430d58f4cbecec199b_Lock-Square-Dial-Pad--Streamline-Nova.png') }}"
                                alt="" class="image-8 _4" />
                        </div>
                        <div class="services__header">Fixed monthly rate</div>
                        <p class="services__p">
                            No surprises here! Pay the same fixed price each month.
                        </p>
                    </div>
                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f78" class="services__col">
                        <div class="services__block _2">
                            <img loading="lazy"
                                src="{{ asset('assets/images/678548430d58f4cbecec1997_Flash-Enable-Allow-1--Streamline-Nova.png') }}"
                                alt="" class="image-8 _3" />
                        </div>
                        <div class="services__header">Fast delivery</div>
                        <p class="services__p">
                            Get your design one at a time in just a couple days on average.
                        </p>
                    </div>
                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f7f" class="services__col">
                        <div class="services__block _4">
                            <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec199d_Star--Streamline-Nova.png') }}"
                                alt="" class="image-8 _2" />
                        </div>
                        <div class="services__header">Top-notch quality</div>
                        <p class="services__p">
                            Senior design quality at your fingertips, whenever you need it.
                        </p>
                    </div>
                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f86" class="services__col">
                        <div class="services__block _5">
                            <img style="
                    -webkit-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    -moz-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    -ms-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                  " loading="lazy" alt=""
                                src="{{ asset('assets/images/678548430d58f4cbecec199f_Resize-Expand--Streamline-Nova.png') }}"
                                class="image-8" />
                        </div>
                        <div class="services__header">Flexible and scalable</div>
                        <p class="services__p">
                            Scale up or down as needed, and pause or cancel at anytime.
                        </p>
                    </div>
                    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f8d" class="services__col last">
                        <div class="services__block _6">
                            <img style="
                    -webkit-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    -moz-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    -ms-transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                    transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                      rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                  " loading="lazy" alt="" src="{{ asset('assets/images/678548430d58f4cbecec19a1_Touch-Id--Streamline-Nova.png') }}"
                                class="image-8" />
                        </div>
                        <div class="services__header">Unique and all yours</div>
                        <p class="services__p">
                            Every design is made especially for you and is 100% yours.
                        </p>
                    </div>
                    <div class="div-block-18"></div>
                </div>
                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f95" style="opacity: 0" class="slider-wrapper _33">
                    <div data-delay="4000" data-animation="slide" class="slider-resource w-slider" data-autoplay="false"
                        data-easing="ease" style="
                -webkit-transform: translate3d(55px, null, 0) scale3d(1, 1, 1)
                  rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                -moz-transform: translate3d(55px, null, 0) scale3d(1, 1, 1)
                  rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                -ms-transform: translate3d(55px, null, 0) scale3d(1, 1, 1)
                  rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                transform: translate3d(55px, null, 0) scale3d(1, 1, 1)
                  rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                opacity: 0;
              " data-hide-arrows="false" data-disable-swipe="true" data-w-id="4bf06ab7-87fa-09aa-0827-163070733f96"
                        data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="false">
                        <div class="mask-blog w-slider-mask">
                            <div class="blog-item w-slide">
                                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733f99" class="services__col">
                                    <div class="services__block _1">
                                        <img style="
                          -webkit-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          -moz-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          -ms-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                            rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                        " data-w-id="4bf06ab7-87fa-09aa-0827-163070733f9b" alt=""
                                            src="{{ asset('assets/images/678548430d58f4cbecec1999_Trello-Logo--Streamline-Logos.png') }}"
                                            loading="lazy" class="image-8" />
                                    </div>
                                    <div class="services__header">Design board</div>
                                    <p class="services__p">
                                        Easily manage your design queue with a Trello board.
                                    </p>
                                </div>
                            </div>
                            <div class="blog-item w-slide">
                                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733fa1" class="services__col">
                                    <div class="services__block _3">
                                        <img loading="lazy"
                                            src="{{ asset('assets/images/678548430d58f4cbecec199b_Lock-Square-Dial-Pad--Streamline-Nova.png') }}"
                                            alt="" class="image-8 _4" />
                                    </div>
                                    <div class="services__header">Fixed monthly rate</div>
                                    <p class="services__p">
                                        No surprises here! Pay the same fixed price each month.
                                    </p>
                                </div>
                            </div>
                            <div class="blog-item w-slide">
                                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733fa9" class="services__col">
                                    <div class="services__block _2">
                                        <img loading="lazy"
                                            src="{{ asset('assets/images/678548430d58f4cbecec1997_Flash-Enable-Allow-1--Streamline-Nova.png') }}"
                                            alt="" class="image-8 _3" />
                                    </div>
                                    <div class="services__header">Fast delivery</div>
                                    <p class="services__p">
                                        Get your design one at a time in just a couple days on
                                        average.
                                    </p>
                                </div>
                            </div>
                            <div class="blog-item w-slide">
                                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733fb1" class="services__col">
                                    <div class="services__block _4">
                                        <img loading="lazy"
                                            src="{{ asset('assets/images/678548430d58f4cbecec199d_Star--Streamline-Nova.png') }}"
                                            alt="" class="image-8 _2" />
                                    </div>
                                    <div class="services__header">Top-notch quality</div>
                                    <p class="services__p">
                                        Senior-level design quality at your fingertips, whenever
                                        you need it.
                                    </p>
                                </div>
                            </div>
                            <div class="blog-item w-slide">
                                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733fb9" class="services__col">
                                    <div class="services__block _5">
                                        <img style="
                          -webkit-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          -moz-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          -ms-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                            rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                        " loading="lazy" alt=""
                                            src="{{ asset('assets/images/678548430d58f4cbecec199f_Resize-Expand--Streamline-Nova.png') }}"
                                            class="image-8" />
                                    </div>
                                    <div class="services__header">Flexible and scalable</div>
                                    <p class="services__p">
                                        Scale up or down as needed, and pause or cancel at
                                        anytime.
                                    </p>
                                </div>
                            </div>
                            <div class="blog-item w-slide">
                                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733fc1" class="services__col last">
                                    <div class="services__block _6">
                                        <img style="
                          -webkit-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          -moz-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          -ms-transform: translate3d(0, 130px, 0)
                            scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0)
                            skew(0, 0);
                          transform: translate3d(0, 130px, 0) scale3d(1, 1, 1)
                            rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
                        " loading="lazy" alt=""
                                            src="{{ asset('assets/images/678548430d58f4cbecec19a1_Touch-Id--Streamline-Nova.png') }}"
                                            class="image-8" />
                                    </div>
                                    <div class="services__header">Unique and all yours</div>
                                    <p class="services__p">
                                        Every design is made especially for you and is 100% yours.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow-2 w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733fca"
                            class="right-arrow-2 w-slider-arrow-right">
                            <div class="w-icon-slider-right"></div>
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
                    </div>
                </div>
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
        <div class="pricing">
            <div class="container">
                <div class="inner-container slider">
                    <div class="w-layout-grid grid-3">
                        <div class="div-block-17">
                            <livewire:editable-testimonial1 />
                        </div>
                        <div class="div-block-17">
                            <livewire:editable-testimonial2 />
                        </div>
                    </div>
                </div>
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
        <div class="pricing p-b-120">
            <div class="container m-t-0">
                <div class="inner-container">
                    <div class="div-block-27">
                        <div data-w-id="4bf06ab7-87fa-09aa-0827-163070733ff3" style="opacity: 0" class="div-block-28">
                            <livewire:editable-marquee />
                            <div data-w-id="4bf06ab7-87fa-09aa-0827-163070734004" style="opacity: 0" class="_44959">
                                <div>
                                    <div class="div-block-33">
                                        <div class="div-block-34">
                                            <div class="div-block-36">
                                                <div class="div-block-35">
                                                    <img src="{{ asset('assets/images/6785582d859f4a059de5f543_Group_1171274565.svg') }}"
                                                        loading="lazy" alt="" />
                                                </div>
                                                <div>Buy Me A Coffee</div>
                                            </div>
                                            <div class="text-block-4">
                                                Fintech Product of the Year
                                            </div>
                                            <img src="{{ asset('assets/images/678557d2de5ecf01f3e67f14_producthunt-official_(1)_1.svg') }}"
                                                loading="lazy" alt="" class="image-31" />
                                        </div>
                                        <div class="div-block-34">
                                            <div class="div-block-36">
                                                <div class="div-block-35">
                                                    <img src="{{ asset('assets/images/6785584fcfd39e0459ff4001_Switchboard_Logo_Symbol_4.svg') }}"
                                                        loading="lazy" alt="" />
                                                </div>
                                                <div>Switchboard</div>
                                            </div>
                                            <div class="text-block-4">
                                                Remote Work Product of the Year
                                            </div>
                                            <img src="{{ asset('assets/images/678557d2de5ecf01f3e67f14_producthunt-official_(1)_1.svg') }}"
                                                loading="lazy" alt="" class="image-31" />
                                        </div>
                                    </div>
                                </div>
                                <div class="hiw__card-header left _4">Recent work</div>
                                <p class="hero__left-bottom-p m-t-12 left">
                                    We&#x27;re talking &quot;Product of the Year&quot; good.
                                </p>
                                <a href="https://www.figma.com/proto/wbWTRa1jCey4uhInRAmH1r/Latest-Projects?page-id=0%3A1&amp;type=design&amp;node-id=906-2343&amp;viewport=450%2C721%2C0.13&amp;t=ZYPXbxSFD1m31WCi-1&amp;scaling=min-zoom&amp;mode=design"
                                    target="_blank" class="button-filled m-t-24 m-t-12 w-inline-block">
                                    <div>See recent work</div>
                                </a>
                            </div>
                        </div>
                        <div data-w-id="4bf06ab7-87fa-09aa-0827-16307073400c" style="opacity: 0" class="async _4">
                            <div>
                                <div data-w-id="4bf06ab7-87fa-09aa-0827-16307073400d" style="opacity: 0"
                                    class="div-block-29">
                                    <div class="new-service-pill">
                                        <div>Web design</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Logos</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Slide decks</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Branding</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Social media</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>UI/UX design</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Webflow development</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Mobile apps</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Print design</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Email</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Display ads</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Icons</div>
                                    </div>
                                    <div class="new-service-pill">
                                        <div>Brand guides</div>
                                    </div>
                                    <div class="new-service-pill more">
                                        <div>+ more</div>
                                    </div>
                                </div>
                                <div class="div-block-31 _444">
                                    <div class="hiw__card-header">
                                        Apps, websites, logos &amp; more
                                    </div>
                                    <p class="hero__left-bottom-p m-t-12">
                                        All the things you need under one roof.
                                    </p>
                                </div>
                            </div>
                            <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec19d4_pink.svg') }}" alt=""
                                class="image-27" /><img loading="lazy"
                                src="{{ asset('assets/images/678548430d58f4cbecec19d6_Group_1171274487.svg') }}" alt=""
                                class="image-30" />
                        </div>
                    </div>
                </div>
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
        <div id="pricing" class="pricing">
            <div class="container p-b-0 p-t-0">
                <div data-w-id="4bf06ab7-87fa-09aa-0827-163070734043" style="opacity: 0" class="hiw__header-wrapper">
                    <div class="eyebrow">PRICING</div>
                    <h1 class="dddd">
                        One subscription,
                        <span class="text-italics">endless possibilities</span>
                    </h1>
                </div>
                <div class="pricing__flex">
                    <div data-w-id="4bf06ab7-87fa-09aa-0827-16307073404b" class="div-block-3">
                        <div>
                            <div data-w-id="4bf06ab7-87fa-09aa-0827-16307073404d" style="opacity: 0"
                                class="hero__member-card-badge m-b-24">
                                <div class="lottie-animation-5" data-w-id="4bf06ab7-87fa-09aa-0827-16307073404e"
                                    data-animation-type="lottie"
                                    data-src="{{ asset('assets/lottie/67840672d2c7cd35037e445d_Main_Scene.json') }}" data-loop="1"
                                    data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg"
                                    data-default-duration="0" data-duration="1.8333333333333333">
                                </div>
                                <div>Start today</div>
                            </div>
                            <livewire:editable-member-card-header />
                        </div>
                        <img class="image-10" src="{{ asset('assets/images/678548430d58f4cbecec19a8_Group_1171274554.png') }}" alt=""
                            style="
                  -webkit-transform: translate3d(0px, 0px, 0) scale3d(1, 1, 1)
                    rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);
                  -moz-transform: translate3d(0px, 0px, 0) scale3d(1, 1, 1)
                    rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);
                  -ms-transform: translate3d(0px, 0px, 0) scale3d(1, 1, 1)
                    rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);
                  transform: translate3d(0px, 0px, 0) scale3d(1, 1, 1)
                    rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);
                " sizes="(max-width: 1631px) 100vw, 1631px" data-w-id="4bf06ab7-87fa-09aa-0827-163070734055"
                            loading="lazy" />
                    </div>
                    <livewire:editable-pricing-card />
                </div>
                <div class="w-layout-grid grid-2">
                    <div class="div-block-10 _1">
                        <div class="div-block-11">
                            <div class="div-block-12">
                                <img loading="lazy"
                                    src="{{ asset('assets/images/678548430d58f4cbecec19b6_Pause-Circle--Streamline-Micro.svg') }}"
                                    alt="" />
                                <div class="hiw__card-header m-b-0">Pause anytime</div>
                            </div>
                            <p class="hiw__card-p text-black">
                                Temporarily pause your subscription anytime, no sweat.
                            </p>
                        </div>
                    </div>
                    <div class="div-block-10">
                        <div class="div-block-11 _2">
                            <div class="div-block-12">
                                <img width="24" loading="lazy" alt=""
                                    src="{{ asset('assets/images/678548430d58f4cbecec19b7_Validation-Check-Circle--Streamline-Micro.svg') }}"
                                    class="invert" />
                                <div class="hiw__card-header m-b-0">Try it for a week</div>
                            </div>
                            <p class="hiw__card-p text-black">
                                Not loving it after a week? Get 75% back, no questions asked.
                            </p>
                        </div>
                    </div>
                </div>
                <livewire:editable-logos-row />
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
        <div class="pricing">
            <div class="container faqq">
                <div class="inner-container">
                    <livewire:editable-faq />
                </div>
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
        <div id="book" class="footer">
            <div class="container hero-container foooooo">
                <div class="inner-container">
                    <div class="footer__flex">
                        <div class="div-block-25 desktop">
                            <div class="hero__left white">
                                <div class="hero__left-top">
                                    <a href="#" class="hero__logo-block invert w-inline-block">
                                        <div data-w-id="4bf06ab7-87fa-09aa-0827-16307073411c" data-is-ix2-target="1"
                                            class="lottie-animation-4 _33" data-animation-type="lottie"
                                            data-src="{{ asset('assets/lottie/65df60bd9c030c56a272ea68_Comp_1_(1).json') }}"
                                            data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg"
                                            data-default-duration="0.8341674668578307" data-duration="0"></div>
                                        <livewire:editable-logo />
                                    </a>
                                </div>
                                <livewire:editable-footer-cta />
                            </div>
                            <div class="smiles-desktop">
                                <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec19d8_Smiley_faces.svg') }}"
                                    alt="" />
                                <div class="div-block-26">
                                    <div class="head">Headquartered in Phoenix, Arizona</div>
                                    <a href="https://brettwill1025.notion.site/Terms-Conditions-4901d894656448a69c4c4e04d40d3bbc"
                                        target="_blank" class="text-link _3">Terms of service</a><a
                                        href="https://brettwill1025.notion.site/DesignJoy-Privacy-Policy-0011594d80724a68821940237f9f7b02"
                                        target="_blank" class="text-link _3">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                        <div data-w-id="4bf06ab7-87fa-09aa-0827-16307073412e" style="opacity: 0"
                            class="book-a-call-wrapper">
                            <div class="div-block-38">
                                <div class="text-block-6">
                                    Designjoy is experiencing a high volume of bookings, so
                                    slots are limited. For faster service, email
                                    <a href="mailto:hello@designjoy.co" class="text-link pink">hello@designjoy.co</a>
                                    for a same-day response.
                                </div>
                            </div>

                            <div class="book-desktop w-embed w-script">
                                <!-- Cal inline embed code begins -->
                                <div style="width:100%;height:100%;overflow:scroll" id="my-cal-inline"></div>
                                <script type="text/javascript">
                                    (function (C, A, L) { let p = function (a, ar) { a.q.push(ar); }; let d = C.document; C.Cal = C.Cal || function () { let cal = C.Cal; let ar = arguments; if (!cal.loaded) { cal.ns = {}; cal.q = cal.q || []; d.head.appendChild(d.createElement("script")).src = A; cal.loaded = true; } if (ar[0] === L) { const api = function () { p(api, arguments); }; const namespace = ar[1]; api.q = api.q || []; if (typeof namespace === "string") { cal.ns[namespace] = cal.ns[namespace] || api; p(cal.ns[namespace], ar); p(cal, ["initNamespace", namespace]); } else p(cal, ar); return; } p(cal, ar); }; })(window, "https://app.cal.com/embed/embed.js", "init");
                                    Cal("init", "15min", { origin: "https://cal.com" });

                                    Cal.ns["15min"]("inline", {
                                        elementOrSelector: "#my-cal-inline",
                                        config: { "layout": "month_view", "theme": "dark" },
                                        calLink: "designjoy/15min",
                                    });

                                    Cal.ns["15min"]("ui", { "theme": "dark", "cssVarsPerTheme": { "light": { "cal-brand": "#000000" }, "dark": { "cal-brand": "#ffffff" } }, "hideEventTypeDetails": true, "layout": "month_view" });
                                </script>
                                <!-- Cal inline embed code ends -->
                            </div>
                        </div>
                        <div class="smiles-mobile">
                            <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec19d8_Smiley_faces.svg') }}" alt="" />
                            <div class="div-block-26">
                                <div class="head">Headquartered in Phoenix, Arizona</div>
                                <a href="https://brettwill1025.notion.site/Terms-Conditions-4901d894656448a69c4c4e04d40d3bbc"
                                    target="_blank" class="text-link _3">Terms of service</a><a
                                    href="https://brettwill1025.notion.site/DesignJoy-Privacy-Policy-0011594d80724a68821940237f9f7b02"
                                    target="_blank" class="text-link _3">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-line-right dark"></div>
                <div class="grid-line-left dark"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/designjoy.schunk.36b8fb49256177c8.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/designjoy.schunk.8208d3e53b97e3c7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/designjoy.schunk.64554273d6187735.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/designjoy.schunk.4928c134fa61d767.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/designjoy.5011d3a6.da6bd147aa9ec596.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>

    <livewire:auth.login-modal />
    @livewireScripts
</body>

</html>