@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.letter-head.actions.edit', ['name' => $letterHead->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <letter-head-form
                    :action="'{{ $letterHead->resource_url }}'"
                    :data="{{ $letterHead->toJson() }}"
                    inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.letter-head.actions.edit', ['name' => $letterHead->id]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.letter-head.components.form-elements')

                        @include('brackets/admin-ui::admin.includes.media-uploader', [
                            'mediaCollection' => app(\App\Models\LetterHead::class)->getMediaCollection('letterhead'),
                            'media' => $letterHead->getThumbs200ForCollection('letterhead'),
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