<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };</script>

<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Theme Bundle-->

<!--begin::Page Vendors(used by this page)-->
<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
{{--<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script>--}}
<script src="{{asset('assets/plugins/custom/gmaps/gmaps.js')}}"></script>
<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<!--end::Page Scripts-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<!--end::Page Scripts-->

{{--@jquery--}}
{{--<!-- The core Firebase JS SDK is always required and must be listed first -->--}}
{{--<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>--}}
{{--<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>--}}

{{--<!-- https://firebase.google.com/docs/web/setup#available-libraries -->--}}
{{--<script>--}}
{{--    // Your web app's Firebase configuration--}}
{{--    var firebaseConfig = {--}}
{{--        apiKey: "AIzaSyDa-Mt_Z2_e49PCYE-vjGnw3nkJJ86nYFQ",--}}
{{--        authDomain: "laravel-25776.firebaseapp.com",--}}
{{--        projectId: "laravel-25776",--}}
{{--        storageBucket: "laravel-25776.appspot.com",--}}
{{--        messagingSenderId: "433141213721",--}}
{{--        appId: "1:433141213721:web:6285804aadb32becfed888",--}}
{{--        measurementId: "G-HVKDMGBTVL"--}}
{{--    };--}}
{{--    // Initialize Firebase--}}
{{--    firebase.initializeApp(firebaseConfig);--}}

{{--    const messaging = firebase.messaging();--}}

{{--    function initFirebaseMessagingRegistration() {--}}
{{--        messaging.requestPermission().then(function () {--}}
{{--            return messaging.getToken()--}}
{{--        }).then(function(token) {--}}

{{--            axios.post("{{ route('fcmToken') }}",{--}}
{{--                _method:"PATCH",--}}
{{--                token--}}
{{--            }).then(({data})=>{--}}
{{--                console.log(data)--}}
{{--            }).catch(({response:{data}})=>{--}}
{{--                console.error(data)--}}
{{--            })--}}

{{--        }).catch(function (err) {--}}
{{--            console.log(`Token Error :: ${err}`);--}}
{{--        });--}}
{{--    }--}}

{{--    initFirebaseMessagingRegistration();--}}

{{--    messaging.onMessage(function({data:{body,title}}){--}}
{{--        new Notification(title, {body});--}}
{{--    });--}}
{{--</script>--}}
@yield('script')


@toastr_js
@toastr_render

