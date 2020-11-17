@extends('admin.layout.dashboard')

@section('title', trans('admin.access-log.actions.edit', ['name' => $accessLog->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <access-log-form
                :action="'{{ $accessLog->resource_url }}'"
                :data="{{ $accessLog->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.access-log.actions.edit', ['name' => $accessLog->id]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.access-log.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </access-log-form>

    </div>

</div>

@endsection