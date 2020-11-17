@extends('admin.layout.dashboard')

@section('title', 'Edit JCC')

@section('body')

    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Content-->
        <jcc-editor></jcc-editor>
        <!--End:: App Content-->
    </div>
    <!--End::App-->

@endsection
