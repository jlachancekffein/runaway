<footer class="footer">
    <div class="layout-container">
        <div class="footer-content">
            <div class="footer-menus">
                <ul class="footer-menu">
                    <li><a href="{{ url('/how-it-works') }}">{{ trans('theme.howItWorks') }}</a></li>
                    <li><a href="{{ url('/faq') }}">{{ trans('theme.faq') }}</a></li>
                    <li><a href="{{ url('/register') }}">{{ trans('theme.createYourProfile') }}</a></li>
                    <li><a href="{{ url('/terms-and-conditions') }}">{{ trans('theme.termsConditions') }}</a></li>
                    <li><a href="{{ url('/returns-exchanges') }}">{{ trans('theme.returnsExchanges') }}</a></li>
                    <li><a href="{{ url('/contact') }}">{{ trans('theme.contactUs') }}</a></li>
                </ul><?php
                
                ?><ul class="footer-menu">
                    <li>{{ trans('theme.articlesTitle') }}</li>
                    <li><a href="{{ url('/blog') }}">{{ trans('theme.blog') }}</a></li>
                    <li><a href="{{ url('/lookbook') }}">{{ trans('theme.lookbook') }}</a></li>
                    <li><a href="javascript:;" type="button" data-toggle="modal" data-target="#modal-newsletter">{{ trans('theme.newsletter') }}</a></li>
                </ul><?php
                
                ?>@if (!Auth::guest())<?php
                ?><ul class="footer-menu">
                    <li><a href="{{ route('profile') }}">{{ trans('theme.myAccount') }}</a></li>
                    @if (Auth::user()->role === 'admin')
                    <li><a href="{{ url('/admin/articles/blog') }}">{{ trans('theme.blog') }}</a></li>
                    <li><a href="{{ url('/admin/articles/lookbook') }}">{{ trans('theme.lookbook') }}</a></li>
                    @else
                    <li><a href="{{ url('account/kit-request') }}">{{ trans('theme.kitRequest') }}</a></li>
                    <li><a href="{{ url('account/kits') }}">{{ trans('theme.pendingKits') }}</a></li>
                    @endif
                    <?php /*<li><a href="#">Historique des commandes</a></li>*/ ?>
                    <li><a href="{{ url('/account/question/1') }}">{{ trans('theme.changePreferences') }}</a></li>
                    <li><a href="{{ url('/account/change-password') }}">{{ trans('theme.changePassword') }}</a></li>
                </ul>
                @endif
            </div><?php
            
            /*?><div class="footer-slogan">{{ trans('theme.slogan') }}</div><?php*/
            
            ?><a class="footer-pinkPoka" href="https://pinkpoka.com/" target="_blank">
                <img src="/images/pink-poka.png" alt="">
                <p>{{ trans('theme.pinkPoka') }}</p>
            </a><?php
            
            ?><div class="footer-rightCol">
                @if (Auth::guest())
                <a class="buttonTransparent-footer" href="{{ url('/register') }}">{{ trans('theme.createYourProfile') }}</a>
                @else
                <a class="buttonTransparent-footer" href="{{ route('profile') }}">{{ trans('theme.myAccount') }}</a>
                @endif
                <div class="footer-social">
                    {{ trans('theme.social') }}<?php
                    ?><a class="footer-socialIcon" href="{{ trans('general.facebook') }}" target="_blank"><img src="/images/footer-facebook.png" alt="Facebook"></a><?php
                    ?><a class="footer-socialIcon" href="{{ trans('general.instagram') }}" target="_blank"><img src="/images/footer-instagram.png" alt="Instagram"></a><?php
                    /*?><a class="footer-socialIcon" href="javascript:;"><img src="/images/footer-google-plus.png" alt="Google +"></a>*/ ?>
                </div>
                <a class="footer-language" href="{{ url(URL::current()) }}?locale={{ trans('app.other_language_short') }}">{{ trans('app.other_language') }}</a>
            </div>
        </div>
        
        <div class="footer-smallTexts">
            <p class="footer-copyright">{{ trans('theme.copyright') }} <strong>Runway 2 doorway</strong></p>
            <p class="footer-imarcom">{{ trans('theme.madeByImarcom') }} <a href="http://www.imarcom.net" target="_blank"><strong>Imarcom</strong></a></p>
        </div>
    </div>
</footer>