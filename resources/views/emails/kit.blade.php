@extends('layouts.emails')

@section('title')
{{ trans('kits.emailTitle') }}
@endsection

@section('content')

<tr>
    <td style="text-align: center; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ $userName }},
    </td>
</tr>
<tr>
    <td style="text-align: center; padding-top: 15px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ trans('kits.emailText1') }}
    </td>
</tr>
<tr>
    <td style="text-align: center; padding-top: 15px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ trans('kits.emailText2') }}
    </td>
</tr>
<tr>
    <td style="text-align: center; padding-top: 30px;">
        <a style="background: #c09e7a; padding: 12px 31px; text-transform: uppercase; text-decoration: none; font-size: 16px; color: #fff; font-family: Arial, Helvetica, sans-serif;" href="<?= $link ?>">{{ trans('kits.emailButton') }}</a>
    </td>
</tr>
<tr>
    <td style="padding-top: 80px;"><table cellpadding="0" cellspacing="0" border="0" align="center">
        <tr>
            <td style="padding: 0 10px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
                <a href="{{ trans('general.facebook') }}"><img style="display: block; border: 0;" src="{{ asset('images/mailsFacebook.jpg') }}" alt="Facebook"></a>
            </td>
            <td style="padding: 0 10px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
                <a href="{{ trans('general.instagram') }}"><img style="display: block; border: 0;" src="{{ asset('images/mailsInstagram.jpg') }}" alt="Instagram"></a>
            </td>
        </tr>
    </table></td>
</tr>
<tr>
    <td style="text-align: center; padding-top: 15px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ trans('contact.address') }}, {{ trans('contact.city') }}<br>
        {{ trans('contact.callUs') }} <a style="color: #c09e7a; text-decoration: underline;" href="tel:{{ trans('contact.tollFreeNumber') }}">{{ trans('contact.tollFreeNumber') }}</a>
    </td>
</tr>

@endsection
