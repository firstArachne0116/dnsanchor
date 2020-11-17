@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.payment-term.actions.edit', ['name' => $paymentTerm->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <payment-term-form
                :action="'{{ $paymentTerm->resource_url }}'"
                :data="{{ $paymentTerm->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.payment-term.actions.edit', ['name' => $paymentTerm->id]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.payment-term.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </payment-term-form>

    </div>

</div>

@endsection