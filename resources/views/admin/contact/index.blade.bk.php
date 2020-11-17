@extends('admin.layout.dashboard')

@section('title', trans('admin.contact.actions.index'))

@section('body')
    <contact-listing
            :data="{{ $data->toJson() }}"
            :url="'{{ url('admin/contacts') }}'"
            inline-template>

        <div class="row">
            <vk-offcanvas-content>
                <vk-offcanvas flipped :show.sync="show_filters_pane">
                    <vk-offcanvas-close @click="show_filters_pane = false;"></vk-offcanvas-close>
                    <h3 class="font-weight-bold">Filter contacts by</h3>

                    <div class="input-group">
                        <multiselect v-model="filter_dropdown" :options="availableFilters" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Filters" label="label" track-by="name" :preselect-first="false">
                        </multiselect>

                        <span class="input-group-append"><button @click.prevent="addFilter" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Add Filter</button></span>

                    </div>
                    <div v-if="activeFilters.length > 0">
                        <hr>
                        <h4>Active Filters (@{{ activeFilters.length }} applied)</h4>
                        <div v-for="(filter, index) in activeFilters">
                            <label>@{{ filter.label }}</label>
                            <multiselect v-model="activeFilters[index].selectedOption" :options="activeFilters[index].options" :multiple="false" :close-on-select="true" :preselect-first="true"></multiselect>

                            <div v-if="activeFilters[index].type === 'dropdown'">
                                <multiselect @select="updateFilters" v-model="activeFilters[index].selectedValue" :options="activeFilters[index].values" label="label" track-by="name" :multiple="false" :close-on-select="true" :preselect-first="true"></multiselect>
                            </div>

                            <div v-else-if="activeFilters[index].type === 'number'">
                                <input class="form-control" type="number" @input="updateFilters" v-model="activeFilters[index].selectedValue">
                            </div>

                            <div v-else-if="activeFilters[index].type === 'text'">
                                <input class="form-control" type="text" @input="updateFilters" v-model="activeFilters[index].selectedValue">
                            </div>
                        </div>
                    </div>

                </vk-offcanvas>
            </vk-offcanvas-content>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.contact.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/contacts/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.contact.actions.create') }}
                        </a>
                        <a class="btn btn-primary mr-3 text-white btn-sm pull-right m-b-0" id="filters-btn" @click="show_filters_pane = true" role="button"><i class="fa fa-filter"></i>&nbsp; {{ trans('admin.contact.actions.filters') }}
                        </a>
                    </div>
                    <div class="card-body" v-cloak>
                        <form @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-auto form-group ">
                                    <select class="form-control" v-model="pagination.state.per_page">

                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                            </div>
                        </form>

                        <table v-if="!isLoading" class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Company Name</th>
                                    <th>Primary Contact Name</th>
                                    <th>Primary Contact Status</th>
                                    <th>Source</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection">
                                    <td>@{{ item.type }}</td>
                                    <td><editable :on-update="updateRecord" :record-id="item.id" record-name="company_name" :text="item.company_name"></editable></td>
                                    <td><editable :on-update="updateRecord" :record-id="item.id" record-name="primary_contact_name" :text="item.primary_contact_name"></editable></td>
                                    <td><editable :on-update="updateRecord" :record-id="item.id" record-name="primary_contact_status" :text="item.primary_contact_status"></editable></td>
                                    <td>@{{ item.source }}</td>
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}">
                                                    <i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else class="spinner mx-auto mt-5 mb-5">
                            <div class="shape shape-1"></div>
                            <div class="shape shape-2"></div>
                            <div class="shape shape-3"></div>
                            <div class="shape shape-4"></div>
                        </div>


                        <div class="row" v-if="pagination.state.total > 0">
                            <div class="col-sm">
                                <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                            </div>
                            <div class="col-sm-auto">
                                <pagination></pagination>
                            </div>
                        </div>

                        <div class="no-items-found" v-if="!collection.length > 0">
                            <i class="icon-magnifier"></i>
                            <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                            <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                            <a class="btn btn-primary btn-spinner" href="{{ url('admin/contacts/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.contact.actions.create') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </contact-listing>

@endsection