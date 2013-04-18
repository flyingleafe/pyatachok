<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    {{ Seovel::title() }}
    {{ Seovel::description() }}

    @yield('before_assets')

    {{ Asset::styles() }}
    {{ Asset::scripts() }}

    @yield('after_assets')
</head>
<body>
    <div class="banner top">
        banner place
    </div>
    <div class="container">
    @include('blocks.header')
        @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif

        @yield('content')
    </div>
    <div class="slider">
        <div class="slider-content">
            <img src="/img/slide1.png"/>
        </div>
    </div>
    <div class="footer">
        <div class="footer-content">
           <div class="left-col">
               <ul class="menu">
                    <li><a href="">О нас</a></li>
                    <li><a href="">Контакты</a></li>
                    <li><a href="">Отзывы</a></li>
                </ul>

                <ul class="menu">
                    <li><a href="">Блог</a></li>
                    <li><a href="">Реклама</a></li>
                </ul>
               <div class="clearfix"></div>
           </div>

            <div class="right-col">

               <div class="socials">
                    <ul >
                        <li class="twitter"><a href="" title="twitter"></a> </li>
                        <li class="facebook"><a href="" title="facebook"></a> </li>
                        <li class="vk"><a href="" title="vk"></a> </li>
                    </ul>
                    <div class="clear"></div>
               </div>
                <a href="/" class="small-logo"><img src="/img/small_logo.png" /> <div class="clear"></div> </a></br>
            <p>© «Пятачок-онлайн» — Лучший способ найти работу 2013.</p>
        </div>
            <div class="clear"></div>
        </div>
        <div class="banner bottom">
            banner place
        </div>

    </div>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-38532353-1']);
    _gaq.push(['_setDomainName', '5ok.su']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
</body>
</html>