@extends('admin.layout.dashboard')

@section('title', trans('admin.contact.actions.index'))

@section( 'quick-panel' )
    <quick-panel :filters="{{ '[{"selected":false,"type":"dropdown","name":"contact_type","label":"Contact Type","options":["is","is not"],"selectedOption":null,"values":[{"label":"Lead","name":"lead"},{"label":"Prospect","name":"prospect"},{"label":"Client","name":"client"}],"selectedValue":null},{"selected":false,"type":"number","name":"contact_id","label":"Contact ID","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null},{"selected":false,"type":"text","name":"contact_name","label":"Contact Name","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null},{"selected":false,"type":"text","name":"company_name","label":"Company Name","options":["is equal to","is not equal to","contains","does not contain"],"selectedOption":null,"selectedValue":null}]' }}"></quick-panel>
@endsection

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
                        {{-- <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid mb-3 ml-0 mr-0 mt-0 shadow-none bg-transparent">
                            <div class="kt-portlet__head p-0">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Contacts
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                        <a @click.prevent="setTab( 'resource-create' )" :class="{ 'active' : isTabShowing( 'resource-create' ) }" class="btn btn-sm btn-brand" href="#" role="tab">
                                            Create New Contact
                                        </a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div v-cloak>
            <div v-show="isTabShowing( 'resource-index' )">
                <contact-listing
                    ref="resource_index"
                    :data="{{ json_encode($data) }}"
                    :url="'{{ url('admin/contacts') }}'"
                    inline-template>

                    <div class="row">
                        <div class="col">
                            <div class="w-100">
                                <div class="w-100" v-cloak>

                                    <!--begin::List Resource-->
                                    <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                        <div class="kt-subheader__main">
                                            <h3 class="kt-subheader__title">
                                                Contacts
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
                                                <div style="padding-left: 10px">
                                                    <multiselect v-model="filters[0]" :options="options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Search by ..." label="name" track-by="name" :preselect-first="false">
                                                    </multiselect>
                                                </div>
                                                <div style="padding-left: 10px">
                                                    <multiselect v-model="filters[1]" :options="project_status" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Project Stage" label="name" track-by="name" :preselect-first="false">
                                                    </multiselect>
                                                </div>
                                                <div style="padding-left: 15px">
                                                    <div>
                                                        <input v-model="filters[2]" type="checkbox" style="with: 15px" />
                                                        Does not contain
                                                    </div>
                                                </div>
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
                                                            <th is='sortable' :column="'id'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Contact ID</span></th>
                                                            <th is='sortable' :column="'type'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Type</span></th>
                                                            <th is='sortable' :column="'sales_persons'" class="kt-datatable__cell kt-datatable__cell--sort"><span>Salesperson(s)</span></th>
                                                            <th is='sortable' :column="'company_name'" class="kt-datatable__cell kt-datatable__cell--sort">
                                                                <span>Company Name</span></th>
                                                            <th is='sortable' :column="'primary_contact_name'" class="kt-datatable__cell kt-datatable__cell--sort">
                                                                <span>Primary Contact Name</span></th>
                                                            <th is='sortable' :column="'primary_contact_communication_preferences'" class="kt-datatable__cell kt-datatable__cell--sort">
                                                                <span>Primary Contact Comm. Preferences</span></th>
                                                            <th class="kt-datatable__cell"><span>Actions</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="kt-datatable__body">
                                                        <tr @click.prevent="$parent.editRecord(item.resource_url)" style="height: 50px;" class="kt-datatable__row" v-for="(item, index) in collection">
                                                            <td class="kt-datatable__cell"><span>@{{ item.id }}</span></td>
                                                            <td class="kt-datatable__cell"><span>@{{ item.type }}</span></td>
                                                            <td class="kt-datatable__cell">
                                                                <span v-if="item.sales_persons">
                                                                    <span v-for="(salesperson,index) in item.sales_persons">
                                                                        @{{ salesperson.full_name }}@{{ ( index + 1 ) !== item.sales_persons.length ? ',' : '' }}
                                                                    </span>
                                                                </span>
                                                            </td>
                                                            <td class="kt-datatable__cell">
                                                                <editable :on-update="$parent.updateRecord" :record-url="item.resource_url" record-name="company_name" :text="item.company_name"></editable>
                                                            </td>
                                                            <td class="kt-datatable__cell">
                                                                <editable :on-update="$parent.updateRecord" :record-url="item.resource_url" record-name="primary_contact_name" :text="item.primary_contact_name"></editable>
                                                            </td>
                                                            <td class="kt-datatable__cell"><span>@{{ item.primary_contact_communication_preferences ? item.primary_contact_communication_preferences.join( ', ' ) : 'Not Specified' }}</span>
                                                            </td>
                                                            <!--begin::Actions-->
                                                            <td class="kt-datatable__cell">
                                                                <span style="overflow: visible; position: relative; width: 80px;">
                                                                    {{-- <a class="mr-2" data-toggle="tooltip" title="View" @click.stop="$parent.viewRecord(item.resource_url)" href="#"><i class="flaticon2-checking"></i></a>
                                                                    <a class="mr-2" data-toggle="tooltip" title="Edit" @click.stop="$parent.editRecord(item.resource_url)" href="#"><i class="flaticon2-pen"></i></a> --}}
                                                                    <a class="mr-2" data-toggle="tooltip" title="Generate a new RFQ" @click.stop="$parent.fabActionGenerateNewRFQ(item.id)" href="#"><i class="flaticon-add"></i></a>
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
                                                <a class="btn btn-primary btn-spinner mt-3" href="#" @click.prevent="$parent.setTab( 'resource-create' )" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.contact.actions.create') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::List Resource-->

                                </div>
                            </div>
                        </div>
                    </div>
                </contact-listing>
            </div>

            <div v-if="isTabShowing( 'resource-create' )">

                <fab
                    v-if="!is_viewing"
                    :actions="is_creating?fabActions1:fabActions2"
                    bg-color="#4273FA"
                    main-icon="apps"
                    @save="fabActionSave"
                    @print_cc="fabActionPrintCC"
                    @new_rfq="fabActionGenerateNewRFQ"
                ></fab>

                <div class="row">
                    <div class="col">
                        <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                            <div class="kt-subheader__main">
                                <button @click.prevent="setTab( 'resource-index' )" type="button" class="btn btn-sm btn-upper" style="background: #edeff6">
                                    <i class="flaticon2-left-arrow-1 mr-0 pr-0"></i>
                                </button>
                                <h3 class="ml-3 kt-subheader__title">
                                    Back to contacts
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-0">
                        <contact-form
                            ref="resource_create"
                            :action="'{{ url('admin/contacts') }}'"
                            :active_record="this.active_record"
                            inline-template>
                            <form ref="form" class="form-horizontal form-create kt-form" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>
                                <fab
                                    v-if="$parent.is_viewing"
                                    :actions="$parent.fabActionsViewingMode"
                                    bg-color="#4273FA"
                                    main-icon="apps"
                                    @edit="$parent.fabActionEdit(form.resource_url)"
                                    @delete="$parent.fabActionDelete(form.resource_url)"
                                >
                                </fab>
                                @include('admin.contact.components.form-elements')
                            </form>

                        </contact-form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</resource-listing-form-combination>

@endsection
