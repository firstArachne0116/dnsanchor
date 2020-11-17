@extends('admin.layout.dashboard')

@section('title', trans('admin.project.actions.index'))

@section('body')

    <project-listing
            :data="{{ $data->toJson() }}"
            :url="'{{ url('admin/projects') }}'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="w-100">
                    {{--                    <div class="card-header">--}}
                    {{--                        <i class="fa fa-align-justify"></i> {{ trans('admin.project.actions.index') }}--}}
                    {{--                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/projects/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.project.actions.create') }}</a>--}}
                    {{--                    </div>--}}


                    <div class="w-100" v-cloak>
                        <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        Projects
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

                                                            <!--<i class="flaticon2-search-1"></i>-->
														</span>
													</span>
                                            </div>
                                        </form>
                                    </div>
{{--                                    <div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">--}}
{{--                                        <div class="kt-subheader__desc">--}}
{{--                                            <span id="kt_subheader_group_selected_rows">0</span> Selected:</div>--}}
{{--                                        <div class="btn-toolbar kt-margin-l-20">--}}
{{--                                            <div class="dropdown" id="kt_subheader_group_actions_status_change">--}}
{{--                                                <button type="button" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">--}}
{{--                                                    Update Status--}}
{{--                                                </button>--}}
{{--                                                <div class="dropdown-menu">--}}
{{--                                                    <ul class="kt-nav">--}}
{{--                                                        <li class="kt-nav__section kt-nav__section--first">--}}
{{--                                                            <span class="kt-nav__section-text">Change status to:</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="kt-nav__item">--}}
{{--                                                            <a href="#" class="kt-nav__link" data-toggle="status-change" data-status="1">--}}
{{--                                                                <span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--bold">Approved</span></span>--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="kt-nav__item">--}}
{{--                                                            <a href="#" class="kt-nav__link" data-toggle="status-change" data-status="2">--}}
{{--                                                                <span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--bold">Rejected</span></span>--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="kt-nav__item">--}}
{{--                                                            <a href="#" class="kt-nav__link" data-toggle="status-change" data-status="3">--}}
{{--                                                                <span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-warning kt-badge--inline kt-badge--bold">Pending</span></span>--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="kt-nav__item">--}}
{{--                                                            <a href="#" class="kt-nav__link" data-toggle="status-change" data-status="4">--}}
{{--                                                                <span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-info kt-badge--inline kt-badge--bold">On Hold</span></span>--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <button class="btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_fetch" data-toggle="modal" data-target="#kt_datatable_records_fetch_modal">--}}
{{--                                                Fetch Selected--}}
{{--                                            </button>--}}
{{--                                            <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_delete_all">--}}
{{--                                                Delete All--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="kt-subheader__toolbar col">
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
                                <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded">
                                    <table class="kt-datatable__table">
                                        <thead class="kt-datatable__head">
                                            <tr class="kt-datatable__row">
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Reference</span>
                                                </th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Project Title</span></th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Customer ID</span>
                                                </th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Primary Contact Name</span></th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Company Name</span></th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Telephone</span>
                                                </th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Actions</span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="kt-datatable__body">
                                            <tr class="kt-datatable__row" v-for="(item, index) in collection">
                                                <td class="kt-datatable__cell">@{{ item.id }}</td>
                                                <td class="kt-datatable__cell">@{{ item.title || '-' }}</td>
                                                <td class="kt-datatable__cell">@{{ item.client_id || '-' }}</td>
                                                <td class="kt-datatable__cell">@{{ item.hasOwnProperty( 'client' ) && item.client ? item.client.primary_contact_name : '-' }}</td>
                                                <td class="kt-datatable__cell">@{{ item.hasOwnProperty( 'client' ) && item.client ? item.client.company_name : '-' }}</td>
                                                <td class="kt-datatable__cell">@{{ item.hasOwnProperty( 'client' ) && item.client ? item.client.company_phone : '-' }}</td>
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
                                    </table>
                                    <div class="kt-datatable__pager kt-datatable--paging-loaded">
                                        <ul class="kt-datatable__pager-nav">
                                            <li>
                                                <a title="First" class="kt-datatable__pager-link kt-datatable__pager-link--first kt-datatable__pager-link--disabled" data-page="1" disabled="disabled"><i class="flaticon2-fast-back"></i></a>
                                            </li>
                                            <li>
                                                <a title="Previous" class="kt-datatable__pager-link kt-datatable__pager-link--prev kt-datatable__pager-link--disabled" data-page="1" disabled="disabled"><i class="flaticon2-back"></i></a>
                                            </li>
                                            <li style=""></li>
                                            <li style="display: none;">
                                                <input type="text" class="kt-pager-input form-control" title="Page number">
                                            </li>
                                            <li>
                                                <a class="kt-datatable__pager-link kt-datatable__pager-link-number kt-datatable__pager-link--active" data-page="1" title="1">1</a>
                                            </li>
                                            <li>
                                                <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="2" title="2">2</a>
                                            </li>
                                            <li>
                                                <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="3" title="3">3</a>
                                            </li>
                                            <li>
                                                <a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="4" title="4">4</a>
                                            </li>
                                            <li style=""></li>
                                            <li>
                                                <a title="Next" class="kt-datatable__pager-link kt-datatable__pager-link--next" data-page="2"><i class="flaticon2-next"></i></a>
                                            </li>
                                            <li>
                                                <a title="Last" class="kt-datatable__pager-link kt-datatable__pager-link--last" data-page="4"><i class="flaticon2-fast-next"></i></a>
                                            </li>
                                        </ul>
                                        <div class="kt-datatable__pager-info">
                                            <div class="dropdown bootstrap-select kt-datatable__pager-size dropup" style="width: 60px;">
                                                <select class="selectpicker kt-datatable__pager-size" title="Select page size" data-width="60px" data-selected="10" tabindex="-98">
                                                    <option selected value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> </div>
                                            <span class="kt-datatable__pager-detail">Showing 1 - 10 of 40</span></div>
                                    </div>

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
    </project-listing>

@endsection
