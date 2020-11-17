@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.purchase-order.actions.index'))

@section('body')

    <purchase-order-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/purchase-orders') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.purchase-order.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/purchase-orders/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.purchase-order.actions.create') }}</a>
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

                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th class="bulk-checkbox">
                                        <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                        <label class="form-check-label" for="enabled">
                                            #
                                        </label>
                                    </th>

                                    <th is='sortable' :column="'id'">{{ trans('admin.purchase-order.columns.id') }}</th>
                                    <th is='sortable' :column="'project_id'">{{ trans('admin.purchase-order.columns.project_id') }}</th>
                                    <th is='sortable' :column="'type'">{{ trans('admin.purchase-order.columns.type') }}</th>
                                    <th is='sortable' :column="'vendor_id'">{{ trans('admin.purchase-order.columns.vendor_id') }}</th>
                                    <th is='sortable' :column="'contact_id'">{{ trans('admin.purchase-order.columns.contact_id') }}</th>
                                    <th is='sortable' :column="'sales_representative_id'">{{ trans('admin.purchase-order.columns.sales_representative_id') }}</th>
                                    <th is='sortable' :column="'approved_manager_id'">{{ trans('admin.purchase-order.columns.approved_manager_id') }}</th>
                                    <th is='sortable' :column="'approval_requested_by'">{{ trans('admin.purchase-order.columns.approval_requested_by') }}</th>
                                    <th is='sortable' :column="'template_type'">{{ trans('admin.purchase-order.columns.template_type') }}</th>
                                    <th is='sortable' :column="'title'">{{ trans('admin.purchase-order.columns.title') }}</th>
                                    <th is='sortable' :column="'quantity'">{{ trans('admin.purchase-order.columns.quantity') }}</th>
                                    <th is='sortable' :column="'trim_size'">{{ trans('admin.purchase-order.columns.trim_size') }}</th>
                                    <th is='sortable' :column="'information_requests'">{{ trans('admin.purchase-order.columns.information_requests') }}</th>
                                    <th is='sortable' :column="'extent'">{{ trans('admin.purchase-order.columns.extent') }}</th>
                                    <th is='sortable' :column="'origination'">{{ trans('admin.purchase-order.columns.origination') }}</th>
                                    <th is='sortable' :column="'finishing_information'">{{ trans('admin.purchase-order.columns.finishing_information') }}</th>
                                    <th is='sortable' :column="'packaging_information'">{{ trans('admin.purchase-order.columns.packaging_information') }}</th>
                                    <th is='sortable' :column="'vendor_notes'">{{ trans('admin.purchase-order.columns.vendor_notes') }}</th>
                                    <th is='sortable' :column="'customer_shipping_to'">{{ trans('admin.purchase-order.columns.customer_shipping_to') }}</th>
                                    <th is='sortable' :column="'remittance_id'">{{ trans('admin.purchase-order.columns.remittance_id') }}</th>
                                    <th is='sortable' :column="'payment_term_id'">{{ trans('admin.purchase-order.columns.payment_term_id') }}</th>
                                    <th is='sortable' :column="'fob_at'">{{ trans('admin.purchase-order.columns.fob_at') }}</th>
                                    <th is='sortable' :column="'materials_in_at'">{{ trans('admin.purchase-order.columns.materials_in_at') }}</th>
                                    <th is='sortable' :column="'delivery_at'">{{ trans('admin.purchase-order.columns.delivery_at') }}</th>
                                    <th is='sortable' :column="'approved_at'">{{ trans('admin.purchase-order.columns.approved_at') }}</th>

                                    <th></th>
                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="27">
                                        <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/purchase-orders')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                    href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                        <span class="pull-right pr-2">
                                            <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/purchase-orders/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                        </span>

                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                    <td class="bulk-checkbox">
                                        <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                        <label class="form-check-label" :for="'enabled' + item.id">
                                        </label>
                                    </td>

                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.project_id }}</td>
                                    <td>@{{ item.type }}</td>
                                    <td>@{{ item.vendor_id }}</td>
                                    <td>@{{ item.contact_id }}</td>
                                    <td>@{{ item.sales_representative_id }}</td>
                                    <td>@{{ item.approved_manager_id }}</td>
                                    <td>@{{ item.approval_requested_by }}</td>
                                    <td>@{{ item.template_type }}</td>
                                    <td>@{{ item.title }}</td>
                                    <td>@{{ item.quantity }}</td>
                                    <td>@{{ item.trim_size }}</td>
                                    <td>@{{ item.information_requests }}</td>
                                    <td>@{{ item.extent }}</td>
                                    <td>@{{ item.origination }}</td>
                                    <td>@{{ item.finishing_information }}</td>
                                    <td>@{{ item.packaging_information }}</td>
                                    <td>@{{ item.vendor_notes }}</td>
                                    <td>@{{ item.customer_shipping_to }}</td>
                                    <td>@{{ item.remittance_id }}</td>
                                    <td>@{{ item.payment_term_id }}</td>
                                    <td>@{{ item.fob_at | datetime }}</td>
                                    <td>@{{ item.materials_in_at | datetime }}</td>
                                    <td>@{{ item.delivery_at | datetime }}</td>
                                    <td>@{{ item.approved_at | datetime }}</td>
                                    
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

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
                            <a class="btn btn-primary btn-spinner" href="{{ url('admin/purchase-orders/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.purchase-order.actions.create') }}</a>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </purchase-order-listing>

@endsection