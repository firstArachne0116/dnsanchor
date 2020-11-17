@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.template.actions.edit', ['name' => $template->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <template-form
                :action="'{{ $template->resource_url }}'"
                :data="{{ $template->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.template.actions.edit', ['name' => $template->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.template.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </template-form>

        </div>
    
</div>

@endsection