@extends('layouts.emails')

@section('title')
{{ trans('kits.emailConfirmedTitle', compact('customerName', 'kitName')) }}
@endsection

@section('content')

<tr>
    <td colspan="2" style="padding-bottom: 20px; text-align: center; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ trans('kits.emailConfirmedText', ['name' => $customerName]) }}
    </td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('kits.emailConfirmedNameField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $customerName ?></td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('kits.emailConfirmedKitNameField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $kitName ?></td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('kits.emailConfirmedTransactionField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $transactionId ?></td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('kits.emailConfirmedTransactionDateField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $transactionDate ?></td>
</tr>
<tr>
    <td colspan="2" style="padding-top: 30px; text-align: center;">
        <a style="background: #c09e7a; padding: 12px 31px; text-transform: uppercase; text-decoration: none; font-size: 16px; color: #fff; font-family: Arial, Helvetica, sans-serif;" href="<?= $link ?>">{{ trans('kits.emailConfirmedButton') }}</a>
    </td>
</tr>

@endsection
