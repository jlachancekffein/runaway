<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Runway 2 Doorway</title>
</head>
<body style="margin: 0; background: #f4f4f3;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td align="center"><table cellpadding="0" cellspacing="0" border="0" width="730" style="background: #fff;">
                <tr>
                    <td><a href="{{ url('/') . '?locale=' . App::getLocale() }}"><img style="display: block; border: 0;" src="{{ asset('images/mail-header.jpg') }}" alt=""></a></td>
                </tr>
                <tr>
                    <td><img style="display: block; border: 0;" src="{{ asset('images/mail-banner-v2.jpg') }}" alt=""></td>
                </tr>
                <tr>
                    <td style="padding: 83px 70px 13px 70px; border-bottom: 1px solid #cecece; font-size: 22px; font-weight: 400; color: #c09e7a; font-family: Arial, Helvetica, sans-serif;">
                        @yield('title')
                    </td>
                </tr>
                <tr>
                    <td style="padding: 38px 70px 60px 70px;"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                        @yield('content')
                    </table></td>
                </tr>
            </table></td>
        </tr>
    </table>
</body>
</html>