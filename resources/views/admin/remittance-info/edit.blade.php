@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.remittance-info.actions.edit', ['name' => $remittanceInfo->name]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <remittance-info-form
                :action="'{{ $remittanceInfo->resource_url }}'"
                :data="{{ $remittanceInfo->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.remittance-info.actions.edit', ['name' => $remittanceInfo->name]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.remittance-info.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </remittance-info-form>

    </div>

</div>

@endsection