@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.timesheet.actions.edit', ['name' => $timesheet->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <timesheet-form
                :action="'{{ $timesheet->resource_url }}'"
                :data="{{ $timesheet->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.timesheet.actions.edit', ['name' => $timesheet->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.timesheet.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </timesheet-form>

        </div>
    
</div>

@endsection