@extends('admin.layout.dashboard')

@section('title', trans('admin.project.actions.index'))

@section( 'quick-panel' )
    <quick-panel :filters="{{ '[{"selected":false,"type":"dropdown","name":"contact_type","label":"Contact Type","options":["is","is not"],"selectedOption":null,"values":[{"label":"Lead","name":"lead"},{"label":"Prospect","name":"prospect"},{"label":"Client","name":"client"}],"selectedValue":null},{"selected":false,"type":"number","name":"contact_id","label":"Contact ID","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null},{"selected":false,"type":"text","name":"contact_name","label":"Contact Name","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null},{"selected":false,"type":"text","name":"company_name","label":"Company Name","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null}]' }}"></quick-panel>
@endsection

@section('body')

    <contact-listing
            :data="{{ $data->toJson() }}"
            :url="'{{ url('admin/projects') }}'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="w-100">
                    <div class="w-100" v-cloak>
                        <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                            <div class="kt-subheader__main">
                                <h3 class="kt-subheader__title">
                                    Contacts
                                </h3>
                                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                <div class="kt-subheader__group" id="kt_subheader_search">
											<span class="kt-subheader__desc" id="kt_subheader_total">
												@{{ pagination.state.total }} Total </span>
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
                            <div class="kt-subheader__toolbar col">
                                <a href="{{ url( 'admin/projects/create' )  }}" class="btn btn-label-brand btn-bold mr-3">Create New</a>
                                <div class="col-sm-auto form-group m-0 p-0">
                                    <select class="form-control" v-model="pagination.state.per_page">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- <form @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </form> --}}

                        <div class="kt-portlet">
                            <div class="kt-portlet__body kt-portlet__body--fit">
                                <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded">
                                    <table class="kt-datatable__table">
                                        <thead class="kt-datatable__head">
                                            <tr class="kt-datatable__row">
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Type</span>
                                                </th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Company Name</span></th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Primary Contact Name</span>
                                                </th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Primary Contact Status</span>
                                                </th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Source</span>
                                                </th>
                                                <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                    <span>Actions</span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="kt-datatable__body">
                                            <tr class="kt-datatable__row" v-for="(item, index) in collection">
                                                <td class="kt-datatable__cell">@{{ item.id }}</td>
                                                <td class="kt-datatable__cell">
                                                    <editable :on-update="updateRecord" :record-id="item.id" record-name="company_name" :text="item.company_name"></editable>
                                                </td>
                                                <td class="kt-datatable__cell">
                                                    <editable :on-update="updateRecord" :record-id="item.id" record-name="primary_contact_name" :text="item.primary_contact_name"></editable>
                                                </td>
                                                <td class="kt-datatable__cell">
                                                    <editable :on-update="updateRecord" :record-id="item.id" record-name="primary_contact_status" :text="item.primary_contact_status"></editable>
                                                </td>
                                                <td class="kt-datatable__cell">@{{ item.source || '-' }}</td>
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
                                                    {{-- <div class="row no-gutters">
                                                        <div class="col-auto">
                                                            <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                            <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}">
                                                                <i class="fa fa-trash-o"></i></button>
                                                        </form>
                                                    </div> --}}
                                                </td>
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
                                    <a class="btn btn-primary btn-spinner mt-3" href="{{ url('admin/projects/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.project.actions.create') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </contact-listing>

@endsection
