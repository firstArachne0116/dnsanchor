@extends('admin.layout.dashboard')

@section('title', trans('admin.role.actions.index'))

@section('body')

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

                            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid mb-3 ml-0 mr-0 mt-0 shadow-none bg-transparent">
                                <div class="kt-portlet__head p-0">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Roles
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                            <li class="nav-item">
                                                <a @click.prevent="setTab( 'resource-create' )" :class="{ 'active' : isTabShowing( 'resource-create' ) }" class="nav-link" href="#" role="tab">
                                                    Create New Role
                                                </a>
                                            </li>
                                            <li class="nav-item ml-3">
                                                <a @click.prevent="setTab( 'resource-index' )" :class="{ 'active' : isTabShowing( 'resource-index' ) }" class="nav-link" href="#" role="tab">
                                                    Dashboard
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
            <div v-cloak>
                <div v-show="isTabShowing( 'resource-index' )">
                    <role-listing
                            ref="resource_index"
                            :data="{{ $data->toJson() }}"
                            :url="'{{ url('admin/roles') }}'"
                            inline-template>

                        <div class="row">
                            <div class="col">
                                <div class="w-100">
                                    <div class="w-100" v-cloak>

                                        <!--begin::List Resource-->
                                        <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                            <div class="kt-subheader__main">
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

                                        <div class="kt-portlet mt-5">
                                            <div class="kt-portlet__body kt-portlet__body--fit">
                                                <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded">
                                                    <table class="kt-datatable__table">
                                                        <thead class="kt-datatable__head">
                                                            <tr class="kt-datatable__row">
                                                                <th class="kt-datatable__cell kt-datatable__cell--sort"><span>ID</span></th>
                                                                <th class="kt-datatable__cell kt-datatable__cell--sort"><span>Name</span></th>
{{--                                                                <th class="kt-datatable__cell kt-datatable__cell--sort"><span>Guard</span></th>--}}

                                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                    <span>Actions</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="kt-datatable__body">
                                                            <tr class="kt-datatable__row" v-for="(item, index) in collection">
                                                                <td class="kt-datatable__cell">
                                                                    <span>@{{ item.id }}</span>
                                                                </td>
                                                                <td class="kt-datatable__cell">
                                                                    <editable :on-update="$parent.updateRecord" :record-url="item.resource_url" record-name="name" :text="item.name"></editable>
                                                                </td>

{{--                                                                <td class="kt-datatable__cell">--}}
{{--                                                                    <editable :on-update="$parent.updateRecord" :record-url="item.resource_url" record-name="guard_name" :text="item.guard_name"></editable>--}}
{{--                                                                </td>--}}


                                                                <!--begin::Actions-->
                                                                <td class="kt-datatable__cell">
                                                <span style="overflow: visible; position: relative; width: 80px;">
                                                    <div class="dropdown">
                                                          <a class="btn btn-sm btn-clean btn-icon btn-icon-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="flaticon-more-1"></i>
                                                          </a>

                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" @click.prevent="$parent.editRecord(item.resource_url)">Edit</a>
                                                            <a class="dropdown-item" @click.prevent="$parent.deleteRecord(item.resource_url)" href="#">Delete</a>
                                                          </div>
                                                    </div>
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
                                                    <a class="btn btn-primary btn-spinner mt-3" href="#" @click.prevent="$parent.setTab( 'resource-create' )" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.role.actions.create') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::List Resource-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </role-listing>
                </div>

                <div v-if="isTabShowing( 'resource-create' )">

                    <div class="row">
                        <div class="col">
                            <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                <div class="kt-subheader__main">
                                    <button @click.prevent="setTab( 'resource-index' )" type="button" class="btn btn-sm btn-upper" style="background: #edeff6">
                                        <i class="flaticon2-left-arrow-1 mr-0 pr-0"></i></button>
                                    <button @click.prevent="submitCreateForm" type="button" class="ml-2 btn btn-sm btn-brand btn-upper">
                                        <i class="fa fa-save"></i> {{ trans('brackets/admin-ui::admin.btn.save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mt-4">
                            <role-form
                                    ref="resource_create"
                                    :action="'{{ url('admin/roles') }}'"
                                    :permissions="{{ json_encode( $permissions->toArray() ) }}"
                                    inline-template>

                                <form ref="form" class="form-horizontal form-create kt-form" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>
                                    @include('admin.role.components.form-elements')
                                </form>

                            </role-form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </resource-listing-form-combination>

@endsection
