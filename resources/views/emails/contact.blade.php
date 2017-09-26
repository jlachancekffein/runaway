@extends('layouts.emails')

@section('title')
{{ trans('contact.emailTitle') }}
@endsection

@section('content')

<tr>
    <td style="text-align: center; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ trans('contact.emailText') }}<br><br>
        {{ trans('contact.emailText2') }}
    </td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('contact.emailNameField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $name ?></td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('contact.emailEmailField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><a style="text-decoration: underline; color: #000;" href="mailto:<?= $email ?>"><?= $email ?></a></td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('contact.emailPhoneField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $phone ?></td>
</tr>
<tr>
    <td valign="top" style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('contact.emailMessageField') }}</td>
    <td valign="top" style="padding: 8px; text-align: justify; font-size: 13px; line-height: 21px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $text ?></td>
</tr>

@endsection