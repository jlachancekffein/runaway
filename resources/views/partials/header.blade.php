
<nav class="navbar navbar-white navbar-static-top">
@if(request()->route()->getName() == 'home')    
  <div class="navbar-supheader"><div class="layout-container">{{ trans('theme.supheader') }}</div></div>
@endif
    <div class="layout-container navbar-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">{{ trans('theme.burgerToggle') }}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            @if (Auth::guest())
            <a class="headerButton" href="{{ url('/register') }}">{{ trans('theme.createYourProfile') }}</a>
            @else
            <a class="headerButton" href="{{ route('profile') }}">{{ trans('theme.myAccount') }}</a>
            @endif

            @if (Request::is('/'))
            <h1 class="navbar-brandHeadtag">
            @endif
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/runway2doorway.png" alt="Runway 2 Doorway">
                </a>
            @if (Request::is('/'))
            </h1>
            @endif
            
            <?php /*<span class="navbar-brandSlogan">{{ trans('theme.brandSlogan') }}</span>*/ ?>
        </div>
        
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
@if (Auth::guest())
                <li><a class="navbar-registerButton" href="{{ url('/register') }}">{{ trans('theme.createYourProfile') }}</a></li>
                <li><button type="button" data-toggle="modal" data-target="#modal-login">{{ trans('theme.signin') }}</button></li>
@else
                <li><a class="navbar-registerButton" href="{{ route('profile') }}">{{ trans('theme.myAccount') }}</a></li>
    @if (Auth::user()->role === 'admin')
                <li><a href="{{ url('/admin/kits') }}"><span class="fa fa-tags"></span> {{ trans('theme.kits') }} <span class="badge">{{ $kitRequestsCount }}</span></a></li>
                <li><a href="{{ url('/admin/transactions') }}"><span class="fa fa-shopping-bag"></span> {{ trans('theme.transactions') }} <span class="badge">{{ $transactionsCount }}</span></a></li>
                <li><a href="{{ url('/admin/articles/blog') }}"><span class="fa fa-wordpress"></span> {{ trans('theme.blog') }}</a></li>
                <li><a href="{{ url('/admin/articles/lookbook') }}"><span class="fa fa-book"></span> {{ trans('theme.lookbook') }}</a></li>
    @endif
@endif
                <li><a href="{{ url('/how-it-works') }}">{{ trans('theme.howItWorks') }}</a></li>
                <li><a href="{{ url('/blog') }}">{{ trans('theme.blog') }}</a></li>
                <li><a href="{{ url('/lookbook') }}">{{ trans('theme.lookbook') }}</a></li>
                <li><a href="{{ url('/stylism') }}">{{ trans('theme.stylism') }}</a></li>
                <li><a href="{{ url('/its-founder') }}">{{ trans('theme.stylist') }}</a></li>
                <li><a href="{{ url('/contact') }}">{{ trans('theme.contactUs') }}</a></li>
@if (!Auth::guest())
                <li><a href="{{ url('/logout') }}"><span class="fa fa-sign-out"></span> {{ trans('theme.logout') }}</a></li>
@endif
            </ul>
        </div>
    </div>
</nav>