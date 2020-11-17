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
            @if ( isset( $active_record ) )
                <resource-listing-form-combination :edit="{{ json_encode( $active_record ) }}" inline-template>
            @else
                <resource-listing-form-combination {!! isset( $create ) && $create ? ':create="true"' : '' !!} inline-template>
            @endif
                    <div>
                        <div class="row">
                            <div class="col">
                                <div class="kt-subheader w-100 m-0 p-0 kt-grid__item" id="kt_subheader">
                                    <div class="kt-subheader__main w-100">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-cloak>
                            <div v-show="isTabShowing( 'resource-index' )">
                                <leave-request-listing
                                    ref="resource_index"
                                    :data="{{ $data->toJson() }}"
                                    :url="'{{ url('admin/leave-requests') }}'"
                                    inline-template>

                                    <div class="row">
                                        <div class="col">
                                            <div class="w-100">
                                                <div class="w-100" v-cloak>

                                                    <!--begin::List Resource-->
                                                    <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                                        <div class="kt-subheader__main">
                                                            <h3 class="kt-subheader__title">
                                                                My Leave Requests
                                                            </h3>
                                                        </div>

                                                        <!-- begin::Pagination -->
                                                        <div class="kt-subheader__toolbar col">
                                                            <a @click.prevent="switchToCreate" href="#" class="btn btn-label-brand btn-bold mr-3">Create New</a>

                                                            <div class="col-sm-auto form-group m-0 p-0">
                                                                <select class="form-control" v-model="pagination.state.per_page">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="100">100</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- emd::Pagination -->
                                                    </div>

                                                    <div class="kt-portlet mt-2">
                                                        <div class="kt-portlet__body kt-portlet__body--fit">
                                                            <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded">
                                                                <table class="kt-datatable__table">
                                                                    <thead class="kt-datatable__head">
                                                                        <tr class="kt-datatable__row">
                                                                            <th is='sortable' :column="'id'" class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                <span>Requested On</span>
                                                                            </th>
                                                                            <th is='sortable' :column="'type'" class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                <span>Purpose</span>
                                                                            </th>
                                                                            <th is='sortable' :column="'sales_persons'" class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                <span>Requested Dates</span>
                                                                            </th>
                                                                            <th is='sortable' :column="'company_name'" class="kt-datatable__cell kt-datatable__cell--sort">
                                                                                <span>Approved By</span>
                                                                            </th>
                                                                            <th class="kt-datatable__cell">
                                                                                <span>Actions</span>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="kt-datatable__body">
                                                                        <tr @click.prevent="$parent.viewRecord(item.resource_url)" style="height: 50px;" class="kt-datatable__row" v-for="(item, index) in collection">
                                                                            <td class="kt-datatable__cell">
                                                                                <span>@{{ item.requested_at | moment("dddd, MMMM Do YYYY") }}</span>
                                                                            </td>
                                                                            <td class="kt-datatable__cell">
                                                                                <span>@{{ item.purpose }}</span>
                                                                            </td>
                                                                            <td class="kt-datatable__cell">
                                                                                <span v-if="item.requested_dates">
                                                                                    <span v-for="(date,index) in item.requested_dates">
                                                                                    @{{ date | moment("dddd, MMMM Do YYYY") }}@{{ ( index + 1 ) !== item.requested_dates.length ? ',' : '' }}
                                                                                    </span>
                                                                                </span>
                                                                            </td>
                                                                            <td class="kt-datatable__cell">
                                                                                <span>@{{ item.approved_at ? ( item.approved_at | moment("dddd, MMMM Do YYYY") ) : 'Awaiting Approval' }}</span>
                                                                            </td>
                                                                            <!--begin::Actions-->
                                                                            <td class="kt-datatable__cell">
                                                                                <span style="overflow: visible; position: relative; width: 80px;">
                                                                                    <a class="mr-2" data-toggle="tooltip" title="View" @click.stop="$parent.viewRecord(item.resource_url)" href="#"><i class="flaticon2-checking"></i></a>
                                                                                    <a class="mr-2" data-toggle="tooltip" title="Edit" @click.stop="$parent.editRecord(item.resource_url)" href="#"><i class="flaticon2-pen"></i></a>
                                                                                    <a class="mr-2" data-toggle="tooltip" title="Delete" @click.stop="$parent.deleteRecord(item.resource_url)" href="#"><i class="flaticon2-rubbish-bin"></i></a>
                                                                                </span>
                                                                            </td>
                                                                            <!--end::Actions-->
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="kt-datatable__pager kt-datatable--paging-loaded" v-if="pagination.state.total > 0">

                                                                    <div class="kt-datatable__pager-info">
                                                                        <span class="kt-datatable__pager-detail">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                                                    </div>

                                                                    <pagination inline-template>
                                                                        <ul class="kt-datatable__pager-nav pagination sizeClass" v-if="pagination.last_page > 1">
                                                                            <li v-if="showPrevious()" :class="{ 'disabled' : pagination.current_page <= 1, '': true }">
                                                                                <a href="#" v-if="pagination.current_page <= 1" class="kt-datatable__pager-link kt-datatable__pager-link--prev kt-datatable__pager-link--disabled">
                                                                                    <i class="flaticon2-back"></i>
                                                                                </a>

                                                                                <a :title="config.ariaPrevioius" :disabled="pagination.current_page <= 1" v-if="pagination.current_page > 1" :aria-label="config.ariaPrevioius" @click.prevent="changePage(pagination.current_page - 1)" class="kt-datatable__pager-link kt-datatable__pager-link--prev kt-datatable__pager-link--disabled">
                                                                                    <i class="flaticon2-back"></i>
                                                                                </a>
                                                                            </li>

                                                                            <li v-for="num in array" :class="{ 'kt-datatable__pager-link--active': num === pagination.current_page }">
                                                                                <a href="#" :class="{ 'kt-datatable__pager-link--active': num === pagination.current_page }" @click.prevent="changePage(num)" class="kt-datatable__pager-link">@{{ num }}</a>
                                                                            </li>

                                                                            <li v-if="showNext()" :class="{ 'disabled' : pagination.current_page === pagination.last_page || pagination.last_page === 0, 'page-item': true }">
                                                                                <span v-if="pagination.current_page === pagination.last_page || pagination.last_page === 0" class="kt-datatable__pager-link kt-datatable__pager-link--next">
                                                                                    <i class="flaticon2-next"></i>
                                                                                </span>
                                                                                <a href="#" v-if="pagination.current_page < pagination.last_page" :aria-label="config.ariaNext" @click.prevent="changePage(pagination.current_page + 1)" class="page-link">
                                                                                    <span aria-hidden="true">@{{ config.nextText }}</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </pagination>
                                                                </div>


                                                            </div>


                                                            <div class="no-items-found text-center pt-3 pb-5" v-if="!collection.length > 0">
                                                                <i class="icon-magnifier"></i>
                                                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                                                <a class="btn btn-primary btn-spinner mt-3" href="#" @click.prevent="$parent.setTab( 'resource-create' )" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.leave-request.actions.create') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::List Resource-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </leave-request-listing>
                            </div>

                            <div v-if="isTabShowing( 'resource-create' )">

                                <fab
                                    v-if="!is_viewing"
                                    :actions="fabActions"
                                    bg-color="#4273FA"
                                    main-icon="apps"
                                    @save="fabActionSave"
                                    @save_new="fabActionSaveAndNew"
                                    @save_exit="fabActionSaveAndExit"
                                ></fab>

                                <div class="row">
                                    <div class="col">
                                        <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                            <div class="kt-subheader__main">
                                                <button @click.prevent="setTab( 'resource-index' )" type="button" class="btn btn-sm btn-upper" style="background: #edeff6">
                                                    <i class="flaticon2-left-arrow-1 mr-0 pr-0"></i>
                                                </button>

                                                <h3 class="ml-3 kt-subheader__title">
                                                    Back to leave requests
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mt-0">
                                        <leave-request-form
                                            ref="resource_create"
                                            :action="'{{ url('admin/leave-requests') }}'"
                                            inline-template>
                                            <div>
                                                <form ref="form" class="form-horizontal form-create kt-form" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>
                                                    <fab
                                                        v-if="$parent.is_viewing"
                                                        :actions="$parent.fabActionsViewingMode"
                                                        bg-color="#4273FA"
                                                        main-icon="apps"
                                                        @edit="$parent.fabActionEdit(form.resource_url)"
                                                        @delete="$parent.fabActionDelete(form.resource_url)"
                                                    ></fab>

                                                    @include('admin.leave-request.components.form-elements')
                                                </form>
                                            </div>
                                        </leave-request-form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </resource-listing-form-combination>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End::App-->

@endsection
