@extends('admin.layout.dashboard')

@section('title', trans('admin.project.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">

            <project-form
                :action="'{{ url('admin/projects') }}'"
                :types="{{ json_encode( $project_types ) }}"
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.project.actions.create') }}
                    </div>

                    <div class="card-body">

                        @include('admin.project.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

            </project-form>

        </div>

    </div>

@endsection