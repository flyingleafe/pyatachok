<!doctype html>
<html>
<head>
    {{ Seovel::title() }}
    {{ Seovel::description() }}
    {{ Asset::styles() }}
    {{ Asset::scripts() }}
</head>
<body>
    <div class="container">
        @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif


        @yield('content')
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