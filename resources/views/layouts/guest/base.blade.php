<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Xibalba</title>

    {{--  Styles Sheets Section  --}}
    @include('layouts.guest.partials.styles')
</head>

<body>
    @yield('content')

{{-- cripts section--}}
@include('layouts.guest.partials.scripts')


</body>
</html>
