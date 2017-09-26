@extends('layouts.emails')

@section('title')
{{ trans('passwords.resetPasswordEmailTitle') }}
@endsection

@section('content')

<tr>
    <td style="padding: 8px; text-align: center;">
        <a style="background: #c09e7a; padding: 12px 31px; text-transform: uppercase; text-decoration: none; font-size: 16px; color: #fff; font-family: Arial, Helvetica, sans-serif;"
           href="{{ url('password/reset', $token) . '?email=' . urlencode($user->getEmailForPasswordReset()) }}"
        >{{ trans('passwords.resetPasswordEmailText') }}</a>
    </td>
</tr>

@endsection