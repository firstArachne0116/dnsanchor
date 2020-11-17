@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.customer-category.actions.edit', ['name' => $customerCategory->name]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <customer-category-form
                :action="'{{ $customerCategory->resource_url }}'"
                :data="{{ $customerCategory->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.customer-category.actions.edit', ['name' => $customerCategory->name]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.customer-category.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </customer-category-form>

    </div>

</div>

@endsection