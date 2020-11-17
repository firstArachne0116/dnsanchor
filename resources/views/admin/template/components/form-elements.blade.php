<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <span v-if="$parent.active_record">
                    Editing @{{ form.name }}
                </span>
                <span v-else>
                    Create New Template
                </span>
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <div class="kt-portlet__body">
        <div class="row">
            <div class="mt-3 col-12" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid}">
                <label class="form-check-label" for="name">
                    {{ trans('admin.email-template.columns.name') }}
                </label>

                <input type="text" v-model="form.name" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid }" id="name" name="name" placeholder="{{ trans('admin.project.columns.name') }}">
                <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
            </div>
        </div>

        <div class="row">
            <div class="mt-3 col-12" :class="{'has-danger': errors.has('content'), 'has-success': this.fields.content && this.fields.content.valid}">
                <label class="form-check-label" for="content">
                    {{ trans('admin.email-template.columns.content') }}
                </label>

                <vue-mce :config="config" v-model="form.content"/>
                <div v-if="errors.has('content')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('content') }}</div>
            </div>
        </div>

    </div>

</div>

{{--<form-builder type="template"></form-builder>--}}
