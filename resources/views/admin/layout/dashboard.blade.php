<!DOCTYPE html>
<html lang="en">

    <!-- begin::Head -->
    <head>
        <base href="">
        <meta charset="utf-8" />
        <title>Global Printing Sourcing Development: Dashboard</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

        <!--end::Fonts -->

        <!--begin::Page Vendors Styles(used by this page) -->
        <link href="{{ asset( 'plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

        <!--end::Page Vendors Styles -->

        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{ asset( 'css/style.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset( 'plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    @stack( 'styles' )

    <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->

        <!--end::Layout Skins -->
        <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--left kt-aside--fixed kt-page--loading">

        <!-- begin::Page loader -->

        <!-- end::Page Loader -->

        <!-- begin:: Page -->

        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="{{ url( 'admin' ) }}">
                    <img alt="Logo" src="{{ asset( 'images/logo.png' ) }}" />
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler">
                    <span></span></button>
                <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler">
                    <i class="flaticon-more-1"></i></button>
            </div>
        </div>

        <!-- end:: Header Mobile -->
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                    <!-- begin:: Header -->
                    <div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">
                        <div class="kt-container  kt-container--fluid ">

                            <!-- begin: Header Menu -->
                            <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn">
                                <i class="la la-close"></i></button>
                            <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
                                {{-- <button class="kt-aside-toggler kt-aside-toggler--left" id="kt_aside_toggler">
                                    <span>
                                    </span>
                                </button> --}}


                                <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                                    <ul class="kt-menu__nav ">
                                        <li class="kt-menu__item kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                            <a href="{{ url( 'admin' ) }}" class="kt-menu__link"><span class="kt-menu__link-text">Dashboard</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        </li>

                                        <li class="kt-menu__item kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                            <a href="{{ url( 'admin/contacts' ) }}" class="kt-menu__link"><span class="kt-menu__link-text">Contacts</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        </li>

                                        <li class="kt-menu__item kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                            <a href="{{ url( 'admin/vendors' ) }}" class="kt-menu__link"><span class="kt-menu__link-text">Settings</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        </li>

                                        <li class="kt-menu__item kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                            <a href="{{ url( 'admin/projects' ) }}" class="kt-menu__link"><span class="kt-menu__link-text">Projects</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        </li>

                                        <li class="kt-menu__item kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                            <a href="javascript:void(0)" class="kt-menu__link"><span class="kt-menu__link-text">Tasks</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        </li>

                                        <li class="kt-menu__item kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                            <a href="{{ url( 'admin/templates' ) }}" class="kt-menu__link"><span class="kt-menu__link-text">Templates</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        </li>

                                        <li class="kt-menu__item kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                            <a href="{{ url( 'admin' ) }}" class="kt-menu__link"><span class="kt-menu__link-text">Staff Area</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                                <!--begin: Search -->
                               {{-- <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
                               </div> --}}

                                <!--end: Search -->

                            <!-- end: Header Menu -->

                            <!-- begin:: Brand -->
                            {{-- <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                                <a class="kt-header__brand-logo" href="?page=index">
                                    <img alt="Logo" width="62" src="{{ asset('images/logo.png' ) }}" />
                                </a>
                            </div> --}}

                        <!-- end:: Brand -->

                            <!-- begin:: Header Topbar -->
                            <div class="kt-header__topbar kt-grid__item">

                                <div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact" id="kt_quick_search_dropdown">
                                    <form style="margin-top:10px;" method="get" class="kt-quick-search__form">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="flaticon2-search-1"></i></span>
                                            </div>
                                            <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200">
                                    </div>
                                </div>

                                <!--begin: Notifications -->
                                <div class="kt-header__topbar-item dropdown">
                                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                        <span class="kt-header__topbar-icon"><i class="flaticon2-bell-alarm-symbol"></i></span>
                                        <span v-if="getNotificationCount > 0" class="kt-badge kt-badge--danger"></span>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                        <form>

                                            <!--begin: Head -->
                                            <div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
                                                <h3 class="kt-head__title">
                                                    User Notifications
                                                    <span v-if="getNotificationCount > 0" class="btn btn-label-primary btn-sm btn-bold btn-font-md">@{{ getNotificationCount }} new</span>
                                                </h3>
                                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Alerts</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" role="tab" aria-selected="false">Events</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs" role="tab" aria-selected="false">Logs</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <!--end: Head -->
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                                                    <gpsd-notifications></gpsd-notifications>
                                                </div>
                                                <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                                                    <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-psd kt-font-success"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New report has been received
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    23 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon-download-1 kt-font-danger"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    Finance report has been generated
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    25 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-line-chart kt-font-success"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New order has been received
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    2 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-box-1 kt-font-brand"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New customer is registered
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    3 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-chart2 kt-font-danger"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    Application has been approved
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    3 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-image-file kt-font-warning"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New file has been uploaded
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    5 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-drop kt-font-info"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New user feedback received
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    8 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-pie-chart-2 kt-font-success"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    System reboot has been successfully completed
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    12 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-favourite kt-font-brand"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New order has been placed
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    15 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item kt-notification__item--read">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-safe kt-font-primary"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    Company meeting canceled
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    19 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-psd kt-font-success"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New report has been received
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    23 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon-download-1 kt-font-danger"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    Finance report has been generated
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    25 hrs ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon-security kt-font-warning"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New customer comment recieved
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    2 days ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="kt-notification__item">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="flaticon2-pie-chart kt-font-success"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    New customer is registered
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    3 days ago
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                                    <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                                        <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                                            <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                                                All caught up!
                                                                <br>No new notifications.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!--end: Notifications -->

                                <!--begin: Quick actions -->
                                <div class="kt-header__topbar-item dropdown">
                                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                        <span class="kt-header__topbar-icon"><i class="fa-plus fa"></i></span>
                                    </div>
                                    <div style="width:480px;" class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                        <form>

                                            <!--begin: Grid Nav -->
                                            <div class="kt-grid-nav kt-grid-nav--skin-light">
                                                <div style="background: rgb(217, 217, 217);display: table-caption;padding: 0.35em 1em;text-transform: uppercase;font-weight: 500;color: #777;" class="w-100 kt-grid-nav__row">
                                                    Records
                                                </div>
                                                <div class="kt-grid-nav__row">
                                                    <a href="{{ url( '/admin/contacts/create' ) }}" class="kt-grid-nav__item">
                                                        <span class="kt-grid-nav__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                                </g>
                                                            </svg> </span>
                                                        <span class="kt-grid-nav__desc">Add Contact</span>
                                                    </a>
                                                    <a href="{{ url( '/admin/projects/create' ) }}" class="kt-grid-nav__item">
                                                            <span class="kt-grid-nav__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
                                                                    <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
                                                                </g>
                                                            </svg> </span>
                                                        <span class="kt-grid-nav__desc">Add Project</span>
                                                    </a>
                                                    <a href="{{ url( '/admin/vendors/create' ) }}" class="kt-grid-nav__item">
                                                        <span class="kt-grid-nav__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#000000" opacity="0.3" />
                                                                    <polygon fill="#000000" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912" />
                                                                </g>
                                                            </svg></span>
                                                        <span class="kt-grid-nav__desc">Add Vendor</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <!--end: Grid Nav -->


                                            <!--begin: Grid Nav -->
                                            <div class="kt-grid-nav kt-grid-nav--skin-light">
                                                <div style="background: rgb(217, 217, 217);display: table-caption;padding: 0.35em 1em;text-transform: uppercase;font-weight: 500;color: #777;" class="w-100 kt-grid-nav__row">
                                                    Templates
                                                </div>
                                                <div class="kt-grid-nav__row">
                                                    <a href="{{ url( '/admin/templates/create' ) }}" class="kt-grid-nav__item">
                                                        <span class="kt-grid-nav__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3" />
                                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000" />
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1" />
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1" />
                                                                </g>
                                                            </svg> </span>
                                                        <span class="kt-grid-nav__desc">Add Template</span>
                                                    </a>
                                                    <a href="{{ url( '/admin/email-templates/create' ) }}" class="kt-grid-nav__item">
                                                            <span class="kt-grid-nav__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
                                                                    <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
                                                                </g>
                                                            </svg> </span>
                                                        <span class="kt-grid-nav__desc">Add Email Template</span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="kt-grid-nav__item">

                                                    </a>
                                                </div>
                                            </div>

                                            <!--end: Grid Nav -->
                                        </form>
                                    </div>
                                </div>

                                <!--end: Quick actions -->

                                <!--begin: Quick panel tdoggler -->
                                {{-- <div class="kt-header__topbar-item" data-toggle="kt-tooltip" title="Quick panel" data-placement="top">
                                    <div class="kt-header__topbar-wrapper">
                                        <span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn"><i class="flaticon2-cube-1"></i></span>
                                    </div>
                                </div> --}}

                                <!--end: Quick panel toggler -->

                                <!--begin: User bar -->
                                <div class="kt-header__topbar-item kt-header__topbar-item--user" v-cloak>
                                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                        <span class="kt-header__topbar-welcome kt-visible-desktop">Hi,</span>
                                        <span class="kt-header__topbar-username kt-visible-desktop">@{{ getUser.first_name }}</span>
                                    <!--                                        <img alt="Pic" src="assets/media/users/300_21.jpg" />-->

                                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                        <span class="kt-badge kt-badge--username kt-badge--unified-brand kt-badge--lg kt-badge--circle kt-badge--bold">@{{ getUserInitials }}</span>
                                    </div>

                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                        <!--begin: Head -->
                                        <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                            <div class="kt-user-card__avatar">
                                                <!-- <img class="kt-hidden-" alt="Pic" src="assets/media/users/300_25.jpg" /> -->

                                                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                                <span class="kt-badge kt-badge--username kt-badge--unified-brand kt-badge--lg kt-badge--circle kt-badge--bold">JN</span>
                                            </div>
                                            <div class="kt-user-card__name">
                                                @{{ getUser.first_name + " " + getUser.last_name }}
                                            </div>
                                        </div>

                                        <!--end: Head -->

                                        <!--begin: Navigation -->
                                        <div class="kt-notification">
                                            <a href="{{ url( 'admin/profile' ) }}" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-calendar-3 kt-font-success"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title kt-font-bold">
                                                        My Profile
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        Account settings and more
                                                    </div>
                                                </div>
                                            </a>
                                            {{-- <a href="custom/apps/user/profile-2.html" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-rocket-1 kt-font-danger"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title kt-font-bold">
                                                        My Activities
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        Logs and notifications
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-hourglass kt-font-brand"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title kt-font-bold">
                                                        My Tasks
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        latest tasks and projects
                                                    </div>
                                                </div>
                                            </a> --}}
                                            {{-- <a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-cardiogram kt-font-warning"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title kt-font-bold">
                                                        Billing
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        billing & statements <span class="kt-badge kt-badge&#45;&#45;danger kt-badge&#45;&#45;inline kt-badge&#45;&#45;pill kt-badge&#45;&#45;rounded">2 pending</span>
                                                    </div>
                                                </div>
                                            </a> --}}
                                            <div class="kt-notification__custom kt-space-between">
                                                <form method="post" ref="logout_form" action="{{ url( 'admin/logout' ) }}">
                                                    {{ csrf_field() }}
                                                </form>
                                                <a @click.prevent="$refs.logout_form.submit()" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                                {{-- <a href="custom/user/login-v2.html" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a> --}}
                                            </div>
                                        </div>

                                        <!--end: Navigation -->
                                    </div>
                                </div>

                                <!--end: User bar -->

                            </div>

                            <!-- end:: Header Topbar -->
                        </div>
                    </div>
                    <!-- end:: Header -->

                    <!-- begin:: Aside -->
                    <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                    <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                        <!-- begin:: Aside Menu -->
                        <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                            <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
                                <ul class="kt-menu__nav ">
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin') }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-cog"></i><span class="kt-menu__link-text">Dashboard</span></a>
                                    </li>
                                    <li class="kt-menu__section ">
                                        <h4 class="kt-menu__section-text">Management</h4>
                                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/contacts' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-cube"></i><span class="kt-menu__link-text">Contacts</span></a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/projects' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-cube"></i><span class="kt-menu__link-text">Projects</span></a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-dolly"></i><span class="kt-menu__link-text">Vendors</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                                                    <span class="kt-menu__link"><span class="kt-menu__link-text">Vendors</span></span>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="{{ url( '/admin/vendors') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Vendors Dashboard</span></a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="{{ url( '/admin/vendor-categories' ) }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Vendor Categories</span></a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="{{ url( '/admin/vendor-notes') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Vendor Notes</span></a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="{{ url('/admin/vendor-payment-terms') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Vendor Payment Terms</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/payment-terms' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-fill"></i><span class="kt-menu__link-text">Payment Terms</span></a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/customer-categories' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-fill"></i><span class="kt-menu__link-text">Customer Categories</span></a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/remittance-infos' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-fill"></i><span class="kt-menu__link-text">Remittance Infos</span></a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/orientations' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-fill"></i><span class="kt-menu__link-text">Orientations</span></a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/letter-heads' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-fill"></i><span class="kt-menu__link-text">Letter Heads</span></a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/project-types' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-fill"></i><span class="kt-menu__link-text">Project Types</span></a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/access-logs' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-fill"></i><span class="kt-menu__link-text">Access Logs</span></a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/admin-users' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-fill"></i><span class="kt-menu__link-text">Users</span></a>
                                    </li>

                                    <li class="kt-menu__section ">
                                        <h4 class="kt-menu__section-text">Templates</h4>
                                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                                    </li>

                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/email-templates' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-envelope"></i><span class="kt-menu__link-text">Email Templates</span></a>
                                    </li>

                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ url( '/admin/templates' ) }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-envelope-open-text"></i><span class="kt-menu__link-text">Other Templates</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- end:: Aside Menu -->
                    </div>

                    <div id="notifications"></div>

                    <!-- end:: Aside -->
                    <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                        {{-- <div class="breadcrumbs" style="background: #fafafa; border-bottom: solid 1px #f0f0f0;margin:0;">
                            <div class="kt-content p-0 kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                                <div class="kt-subheader p-0 m-0   kt-grid__item" id="kt_subheader">
                                    <div class="kt-container kt-container--fluid">
                                        <div class="p-0 m-0 kt-subheader__main">
                                            <div class="kt-subheader__breadcrumbs">
                                                <a href="" class="kt-subheader__breadcrumbs-link"><a href="#">Dashboards</a></a>
                                                <span class="kt-subheader__breadcrumbs-separator"></span>
                                                <a href="" class="kt-subheader__breadcrumbs-link">Default Dashboard </a>
                                                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                                            </div>
                                        </div>

                                        <div class="kt-subheader__toolbar">
                                            <a id="kt_quick_panel_toggler_btn" href="#" class="btn btn-label-primary btn-bold mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        @hassection( 'page-title' )
                            <!-- begin:: Subheader -->
                                <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                                    <div class="kt-container ">
                                        <div class="kt-subheader__main">
                                            @hassection( 'page-title' )
                                                <h3 class="kt-subheader__title mt-3">@yield( 'page-title' )</h3>
                                            @endif
                                            <span class="kt-subheader__separator kt-hidden"></span>
                                            <div class="kt-subheader__breadcrumbs">
                                                {{-- <span class="kt-subheader__breadcrumbs-separator"></span>
                                                <a href="" class="kt-subheader__breadcrumbs-link">
                                                    Default Dashboard </a>

                                                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link&#45;&#45;active">Activities Dashboard</span> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="kt-subheader__toolbar">
                                            <div class="kt-subheader__wrapper">
                                                <a href="#" class="btn bg-transparent kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-placement="left">
                                                    <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                                                    <span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date">Aug 16</span>

                                                    &lt;!&ndash;<i class="flaticon2-calendar-1"></i>&ndash;&gt;
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon&#45;&#45;sm">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
                                                        </g>
                                                    </svg> </a>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                        @endif

                        <!-- end:: Subheader -->

                            <!-- begin:: Content -->
                            <div id="app" :class="{ 'kt-container--fluid' : wideContainer }" class="kt-container kt-grid__item kt-grid__item--fluid">

                            @hasSection( 'quick-panel' )
                                <!-- begin::Quick Panel -->
                                <div id="kt_quick_panel" class="kt-quick-panel">
                                    <a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>
                                        <div class="kt-quick-panel__content">
                                            <div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_page_settings" role="tabpanel">
                                                @yield( 'quick-panel' )
                                            </div>
                                        </div>
                                </div>
                                <!-- end::Quick Panel -->
                                @endif

                                <!--Begin::Dashboard 1-->

                                <div class="modals">
                                    <v-dialog />
                                </div>
                                <div>
                                    <notifications position="bottom right" :duration="2000" />
                                </div>

                            @yield( 'body' )

                            <!--Begin::Row-->

                                <!--End::Row-->

                                <!--Begin::Row-->
                                {{-- <div class="row">
                                    <div class="col-xl-8 col-lg-12 order-lg-3 order-xl-1">

                                        &lt;!&ndash;begin:: Widgets/Best Sellers&ndash;&gt;
                                        <div class="kt-portlet kt-portlet--height-fluid">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        Best Sellers
                                                    </h3>
                                                </div>
                                                <div class="kt-portlet__head-toolbar">
                                                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab">
                                                                Latest
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab">
                                                                Month
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab">
                                                                All time
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                                                        <div class="kt-widget5">
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product27.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Great Logo Designn
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic admin themes.
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Keenthemes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">19,200</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">1046</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product22.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Branding Mockup
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic bootstrap themes.
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Fly themes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">24,583</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">3809</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product15.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Awesome Mobile App
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic admin themes.Lorem Ipsum Amet
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Fly themes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">210,054</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">1103</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="kt_widget5_tab2_content">
                                                        <div class="kt-widget5">
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product10.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Branding Mockup
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic bootstrap themes.
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Fly themes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">24,583</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">3809</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product11.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Awesome Mobile App
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic admin themes.Lorem Ipsum Amet
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Fly themes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">210,054</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">1103</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product6.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Great Logo Designn
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic admin themes.
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Keenthemes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">19,200</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">1046</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="kt_widget5_tab3_content">
                                                        <div class="kt-widget5">
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product11.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Awesome Mobile App
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic admin themes.Lorem Ipsum Amet
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Fly themes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">210,054</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">1103</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product6.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Great Logo Designn
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic admin themes.
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Keenthemes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">19,200</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">1046</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget5__item">
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__pic">
                                                                        <img class="kt-widget7__img" src="assets/media/products/product10.jpg" alt="">
                                                                    </div>
                                                                    <div class="kt-widget5__section">
                                                                        <a href="#" class="kt-widget5__title">
                                                                            Branding Mockup
                                                                        </a>
                                                                        <p class="kt-widget5__desc">
                                                                            Metronic bootstrap themes.
                                                                        </p>
                                                                        <div class="kt-widget5__info">
                                                                            <span>Author:</span>
                                                                            <span class="kt-font-info">Fly themes</span>
                                                                            <span>Released:</span>
                                                                            <span class="kt-font-info">23.08.17</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget5__content">
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">24,583</span>
                                                                        <span class="kt-widget5__sales">sales</span>
                                                                    </div>
                                                                    <div class="kt-widget5__stats">
                                                                        <span class="kt-widget5__number">3809</span>
                                                                        <span class="kt-widget5__votes">votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        &lt;!&ndash;end:: Widgets/Best Sellers&ndash;&gt;
                                    </div>
                                    <div class="col-xl-4 col-lg-6 order-lg-3 order-xl-1">

                                        &lt;!&ndash;begin:: Widgets/New Users&ndash;&gt;
                                        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        New Users
                                                    </h3>
                                                </div>
                                                <div class="kt-portlet__head-toolbar">
                                                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab1_content" role="tab">
                                                                Today
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#kt_widget4_tab2_content" role="tab">
                                                                Month
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="kt_widget4_tab1_content">
                                                        <div class="kt-widget4">
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_4.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Anna Strong
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Visual Designer,Google Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-brand btn-bold">Follow</a>
                                                            </div>
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_14.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Milano Esco
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Product Designer, Apple Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-warning btn-bold">Follow</a>
                                                            </div>
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_11.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Nick Bold
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Web Developer, Facebook Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-danger btn-bold">Follow</a>
                                                            </div>
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_1.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Wiltor Delton
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Project Manager, Amazon Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-success btn-bold">Follow</a>
                                                            </div>
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_5.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Nick Stone
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Visual Designer, Github Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-primary btn-bold">Follow</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="kt_widget4_tab2_content">
                                                        <div class="kt-widget4">
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_2.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Kristika Bold
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Product Designer,Apple Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-success">Follow</a>
                                                            </div>
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_13.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Ron Silk
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Release Manager, Loop Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-brand">Follow</a>
                                                            </div>
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_9.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Nick Bold
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Web Developer, Facebook Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-danger">Follow</a>
                                                            </div>
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_2.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Wiltor Delton
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Project Manager, Amazon Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-success">Follow</a>
                                                            </div>
                                                            <div class="kt-widget4__item">
                                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                                    <img src="assets/media/users/100_8.jpg" alt="">
                                                                </div>
                                                                <div class="kt-widget4__info">
                                                                    <a href="#" class="kt-widget4__username">
                                                                        Nick Bold
                                                                    </a>
                                                                    <p class="kt-widget4__text">
                                                                        Web Developer, Facebook Inc
                                                                    </p>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-label-info">Follow</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        &lt;!&ndash;end:: Widgets/New Users&ndash;&gt;
                                    </div>
                                    <div class="col-xl-4 col-lg-4 order-lg-2 order-xl-1">

                                        &lt;!&ndash;begin:: Widgets/Daily Sales&ndash;&gt;
                                        <div class="kt-portlet kt-portlet--height-fluid">
                                            <div class="kt-widget14">
                                                <div class="kt-widget14__header kt-margin-b-30">
                                                    <h3 class="kt-widget14__title">
                                                        Daily Sales
                                                    </h3>
                                                    <span class="kt-widget14__desc">
                                                        Check out each collumn for more details
                                                    </span>
                                                </div>
                                                <div class="kt-widget14__chart" style="height:120px;">
                                                    <canvas id="kt_chart_daily_sales"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        &lt;!&ndash;end:: Widgets/Daily Sales&ndash;&gt;
                                    </div>
                                    <div class="col-xl-4 col-lg-4 order-lg-2 order-xl-1">

                                        &lt;!&ndash;begin:: Widgets/Profit Share&ndash;&gt;
                                        <div class="kt-portlet kt-portlet--height-fluid">
                                            <div class="kt-widget14">
                                                <div class="kt-widget14__header">
                                                    <h3 class="kt-widget14__title">
                                                        Profit Share
                                                    </h3>
                                                    <span class="kt-widget14__desc">
                                                        Profit Share between customers
                                                    </span>
                                                </div>
                                                <div class="kt-widget14__content">
                                                    <div class="kt-widget14__chart">
                                                        <div class="kt-widget14__stat">45</div>
                                                        <canvas id="kt_chart_profit_share" style="height: 140px; width: 140px;"></canvas>
                                                    </div>
                                                    <div class="kt-widget14__legends">
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-success"></span>
                                                            <span class="kt-widget14__stats">37% Sport Tickets</span>
                                                        </div>
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                            <span class="kt-widget14__stats">47% Business Events</span>
                                                        </div>
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-brand"></span>
                                                            <span class="kt-widget14__stats">19% Others</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        &lt;!&ndash;end:: Widgets/Profit Share&ndash;&gt;
                                    </div>
                                    <div class="col-xl-4 col-lg-4 order-lg-2 order-xl-1">

                                        &lt;!&ndash;begin:: Widgets/Revenue Change&ndash;&gt;
                                        <div class="kt-portlet kt-portlet--height-fluid">
                                            <div class="kt-widget14">
                                                <div class="kt-widget14__header">
                                                    <h3 class="kt-widget14__title">
                                                        Revenue Change
                                                    </h3>
                                                    <span class="kt-widget14__desc">
                                                        Revenue change breakdown by cities
                                                    </span>
                                                </div>
                                                <div class="kt-widget14__content">
                                                    <div class="kt-widget14__chart">
                                                        <div id="kt_chart_revenue_change" style="height: 150px; width: 150px;"></div>
                                                    </div>
                                                    <div class="kt-widget14__legends">
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-success"></span>
                                                            <span class="kt-widget14__stats">+10% New York</span>
                                                        </div>
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                            <span class="kt-widget14__stats">-7% London</span>
                                                        </div>
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-brand"></span>
                                                            <span class="kt-widget14__stats">+20% California</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        &lt;!&ndash;end:: Widgets/Revenue Change&ndash;&gt;
                                    </div>
                                    <div class="col-xl-4 col-lg-6 order-lg-3 order-xl-1">

                                        &lt;!&ndash;begin:: Widgets/Tasks &ndash;&gt;
                                        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        Tasks
                                                    </h3>
                                                </div>
                                                <div class="kt-portlet__head-toolbar">
                                                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab1_content" role="tab">
                                                                Today
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab2_content" role="tab">
                                                                Week
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab3_content" role="tab">
                                                                Month
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="kt_widget2_tab1_content">
                                                        <div class="kt-widget2">
                                                            <div class="kt-widget2__item kt-widget2__item--primary">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Metronic Great Again.Lorem Ipsum Amet
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Bob
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--warning">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Prepare Docs For Metting On Monday
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Sean
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--brand">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Widgets Development. Estudiat Communy Elit
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Aziko
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--success">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Metronic Development. Lorem Ipsum
                                                                    </a>
                                                                    <a class="kt-widget2__username">
                                                                        By James
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--danger">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Completa Financial Report For Emirates Airlines
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Bob
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--info">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Completa Financial Report For Emirates Airlines
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Sean
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="kt_widget2_tab2_content">
                                                        <div class="kt-widget2">
                                                            <div class="kt-widget2__item kt-widget2__item--success">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Metronic Development.Lorem Ipsum
                                                                    </a>
                                                                    <a class="kt-widget2__username">
                                                                        By James
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--warning">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Prepare Docs For Metting On Monday
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Sean
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--danger">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Completa Financial Report For Emirates Airlines
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Bob
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--primary">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Metronic Great Again.Lorem Ipsum Amet
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Bob
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--info">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Completa Financial Report For Emirates Airlines
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Sean
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--brand">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Widgets Development.Estudiat Communy Elit
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Aziko
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="kt_widget2_tab3_content">
                                                        <div class="kt-widget2">
                                                            <div class="kt-widget2__item kt-widget2__item--warning">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Metronic Development. Lorem Ipsum
                                                                    </a>
                                                                    <a class="kt-widget2__username">
                                                                        By James
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--danger">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Completa Financial Report For Emirates Airlines
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Bob
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--brand">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Widgets Development.Estudiat Communy Elit
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Aziko
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--info">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Completa Financial Report For Emirates Airlines
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Sean
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--success">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Completa Financial Report For Emirates Airlines
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Bob
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget2__item kt-widget2__item--primary">
                                                                <div class="kt-widget2__checkbox">
                                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                                        <input type="checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="kt-widget2__info">
                                                                    <a href="#" class="kt-widget2__title">
                                                                        Make Metronic Great Again.Lorem Ipsum Amet
                                                                    </a>
                                                                    <a href="#" class="kt-widget2__username">
                                                                        By Bob
                                                                    </a>
                                                                </div>
                                                                <div class="kt-widget2__actions">
                                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                        <i class="flaticon-more-1"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                                        <ul class="kt-nav">
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                                    <span class="kt-nav__link-text">Members</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="kt-nav__item">
                                                                                <a href="#" class="kt-nav__link">
                                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        &lt;!&ndash;end:: Widgets/Tasks &ndash;&gt;
                                    </div>
                                    <div class="col-xl-4 col-lg-6 order-lg-3 order-xl-1">

                                        &lt;!&ndash;begin:: Widgets/Notifications&ndash;&gt;

                                        &lt;!&ndash;end:: Widgets/Notifications&ndash;&gt;
                                    </div>
                                    <div class="col-xl-4 col-lg-6 order-lg-3 order-xl-1">

                                        &lt;!&ndash;begin:: Widgets/Support Tickets &ndash;&gt;
                                        <div class="kt-portlet kt-portlet--height-fluid">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        Support Tickets
                                                    </h3>
                                                </div>
                                                <div class="kt-portlet__head-toolbar">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="flaticon-more-1"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">

                                                            &lt;!&ndash;begin::Nav&ndash;&gt;
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__head">
                                                                    Export Options
                                                                    <span data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand kt-svg-icon--md1">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24" />
                                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                                                <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
                                                                                <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                                                            </g>
                                                                        </svg> </span>
                                                                </li>
                                                                <li class="kt-nav__separator"></li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link">
                                                                        <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                                        <span class="kt-nav__link-text">Activity</span>
                                                                    </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link">
                                                                        <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                                        <span class="kt-nav__link-text">FAQ</span>
                                                                    </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link">
                                                                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                                                        <span class="kt-nav__link-text">Settings</span>
                                                                    </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link">
                                                                        <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                                        <span class="kt-nav__link-text">Support</span>
                                                                        <span class="kt-nav__link-badge">
                                                                            <span class="kt-badge kt-badge--success kt-badge--rounded">5</span>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="kt-nav__separator"></li>
                                                                <li class="kt-nav__foot">
                                                                    <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                                                    <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                                                </li>
                                                            </ul>

                                                            &lt;!&ndash;end::Nav&ndash;&gt;
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body">
                                                <div class="kt-widget3">
                                                    <div class="kt-widget3__item">
                                                        <div class="kt-widget3__header">
                                                            <div class="kt-widget3__user-img">
                                                                <img class="kt-widget3__img" src="assets/media/users/user1.jpg" alt="">
                                                            </div>
                                                            <div class="kt-widget3__info">
                                                                <a href="#" class="kt-widget3__username">
                                                                    Melania Trump
                                                                </a><br>
                                                                <span class="kt-widget3__time">
                                                                    2 day ago
                                                                </span>
                                                            </div>
                                                            <span class="kt-widget3__status kt-font-info">
                                                                Pending
                                                            </span>
                                                        </div>
                                                        <div class="kt-widget3__body">
                                                            <p class="kt-widget3__text">
                                                                Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget3__item">
                                                        <div class="kt-widget3__header">
                                                            <div class="kt-widget3__user-img">
                                                                <img class="kt-widget3__img" src="assets/media/users/user4.jpg" alt="">
                                                            </div>
                                                            <div class="kt-widget3__info">
                                                                <a href="#" class="kt-widget3__username">
                                                                    Lebron King James
                                                                </a><br>
                                                                <span class="kt-widget3__time">
                                                                    1 day ago
                                                                </span>
                                                            </div>
                                                            <span class="kt-widget3__status kt-font-brand">
                                                                Open
                                                            </span>
                                                        </div>
                                                        <div class="kt-widget3__body">
                                                            <p class="kt-widget3__text">
                                                                Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.Ut wisi enim ad minim veniam,quis nostrud exerci tation ullamcorper.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget3__item">
                                                        <div class="kt-widget3__header">
                                                            <div class="kt-widget3__user-img">
                                                                <img class="kt-widget3__img" src="assets/media/users/user5.jpg" alt="">
                                                            </div>
                                                            <div class="kt-widget3__info">
                                                                <a href="#" class="kt-widget3__username">
                                                                    Deb Gibson
                                                                </a><br>
                                                                <span class="kt-widget3__time">
                                                                    3 weeks ago
                                                                </span>
                                                            </div>
                                                            <span class="kt-widget3__status kt-font-success">
                                                                Closed
                                                            </span>
                                                        </div>
                                                        <div class="kt-widget3__body">
                                                            <p class="kt-widget3__text">
                                                                Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        &lt;!&ndash;end:: Widgets/Support Tickets &ndash;&gt;
                                    </div>
                                </div> --}}

                                <!--End::Row-->

                                <!--End::Dashboard 1-->
                            </div>

                            <!-- end:: Content -->
                        </div>
                    </div>

                    <!-- begin:: Footer -->
                    <div class="kt-footer kt-grid__item" id="kt_footer">
                        <div class="kt-container text-center">
                            <div class="kt-footer__wrapper">
                                <div class="kt-footer__copyright text-center m-auto">
                                    2019&nbsp;&copy;&nbsp;<a href="#" class="kt-link">Global Printing Sourcing Development</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end:: Footer -->
                </div>
            </div>
        </div>
        <!-- end:: Page -->

        <!-- begin::Scrolltop -->
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>

        <!-- end::Scrolltop -->

        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {
                'colors': {
                    'state': {
                        'brand': '#591df1',
                        'light': '#ffffff',
                        'dark': '#282a3c',
                        'primary': '#5867dd',
                        'success': '#34bfa3',
                        'info': '#36a3f7',
                        'warning': '#ffb822',
                        'danger': '#fd3995'
                    },
                    'base': {
                        'label': ['#c5cbe3', '#a1a8c3', '#3d4465', '#3e4466'],
                        'shape': ['#f0f3ff', '#d9dffa', '#afb4d4', '#646c9a']
                    }
                }
            };
        </script>

        <!-- end::Global Config -->

        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="{{ asset( 'js/plugins.bundle.new.js') }}" type="text/javascript"></script>
        <script src="{{ asset( 'js/scripts.bundle.new.js') }}" type="text/javascript"></script>

        <!--end::Global Theme Bundle -->

        <!--begin::Page Vendors(used by this page) -->
        <script src="{{ asset( 'plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
    {{--        <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>--}}
    {{--        <script src="{{ asset( 'plugins/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>--}}

    <!--end::Page Vendors -->

        <!--begin::Page Scripts(used by this page) -->
        <script src="{{ asset('js/admin-new.js') }}" type="text/javascript"></script>

    @stack( 'scripts' )

    <!--end::Page Scripts -->
    </body>

    <!-- end::Body -->
</html>
