<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <span v-if="$parent.active_record">
                    Editing @{{ form.name }}
                </span>
                <span v-else>
                    Create New Email Template
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
            <div class="mt-3 col-12" :class="{'has-danger': errors.has('header'), 'has-success': this.fields.header && this.fields.header.valid}">
                <label class="form-check-label" for="header">
                    {{ trans('admin.email-template.columns.header') }}
                </label>

                <vue-mce :config="config" v-model="form.header"/>
                <div v-if="errors.has('header')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('header') }}</div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="mt-3 col-12" :class="{'has-danger': errors.has('body'), 'has-success': this.fields.body && this.fields.body.valid}">
                <label class="form-check-label" for="body">
                    {{ trans('admin.email-template.columns.body') }}
                </label>

                <vue-mce :config="config" v-model="form.body" />
                <div v-if="errors.has('body')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('body') }}</div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="mt-3 col-12" :class="{'has-danger': errors.has('footer'), 'has-success': this.fields.footer && this.fields.footer.valid}">
                <label class="form-check-label" for="footer">
                    {{ trans('admin.email-template.columns.footer') }}
                </label>

                <vue-mce :config="config" v-model="form.footer"/>
                <div v-if="errors.has('footer')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('footer') }}</div>
            </div>
        </div>

    </div>

</div>

{{--<form-builder type="template"></form-builder>--}}
