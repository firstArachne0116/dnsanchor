@extends('admin.layout.dashboard')

@section('title', trans('admin.admin-user.actions.edit_profile'))

@section('body')

    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

    @include( 'admin.layout.employee-area-sidebar' )

    <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="kt-container">
                <dashboard></dashboard>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End::App-->

@endsection
