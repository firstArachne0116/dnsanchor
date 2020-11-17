@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.purchase-order.actions.edit', ['name' => $purchaseOrder->title]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <purchase-order-form
                :action="'{{ $purchaseOrder->resource_url }}'"
                :data="{{ $purchaseOrder->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.purchase-order.actions.edit', ['name' => $purchaseOrder->title]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.purchase-order.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </purchase-order-form>

        </div>
    
</div>

@endsection