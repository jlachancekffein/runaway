@extends('layouts.emails')

@section('title')
{{ trans('kitRequests.emailTitle') }}
@endsection

@section('content')

<tr>
    <td colspan="2" style="padding-bottom: 20px; text-align: center; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ trans('kitRequests.emailText', ['name' => $name]) }}
    </td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('kitRequests.emailNameField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $name ?></td>
</tr>
<tr>
    <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('kitRequests.emailBudgetField') }}</td>
    <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $budget ?></td>
</tr>
<tr>
    <td valign="top" style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('kitRequests.emailCommentField') }}</td>
    <td valign="top" style="padding: 8px; text-align: justify; font-size: 13px; line-height: 21px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $comment ?></td>
</tr>
<tr>
    <td colspan="2" style="padding-top: 30px; text-align: center;">
        <a style="background: #c09e7a; padding: 12px 31px; text-transform: uppercase; text-decoration: none; font-size: 16px; color: #fff; font-family: Arial, Helvetica, sans-serif;" href="<?= $link ?>">{{ trans('kitRequests.emailButton') }}</a>
    </td>
</tr>

@endsection
