<!doctype html>
<!-- Based on welcome.blade.php theme -->
<html data-wf-domain="www.designjoy.co" data-wf-page="65da23fdb371c78225345308" data-wf-site="5837424ae11409586f837994">

<head>
    <meta charset="utf-8" />
    <title>Thank You - Designjoy</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="{{ asset('assets/css/designjoy.shared.d3c8c2815.min.css') }}" rel="stylesheet" type="text/css" />
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
    @livewireStyles
</head>

<body>
    <div>
        <div class="hero">
            <div class="container hero-container" style="min-height: 100vh;">
                <div class="inner-container" style="display: flex; flex-direction: column; min-height: 100vh;">
                    <div class="hero__flex" style="flex: 1; align-items: center; justify-content: center;">
                        <div class="hero__left" style="width: 100%; text-align: center; display: flex; flex-direction: column; align-items: center;">
                            <div class="hero__left-top" style="margin-bottom: 40px; justify-content: center; width: 100%;">
                                <div class="hero__logo-block w-inline-block" style="margin: 0 auto;">
                                    <div class="lottie-animation-4 _33" data-animation-type="lottie"
                                        data-src="{{ asset('assets/lottie/65df60bd9c030c56a272ea68_Comp_1_(1).json') }}" data-loop="0"
                                        data-direction="1" data-autoplay="0" data-renderer="svg"></div>
                                    <livewire:editable-logo />
                                </div>
                            </div>
                            <div class="hero__left-bottom" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                                <h1 style="font-size: 56px; line-height: 1.1; margin-bottom: 20px; font-weight: 700; max-width: 800px; margin-left: auto; margin-right: auto;">
                                    Payment Successful!
                                </h1>
                                <p class="hero__left-bottom-p" style="max-width: 600px; margin: 0 auto 40px auto; font-size: 20px;">
                                    <span class="text-span _3">Thank you for subscribing. We're excited to have you on board! You will receive an email shortly with the next steps.</span>
                                </p>
                                <a href="{{ url('/') }}" class="button-filled w-inline-block" style="margin: 0 auto;">
                                    <div>Return to Home</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-line-right"></div>
                <div class="grid-line-left"></div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
