@extends('admin.layout.dashboard')

@section('title', trans('admin.project.actions.index'))


@push( 'styles' )
    <link href="{{ asset( 'css/todo.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push( 'styles' )
    <style>
        .mce-notification {
            display: none !important;
        }
    </style>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
@endpush

@section( 'quick-panel' )
    <quick-panel :filters="{{ '[{"selected":false,"type":"dropdown","name":"project_type","label":"Contact Type","options":["is","is not"],"selectedOption":null,"values":[{"label":"Lead","name":"lead"},{"label":"Prospect","name":"prospect"},{"label":"Client","name":"client"}],"selectedValue":null},{"selected":false,"type":"number","name":"project_id","label":"Contact ID","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null},{"selected":false,"type":"text","name":"project_name","label":"Contact Name","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null},{"selected":false,"type":"text","name":"company_name","label":"Company Name","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null}]' }}"></quick-panel>
@endsection

@section('body')

@if ( isset( $active_record ) )
    <resource-listing-form-combination :edit="{{ json_encode( $active_record ) }}" inline-template>
@else
    <resource-listing-form-combination {!! isset( $create ) && $create ? ':create="true"' : '' !!} inline-template>
@endif

    <div>
        <div class="mt-4" v-cloak>
            <div v-show="isTabShowing( 'resource-index' )">
                <project-listing
                    ref="resource_index"
                    :data="{{ $data->toJson() }}"
                    :url="'{{ url('admin/projects') }}'"
                    inline-template>

                    <div class="row">
                        <div class="col">
                            <div class="w-100">
                                <div class="w-100" v-cloak>

                                    <!--begin::List Resource-->
                                    <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                        <div class="kt-subheader__main">
                                            <h3 class="kt-subheader__title">
                                                Projects
                                            </h3>
                                            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                            <div class="kt-subheader__group" id="kt_subheader_search">
                                                <span class="kt-subheader__desc" id="kt_subheader_total">@{{ pagination.state.total }} Total </span>
                                                <form @submit.prevent="" class="kt-margin-l-20" id="kt_subheader_search_form">
                                                    <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                                                        <input type="text" class="form-control" v-model="search" @keyup.enter="filter('search', $event.target.value)" placeholder="Search..." id="generalSearch">
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
                                                            <th is='sortable' :column="'id'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Reference</span></th>
                                                            <th is='sortable' :column="'title'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Project Title</span></th>
                                                            <th is='sortable' :column="'client_id'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Customer ID</span></th>
                                                            <th is='sortable' :column="'primary_contact_name'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Primary Contact Name</span></th>
                                                            <th is='sortable' :column="'company_name'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Company Name</span></th>
                                                            <th is='sortable' :column="'company_name'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Company Phone</span></th>
                                                            <th class="kt-datatable__cell"><span>Actions</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="kt-datatable__body">
                                                        <tr @click.prevent="$parent.viewRecord(item.resource_url);" style="height: 50px;" class="kt-datatable__row" v-for="(item, index) in collection">
                                                            <td class="kt-datatable__cell">@{{ item.reference }}</td>
                                                            <td class="kt-datatable__cell">
                                                                <svg v-if="item.status === 'AWAITING_MANAGER_APPROVAL'" data-toggle="tooltip" data-title="Pending Review" width="23" viewBox="0 0 48 48">
                                                                    <path fill="#FFC107" d="M40,40H8c-0.717,0-1.377-0.383-1.734-1.004c-0.356-0.621-0.354-1.385,0.007-2.004l16-28C22.631,8.378,23.289,8,24,8s1.369,0.378,1.728,0.992l16,28c0.361,0.619,0.363,1.383,0.007,2.004S40.716,40,40,40z" />
                                                                    <path fill="#5D4037" d="M22,34.142c0-0.269,0.047-0.515,0.143-0.746c0.094-0.228,0.229-0.426,0.403-0.592c0.171-0.168,0.382-0.299,0.624-0.393c0.244-0.092,0.518-0.141,0.824-0.141c0.306,0,0.582,0.049,0.828,0.141c0.25,0.094,0.461,0.225,0.632,0.393c0.175,0.166,0.31,0.364,0.403,0.592C25.953,33.627,26,33.873,26,34.142c0,0.27-0.047,0.516-0.143,0.74c-0.094,0.225-0.229,0.419-0.403,0.588c-0.171,0.166-0.382,0.296-0.632,0.392C24.576,35.954,24.3,36,23.994,36c-0.307,0-0.58-0.046-0.824-0.139c-0.242-0.096-0.453-0.226-0.624-0.392c-0.175-0.169-0.31-0.363-0.403-0.588C22.047,34.657,22,34.411,22,34.142 M25.48,30h-2.973l-0.421-12H25.9L25.48,30z" />
                                                                </svg> @{{ item.title || '-' }}
                                                            </td>
                                                            <td class="kt-datatable__cell">@{{ item.client_id || '-' }}</td>
                                                            <td class="kt-datatable__cell">@{{ item.hasOwnProperty( 'client' ) && item.client ? item.client.primary_contact_name : '-' }}</td>
                                                            <td class="kt-datatable__cell">@{{ item.hasOwnProperty( 'client' ) && item.client ? item.client.company_name : '-' }}</td>
                                                            <td class="kt-datatable__cell">@{{ item.hasOwnProperty( 'client' ) && item.client ? item.client.company_phone : '-' }}</td>

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
                                                <a class="btn btn-primary btn-spinner mt-3" href="#" @click.prevent="$parent.setTab( 'resource-create' )" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.project.actions.create') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::List Resource-->

                                </div>
                            </div>
                        </div>
                    </div>
                </project-listing>
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
                                    Back to projects
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-0">
                        <project-form
                            ref="resource_create"
                            :action="'{{ url( 'admin/projects' ) }}'"
                            aa-content="{{ $aa_content }}"
                            :types="{{ json_encode( $project_types ) }}"
                            :is-manager="{{ request()->user()->hasRole( 'Manager' ) ? 'true' : 'false' }}"
                            :customer_id="{{ isset($customer_id) ? $customer_id : -1}}"
                            inline-template>

                            <div>

                                <modal v-if="isUserManager && form.status === 'AWAITING_MANAGER_APPROVAL'" v-cloak :min-height="500" height="auto" name="pending-review">
                                    <div class="container text-center">
                                        <svg class="mt-5" width="58" viewBox="0 0 48 48">
                                            <path fill="#FFC107" d="M40,40H8c-0.717,0-1.377-0.383-1.734-1.004c-0.356-0.621-0.354-1.385,0.007-2.004l16-28C22.631,8.378,23.289,8,24,8s1.369,0.378,1.728,0.992l16,28c0.361,0.619,0.363,1.383,0.007,2.004S40.716,40,40,40z" />
                                            <path fill="#5D4037" d="M22,34.142c0-0.269,0.047-0.515,0.143-0.746c0.094-0.228,0.229-0.426,0.403-0.592c0.171-0.168,0.382-0.299,0.624-0.393c0.244-0.092,0.518-0.141,0.824-0.141c0.306,0,0.582,0.049,0.828,0.141c0.25,0.094,0.461,0.225,0.632,0.393c0.175,0.166,0.31,0.364,0.403,0.592C25.953,33.627,26,33.873,26,34.142c0,0.27-0.047,0.516-0.143,0.74c-0.094,0.225-0.229,0.419-0.403,0.588c-0.171,0.166-0.382,0.296-0.632,0.392C24.576,35.954,24.3,36,23.994,36c-0.307,0-0.58-0.046-0.824-0.139c-0.242-0.096-0.453-0.226-0.624-0.392c-0.175-0.169-0.31-0.363-0.403-0.588C22.047,34.657,22,34.411,22,34.142 M25.48,30h-2.973l-0.421-12H25.9L25.48,30z" />
                                        </svg>

                                        <h3 class="mb-2 kt-heading">@{{ form.template_type }} Awaiting Review</h3>
                                    </div>

                                    <div class="container text-center mt-3 mb-5">
                                        <div class="row">
                                            <div class="col-9 mx-auto">
                                                <p>This project is currently pending review. Before it can continue to the next stage, it must be approved by a manager.</p>

                                                <button @click.prevent="closeModal('pending-review')" type="button" class="mt-3 btn btn-primary">Ok, let me review</button>

                                            </div>
                                        </div>
                                    </div>
                                </modal>

                                <div v-if="isUserManager && form.status === 'AWAITING_MANAGER_APPROVAL'" class="alert alert-warning fade show" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">This project is currently pending review of the @{{ form.template_type }}. Before it can continue to the next stage, it must be approved by a manager.</div>
                                    <div style="position:relative;top:-5px;" class="d-inline-block float-right ml-5">
                                        <button @click.prevent="confirmSaveAsOfficial(true)" type="button" class="mt-3 btn btn-primary">Approve</button>
                                        <button @click.prevent="confirmSaveAsOfficial(false)" type="button" class="mt-3 btn btn-brand">Deny</button>
                                    </div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>

                                <!-- begin:: Content -->
                                <div class=" kt-grid__item kt-grid__item--fluid">

                                    <!--Begin:: Portlet-->
                                    <div class="kt-portlet kt-portlet--tabs">
                                        <div class="kt-portlet__head">
                                            <div class="kt-portlet__head-toolbar">
                                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                                                    <li class="nav-item">
                                                        <a @click="setTab('overview')" :class="'nav-link' + (($parent.is_viewing || $parent.is_editing) ? ' active' : '')" data-toggle="tab" href="#gpsd_overview" role="tab">
                                                            <i class="flaticon2-calendar-3"></i> Overview
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a @click="setTab('rfq')" :class="'nav-link' + ((!$parent.is_viewing && !$parent.is_editing) ? ' active' : '')" data-toggle="tab" href="#gpsd_rfq" role="tab">
                                                            <i v-if="!isPendingReview('RFQ')" class="flaticon2-notepad"></i>
                                                            <svg v-else data-toggle="tooltip" data-title="Pending Review" width="20" viewBox="0 0 48 48">
                                                                <path fill="#FFC107" d="M40,40H8c-0.717,0-1.377-0.383-1.734-1.004c-0.356-0.621-0.354-1.385,0.007-2.004l16-28C22.631,8.378,23.289,8,24,8s1.369,0.378,1.728,0.992l16,28c0.361,0.619,0.363,1.383,0.007,2.004S40.716,40,40,40z" />
                                                                <path fill="#5D4037" d="M22,34.142c0-0.269,0.047-0.515,0.143-0.746c0.094-0.228,0.229-0.426,0.403-0.592c0.171-0.168,0.382-0.299,0.624-0.393c0.244-0.092,0.518-0.141,0.824-0.141c0.306,0,0.582,0.049,0.828,0.141c0.25,0.094,0.461,0.225,0.632,0.393c0.175,0.166,0.31,0.364,0.403,0.592C25.953,33.627,26,33.873,26,34.142c0,0.27-0.047,0.516-0.143,0.74c-0.094,0.225-0.229,0.419-0.403,0.588c-0.171,0.166-0.382,0.296-0.632,0.392C24.576,35.954,24.3,36,23.994,36c-0.307,0-0.58-0.046-0.824-0.139c-0.242-0.096-0.453-0.226-0.624-0.392c-0.175-0.169-0.31-0.363-0.403-0.588C22.047,34.657,22,34.411,22,34.142 M25.48,30h-2.973l-0.421-12H25.9L25.48,30z" />
                                                            </svg>
                                                            RFQ
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a :disabled="!hasCompletedSection('rfq')" :class="!hasCompletedSection('rfq') ? 'disabled' : ''" @click.prevent="setTab('pcq', !hasCompletedSection('rfq'))" class="nav-link " data-toggle="tab" href="#gpsd_pcq" role="tab">
                                                            <i v-if="!isPendingReview('PCQ')" class="flaticon2-notepad"></i>
                                                            <svg v-else data-toggle="tooltip" data-title="Pending Review" width="20" viewBox="0 0 48 48">
                                                                <path fill="#FFC107" d="M40,40H8c-0.717,0-1.377-0.383-1.734-1.004c-0.356-0.621-0.354-1.385,0.007-2.004l16-28C22.631,8.378,23.289,8,24,8s1.369,0.378,1.728,0.992l16,28c0.361,0.619,0.363,1.383,0.007,2.004S40.716,40,40,40z" />
                                                                <path fill="#5D4037" d="M22,34.142c0-0.269,0.047-0.515,0.143-0.746c0.094-0.228,0.229-0.426,0.403-0.592c0.171-0.168,0.382-0.299,0.624-0.393c0.244-0.092,0.518-0.141,0.824-0.141c0.306,0,0.582,0.049,0.828,0.141c0.25,0.094,0.461,0.225,0.632,0.393c0.175,0.166,0.31,0.364,0.403,0.592C25.953,33.627,26,33.873,26,34.142c0,0.27-0.047,0.516-0.143,0.74c-0.094,0.225-0.229,0.419-0.403,0.588c-0.171,0.166-0.382,0.296-0.632,0.392C24.576,35.954,24.3,36,23.994,36c-0.307,0-0.58-0.046-0.824-0.139c-0.242-0.096-0.453-0.226-0.624-0.392c-0.175-0.169-0.31-0.363-0.403-0.588C22.047,34.657,22,34.411,22,34.142 M25.48,30h-2.973l-0.421-12H25.9L25.48,30z" />
                                                            </svg>
                                                            PCQ
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a :disabled="!hasCompletedSection('pcq')" :class="!hasCompletedSection('pcq') ? 'disabled' : ''" @click.prevent="setTab('fcq', !hasCompletedSection('pcq'))" class="nav-link" data-toggle="tab" href="#gpsd_fcq" role="tab">
                                                            <i class="flaticon2-notepad"></i> FCQ
                                                            <span v-if="fcq_signed" class="ml-3 btn btn-label-success btn-sm btn-bold btn-upper">Signed</span>
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
                                                    <li class="nav-item">
                                                        <a @click="setTab('sales_invoice')" class="nav-link " data-toggle="tab" href="#gpsd_sales_invoice" role="tab">
                                                            <i class="flaticon2-pie-chart-2"></i> Sales Invoice
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End:: Portlet-->

                                    <div v-if="editing_misc_po || creating_misc_po" class="row">
                                        <div class="col">
                                            <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                                <div class="kt-subheader__main">
                                                    <button @click.prevent="() => { editing_misc_po = false; creating_misc_po = false; }" type="button" class="btn btn-sm btn-upper" style="background: #edeff6">
                                                        <i class="flaticon2-left-arrow-1 mr-0 pr-0"></i></button>

                                                    <h3 class="ml-3 kt-subheader__title">
                                                        Back to misc PO's
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @include( 'admin.project.components.form-elements')
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
                                            <strong>are about to confirm this as an official @{{ friendly_template_type }}</strong>. Would you like to proceed?
                                        </p>
                                    </div>

                                    <div style="margin-top:50px;" class="row">
                                        <button @click.prevent="closeModal('approve-version')" type="button" class="btn-secondary pt-3 pb-3 btn-lg rounded-0 btn col-6">Cancel</button>
                                        <button @click.prevent="confirmSaveAsOfficial(true)" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Confirm as official @{{ friendly_template_type }}!</button>
                                    </div>
                                </modal>

                                <modal v-cloak :min-height="500" height="auto" name="reject-version">
                                    <div class="container text-center">
                                        <h3 class="mt-5 mb-2">Are you sure?</h3>
                                        <p class="mb-4">You
                                            <strong>are about to reject this @{{ friendly_template_type }}</strong>. Would you like to proceed?
                                        </p>
                                    </div>

                                    <div style="margin-top:50px;" class="row">
                                        <button @click.prevent="closeModal('reject-version')" type="button" class="btn-secondary pt-3 pb-3 btn-lg rounded-0 btn col-6">Cancel</button>
                                        <button @click.prevent="confirmSaveAsOfficial(false)" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Reject @{{ friendly_template_type }}!</button>
                                    </div>
                                </modal>

                                <modal v-cloak :min-height="500" height="auto" name="save-as-official">
                                    <div class="container text-center">
                                        <h3 class="mt-5 mb-2">Save as official @{{ friendly_template_type }}</h3>
                                        <p class="mb-4">You are about to save this as an official @{{ friendly_template_type }}. Would you like to proceed?</p>
                                    </div>

                                    <div style="margin-top:50px;" class="row">
                                        <button @click.prevent="closeModal('save-as-official')" type="button" class="btn-secondary pt-3 pb-3 btn-lg rounded-0 btn col-6">Cancel</button>
                                        <button @click.prevent="saveAsOfficial" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Confirm, save as official @{{ friendly_template_type }}!</button>
                                    </div>
                                </modal>

                                <modal v-cloak :min-height="500" height="auto" name="print">
                                    <div class="container text-center">
                                        <h3 class="mt-5 mb-2">Save & Print @{{ friendly_template_type }}</h3>
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
                                        <button @click.prevent="convenientPrint" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Save & Print @{{ friendly_template_type }}</button>
                                    </div>
                                </modal>

                                <modal v-cloak :min-height="500" height="auto" name="download">
                                    <div class="container text-center">
                                        <h3 class="mt-5 mb-2">Save & Download @{{ friendly_template_type }}</h3>
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
                                        <button @click.prevent="convenientDownload" type="button" class="btn-primary btn-lg rounded-0 btn col-6">Save & Download @{{ friendly_template_type }}</button>
                                    </div>
                                </modal>

                                <!-- end:: Content -->
                            </div>

                        </project-form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</resource-listing-form-combination>

@endsection
