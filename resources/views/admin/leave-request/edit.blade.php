@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.leave-request.actions.edit', ['name' => $leaveRequest->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <leave-request-form
                :action="'{{ $leaveRequest->resource_url }}'"
                :data="{{ $leaveRequest->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.leave-request.actions.edit', ['name' => $leaveRequest->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.leave-request.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </leave-request-form>

        </div>
    
</div>

@endsection