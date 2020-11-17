@extends('admin.layout.dashboard')

@section('title', trans('admin.contact.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">

            <contact-form
                :action="'{{ url('admin/contacts') }}'"
                
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.contact.actions.create') }}
                    </div>

                    <div class="card-body">

                        @include('admin.contact.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

            </contact-form>

        </div>

    </div>

@endsection