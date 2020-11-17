@extends('admin.layout.dashboard')

@section('title', trans('admin.project.actions.create' ) )

@section( 'quick-panel' )
    <quick-panel inline-template>
        <div>
            @{{ page }}
        </div>
    </quick-panel>
@endsection

@push( 'styles' )
    <link href="{{ asset( 'css/todo.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('body')

    <div class="container-fluid">

        <project-form
                action="{{ url( 'admin/projects' ) }}"
                :types="{{ json_encode( $project_types ) }}"
                :is-manager="{{ request()->user()->hasRole( 'Manager' ) ? 'true' : 'false' }}"
                inline-template>

            <div>

                <!-- begin:: Subheader -->
                <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                    <div class="kt-container ">
                        <div class="kt-subheader__main mt-3">
                            <h3 class="kt-subheader__title">
                                Projects</h3>
                            <span class="kt-subheader__separator kt-hidden"></span>
                            <div class="kt-subheader__breadcrumbs">
                                <span class="kt-subheader__breadcrumbs-separator"></span>
                                <!--											<a href="" class="kt-subheader__breadcrumbs-link">-->
                                <!--												Default Dashboard </a>-->

                                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">New Project</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end:: Subheader -->

                <!-- begin:: Content -->
                <div class="kt-container  kt-grid__item kt-grid__item--fluid">


                    <!--Begin:: Portlet-->
                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                                    <li class="nav-item">
                                        <a @click="setTab('overview')" class="nav-link active" data-toggle="tab" href="#gpsd_overview" role="tab">
                                            <i class="flaticon2-calendar-3"></i> Overview
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="setTab('rfq')" class="nav-link " data-toggle="tab" href="#gpsd_rfq" role="tab">
                                            <i class="flaticon2-notepad"></i> RFQ
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="setTab('pcq')" class="nav-link" data-toggle="tab" href="#gpsd_pcq" role="tab">
                                            <i class="flaticon2-notepad"></i> PCQ
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="setTab('fcq')" class="nav-link " data-toggle="tab" href="#gpsd_fcq" role="tab">
                                            <i class="flaticon2-notepad"></i> FCQ
                                            <span v-if="!fcq_signed" class="ml-3 btn btn-label-brand btn-sm btn-bold btn-upper">Awaiting Approval</span>
                                            <span v-else class="ml-3 btn btn-label-success btn-sm btn-bold btn-upper">Signed</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="setTab('jcp')" class="nav-link " data-toggle="tab" href="#gpsd_jcp" role="tab">
                                            <i class="flaticon2-checking"></i> JCP
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="setTab('po')" class="nav-link " data-toggle="tab" href="#gpsd_po" role="tab">
                                            <i class="flaticon2-pie-chart"></i> PO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="setTab('misc_po')" class="nav-link " data-toggle="tab" href="#gpsd_misc_po" role="tab">
                                            <i class="flaticon2-pie-chart-1"></i> Misc PO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="setTab('aa')" class="nav-link " data-toggle="tab" href="#gpsd_aa" role="tab">
                                            <i class="flaticon2-analytics-2"></i> AA
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="setTab('jcw')" class="nav-link " data-toggle="tab" href="#gpsd_jcw" role="tab">
                                            <i class="flaticon2-pie-chart-2"></i> JCW
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--End:: Portlet-->

                    <!--begin:: Portlet-->
                    <div class="tab-content">
                        <div v-cloak class="row" v-if="isCurrentTab( ['po'] ) && fcq_signed || isCurrentTab([ 'rfq', 'pcq', 'fcq', ])">
                            <div class="col-3">
                                <div style="position: sticky; top: 90px;">
                                    <!--begin::Section-->
                                    <div class="kt-portlet bg-white">
                                        <ul class="kt-nav kt-nav--active-bg" id="kt_nav" role="tablist">
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                          <span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg>									</span>
                                                    <span class="kt-nav__link-text">Main Details</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item kt-nav__item--active">
                                                <a class="kt-nav__link  dropdown-toggle" role="tab" id="kt_nav_link_1" data-toggle="collapse" href="#kt_nav_sub_1" aria-expanded=" false">
                                          <span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24" />
        <polygon fill="#000000" opacity="0.3" points="12 2 4 19 20 19" />
        <rect fill="#000000" x="11" y="11" width="2" height="11" rx="1" />
    </g>
</svg>						</span>
                                                    <span class="kt-nav__link-text">Project Type(s)</span>
                                                </a>
                                                <ul class="kt-nav__sub collapse show" id="kt_nav_sub_1" role="tabpanel" aria-labelledby="m_nav_link_1" data-parent="#kt_nav">
                                                    <li v-for="type in types" class="kt-nav__item">
                                                        <a :href="'#' + type.friendly_name + '-' + type.id" class="kt-nav__link">
                                                            <span class="kt-nav__link-bullet kt-nav__link-bullet--line"><span></span></span>
                                                            <span class="kt-nav__link-text">@{{ type.name }}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                          <span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg>									</span>
                                                    <span class="kt-nav__link-text">Other Information</span>
                                                </a>
                                            </li>

                                            <li v-if="isCurrentTab(['pcq', 'fcq'])" class="kt-nav__item">
                                                <a href="#pcq_information" class="kt-nav__link">
                                          <span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg>									</span>
                                                    <span class="kt-nav__link-text">PCQ Information</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end::Section-->

                                    {{--                                    <!--begin::Actions-->--}}
                                    {{--                                    <div class="kt-subheader__toolbar">--}}
                                    {{--                                        <div class="kt-subheader__wrapper">--}}
                                    {{--                                            <a href="#" class="btn kt-subheader__btn-primary">--}}
                                    {{--                                                Actions &nbsp;--}}
                                    {{--                                                <!--<i class="flaticon2-calendar-1"></i>-->--}}
                                    {{--                                            </a>--}}

                                    {{--                                            <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="left">--}}
                                    {{--                                                <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                    {{--                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">--}}
                                    {{--                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                                    {{--                                                            <polygon points="0 0 24 0 24 24 0 24" />--}}
                                    {{--                                                            <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />--}}
                                    {{--                                                            <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />--}}
                                    {{--                                                        </g>--}}
                                    {{--                                                    </svg>                        <!--<i class="flaticon2-plus"></i>-->--}}
                                    {{--                                                </a>--}}
                                    {{--                                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">--}}
                                    {{--                                                    <!--begin::Nav-->--}}
                                    {{--                                                    <ul class="kt-nav">--}}
                                    {{--                                                        <li class="kt-nav__head">--}}
                                    {{--                                                            Add anything or jump to:--}}
                                    {{--                                                            <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>--}}
                                    {{--                                                        </li>--}}
                                    {{--                                                        <li class="kt-nav__separator"></li>--}}
                                    {{--                                                        <li class="kt-nav__item">--}}
                                    {{--                                                            <a href="#" class="kt-nav__link">--}}
                                    {{--                                                                <i class="kt-nav__link-icon flaticon2-drop"></i>--}}
                                    {{--                                                                <span class="kt-nav__link-text">Order</span>--}}
                                    {{--                                                            </a>--}}
                                    {{--                                                        </li>--}}
                                    {{--                                                        <li class="kt-nav__item">--}}
                                    {{--                                                            <a href="#" class="kt-nav__link">--}}
                                    {{--                                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>--}}
                                    {{--                                                                <span class="kt-nav__link-text">Ticket</span>--}}
                                    {{--                                                            </a>--}}
                                    {{--                                                        </li>--}}
                                    {{--                                                        <li class="kt-nav__item">--}}
                                    {{--                                                            <a href="#" class="kt-nav__link">--}}
                                    {{--                                                                <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>--}}
                                    {{--                                                                <span class="kt-nav__link-text">Goal</span>--}}
                                    {{--                                                            </a>--}}
                                    {{--                                                        </li>--}}
                                    {{--                                                        <li class="kt-nav__item">--}}
                                    {{--                                                            <a href="#" class="kt-nav__link">--}}
                                    {{--                                                                <i class="kt-nav__link-icon flaticon2-new-email"></i>--}}
                                    {{--                                                                <span class="kt-nav__link-text">Support Case</span>--}}
                                    {{--                                                                <span class="kt-nav__link-badge">--}}
                                    {{--                                        <span class="kt-badge kt-badge--success">5</span>--}}
                                    {{--                                    </span>--}}
                                    {{--                                                            </a>--}}
                                    {{--                                                        </li>--}}
                                    {{--                                                        <li class="kt-nav__separator"></li>--}}
                                    {{--                                                        <li class="kt-nav__foot">--}}
                                    {{--                                                            <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>--}}
                                    {{--                                                            <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>--}}
                                    {{--                                                        </li>--}}
                                    {{--                                                    </ul>--}}
                                    {{--                                                    <!--end::Nav-->--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <!--end::Actions-->--}}
                                </div>

                            </div>

                            <div class="col-9">

                                <!-- begin::Main Details-->
                                <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_2">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="kt-portlet__head-title">
                                                Main Details
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="kt-portlet__content">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group" :class="{'has-danger': errors.has('client'), 'has-success': this.fields.client && this.fields.client.valid}">
                                                        <label for="client">
                                                            {{ trans('admin.project.columns.client') }}
                                                        </label>

                                                        <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="form.client" id="ajax" label="primary_contact_name" track-by="id" placeholder="Type to search" open-direction="bottom" :options="clients" :multiple="false" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit-text="limitText" :max-height="600" :show-no-results="true" :hide-selected="false" @search-change="clientLookup">
                                                            <template slot="tag" slot-scope="{ option, remove }">
                                                                <span class="custom__tag"><span>@{{ option.primary_contact_name }}</span><span class="custom__remove" @click="remove(option)">❌</span></span>
                                                            </template>
                                                            <template slot="clear" slot-scope="props">
                                                                <div class="multiselect__clear" v-if="form.client.length" @mousedown.prevent.stop="clearAll(props.search)"></div>
                                                            </template>
                                                            <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                                                        </multiselect>

                                                        {{--            <input @input="contactLookup" type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.client" v-validate="'required'" class="form-control" :class="{'form-control-danger': errors.has('client'), 'form-control-success': this.fields.client && this.fields.client.valid }" id="client" name="client" placeholder="{{ trans('admin.project.columns.client') }}">--}}
                                                        <div v-if="errors.has('client')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('client') }}</div>
                                                    </div>

                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group" :class="{'has-danger': errors.has('assigned_salesperson'), 'has-success': this.fields.name && this.fields.assigned_salesperson.valid}">
                                                        <label for="assigned_salesperson">
                                                            {{ trans('admin.project.columns.assigned_salesperson') }}
                                                        </label>

                                                        <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="form.assigned_salesperson" :options="sales_people" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Salesperson" label="name" track-by="name" :preselect-first="false">
                                                            <template slot="selection" slot-scope="{ values, search, isOpen }">
                    <span class="multiselect__single" v-if="form.assigned_salesperson && form.assigned_salesperson.length && !isOpen">
                        <span v-for="(person, index) in form.assigned_salesperson">
                            <span>@{{person.name}}</span><span v-if="index+1 < form.assigned_salesperson.length">, </span>
                        </span>
                    </span>
                                                            </template>
                                                        </multiselect>
                                                        <div v-if="errors.has('assigned_salesperson')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('assigned_salesperson') }}</div>
                                                    </div>
                                                </div>

                                                <!-- Singular fields -->
                                                <div class="form-group col-6" :class="{'has-danger': errors.has('title'), 'has-success': this.fields.title && this.fields.title.valid}">
                                                    <label for="title">
                                                        {{ trans('admin.project.columns.title') }}
                                                    </label>

                                                    <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.title" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': this.fields.title && this.fields.title.valid }" id="title" name="title" placeholder="{{ trans('admin.project.columns.title') }}">
                                                    <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
                                                </div>

                                                <!-- Quantity -->
                                                <div class="form-group col-6" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid}">
                                                    <label for="quantity">
                                                        {{ trans('admin.project.columns.quantity') }}
                                                    </label>

                                                    <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.quantity" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid }" id="quantity" name="quantity" placeholder="{{ trans('admin.project.columns.quantity') }}">
                                                    <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
                                                </div>

                                                <!-- Trim Size -->
                                                <div class="form-group-last col-4" :class="{'has-danger': errors.has('trim_size'), 'has-success': this.fields.trim_size && this.fields.trim_size.valid}">
                                                    <label for="trim_size">
                                                        {{ trans('admin.project.columns.trim_size') }}
                                                    </label>

                                                    <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.trim_size" class="form-control" :class="{'form-control-danger': errors.has('trim_size'), 'form-control-success': this.fields.trim_size && this.fields.trim_size.valid }" id="trim_size" name="trim_size" placeholder="{{ trans('admin.project.columns.trim_size') }}">
                                                    <div v-if="errors.has('trim_size')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('trim_size') }}</div>
                                                </div>

                                                <!-- Extent -->
                                                <div class="form-group-last col-4" :class="{'has-danger': errors.has('extent'), 'has-success': this.fields.extent && this.fields.extent.valid}">
                                                    <label for="extent">
                                                        {{ trans('admin.project.columns.extent') }}
                                                    </label>

                                                    <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.extent" class="form-control" :class="{'form-control-danger': errors.has('extent'), 'form-control-success': this.fields.extent && this.fields.extent.valid }" id="extent" name="extent" placeholder="{{ trans('admin.project.columns.extent') }}">
                                                    <div v-if="errors.has('extent')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('extent') }}</div>
                                                </div>

                                                <!-- Orientation -->
                                                <div class="form-group-last col-4" :class="{'has-danger': errors.has('orientation'), 'has-success': this.fields.orientation && this.fields.orientation.valid}">
                                                    <label for="orientation">
                                                        {{ trans('admin.project.columns.orientation') }}
                                                    </label>

                                                    <multiselect :disabled="awaitingManagerApproval && ! isManager" :taggable="true" @tag="addTag" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" v-model="form.orientation" :options="orientations" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Orientation" label="name" track-by="id" :preselect-first="true"></multiselect>
                                                    <div v-if="errors.has('orientation')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('orientation') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end::Main Details-->

                                <div v-for="type in types">
                                    <!--begin::Portlet-->
                                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                                        <div class="kt-portlet__head">
                                            <div class="kt-portlet__head-label">
                                                <h3 class="kt-portlet__head-title">
                                                    @{{ type.name }}
                                                </h3>
                                            </div>
                                            <div class="kt-portlet__head-toolbar">
                                                <div class="kt-portlet__head-group">
                                                    <a href="#">
							<span class="kt-switch kt-switch--brand mt-3">
							<label>
							<input v-model="form.type" :value="type.friendly_name" type="checkbox" name="">
							<span></span>
							</label>
							</span>
                                                    </a>
                                                    {{--                                               <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-clean btn-icon-md"><i class="la la-angle-down"></i></a>--}}
                                                    {{--                                               <a href="#" data-ktportlet-tool="remove" class="btn btn-sm btn-icon btn-clean btn-icon-md"><i class="la la-close"></i></a>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="form.type.includes( type.friendly_name )" class="kt-portlet__body">
                                            <div class="kt-portlet__content">
                                                <div class="row kt-form">
                                                    <!-- Material -->
                                                    <div class="col-6">
                                                        <div class="kt-section__title">
                                                            <h5 class="mb-4">Project Materials</h5>
                                                        </div>
                                                        <!-- Text -->
                                                        <div v-for="field in type.fields.materials" class="form-group">
                                                            <label :for="field.friendly_name">
                                                                @{{ field.label }}
                                                            </label>

                                                            <div v-if="field.type === 'text'">
                                                                <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                            </div>

                                                            <div v-else-if="field.type === 'textarea'">
                                                                <textarea :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label"></textarea>
                                                            </div>

                                                            <div v-else-if="field.type == 'select'">
                                                                <select :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                                    <option :value="option" :selected="index === 0 ? 'selected' : false" v-for="(option,index) in field.options.split('\n')">@{{ option }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Specs -->
                                                    <div class="col-6">
                                                        <div class="kt-section__title">
                                                            <h5 class="mb-4">Project Specifications</h5>
                                                        </div>
                                                        <!-- Text -->
                                                        <div v-for="field in type.fields.specs" class="form-group">
                                                            <label :for="field.friendly_name">
                                                                @{{ field.label }}
                                                            </label>

                                                            <div v-if="field.type === 'text'">
                                                                <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                            </div>

                                                            <div v-else-if="field.type === 'textarea'">
                                                                <textarea :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label"></textarea>
                                                            </div>

                                                            <div v-else-if="field.type == 'select'">
                                                                <select :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                                    <option v-for="option in field.options.split('\n')">@{{ option }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--begin::Portlet-->
                                <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_2">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="kt-portlet__head-title">
                                                Other Information
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="kt-portlet__content">
                                            <div class="row">
                                                <div class="form-group  col-6" :class="{'has-danger': errors.has('finishing_information'), 'has-success': this.fields.finishing_information && this.fields.finishing_information.valid}">
                                                    <label for="finishing_information">
                                                        {{ trans('admin.project.columns.finishing_information') }}
                                                    </label>

                                                    <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.finishing_information" class="form-control" :class="{'form-control-danger': errors.has('finishing_information'), 'form-control-success': this.fields.finishing_information && this.fields.finishing_information.valid }" id="finishing_information" name="finishing_information" placeholder="{{ trans('admin.project.columns.finishing_information') }}"></textarea>
                                                    <div v-if="errors.has('finishing_information')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('finishing_information') }}</div>
                                                </div>

                                                <div class="form-group  col-6" :class="{'has-danger': errors.has('packaging_information'), 'has-success': this.fields.packaging_information && this.fields.packaging_information.valid}">
                                                    <label for="packaging_information">
                                                        {{ trans('admin.project.columns.packaging_information') }}
                                                    </label>

                                                    <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.packaging_information" class="form-control" :class="{'form-control-danger': errors.has('packaging_information'), 'form-control-success': this.fields.packaging_information && this.fields.packaging_information.valid }" id="packaging_information" name="packaging_information" placeholder="{{ trans('admin.project.columns.packaging_information') }}"></textarea>
                                                    <div v-if="errors.has('packaging_information')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('packaging_information') }}</div>
                                                </div>

                                                <div class="form-group col-6" :class="{'has-danger': errors.has('origination'), 'has-success': this.fields.origination && this.fields.origination.valid}">
                                                    <label for="origination">
                                                        {{ trans('admin.project.columns.origination') }}
                                                    </label>

                                                    <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.origination" class="form-control" :class="{'form-control-danger': errors.has('origination'), 'form-control-success': this.fields.origination && this.fields.origination.valid }" id="origination" name="origination" placeholder="{{ trans('admin.project.columns.origination') }}"></textarea>
                                                    <div v-if="errors.has('origination')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('origination') }}</div>
                                                </div>

                                                <div class="form-group  col-6" :class="{'has-danger': errors.has('information_requests'), 'has-success': this.fields.information_requests && this.fields.information_requests.valid}">
                                                    <label for="information_requests">
                                                        {{ trans('admin.project.columns.information_requests') }}
                                                    </label>

                                                    <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.information_requests" class="form-control" :class="{'form-control-danger': errors.has('information_requests'), 'form-control-success': this.fields.information_requests && this.fields.information_requests.valid }" id="information_requests" name="information_requests" placeholder="{{ trans('admin.project.columns.information_requests') }}"></textarea>
                                                    <div v-if="errors.has('information_requests')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('information_requests') }}</div>
                                                </div>

                                                <div class="form-group  col-4" :class="{'has-danger': errors.has('materials_in_at'), 'has-success': this.fields.materials_in_at && this.fields.materials_in_at.valid}">
                                                    <label for="materials_in_at">
                                                        {{ trans('admin.project.columns.materials_in_at') }}
                                                    </label>

                                                    <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.materials_in_at" name="materials_in_at"></datepicker>
                                                    <div v-if="errors.has('materials_in_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('materials_in_at') }}</div>
                                                </div>

                                                <div class="form-group  col-4" :class="{'has-danger': errors.has('fob_at'), 'has-success': this.fields.fob_at && this.fields.fob_at.valid}">
                                                    <label for="fob_at">
                                                        {{ trans('admin.project.columns.fob_at') }}
                                                    </label>

                                                    <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.fob_at" name="fob_at"></datepicker>
                                                    <div v-if="errors.has('fob_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fob_at') }}</div>
                                                </div>

                                                <div class="form-group  col-4" :class="{'has-danger': errors.has('delivery_at'), 'has-success': this.fields.delivery_at && this.fields.delivery_at.valid}">
                                                    <label for="delivery_at">
                                                        {{ trans('admin.project.columns.delivery_at') }}
                                                    </label>

                                                    <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.delivery_at" name="delivery_at"></datepicker>
                                                    <div v-if="errors.has('delivery_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('delivery_at') }}</div>
                                                </div>

                                                <div class="form-group-last col-6" :class="{'has-danger': errors.has('ship_to'), 'has-success': this.fields.ship_to && this.fields.ship_to.valid}">
                                                    <label for="ship_to">
                                                        {{ trans('admin.project.columns.ship_to') }}
                                                    </label>

                                                    <textarea :readonly="awaitingManagerApproval && ! isManager" rows="4" type="number" v-model="form.ship_to" class="form-control" :class="{'form-control-danger': errors.has('ship_to'), 'form-control-success': this.fields.ship_to && this.fields.ship_to.valid }" id="ship_to" name="ship_to" placeholder="{{ trans('admin.project.columns.ship_to') }}"></textarea>
                                                    <div v-if="errors.has('ship_to')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ship_to') }}</div>
                                                </div>

                                                <div class="form-group-last col-6" :class="{'has-danger': errors.has('vendor_notes'), 'has-success': this.fields.vendor_notes && this.fields.vendor_notes.valid}">
                                                    <label id="vendor-notes-label" for="vendor_notes">
                                                        {{ trans('admin.project.columns.vendor_notes') }}
                                                    </label>

                                                    <!-- Template Select -->
                                                    <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="vendor_note_template" id="vendor-note-select" label="note" placeholder="Select a template" open-direction="bottom" :options="vendor_notes" :multiple="false" :searchable="true" :internal-search="true" :clear-on-select="false" :close-on-select="true" :max-height="600" :show-no-results="true" :hide-selected="false" @select="addVendorNoteTemplate"></multiselect>

                                                    <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.vendor_notes" class="form-control" :class="{'form-control-danger': errors.has('vendor_notes'), 'form-control-success': this.fields.vendor_notes && this.fields.vendor_notes.valid }" id="vendor_notes" name="vendor_notes" placeholder="{{ trans('admin.project.columns.vendor_notes') }}"></textarea>
                                                    <div v-if="errors.has('vendor_notes')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('vendor_notes') }}</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Portlet-->

                                <!--begin::PCQ-->
                                <div v-if="isCurrentTab(['pcq', 'fcq', 'po'])" class="kt-portlet" data-ktportlet="true" id="pcq_information">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="kt-portlet__head-title">
                                                PCQ Information
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="kt-portlet__content">
                                            <div class="row">
                                                <div class="form-group col-12" :class="{'has-danger': errors.has('additional_comments'), 'has-success': this.fields.additional_comments && this.fields.additional_comments.valid}">
                                                    <label for="additional_comments">
                                                        {{ trans('admin.project.columns.additional_comments') }}
                                                    </label>

                                                    <textarea type="number" v-model="form.additional_comments" class="form-control" :class="{'form-control-danger': errors.has('additional_comments'), 'form-control-success': this.fields.additional_comments && this.fields.additional_comments.valid }" id="additional_comments" name="additional_comments" placeholder="{{ trans('admin.project.columns.additional_comments') }}"></textarea>
                                                    <div v-if="errors.has('additional_comments')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('additional_comments') }}</div>
                                                </div>

                                                <div class="col-6 mt-3">
                                                    <div class="" :class="{'has-danger': errors.has('remittance_info'), 'has-success': this.fields.name && this.fields.remittance_info.valid}">
                                                        <label for="remittance_info">
                                                            {{ trans('admin.project.columns.remittance_info') }}
                                                        </label>

                                                        <multiselect v-model="form.remittance_info" :options="remittance_options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Remittance Info" label="name" track-by="name" :preselect-first="false"></multiselect>
                                                        <div v-if="errors.has('remittance_info')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remittance_info') }}</div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mt-3">
                                                    <div class="" :class="{'has-danger': errors.has('payment_terms'), 'has-success': this.fields.name && this.fields.payment_terms.valid}">
                                                        <label for="payment_terms">
                                                            {{ trans('admin.project.columns.payment_terms') }}
                                                        </label>

                                                        <multiselect v-model="form.payment_terms" :options="payment_term_options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Payment Terms" label="name" track-by="name" :preselect-first="false"></multiselect>
                                                        <div v-if="errors.has('payment_terms')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('payment_terms') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::PCQ-->

                            </div>
                        </div>

                        <!--begin::Line Items-->
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <div v-cloak v-show="isCurrentTab( ['po'] ) && fcq_signed || isCurrentTab(['pcq', 'fcq', ])" data-ktportlet="true" id="pcq_information">
                                        <project-invoice-listing
                                                :data="{{ $blank_invoice_listing }}"
                                                :url="'{{ url('admin/projects/-1/lines') }}'"
                                                :project-id="-1"
                                                :current-tab="current_tab"
                                                :selectable="isCurrentTab(['po'])"
                                                ref="project_invoice"
                                                inline-template>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="w-100">
                                                        <div class="w-100" v-cloak>
                                                            <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                                                <div class="kt-subheader__main">
                                                                    <h3 class="kt-subheader__title">
                                                                        Line Items
                                                                    </h3>
                                                                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                                                    <div class="kt-subheader__group" id="kt_subheader_search">
											<span class="kt-subheader__desc" id="kt_subheader_total">
												@{{ pagination.state.total }} Total </span>
                                                                        <form class="kt-margin-l-20" id="kt_subheader_search_form">
                                                                            <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                                                                                <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
														<span>
															<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
																	<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
																</g>
															</svg>
														</span>
													</span>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                                <div class="kt-subheader__toolbar col">
                                                                    <a href="javascript:void(0)" @click.prevent="isEditing = true" class="btn btn-label-brand btn-bold mr-5">Add Item</a>
                                                                    <div class="col-sm-auto form-group m-0 p-0">
                                                                        <select class="form-control" v-model="pagination.state.per_page">

                                                                            <option value="10">10</option>
                                                                            <option value="25">25</option>
                                                                            <option value="100">100</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{--                        <form @submit.prevent="">--}}
                                                            {{--                            <div class="row justify-content-md-between">--}}
                                                            {{--                                <div class="col col-lg-7 col-xl-5 form-group">--}}
                                                            {{--                                    <div class="input-group">--}}
                                                            {{--                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />--}}
                                                            {{--                                        <span class="input-group-append">--}}
                                                            {{--                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>--}}
                                                            {{--                                        </span>--}}
                                                            {{--                                    </div>--}}
                                                            {{--                                </div>--}}

                                                            {{--                            </div>--}}
                                                            {{--                        </form>--}}

                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__body kt-portlet__body--fit">
                                                                    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded mb-0">
                                                                        <table class="kt-datatable__table">
                                                                            <thead class="kt-datatable__head">
                                                                                <tr class="kt-datatable__row">
                                                                                    <th v-if="selectable" class="kt-datatable__cell">
                                                                                        <span></span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Name</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Description</span></th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Quantity</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Unit Cost</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Unit Price</span></th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Category</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Actions</span></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="kt-datatable__body">
                                                                                <tr class="kt-datatable__row" v-if="isEditing">
                                                                                    <td v-if="selectable" class="kt-datatable__cell">
                                                                                    </td>

                                                                                    <td class="kt-datatable__cell">
                                                                                        <input v-model="form.name" type="text" class="form-control form-control-sm" name="name">
                                                                                    </td>
                                                                                    <td class="kt-datatable__cell">
                                                                                        <textarea v-model="form.description" class="form-control form-control-sm" name="description"></textarea>
                                                                                    </td>
                                                                                    <td class="kt-datatable__cell">
                                                                                        <input v-model="form.quantity" type="number" class="form-control form-control-sm" name="quantity">
                                                                                    </td>
                                                                                    <td class="kt-datatable__cell">
                                                                                        <input v-model="form.unit_cost" class="form-control form-control-sm" name="unit_cost">
                                                                                    </td>
                                                                                    <td class="kt-datatable__cell">
                                                                                        <input v-model="form.unit_price" class="form-control form-control-sm" name="unit_price">
                                                                                    </td>
                                                                                    <td class="kt-datatable__cell">
                                                                                        <multiselect v-model="form.category" :options="categories" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Category" :preselect-first="false"></multiselect>
                                                                                    </td>
                                                                                    <td class="kt-datatable__cell">
                                                                                        <a class="btn btn-primary btn-sm text-white" href="#" @click.prevent="save" title="{{ trans('admin.btn.save') }}" role="button"><i class="fa fa-save"></i> Save</a>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="kt-datatable__row" v-for="(item, index) in collection">
                                                                                    <td v-if="selectable" class="kt-datatable__cell--center kt-datatable__cell kt-datatable__cell--check">
                                                                                        <span style="width: 40px;"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" v-model="applicable_lines" :value="item.id" :key="item.id">&nbsp;<span></span></label></span>
                                                                                    </td>
                                                                                    <td class="kt-datatable__cell">@{{ item.name }}</td>
                                                                                    <td class="kt-datatable__cell">@{{ item.description || '-' }}</td>
                                                                                    <td class="kt-datatable__cell">@{{ item.quantity || '-' }}</td>
                                                                                    <td class="kt-datatable__cell">@{{ '$' + parseFloat( item.unit_cost ).toFixed(2) || '-' }}</td>
                                                                                    <td class="kt-datatable__cell">@{{ '$' + parseFloat( item.unit_price ).toFixed(2) || '-' }}</td>
                                                                                    <td class="kt-datatable__cell">@{{ item.category || 'Misc' }}</td>
                                                                                    <td class="kt-datatable__cell">
                                            <span style="overflow: visible; position: relative; width: 80px;">
                                                <div class="dropdown">
  <a class="btn btn-sm btn-clean btn-icon btn-icon-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="flaticon-more-1"></i>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="item.resource_url + '/edit'">Edit</a>
    <a class="dropdown-item" href="#">View</a>
    <a class="dropdown-item" href="#">View Progress</a>
  </div>
</div>
                                            </span>
                                                                                        {{--                                            <div class="row no-gutters">--}}
                                                                                        {{--                                                <div class="col-auto">--}}
                                                                                        {{--                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>--}}
                                                                                        {{--                                                </div>--}}
                                                                                        {{--                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">--}}
                                                                                        {{--                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}">--}}
                                                                                        {{--                                                        <i class="fa fa-trash-o"></i></button>--}}
                                                                                        {{--                                                </form>--}}
                                                                                        {{--                                            </div>--}}
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>

                                                                            <tfoot v-if="isCurrentTab('fcq')" class="kt-datatable__foot">
                                                                                <tr class="kt-datatable__row">
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>-</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>-</span></th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>-</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span class="">$@{{ total_cost }}</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span class="">$@{{ total_price }}</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>-</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span></span></th>
                                                                                </tr>
                                                                            </tfoot>

                                                                            <tfoot v-else class="kt-datatable__foot">
                                                                                <tr class="kt-datatable__row">
                                                                                    <th v-if="selectable" class="kt-datatable__cell">
                                                                                        <span></span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Name</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Description</span></th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Quantity</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Unit Cost</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Unit Price</span></th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Category</span>
                                                                                    </th>
                                                                                    <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                        <span>Actions</span></th>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                        {{--                                                                        <div class="kt-datatable__pager kt-datatable--paging-loaded">--}}
                                                                        {{--                                                                            <ul class="kt-datatable__pager-nav">--}}
                                                                        {{--                                                                                <li>--}}
                                                                        {{--                                                                                    <a title="First" class="kt-datatable__pager-link kt-datatable__pager-link--first kt-datatable__pager-link--disabled" data-page="1" disabled="disabled"><i class="flaticon2-fast-back"></i></a>--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                                <li>--}}
                                                                        {{--                                                                                    <a title="Previous" class="kt-datatable__pager-link kt-datatable__pager-link--prev kt-datatable__pager-link--disabled" data-page="1" disabled="disabled"><i class="flaticon2-back"></i></a>--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                                <li style=""></li>--}}
                                                                        {{--                                                                                <li style="display: none;">--}}
                                                                        {{--                                                                                    <input type="text" class="kt-pager-input form-control" title="Page number">--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                                <li>--}}
                                                                        {{--                                                                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number kt-datatable__pager-link--active" data-page="1" title="1">1</a>--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                                <li>--}}
                                                                        {{--                                                                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="2" title="2">2</a>--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                                <li>--}}
                                                                        {{--                                                                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="3" title="3">3</a>--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                                <li>--}}
                                                                        {{--                                                                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="4" title="4">4</a>--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                                <li style=""></li>--}}
                                                                        {{--                                                                                <li>--}}
                                                                        {{--                                                                                    <a title="Next" class="kt-datatable__pager-link kt-datatable__pager-link--next" data-page="2"><i class="flaticon2-next"></i></a>--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                                <li>--}}
                                                                        {{--                                                                                    <a title="Last" class="kt-datatable__pager-link kt-datatable__pager-link--last" data-page="4"><i class="flaticon2-fast-next"></i></a>--}}
                                                                        {{--                                                                                </li>--}}
                                                                        {{--                                                                            </ul>--}}
                                                                        {{--                                                                            <div class="kt-datatable__pager-info">--}}
                                                                        {{--                                                                                <div class="dropdown bootstrap-select kt-datatable__pager-size dropup" style="width: 60px;">--}}
                                                                        {{--                                                                                    <select class="selectpicker kt-datatable__pager-size" title="Select page size" data-width="60px" data-selected="10" tabindex="-98">--}}
                                                                        {{--                                                                                        <option selected value="10">10</option>--}}
                                                                        {{--                                                                                        <option value="20">20</option>--}}
                                                                        {{--                                                                                        <option value="30">30</option>--}}
                                                                        {{--                                                                                        <option value="50">50</option>--}}
                                                                        {{--                                                                                        <option value="100">100</option>--}}
                                                                        {{--                                                                                    </select></div>--}}
                                                                        {{--                                                                                <span class="kt-datatable__pager-detail">Showing 1 - 10 of 40</span>--}}
                                                                        {{--                                                                            </div>--}}
                                                                        {{--                                                                        </div>--}}

                                                                    </div>

                                                                    {{--                                <div class="row" v-if="pagination.state.total > 0">--}}
                                                                    {{--                                    <div class="col-sm">--}}
                                                                    {{--                                        <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>--}}
                                                                    {{--                                    </div>--}}
                                                                    {{--                                    <div class="col-sm-auto">--}}
                                                                    {{--                                        <pagination></pagination>--}}
                                                                    {{--                                    </div>--}}
                                                                    {{--                                </div>--}}

                                                                    {{--                                <div class="no-items-found" v-if="!collection.length > 0">--}}
                                                                    {{--                                    <i class="icon-magnifier"></i>--}}
                                                                    {{--                                    <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>--}}
                                                                    {{--                                    <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>--}}
                                                                    {{--                                    <a class="btn btn-primary btn-spinner" href="{{ url('admin/projects/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.project.actions.create') }}--}}
                                                                    {{--                                    </a>--}}
                                                                    {{--                                </div>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </project-invoice-listing>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--end::Line Items-->

                        <!-- Require FCQ signature -->
                        <div v-if="isCurrentTab([ 'po']) && !fcq_signed">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Important
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="kt-sc__title text-center">
                                        <h4>Has the FCQ been signed by the client and 2 docs have been sent out to accounts?</h4>

                                        <div class="kt-form__actions mt-5">
                                            <button @click.prevent="fcq_signed = true" class="btn btn-lg btn-brand mr-5">Yes, all is OK</button>
                                            <button type="reset" class="btn btn-lg btn-secondary">No, cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Require FCQ signature -->

                        <div id="gpsd_overview" class="tab-pane fade show active">
                            <!-- Overview -->
                            <div class="kt-portlet ">
                                <div class="kt-portlet__body">
                                    <div class="kt-widget kt-widget--user-profile-3">
                                        <div class="kt-widget__top">
                                            {{--                            <div class="kt-widget__media kt-hidden-">--}}
                                            {{--                                <img src="assets/media/project-logos/3.png" alt="image">--}}
                                            {{--                            </div>--}}
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__head">

                                                    <a href="#" class="kt-widget__title">New Project</a>
                                                    <div class="kt-widget__action">
                                                        <button type="button" class="btn btn-sm btn-upper" style="background: #edeff6">edit</button>&nbsp;
                                                    </div>
                                                </div>

                                                <div class="kt-widget__info">
                                                    <div class="kt-widget__desc">
                                                        This project was created on
                                                        {{--                                                        <span>{{ $project->created_at->format( 'jS \o\f F, Y' ) }}</span><br>--}}
                                                        by Jarrod Noonan. It has a total of 10 contributors.
                                                    </div>
                                                    <!--														<div class="kt-widget__progress kt-hidden">-->
                                                    <!--															<div class="kt-widget__text">-->
                                                    <!--																Progress-->
                                                    <!--															</div>-->
                                                    <!--															<div class="progress" style="height: 5px;width: 100%;">-->
                                                    <!--																<div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>-->
                                                    <!--															</div>-->
                                                    <!--															<div class="kt-widget__stats">-->
                                                    <!--																78%-->
                                                    <!--															</div>-->
                                                    <!--														</div>-->
                                                    <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                        <div class="kt-widget__item">
																<span class="kt-widget__date">
																	Start Date
																</span>
                                                            <div class="kt-widget__label">
                                                                <span class="btn btn-label-brand btn-sm btn-bold btn-upper">07 may, 18</span>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget__item">
																<span class="kt-widget__date">
																	Due Date
																</span>
                                                            <div class="kt-widget__label">
                                                                <span class="btn btn-label-danger btn-sm btn-bold btn-upper">07 0ct, 18</span>
                                                            </div>
                                                        </div>
                                                        <!--															<div class="kt-widget__item flex-fill">-->
                                                        <!--																<span class="kt-widget__subtitel">Progress</span>-->
                                                        <!--																<div class="kt-widget__progress d-flex  align-items-center">-->
                                                        <!--																	<div class="progress" style="height: 5px;width: 100%;">-->
                                                        <!--																		<div class="progress-bar kt-bg-success" role="progressbar" style="width: 78%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>-->
                                                        <!--																	</div>-->
                                                        <!--																	<span class="kt-widget__stat">-->
                                                        <!--																		78%-->
                                                        <!--																	</span>-->
                                                        <!--																</div>-->
                                                        <!--															</div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget__bottom">
                                            <div class="kt-widget__item">
                                                <div class="kt-widget__icon">
                                                    <i class="flaticon-piggy-bank"></i>
                                                </div>
                                                <div class="kt-widget__details">
                                                    <span class="kt-widget__title">Value</span>
                                                    <span class="kt-widget__value"><span>$</span>@{{ total_value }}</span>
                                                </div>
                                            </div>
                                            <div class="kt-widget__item">
                                                <div class="kt-widget__icon">
                                                    <i class="flaticon-confetti"></i>
                                                </div>
                                                <div class="kt-widget__details">
                                                    <span class="kt-widget__title">Cost</span>
                                                    <span class="kt-widget__value"><span>$</span>@{{ total_cost }}</span>
                                                </div>
                                            </div>
                                            <div class="kt-widget__item">
                                                <div class="kt-widget__icon">
                                                    <i class="flaticon-pie-chart"></i>
                                                </div>
                                                <div class="kt-widget__details">
                                                    <span class="kt-widget__title">Profitability</span>
                                                    <span class="kt-widget__value"><span>$</span>@{{ total_profit }} (@{{ total_profit_percentage }}%)</span>
                                                </div>
                                            </div>
                                            <div class="kt-widget__item">
                                                <div class="kt-widget__icon">
                                                    <i class="flaticon-file-2"></i>
                                                </div>
                                                <div class="kt-widget__details">
                                                    <span class="kt-widget__title">73 Tasks</span>
                                                    <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                                </div>
                                            </div>
                                            <div class="kt-widget__item">
                                                <div class="kt-widget__icon">
                                                    <i class="flaticon-network"></i>
                                                </div>
                                                <div class="kt-widget__details">
                                                    <div class="kt-section__content kt-section__content--solid">
                                                        <div class="kt-media-group">
                                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                                                <img src="assets/media/users/100_7.jpg" alt="image">
                                                            </a>
                                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Alison Brandy">
                                                                <img src="assets/media/users/100_3.jpg" alt="image">
                                                            </a>
                                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Selina Cranson">
                                                                <img src="assets/media/users/100_2.jpg" alt="image">
                                                            </a>
                                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Luke Walls">
                                                                <img src="assets/media/users/100_13.jpg" alt="image">
                                                            </a>
                                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                                                <img src="assets/media/users/100_4.jpg" alt="image">
                                                            </a>
                                                            <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                                                <span>+3</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--begin:: Project Stage -->
                            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Project Stage
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <!--													<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">-->
                                        <!--														<li class="nav-item">-->
                                        <!--															<a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab1_content" role="tab">-->
                                        <!--																Today-->
                                        <!--															</a>-->
                                        <!--														</li>-->
                                        <!--														<li class="nav-item">-->
                                        <!--															<a class="nav-link" data-toggle="tab" href="#kt_widget2_tab2_content" role="tab">-->
                                        <!--																Week-->
                                        <!--															</a>-->
                                        <!--														</li>-->
                                        <!--														<li class="nav-item">-->
                                        <!--															<a class="nav-link" data-toggle="tab" href="#kt_widget2_tab3_content" role="tab">-->
                                        <!--																Month-->
                                        <!--															</a>-->
                                        <!--														</li>-->
                                        <!--													</ul>-->
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="kt_widget2_tab1_content">
                                            <div class="kt-widget2">
                                                <div v-for="checkbox in checklist_questions" :class="checkbox.hasOwnProperty('danger') && checkbox.danger ? 'kt-widget2__item--warning' : 'kt-widget2__item--light'" class="kt-widget2__item">
                                                    <div class="kt-widget2__checkbox">
                                                        <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                            <input v-model="checkbox.checked" type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <div class="kt-widget2__info">
                                                        <a data-toggle="tooltip" :data-title="checkbox.timestamp.format('ddd/mm/yyyy')" href="javascript:void(0)" class="kt-widget2__title">
                                                            @{{ checkbox.label }}
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
                            <!--end:: Project Stage -->
                            <!-- Overview -->
                        </div>
                        <div id="gpsd_rfq" class="tab-pane fade">
                            rfq
                        </div>
                        <div id="gpsd_pcq" class="tab-pane fade">
                            pcq
                        </div>
                        <div id="gpsd_fcq" class="tab-pane fade">
                            fcq
                        </div>
                        <div id="gpsd_jcp" class="tab-pane fade">
                            <a v-if="!is_viewing_files" @click.prevent="is_viewing_files = true" class="btn btn-label-brand btn-bold mr-5">View All Files</a>
                            <a v-else @click.prevent="is_viewing_files = false" class="btn btn-label-brand btn-bold mr-5">Return to JCP</a>

                            <div class="mt-5">
                                <jcc-form v-if="!is_viewing_files" ref="jcp"></jcc-form>

                                <div class="row">
                                    <div class="container-fluid kt-grid__item kt-grid__item--fluid">
                                        <!--Begin::Tasks-->
                                        <div class="kt-grid kt-grid--desktop kt-grid--ver-desktop  kt-todo" id="kt_todo">

                                            <!--Begin:: Tasks Content-->
                                            <div class="kt-grid__item kt-grid__item--fluid kt-todo__content" id="kt_todo_content">
                                                <div class="kt-todo__top">
                                                    <div class="kt-portlet">
                                                        <!--Begin:: Tasks Toolbar-->
                                                        <div class="kt-todo__header">
                                                            <h3 class="kt-todo__title">JCP Files</h3>

                                                            <!--Begin:: Tasks Nav-->
                                                            <div class="kt-todo__nav">
                                                                <a href="/metronic/preview/demo9/custom/apps/todo/tasks.html" class="kt-todo__link ">Main</a>

                                                                <a href="/metronic/preview/demo9/custom/apps/todo/docs.html" class="kt-todo__link ">Housekeeping</a>
                                                            </div>
                                                            <!--End:: Tasks Nav-->

                                                            <!--Begin:: Tasks Users-->
                                                            <div class="kt-todo__users">
                                                                <a @click.prevent="is_viewing_files = true" class="btn btn-label-primary btn-bold mr-5">Download All</a>
                                                            </div>
                                                            <!--End:: Tasks Users-->
                                                        </div>
                                                        <!--End:: Tasks Toolbar-->
                                                    </div>
                                                </div>

                                                <div class="kt-todo__bottom">
                                                    <!--Begin::Section-->
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/pdf.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            Technical Requiremnts.pdf
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/doc.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            Project Budget.docx
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/xml.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            Navitare Booking API.xml
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/html.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            User List.html
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                    </div>
                                                    <!--End::Section-->

                                                    <!--Begin::Section-->
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/csv.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            Passanger Profile.psd
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/zip.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            December 2019 Flights.csv

                                                                        </a></div>
                                                                    <a href="#" class="kt-widget__desc">
                                                                        <!--end::Widget -->
                                                                    </a></div>
                                                                <a href="#" class="kt-widget__desc">
                                                                </a></div>
                                                            <a href="#" class="kt-widget__desc">
                                                                <!--End::Portlet-->
                                                            </a></div>
                                                        <a href="#" class="kt-widget__desc">
                                                        </a>
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <a href="#" class="kt-widget__desc">
                                                                <!--Begin::Portlet-->
                                                            </a>
                                                            <div class="kt-portlet"><a href="#" class="kt-widget__desc">
                                                                </a>
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <a href="#" class="kt-widget__desc">
                                                                        <div class="kt-portlet__head-label">
                                                                            <h3 class="kt-portlet__head-title">

                                                                            </h3>
                                                                        </div>
                                                                    </a>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="kt-widget__desc">
                                                                        </a><a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/jpg.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            Corporate Booking Docum...
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/mp4.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            Video Tutorial.mp4
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                    </div>
                                                    <!--End::Section-->

                                                    <!--Begin::Section-->
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/javascript.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            Apps.js
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                                                            <img class="kt-widget__img kt-hidden-" src="/metronic/themes/metronic/theme/default/demo9/dist/assets/media/files/doc.svg" alt="image">
                                                                        </div>

                                                                        <a href="#" class="kt-widget__desc">
                                                                            report screeshot.jpeg
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                        <div class="col-xl-3 col-lg-6 col-md-6">
                                                            <!--Begin::Portlet-->
                                                            <div class="kt-portlet">
                                                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">

                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                                            <i class="flaticon-more-1"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
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
                                                                <div class="kt-portlet__body">
                                                                    <!--begin::Widget -->
                                                                    <div class="kt-widget__files">
                                                                        <div class="kt-widget__media">
                                <span class="kt-widget__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M8.95128003,13.8153448 L10.9077535,13.8153448 L10.9077535,15.8230161 C10.9077535,16.0991584 11.1316112,16.3230161 11.4077535,16.3230161 L12.4310522,16.3230161 C12.7071946,16.3230161 12.9310522,16.0991584 12.9310522,15.8230161 L12.9310522,13.8153448 L14.8875257,13.8153448 C15.1636681,13.8153448 15.3875257,13.5914871 15.3875257,13.3153448 C15.3875257,13.1970331 15.345572,13.0825545 15.2691225,12.9922598 L12.3009997,9.48659872 C12.1225648,9.27584861 11.8070681,9.24965194 11.596318,9.42808682 C11.5752308,9.44594059 11.5556598,9.46551156 11.5378061,9.48659872 L8.56968321,12.9922598 C8.39124833,13.2030099 8.417445,13.5185067 8.62819511,13.6969416 C8.71848979,13.773391 8.8329684,13.8153448 8.95128003,13.8153448 Z" fill="#000000"></path>
    </g>
</svg></span>
                                                                        </div>
                                                                        <a href="#" class="kt-widget__desc kt-widget__desc--m">
                                                                            Upload File
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Widget -->
                                                                </div>
                                                            </div>
                                                            <!--End::Portlet-->
                                                        </div>
                                                    </div>
                                                    <!--End::Section-->
                                                </div>
                                            </div>
                                            <!--End:: Tasks Content-->
                                        </div>
                                        <!--End::Tasks-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="gpsd_jcw" class="tab-pane fade">
                            jcw
                        </div>
                        <div id="gpsd_po" class="tab-pane fade">
                        </div>
                        <div id="gpsd_aa" class="tab-pane fade">
                            <!-- begin::Main Details-->
                            <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_2">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            AA Template
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="kt-portlet__content">
                                        <quill-editor
                                                v-model="aa_content"
                                                ref="AAEditor"
                                                :options="{}"></quill-editor>
                                    </div>
                                </div>
                            </div>
                            <!-- end::Main Details-->

                            <!-- begin::AA Lines-->
                            <project-invoice-listing
                                    :data="{{ $blank_invoice_listing }}"
                                    :url="'{{ url('admin/projects/-1/lines?category=aa') }}'"
                                    :project-id="-1"
                                    :current-tab="current_tab"
                                    :selectable="false"
                                    ref="aa_line_items"
                                    inline-template>

                                <div class="row">
                                    <div class="col">
                                        <div class="w-100">
                                            <div class="w-100" v-cloak>
                                                <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                                    <div class="kt-subheader__main">
                                                        <h3 class="kt-subheader__title">
                                                            AA Change Order Line Items
                                                        </h3>
                                                        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                                        <div class="kt-subheader__group" id="kt_subheader_search">
											<span class="kt-subheader__desc" id="kt_subheader_total">
												@{{ pagination.state.total }} Total </span>
                                                            <form class="kt-margin-l-20" id="kt_subheader_search_form">
                                                                <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                                                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
														<span>
															<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
																	<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
																</g>
															</svg>
														</span>
													</span>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <div class="kt-subheader__toolbar col">
                                                        <a href="javascript:void(0)" @click.prevent="isEditing = true" class="btn btn-label-brand btn-bold mr-5">Add Item</a>
                                                        <div class="col-sm-auto form-group m-0 p-0">
                                                            <select class="form-control" v-model="pagination.state.per_page">

                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="100">100</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--                        <form @submit.prevent="">--}}
                                                {{--                            <div class="row justify-content-md-between">--}}
                                                {{--                                <div class="col col-lg-7 col-xl-5 form-group">--}}
                                                {{--                                    <div class="input-group">--}}
                                                {{--                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />--}}
                                                {{--                                        <span class="input-group-append">--}}
                                                {{--                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>--}}
                                                {{--                                        </span>--}}
                                                {{--                                    </div>--}}
                                                {{--                                </div>--}}

                                                {{--                            </div>--}}
                                                {{--                        </form>--}}

                                                <div class="kt-portlet">
                                                    <div class="kt-portlet__body kt-portlet__body--fit">
                                                        <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded mb-0">
                                                            <table class="kt-datatable__table">
                                                                <thead class="kt-datatable__head">
                                                                    <tr class="kt-datatable__row">
                                                                        <th v-if="selectable" class="kt-datatable__cell">
                                                                            <span></span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Name</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Description</span></th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Quantity</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Unit Cost</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Unit Price</span></th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Actions</span></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="kt-datatable__body">
                                                                    <tr class="kt-datatable__row" v-if="isEditing">
                                                                        <td v-if="selectable" class="kt-datatable__cell">
                                                                        </td>

                                                                        <td class="kt-datatable__cell">
                                                                            <input v-model="form.name" type="text" class="form-control form-control-sm" name="name">
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <textarea v-model="form.description" class="form-control form-control-sm" name="description"></textarea>
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <input v-model="form.quantity" type="number" class="form-control form-control-sm" name="quantity">
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <input v-model="form.unit_cost" class="form-control form-control-sm" name="unit_cost">
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <input v-model="form.unit_price" class="form-control form-control-sm" name="unit_price">
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <a class="btn btn-primary btn-sm text-white" href="#" @click.prevent="save" title="{{ trans('admin.btn.save') }}" role="button"><i class="fa fa-save"></i> Save</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="kt-datatable__row" v-for="(item, index) in collection">
                                                                        <td v-if="selectable" class="kt-datatable__cell--center kt-datatable__cell kt-datatable__cell--check">
                                                                            <span style="width: 40px;"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" v-model="applicable_lines" :value="item.id" :key="item.id">&nbsp;<span></span></label></span>
                                                                        </td>
                                                                        <td class="kt-datatable__cell">@{{ item.name }}</td>
                                                                        <td class="kt-datatable__cell">@{{ item.description || '-' }}</td>
                                                                        <td class="kt-datatable__cell">@{{ item.quantity || '-' }}</td>
                                                                        <td class="kt-datatable__cell">@{{ '$' + parseFloat( item.unit_cost ).toFixed(2) || '-' }}</td>
                                                                        <td class="kt-datatable__cell">@{{ '$' + parseFloat( item.unit_price ).toFixed(2) || '-' }}</td>
                                                                        <td class="kt-datatable__cell">
                                            <span style="overflow: visible; position: relative; width: 80px;">
                                                <div class="dropdown">
  <a class="btn btn-sm btn-clean btn-icon btn-icon-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="flaticon-more-1"></i>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="item.resource_url + '/edit'">Edit</a>
    <a class="dropdown-item" href="#">View</a>
    <a class="dropdown-item" href="#">View Progress</a>
  </div>
</div>
                                            </span>
                                                                            {{--                                            <div class="row no-gutters">--}}
                                                                            {{--                                                <div class="col-auto">--}}
                                                                            {{--                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>--}}
                                                                            {{--                                                </div>--}}
                                                                            {{--                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">--}}
                                                                            {{--                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}">--}}
                                                                            {{--                                                        <i class="fa fa-trash-o"></i></button>--}}
                                                                            {{--                                                </form>--}}
                                                                            {{--                                            </div>--}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>

                                                                <tfoot v-if="isCurrentTab('fcq')" class="kt-datatable__foot">
                                                                    <tr class="kt-datatable__row">
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>-</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>-</span></th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>-</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span class="">$@{{ total_cost }}</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span class="">$@{{ total_price }}</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>-</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span></span></th>
                                                                    </tr>
                                                                </tfoot>

                                                                <tfoot v-else class="kt-datatable__foot">
                                                                    <tr class="kt-datatable__row">
                                                                        <td v-if="selectable" class="kt-datatable__cell">
                                                                            <span></span>
                                                                        </td>
                                                                        <td class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Name</span>
                                                                        </td>
                                                                        <td class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Description</span></td>
                                                                        <td class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Quantity</span>
                                                                        </td>
                                                                        <td class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Unit Cost</span>
                                                                        </td>
                                                                        <td class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Unit Price</span></td>
                                                                        <td class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Actions</span></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            {{--                                                                        <div class="kt-datatable__pager kt-datatable--paging-loaded">--}}
                                                            {{--                                                                            <ul class="kt-datatable__pager-nav">--}}
                                                            {{--                                                                                <li>--}}
                                                            {{--                                                                                    <a title="First" class="kt-datatable__pager-link kt-datatable__pager-link--first kt-datatable__pager-link--disabled" data-page="1" disabled="disabled"><i class="flaticon2-fast-back"></i></a>--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                                <li>--}}
                                                            {{--                                                                                    <a title="Previous" class="kt-datatable__pager-link kt-datatable__pager-link--prev kt-datatable__pager-link--disabled" data-page="1" disabled="disabled"><i class="flaticon2-back"></i></a>--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                                <li style=""></li>--}}
                                                            {{--                                                                                <li style="display: none;">--}}
                                                            {{--                                                                                    <input type="text" class="kt-pager-input form-control" title="Page number">--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                                <li>--}}
                                                            {{--                                                                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number kt-datatable__pager-link--active" data-page="1" title="1">1</a>--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                                <li>--}}
                                                            {{--                                                                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="2" title="2">2</a>--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                                <li>--}}
                                                            {{--                                                                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="3" title="3">3</a>--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                                <li>--}}
                                                            {{--                                                                                    <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="4" title="4">4</a>--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                                <li style=""></li>--}}
                                                            {{--                                                                                <li>--}}
                                                            {{--                                                                                    <a title="Next" class="kt-datatable__pager-link kt-datatable__pager-link--next" data-page="2"><i class="flaticon2-next"></i></a>--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                                <li>--}}
                                                            {{--                                                                                    <a title="Last" class="kt-datatable__pager-link kt-datatable__pager-link--last" data-page="4"><i class="flaticon2-fast-next"></i></a>--}}
                                                            {{--                                                                                </li>--}}
                                                            {{--                                                                            </ul>--}}
                                                            {{--                                                                            <div class="kt-datatable__pager-info">--}}
                                                            {{--                                                                                <div class="dropdown bootstrap-select kt-datatable__pager-size dropup" style="width: 60px;">--}}
                                                            {{--                                                                                    <select class="selectpicker kt-datatable__pager-size" title="Select page size" data-width="60px" data-selected="10" tabindex="-98">--}}
                                                            {{--                                                                                        <option selected value="10">10</option>--}}
                                                            {{--                                                                                        <option value="20">20</option>--}}
                                                            {{--                                                                                        <option value="30">30</option>--}}
                                                            {{--                                                                                        <option value="50">50</option>--}}
                                                            {{--                                                                                        <option value="100">100</option>--}}
                                                            {{--                                                                                    </select></div>--}}
                                                            {{--                                                                                <span class="kt-datatable__pager-detail">Showing 1 - 10 of 40</span>--}}
                                                            {{--                                                                            </div>--}}
                                                            {{--                                                                        </div>--}}

                                                        </div>

                                                        {{--                                <div class="row" v-if="pagination.state.total > 0">--}}
                                                        {{--                                    <div class="col-sm">--}}
                                                        {{--                                        <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>--}}
                                                        {{--                                    </div>--}}
                                                        {{--                                    <div class="col-sm-auto">--}}
                                                        {{--                                        <pagination></pagination>--}}
                                                        {{--                                    </div>--}}
                                                        {{--                                </div>--}}

                                                        {{--                                <div class="no-items-found" v-if="!collection.length > 0">--}}
                                                        {{--                                    <i class="icon-magnifier"></i>--}}
                                                        {{--                                    <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>--}}
                                                        {{--                                    <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>--}}
                                                        {{--                                    <a class="btn btn-primary btn-spinner" href="{{ url('admin/projects/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.project.actions.create') }}--}}
                                                        {{--                                    </a>--}}
                                                        {{--                                </div>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </project-invoice-listing>

                            <!-- end::Main Details-->

                        </div>
                        <div id="gpsd_misc_po" class="tab-pane fade">
                            <div class="row">
                                <div class="col-12">
                                    <!-- begin::Misc Po -->
                                    <div v-if="!editing_misc_po" class="kt-portlet ">
                                        <div class="kt-portlet__body">
                                            <div class="kt-widget kt-widget--user-profile-3">
                                                <div class="kt-widget__top">

                                                    <div class="kt-widget__content">
                                                        <div class="kt-widget__head">

                                                            <a href="#" class="kt-widget__title">Misc PO #1</a>
                                                            <div class="kt-widget__action">
                                                                <button @click.prevent="editing_misc_po = true" type="button" class="btn btn-sm btn-upper" style="background: #edeff6">edit</button>&nbsp;
                                                            </div>
                                                        </div>

                                                        <div class="kt-widget__info">
                                                            <div class="kt-widget__desc">
                                                                This project was created on
                                                                {{--                                                                <span>{{ $project->created_at->format( 'jS \o\f F, Y' ) }}</span><br>--}}
                                                                by Jarrod Noonan. It has a total of 10 contributors.
                                                            </div>
                                                            <!--														<div class="kt-widget__progress kt-hidden">-->
                                                            <!--															<div class="kt-widget__text">-->
                                                            <!--																Progress-->
                                                            <!--															</div>-->
                                                            <!--															<div class="progress" style="height: 5px;width: 100%;">-->
                                                            <!--																<div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>-->
                                                            <!--															</div>-->
                                                            <!--															<div class="kt-widget__stats">-->
                                                            <!--																78%-->
                                                            <!--															</div>-->
                                                            <!--														</div>-->
                                                            <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                                <div class="kt-widget__item">
																<span class="kt-widget__date">
																	Created At
																</span>
                                                                    <div class="kt-widget__label">
                                                                        <span class="btn btn-label-brand btn-sm btn-bold btn-upper">07 may, 18</span>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-widget__item">
																<span class="kt-widget__date">
																	Last Updated At
																</span>
                                                                    <div class="kt-widget__label">
                                                                        <span class="btn btn-label-danger btn-sm btn-bold btn-upper">07 0ct, 18</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-widget__bottom">
                                                    <div class="kt-widget__item">
                                                        <div class="kt-widget__icon">
                                                            <i class="flaticon-piggy-bank"></i>
                                                        </div>
                                                        <div class="kt-widget__details">
                                                            <span class="kt-widget__title">Value</span>
                                                            <span class="kt-widget__value"><span>$</span>@{{ total_value }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget__item">
                                                        <div class="kt-widget__icon">
                                                            <i class="flaticon-confetti"></i>
                                                        </div>
                                                        <div class="kt-widget__details">
                                                            <span class="kt-widget__title">Cost</span>
                                                            <span class="kt-widget__value"><span>$</span>@{{ total_cost }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget__item">
                                                        <div class="kt-widget__icon">
                                                            <i class="flaticon-pie-chart"></i>
                                                        </div>
                                                        <div class="kt-widget__details">
                                                            <span class="kt-widget__title">Profitability</span>
                                                            <span class="kt-widget__value"><span>$</span>@{{ total_profit }} (@{{ total_profit_percentage }}%)</span>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget__item">
                                                        <div class="kt-widget__icon">
                                                            <i class="flaticon-file-2"></i>
                                                        </div>
                                                        <div class="kt-widget__details">
                                                            <span class="kt-widget__title">73 Line Items</span>
                                                            <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget__item">
                                                        <div class="kt-widget__icon">
                                                            <i class="flaticon-network"></i>
                                                        </div>
                                                        <div class="kt-widget__details">
                                                            <div class="kt-section__content kt-section__content--solid">
                                                                <div class="kt-media-group">
                                                                    <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                                                        <img src="assets/media/users/100_7.jpg" alt="image">
                                                                    </a>
                                                                    <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Alison Brandy">
                                                                        <img src="assets/media/users/100_3.jpg" alt="image">
                                                                    </a>
                                                                    <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Selina Cranson">
                                                                        <img src="assets/media/users/100_2.jpg" alt="image">
                                                                    </a>
                                                                    <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Luke Walls">
                                                                        <img src="assets/media/users/100_13.jpg" alt="image">
                                                                    </a>
                                                                    <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                                                        <img src="assets/media/users/100_4.jpg" alt="image">
                                                                    </a>
                                                                    <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                                                        <span>+3</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end::Misc Po -->


                                    <div v-else>
                                        <!-- begin::Main Details-->
                                        <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_2">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        Main Details
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body">
                                                <div class="kt-portlet__content">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group" :class="{'has-danger': errors.has('client'), 'has-success': this.fields.client && this.fields.client.valid}">
                                                                <label for="client">
                                                                    {{ trans('admin.project.columns.client') }}
                                                                </label>

                                                                <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="misc_po.client" id="ajax" label="primary_contact_name" track-by="id" placeholder="Type to search" open-direction="bottom" :options="clients" :multiple="false" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit-text="limitText" :max-height="600" :show-no-results="true" :hide-selected="false" @search-change="clientLookup">
                                                                    <template slot="tag" slot-scope="{ option, remove }">
                                                                        <span class="custom__tag"><span>@{{ option.primary_contact_name }}</span><span class="custom__remove" @click="remove(option)">❌</span></span>
                                                                    </template>
                                                                    <template slot="clear" slot-scope="props">
                                                                        <div class="multiselect__clear" v-if="misc_po.client.length" @mousedown.prevent.stop="clearAll(props.search)"></div>
                                                                    </template>
                                                                    <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                                                                </multiselect>

                                                                {{--            <input @input="contactLookup" type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.client" v-validate="'required'" class="form-control" :class="{'form-control-danger': errors.has('client'), 'form-control-success': this.fields.client && this.fields.client.valid }" id="client" name="client" placeholder="{{ trans('admin.project.columns.client') }}">--}}
                                                                <div v-if="errors.has('client')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('client') }}</div>
                                                            </div>

                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group" :class="{'has-danger': errors.has('assigned_salesperson'), 'has-success': this.fields.name && this.fields.assigned_salesperson.valid}">
                                                                <label for="assigned_salesperson">
                                                                    {{ trans('admin.project.columns.assigned_salesperson') }}
                                                                </label>

                                                                <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="misc_po.assigned_salesperson" :options="sales_people" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Salesperson" label="name" track-by="name" :preselect-first="false">
                                                                    <template slot="selection" slot-scope="{ values, search, isOpen }">
                    <span class="multiselect__single" v-if="misc_po.assigned_salesperson && misc_po.assigned_salesperson.length && !isOpen">
                        <span v-for="(person, index) in misc_po.assigned_salesperson">
                            <span>@{{person.name}}</span><span v-if="index+1 < misc_po.assigned_salesperson.length">, </span>
                        </span>
                    </span>
                                                                    </template>
                                                                </multiselect>
                                                                <div v-if="errors.has('assigned_salesperson')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('assigned_salesperson') }}</div>
                                                            </div>
                                                        </div>

                                                        <!-- Singular fields -->
                                                        <div class="form-group col-6" :class="{'has-danger': errors.has('title'), 'has-success': this.fields.title && this.fields.title.valid}">
                                                            <label for="title">
                                                                {{ trans('admin.project.columns.title') }}
                                                            </label>

                                                            <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.title" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': this.fields.title && this.fields.title.valid }" id="title" name="title" placeholder="{{ trans('admin.project.columns.title') }}">
                                                            <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
                                                        </div>

                                                        <!-- Quantity -->
                                                        <div class="form-group col-6" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid}">
                                                            <label for="quantity">
                                                                {{ trans('admin.project.columns.quantity') }}
                                                            </label>

                                                            <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.quantity" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid }" id="quantity" name="quantity" placeholder="{{ trans('admin.project.columns.quantity') }}">
                                                            <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
                                                        </div>

                                                        <!-- Trim Size -->
                                                        <div class="form-group-last col-4" :class="{'has-danger': errors.has('trim_size'), 'has-success': this.fields.trim_size && this.fields.trim_size.valid}">
                                                            <label for="trim_size">
                                                                {{ trans('admin.project.columns.trim_size') }}
                                                            </label>

                                                            <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.trim_size" class="form-control" :class="{'form-control-danger': errors.has('trim_size'), 'form-control-success': this.fields.trim_size && this.fields.trim_size.valid }" id="trim_size" name="trim_size" placeholder="{{ trans('admin.project.columns.trim_size') }}">
                                                            <div v-if="errors.has('trim_size')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('trim_size') }}</div>
                                                        </div>

                                                        <!-- Extent -->
                                                        <div class="form-group-last col-4" :class="{'has-danger': errors.has('extent'), 'has-success': this.fields.extent && this.fields.extent.valid}">
                                                            <label for="extent">
                                                                {{ trans('admin.project.columns.extent') }}
                                                            </label>

                                                            <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.extent" class="form-control" :class="{'form-control-danger': errors.has('extent'), 'form-control-success': this.fields.extent && this.fields.extent.valid }" id="extent" name="extent" placeholder="{{ trans('admin.project.columns.extent') }}">
                                                            <div v-if="errors.has('extent')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('extent') }}</div>
                                                        </div>

                                                        <!-- Orientation -->
                                                        <div class="form-group-last col-4" :class="{'has-danger': errors.has('orientation'), 'has-success': this.fields.orientation && this.fields.orientation.valid}">
                                                            <label for="orientation">
                                                                {{ trans('admin.project.columns.orientation') }}
                                                            </label>

                                                            <multiselect :disabled="awaitingManagerApproval && ! isManager" :taggable="true" @tag="addTag" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" v-model="misc_po.orientation" :options="orientations" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Orientation" label="name" track-by="id" :preselect-first="true"></multiselect>
                                                            <div v-if="errors.has('orientation')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('orientation') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end::Main Details-->

                                        <div v-for="type in types">
                                            <!--begin::Portlet-->
                                            <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                                                <div class="kt-portlet__head">
                                                    <div class="kt-portlet__head-label">
                                                        <h3 class="kt-portlet__head-title">
                                                            @{{ type.name }}
                                                        </h3>
                                                    </div>
                                                    <div class="kt-portlet__head-toolbar">
                                                        <div class="kt-portlet__head-group">
                                                            <a href="#">
							<span class="kt-switch kt-switch--brand mt-3">
							<label>
							<input v-model="misc_po.type" :value="type.friendly_name" type="checkbox" name="">
							<span></span>
							</label>
							</span>
                                                            </a>
                                                            {{--                                               <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-clean btn-icon-md"><i class="la la-angle-down"></i></a>--}}
                                                            {{--                                               <a href="#" data-ktportlet-tool="remove" class="btn btn-sm btn-icon btn-clean btn-icon-md"><i class="la la-close"></i></a>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="misc_po.type.includes( type.friendly_name )" class="kt-portlet__body">
                                                    <div class="kt-portlet__content">
                                                        <div class="row kt-form">
                                                            <!-- Material -->
                                                            <div class="col-6">
                                                                <div class="kt-section__title">
                                                                    <h5 class="mb-4">Project Materials</h5>
                                                                </div>
                                                                <!-- Text -->
                                                                <div v-for="field in type.fields.materials" class="form-group">
                                                                    <label :for="field.friendly_name">
                                                                        @{{ field.label }}
                                                                    </label>

                                                                    <div v-if="field.type === 'text'">
                                                                        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                                    </div>

                                                                    <div v-else-if="field.type === 'textarea'">
                                                                        <textarea :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label"></textarea>
                                                                    </div>

                                                                    <div v-else-if="field.type == 'select'">
                                                                        <select :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                                            <option :value="option" :selected="index === 0 ? 'selected' : false" v-for="(option,index) in field.options.split('\n')">@{{ option }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Specs -->
                                                            <div class="col-6">
                                                                <div class="kt-section__title">
                                                                    <h5 class="mb-4">Project Specifications</h5>
                                                                </div>
                                                                <!-- Text -->
                                                                <div v-for="field in type.fields.specs" class="form-group">
                                                                    <label :for="field.friendly_name">
                                                                        @{{ field.label }}
                                                                    </label>

                                                                    <div v-if="field.type === 'text'">
                                                                        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                                    </div>

                                                                    <div v-else-if="field.type === 'textarea'">
                                                                        <textarea :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label"></textarea>
                                                                    </div>

                                                                    <div v-else-if="field.type == 'select'">
                                                                        <select :readonly="awaitingManagerApproval && ! isManager" v-model="misc_po.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                                            <option v-for="option in field.options.split('\n')">@{{ option }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--begin::Portlet-->
                                        <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_2">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        Other Information
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body">
                                                <div class="kt-portlet__content">
                                                    <div class="row">
                                                        <div class="form-group  col-6" :class="{'has-danger': errors.has('finishing_information'), 'has-success': this.fields.finishing_information && this.fields.finishing_information.valid}">
                                                            <label for="finishing_information">
                                                                {{ trans('admin.project.columns.finishing_information') }}
                                                            </label>

                                                            <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="misc_po.finishing_information" class="form-control" :class="{'form-control-danger': errors.has('finishing_information'), 'form-control-success': this.fields.finishing_information && this.fields.finishing_information.valid }" id="finishing_information" name="finishing_information" placeholder="{{ trans('admin.project.columns.finishing_information') }}"></textarea>
                                                            <div v-if="errors.has('finishing_information')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('finishing_information') }}</div>
                                                        </div>

                                                        <div class="form-group  col-6" :class="{'has-danger': errors.has('packaging_information'), 'has-success': this.fields.packaging_information && this.fields.packaging_information.valid}">
                                                            <label for="packaging_information">
                                                                {{ trans('admin.project.columns.packaging_information') }}
                                                            </label>

                                                            <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="misc_po.packaging_information" class="form-control" :class="{'form-control-danger': errors.has('packaging_information'), 'form-control-success': this.fields.packaging_information && this.fields.packaging_information.valid }" id="packaging_information" name="packaging_information" placeholder="{{ trans('admin.project.columns.packaging_information') }}"></textarea>
                                                            <div v-if="errors.has('packaging_information')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('packaging_information') }}</div>
                                                        </div>

                                                        <div class="form-group col-6" :class="{'has-danger': errors.has('origination'), 'has-success': this.fields.origination && this.fields.origination.valid}">
                                                            <label for="origination">
                                                                {{ trans('admin.project.columns.origination') }}
                                                            </label>

                                                            <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="misc_po.origination" class="form-control" :class="{'form-control-danger': errors.has('origination'), 'form-control-success': this.fields.origination && this.fields.origination.valid }" id="origination" name="origination" placeholder="{{ trans('admin.project.columns.origination') }}"></textarea>
                                                            <div v-if="errors.has('origination')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('origination') }}</div>
                                                        </div>

                                                        <div class="form-group  col-6" :class="{'has-danger': errors.has('information_requests'), 'has-success': this.fields.information_requests && this.fields.information_requests.valid}">
                                                            <label for="information_requests">
                                                                {{ trans('admin.project.columns.information_requests') }}
                                                            </label>

                                                            <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="misc_po.information_requests" class="form-control" :class="{'form-control-danger': errors.has('information_requests'), 'form-control-success': this.fields.information_requests && this.fields.information_requests.valid }" id="information_requests" name="information_requests" placeholder="{{ trans('admin.project.columns.information_requests') }}"></textarea>
                                                            <div v-if="errors.has('information_requests')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('information_requests') }}</div>
                                                        </div>

                                                        <div class="form-group  col-4" :class="{'has-danger': errors.has('materials_in_at'), 'has-success': this.fields.materials_in_at && this.fields.materials_in_at.valid}">
                                                            <label for="materials_in_at">
                                                                {{ trans('admin.project.columns.materials_in_at') }}
                                                            </label>

                                                            <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="misc_po.materials_in_at" name="materials_in_at"></datepicker>
                                                            <div v-if="errors.has('materials_in_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('materials_in_at') }}</div>
                                                        </div>

                                                        <div class="form-group  col-4" :class="{'has-danger': errors.has('fob_at'), 'has-success': this.fields.fob_at && this.fields.fob_at.valid}">
                                                            <label for="fob_at">
                                                                {{ trans('admin.project.columns.fob_at') }}
                                                            </label>

                                                            <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="misc_po.fob_at" name="fob_at"></datepicker>
                                                            <div v-if="errors.has('fob_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fob_at') }}</div>
                                                        </div>

                                                        <div class="form-group  col-4" :class="{'has-danger': errors.has('delivery_at'), 'has-success': this.fields.delivery_at && this.fields.delivery_at.valid}">
                                                            <label for="delivery_at">
                                                                {{ trans('admin.project.columns.delivery_at') }}
                                                            </label>

                                                            <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="misc_po.delivery_at" name="delivery_at"></datepicker>
                                                            <div v-if="errors.has('delivery_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('delivery_at') }}</div>
                                                        </div>

                                                        <div class="form-group-last col-6" :class="{'has-danger': errors.has('ship_to'), 'has-success': this.fields.ship_to && this.fields.ship_to.valid}">
                                                            <label for="ship_to">
                                                                {{ trans('admin.project.columns.ship_to') }}
                                                            </label>

                                                            <textarea :readonly="awaitingManagerApproval && ! isManager" rows="4" type="number" v-model="misc_po.ship_to" class="form-control" :class="{'form-control-danger': errors.has('ship_to'), 'form-control-success': this.fields.ship_to && this.fields.ship_to.valid }" id="ship_to" name="ship_to" placeholder="{{ trans('admin.project.columns.ship_to') }}"></textarea>
                                                            <div v-if="errors.has('ship_to')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ship_to') }}</div>
                                                        </div>

                                                        <div class="form-group-last col-6" :class="{'has-danger': errors.has('vendor_notes'), 'has-success': this.fields.vendor_notes && this.fields.vendor_notes.valid}">
                                                            <label id="vendor-notes-label" for="vendor_notes">
                                                                {{ trans('admin.project.columns.vendor_notes') }}
                                                            </label>

                                                            <!-- Template Select -->
                                                            <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="vendor_note_template" id="vendor-note-select" label="note" placeholder="Select a template" open-direction="bottom" :options="vendor_notes" :multiple="false" :searchable="true" :internal-search="true" :clear-on-select="false" :close-on-select="true" :max-height="600" :show-no-results="true" :hide-selected="false" @select="addVendorNoteTemplate"></multiselect>

                                                            <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="misc_po.vendor_notes" class="form-control" :class="{'form-control-danger': errors.has('vendor_notes'), 'form-control-success': this.fields.vendor_notes && this.fields.vendor_notes.valid }" id="vendor_notes" name="vendor_notes" placeholder="{{ trans('admin.project.columns.vendor_notes') }}"></textarea>
                                                            <div v-if="errors.has('vendor_notes')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('vendor_notes') }}</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Portlet-->

                                        <!--begin::PCQ-->
                                        <div v-if="isCurrentTab(['pcq', 'fcq', 'po'])" class="kt-portlet" data-ktportlet="true" id="pcq_information">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        PCQ Information
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body">
                                                <div class="kt-portlet__content">
                                                    <div class="row">
                                                        <div class="form-group col-12" :class="{'has-danger': errors.has('additional_comments'), 'has-success': this.fields.additional_comments && this.fields.additional_comments.valid}">
                                                            <label for="additional_comments">
                                                                {{ trans('admin.project.columns.additional_comments') }}
                                                            </label>

                                                            <textarea type="number" v-model="misc_po.additional_comments" class="form-control" :class="{'form-control-danger': errors.has('additional_comments'), 'form-control-success': this.fields.additional_comments && this.fields.additional_comments.valid }" id="additional_comments" name="additional_comments" placeholder="{{ trans('admin.project.columns.additional_comments') }}"></textarea>
                                                            <div v-if="errors.has('additional_comments')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('additional_comments') }}</div>
                                                        </div>

                                                        <div class="col-6 mt-3">
                                                            <div class="" :class="{'has-danger': errors.has('remittance_info'), 'has-success': this.fields.name && this.fields.remittance_info.valid}">
                                                                <label for="remittance_info">
                                                                    {{ trans('admin.project.columns.remittance_info') }}
                                                                </label>

                                                                <multiselect v-model="misc_po.remittance_info" :options="remittance_options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Remittance Info" label="name" track-by="name" :preselect-first="false"></multiselect>
                                                                <div v-if="errors.has('remittance_info')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remittance_info') }}</div>
                                                            </div>
                                                        </div>

                                                        <div class="col-6 mt-3">
                                                            <div class="" :class="{'has-danger': errors.has('payment_terms'), 'has-success': this.fields.name && this.fields.payment_terms.valid}">
                                                                <label for="payment_terms">
                                                                    {{ trans('admin.project.columns.payment_terms') }}
                                                                </label>

                                                                <multiselect v-model="misc_po.payment_terms" :options="payment_term_options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Payment Terms" label="name" track-by="name" :preselect-first="false"></multiselect>
                                                                <div v-if="errors.has('payment_terms')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('payment_terms') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::PCQ-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Portlet-->
                </div>

                <fab
                        :actions="fabActions"
                        bg-color="#4273FA"
                        main-icon="apps"
                        @save_as_official="openModal('save-as-official')"
                        @print="openModal('print')"
                        @save="convenientSave"
                        @download="openModal('download')"
                ></fab>

                <modal v-cloak :min-height="500" height="auto" name="approve-version">
                    <div class="container text-center">
                        <h3 class="mt-5 mb-2">Are you sure?</h3>
                        <p class="mb-4">You
                            <strong>are about to confirm this as an official @{{ templateType }}</strong>. Would you like to proceed?
                        </p>
                    </div>

                    <div style="margin-top:50px;" class="row">
                        <button @click.prevent="closeModal('approve-version')" type="button" class="btn-secondary pt-3 pb-3 btn-lg rounded-0 btn col-6">Cancel</button>
                        <button @click.prevent="confirmSaveAsOfficial(true)" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Confirm as official @{{ templateType }}!</button>
                    </div>
                </modal>

                <modal v-cloak :min-height="500" height="auto" name="reject-version">
                    <div class="container text-center">
                        <h3 class="mt-5 mb-2">Are you sure?</h3>
                        <p class="mb-4">You
                            <strong>are about to reject this @{{ templateType }}</strong>. Would you like to proceed?
                        </p>
                    </div>

                    <div style="margin-top:50px;" class="row">
                        <button @click.prevent="closeModal('reject-version')" type="button" class="btn-secondary pt-3 pb-3 btn-lg rounded-0 btn col-6">Cancel</button>
                        <button @click.prevent="confirmSaveAsOfficial(false)" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Reject @{{ templateType }}!</button>
                    </div>
                </modal>

                <modal v-cloak :min-height="500" height="auto" name="save-as-official">
                    <div class="container text-center">
                        <h3 class="mt-5 mb-2">Save as official @{{ templateType }}</h3>
                        <p class="mb-4">You are about to save this as an official @{{ templateType }}. Would you like to proceed?</p>
                    </div>

                    <div style="margin-top:50px;" class="row">
                        <button @click.prevent="closeModal('save-as-official')" type="button" class="btn-secondary pt-3 pb-3 btn-lg rounded-0 btn col-6">Cancel</button>
                        <button @click.prevent="saveAsOfficial" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Confirm, save as official @{{ templateType }}!</button>
                    </div>
                </modal>

                <modal v-cloak :min-height="500" height="auto" name="print">
                    <div class="container text-center">
                        <h3 class="mt-5 mb-2">Save & Print @{{ templateType }}</h3>
                    </div>

                    <div class="container mt-3 mb-5">
                        <div class="form-group col-10 mx-auto align-self-center">
                            <label class="col-form-label">Letter Head</label>
                            <select v-model="generate.letterhead" class="form-control">
                                <option selected="selected">Select a letter head...</option>
                                @foreach( \App\Models\LetterHead::all() as $letterHead )
                                    <option value="{{ $letterHead->id }}">{{ $letterHead->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="margin-top:50px;" class="row">
                        <button @click.prevent="closeModal('print')" type="button" class="btn-secondary pt-3 pb-3 btn-lg rounded-0 btn col-6">Cancel</button>
                        <button @click.prevent="convenientPrint" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Save & Print @{{ templateType }}</button>
                    </div>
                </modal>

                <modal v-cloak :min-height="500" height="auto" name="download">
                    <div class="container text-center">
                        <h3 class="mt-5 mb-2">Save & Download @{{ templateType }}</h3>
                    </div>

                    <div class="container mt-3 mb-5">
                        <div class="form-group col-10 mx-auto align-self-center">
                            <label class="col-form-label">Letter Head</label>
                            <select v-model="generate.letterhead" class="form-control">
                                <option selected="selected">Select a letter head...</option>
                                @foreach( \App\Models\LetterHead::all() as $letterHead )
                                    <option value="{{ $letterHead->id }}">{{ $letterHead->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="margin-top:50px;" class="row">
                        <button @click.prevent="closeModal('download')" type="button" class="btn-secondary pt-3 pb-3 btn-lg rounded-0 btn col-6">Cancel</button>
                        <button @click.prevent="convenientDownload" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Save & Download @{{ templateType }}</button>
                    </div>
                </modal>

                <!-- end:: Content -->
            </div>

        </project-form>
    </div>

@endsection