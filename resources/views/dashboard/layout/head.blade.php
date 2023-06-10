{{--    <base href="../../">--}}
<meta charset="utf-8"/>
<title>@yield('title', 'Empty')</title>
<meta name="description" content="Page with empty content"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<link rel="canonical" href="https://keenthemes.com/metronic"/>

<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
<!--end::Fonts-->

<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.'.change_trans().'css')}}" rel="stylesheet" type="text/css"/>
<!--end::Page Vendors Styles-->

<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{asset('assets/plugins/global/plugins.bundle.'.change_trans().'css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.'.change_trans().'css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/style.bundle.'.change_trans().'css')}}" rel="stylesheet" type="text/css"/>
<!--end::Global Theme Styles-->


<!--begin::Layout Themes(used by all pages)-->
<link href="{{asset('assets/css/themes/layout/header/base/light.'.change_trans().'css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/themes/layout/header/menu/light.'.change_trans().'css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/themes/layout/brand/light.'.change_trans().'css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/themes/layout/aside/light.'.change_trans().'css')}}" rel="stylesheet" type="text/css"/>
<!--end::Layout Themes-->

<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}"/>
@toastr_css

@yield('style')

