@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.project-type.actions.edit', ['name' => $projectType->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <project-type-form
                :action="'{{ $projectType->resource_url }}'"
                :data="{{ $projectType->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.project-type.actions.edit', ['name' => $projectType->id]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.project-type.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </project-type-form>

    </div>

</div>

@endsection