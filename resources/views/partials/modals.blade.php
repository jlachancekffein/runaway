<div style="display: none;" class="modal fade" id="modal-terms">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>x</span></button>
                <div class="modal-title">{{ trans('terms.title') }}</div>
            </div>
            <div class="modal-body">
                <p class="regularParagraph">{{ trans('terms.paragraph1') }}</p>
                <p class="regularParagraph">{{ trans('terms.paragraph2') }}</p>
                <br>
                <p class="regularParagraph"><strong>{{ trans('terms.title1') }}</strong></p>
                <p class="regularParagraph">{{ trans('terms.paragraph3') }}</p>
                <p class="regularParagraph">{{ trans('terms.paragraph4') }}</p>
                <p class="regularParagraph">{{ trans('terms.paragraph5') }}</p>
                <br>
                <p class="regularParagraph"><strong>{{ trans('terms.title2') }}</strong></p>
                <p class="regularParagraph">{{ trans('terms.paragraph6') }}</p>
                <p class="regularParagraph">{{ trans('terms.paragraph7') }}</p>
                <br>
                <p class="regularParagraph"><strong>{{ trans('terms.title3') }}</strong></p>
                <p class="regularParagraph">{{ trans('terms.paragraph8') }}</p>
                <p class="regularParagraph">{{ trans('terms.paragraph9') }}</p>
                <br>
                <p class="regularParagraph"><strong>{{ trans('terms.title4') }}</strong></p>
                <p class="regularParagraph">{{ trans('terms.paragraph10') }}</p>
                <br>
                <p class="regularParagraph"><strong>Runway 2 Doorway</strong></p>
                <p class="regularParagraph">{!! trans('terms.r2dAddress') !!}<br>
                    {{ trans('terms.r2dEmail') }} <a href="mailto:{{ trans('general.r2dEmail') }}">{{ trans('general.r2dEmail') }}</a></p>
            </div>
        </div>
    </div>
</div>

<div style="display: none;" class="modal fade" id="modal-login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>x</span></button>
                <div class="modal-title">{{ trans('auth.login') }}</div>
            </div>
            <div class="modal-body">
                <form class="form js-ajaxForm" action="/login" method="post" onsubmit="return false;">
                    {{ csrf_field() }}
                    
                    <div class="form-errors">
                        @if (!empty($errors))
                            @foreach ($errors->all() as $error)
                                <div class="form-error">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                    
                    <div class="form-field">
                        <a class="button-facebook" href="{{ url('/login/facebook') }}">{!! trans('auth.loginFacebook') !!}</a><?php
                        ?><a class="button-google" href="{{ url('/login/google') }}">{!! trans('auth.loginGoogle') !!}</a>
                    </div>
                    <div class="form-createAccountSubtitle">{{ trans('auth.loginEmail') . trans('general.:') }}</div>
                    <div class="form-field">
                        <input class="form-input" type="text" name="email" placeholder="{{ trans('general.email') }}">
                    </div>
                    <div class="form-field">
                        <input class="form-input" type="password" name="password" placeholder="{{ trans('general.password') }}">
                    </div>
                    <div class="form-field">
                        <a class="form-forgotPassword" href="javascript:;" data-toggle="modal" data-target="#modal-forgotPassword">{{ trans('passwords.forgotPassword') . trans('general.?') }}</a>
                        <button type="submit" class="form-submitButton">{{ trans('auth.signin') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="display: none;" class="modal fade" id="modal-forgotPassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>x</span></button>
                <div class="modal-title">{{ trans('passwords.resetPasswordPageTitle') }}</div>
            </div>
            <div class="modal-body">
                <form class="form js-ajaxForm" action="/password/email" method="post" onsubmit="return false;">
                    {{ csrf_field() }}
                    
                    <div class="form-errors">
                        @if (!empty($errors))
                            @foreach ($errors->all() as $error)
                                <div class="form-error">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                    
                    <div class="form-field">
                        <input class="form-input" type="text" name="email" placeholder="{{ trans('general.emailAddress') }}">
                    </div>
                    <div class="form-field">
                        <button type="submit" class="form-submitButton">{{ trans('passwords.sendResetEmail') }}</button>
                    </div>
                </form>
                <div class="form-success">
                    <p>{{ trans('passwords.resetEmailSent') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display: none;" class="modal fade" id="modal-chart">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>x</span></button>
                <div class="modal-title">{{ trans('questions.chartTitle') }}</div>
            </div>
            <div class="modal-body">
                <table class="europeeanChart" cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                        <th>{{ trans('questions.americanChart') }}</th>
                        <th>{{ trans('questions.europeeanChart') }}</th>
                    </tr>
                    <tr><td>2</td><td>32</td></tr>
                    <tr><td>4</td><td>34</td></tr>
                    <tr><td>6</td><td>36</td></tr>
                    <tr><td>8</td><td>38</td></tr>
                    <tr><td>10</td><td>40</td></tr>
                    <tr><td>12</td><td>42</td></tr>
                    <tr><td>14</td><td>44</td></tr>
                    <tr><td>16</td><td>46</td></tr>
                    <tr><td>18</td><td>48</td></tr>
                    <tr><td>20</td><td>50</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div style="display: none;" class="modal fade" id="modal-newsletter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>x</span></button>
                <div class="modal-title">{{ trans('theme.newsletterSubscribeTitle') }}</div>
            </div>
            <div class="modal-body">
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="//runway2doorway.us14.list-manage.com/subscribe/post?u=0a5a8ed7a4137aca7bfc2e119&amp;id=9dd983da96" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <p>{{ trans('theme.newsletterPunchLine') }}</p>
                            <div class="indicates-required"><span class="asterisk">*</span> {{ trans('theme.newsletterMandatory') }}</div>
                            <div class="mc-field-group">
                                <label for="mce-EMAIL">{{ trans('theme.newsletterEmailAddress') }}  <span class="asterisk">*</span></label>
                                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                            </div>
                            <div class="mc-field-group">
                                <label for="mce-FNAME">{{ trans('theme.newsletterFirstName') }} </label>
                                <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                            </div>
                            <div class="mc-field-group">
                                <label for="mce-LNAME">{{ trans('theme.newsletterLastName') }} </label>
                                <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                            </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_0a5a8ed7a4137aca7bfc2e119_9dd983da96" tabindex="-1" value=""></div>
                            <div class="clear"><input type="submit" value="{{ trans('theme.newsletterSubscribe') }}" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                            <p><em>{{ trans('theme.newsletterConfirmationInSpam') }}</em></p>
                        </div>
                    </form>
                </div>
                <!--End mc_embed_signup-->
            </div>
        </div>
    </div>
</div>
