@extends('admin.layout.dashboard')

@section('title', trans('admin.contact.actions.create' ))

@push( 'styles' )
    <link href="{{ asset( 'css/wizard-4.css' ) }}" rel="stylesheet">
@endpush

@push( 'scripts' )
    <script src="{{ asset( 'js/wizard.js' ) }}"></script>
@endpush

@section('body')

    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container ">
            <div class="kt-subheader__main">

                <h3 class="kt-subheader__title">
                    Add Contact
                </h3>

            </div>
            <div class="kt-subheader__toolbar">

                <a href="{{ url( 'admin/contacts' ) }}" class="btn btn-default btn-bold">Back </a>

                <div class="btn-group">
                    <button type="button" class="btn btn-brand btn-bold">Save & Exit</button>
                    <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(113px, 35px, 0px);">
                        <ul class="kt-nav">
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <span class="kt-nav__link-text">Save &amp; Continue</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <span class="kt-nav__link-text">Save &amp; Add New</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!-- begin:: Content -->
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="between">
            <!--begin: Form Wizard Nav -->
            <div class="kt-wizard-v4__nav">
                <div class="kt-wizard-v4__nav-items nav">
                    <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                    <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                1
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    Primary Contact(s)
                                </div>
                               {{-- <div class="kt-wizard-v4__nav-label-desc">
                                   Contact Information
                               </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                2
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    Social Media
                                </div>
                               {{-- <div class="kt-wizard-v4__nav-label-desc">
                                   Contact's Social Media
                               </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                3
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    Alternative Contacts
                                </div>
                            </div>
                        </div>
                    </div>
                   {{-- <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                       <div class="kt-wizard-v4__nav-body">
                           <div class="kt-wizard-v4__nav-number">
                               4
                           </div>
                           <div class="kt-wizard-v4__nav-label">
                               <div class="kt-wizard-v4__nav-label-title">
                                   Review
                               </div>
                           </div>
                       </div>
                   </div> --}}
                </div>
            </div>
            <!--end: Form Wizard Nav -->

            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-grid">
                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">
                            <!--begin: Form Wizard Form-->
                           {{-- <form class="kt-form" id="kt_user_add_form" novalidate="novalidate"> --}}

                                <contact-form
                                        action="{{ url( 'admin/contacts' ) }}"
                                        inline-template>

                                        <form id="kt_user_add_form" class="kt-form kt-wizard-v4__content form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>
                                            @include('admin.contact.components.form-elements')


                                            <!--begin: Form Wizard Step 4-->
                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                                    <div class="kt-heading kt-heading--md">Review your Details and Submit</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v4__review">
                                                            <div class="kt-wizard-v4__review-item">
                                                                <div class="kt-wizard-v4__review-title">
                                                                    Your Account Details
                                                                </div>
                                                                <div class="kt-wizard-v4__review-content">
                                                                    John Wick
                                                                    <br> Phone: +61412345678
                                                                    <br> Email: johnwick@reeves.com
                                                                </div>
                                                            </div>
                                                            <div class="kt-wizard-v4__review-item">
                                                                <div class="kt-wizard-v4__review-title">
                                                                    Your Address Details
                                                                </div>
                                                                <div class="kt-wizard-v4__review-content">
                                                                    Address Line 1
                                                                    <br> Address Line 2
                                                                    <br> Melbourne 3000, VIC, Australia
                                                                </div>
                                                            </div>
                                                            <div class="kt-wizard-v4__review-item">
                                                                <div class="kt-wizard-v4__review-title">
                                                                    Payment Details
                                                                </div>
                                                                <div class="kt-wizard-v4__review-content">
                                                                    Card Number: xxxx xxxx xxxx 1111
                                                                    <br> Card Name: John Wick
                                                                    <br> Card Expiry: 01/21
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: Form Wizard Step 4-->

                                            <!--begin: Form Actions -->
                                                <div class="kt-form__actions">
                                                    <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                                        Previous
                                                    </div>
                                                    <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                                        Submit
                                                    </div>
                                                    <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                                        Next Step
                                                    </div>
                                                </div>
                                                <!--end: Form Actions -->
                                        </form>

                                </contact-form>

                           {{-- </form> --}}
                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
