<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="{{ isset($og_description) && !empty($og_description) ? strip_tags($og_description) : 'Paramount Realty' }}">
<meta name="keywords" content="{{ isset($og_description) && !empty($og_description) ? strip_tags($og_description) : 'Paramount Realty' }}">
<meta name="author" content="Paramount">
<meta name="robots" content="follow, index"/>
<link rel="canonical" href="{{ url()->current() }}" />
<meta property="og:title" content="{{ isset($og_title) && !empty($og_title) ? $og_title : 'Paramount Realty' }}" />
<meta property="og:description" content="{{ isset($og_description) && !empty($og_description) ? strip_tags($og_description) : 'Paramount Realty' }}" />
<meta property="og:image" content="{{ isset($og_image) && !empty($og_image) ? $og_image : asset('assets/front/images/OG.png') }}" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ isset($og_title) && !empty($og_title) ? $og_title.' - Paramount Realty' : 'Paramount Realty' }}</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/common-style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/style.css?v=' . date('Y-m-d H:i:s') . '') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/style-new.css') }}">

<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
