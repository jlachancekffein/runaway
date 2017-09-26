@extends('layouts.emails')

@section('title')
{{ trans('account.emailTitle', ['name' => $customerName]) }}
@endsection

@section('content')

<tr>
    <td style="text-align: center; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ trans('account.emailText', ['name' => $customerName]) }}
    </td>
</tr>
<tr>
    <td style="padding-top: 30px; text-align: center;">
        <a style="background: #c09e7a; padding: 12px 31px; text-transform: uppercase; text-decoration: none; font-size: 16px; color: #fff; font-family: Arial, Helvetica, sans-serif;" href="<?= $link ?>">{{ trans('account.emailButton') }}</a>
    </td>
</tr>

@endsection
