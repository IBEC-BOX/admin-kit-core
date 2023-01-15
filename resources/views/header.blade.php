@push('head')
    <meta name="robots" content="noindex" />
    <link
        href="{{ asset('/vendor/admin-kit/favicon.ico') }}"
        sizes="any"
        type="image/png"
        id="favicon"
        rel="icon"
    >

    <!-- For Safari on iOS -->
    <meta name="theme-color" content="#041d55">

    <!-- Font FuturaTS-Demibold -->
    <link href="{{ asset('/vendor/admin-kit/fonts/FuturaTS-DemiBold.css') }}" rel="stylesheet">
@endpush

<div class="h2 fw-light d-flex align-items-center">
    <img src="{{ asset('/vendor/admin-kit/logo.png') }}" alt="Admin Kit" width="36" height="36"/>

    <p class="ms-3 d-none d-sm-block" style="font-family: 'Futura TS'; margin-bottom: -12px;">
        AdminKit
    </p>
</div>
