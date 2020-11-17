@extends('admin.layout.dashboard')

@section('title', trans('admin.vendor.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">

            <vendor-form
                :action="'{{ url('admin/vendors') }}'"

                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.vendor.actions.create') }}
                    </div>

                    <div class="card-body">

                        @include('admin.vendor.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

            </vendor-form>

        </div>

    </div>

@endsection