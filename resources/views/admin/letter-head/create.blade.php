@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.letter-head.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">

            <letter-head-form
                :action="'{{ url('admin/letter-heads') }}'"
                
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.letter-head.actions.create') }}
                    </div>

                    <div class="card-body">

                        @include('admin.letter-head.components.form-elements')
                        @include('brackets/admin-ui::admin.includes.media-uploader', [
                                                    'mediaCollection' => app(\App\Models\LetterHead::class)->getMediaCollection('letterhead'),
                                                    'label' => 'Letter Head Image'
                                                 ])
                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

            </letter-head-form>

        </div>

    </div>

@endsection