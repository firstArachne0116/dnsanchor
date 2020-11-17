@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.vendor-category.actions.edit', ['name' => $vendorCategory->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <vendor-category-form
                :action="'{{ $vendorCategory->resource_url }}'"
                :data="{{ $vendorCategory->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.vendor-category.actions.edit', ['name' => $vendorCategory->id]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.vendor-category.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </vendor-category-form>

    </div>

</div>

@endsection