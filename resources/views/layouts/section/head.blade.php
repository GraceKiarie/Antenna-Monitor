<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>{{ $title ?? 'TODO' }} | {{ config('app.name') }}</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
<meta name="description" content="App Dashboard">
<meta name="msapplication-tap-highlight" content="no">

<link href="./assets/css/template.css" rel="stylesheet">
<!-- PAGE SPECIFIC STYLES -->
<!-- FRAMEWORK CSS FOR PAGE -->
@stack('app-styles')

<!-- CUSTOM PAGE CSS -->
<link href="./assets/css/app.css" rel="stylesheet">
@stack('page-styles')
