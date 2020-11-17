@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.project-invoice.actions.edit', ['name' => $projectInvoice->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <project-invoice-form
                :action="'{{ $projectInvoice->resource_url }}'"
                :data="{{ $projectInvoice->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.project-invoice.actions.edit', ['name' => $projectInvoice->id]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.project-invoice.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </project-invoice-form>

    </div>

</div>

@endsection