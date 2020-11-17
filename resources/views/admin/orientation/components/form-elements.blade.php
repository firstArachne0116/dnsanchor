<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <span v-if="$parent.active_record">
                    Editing @{{ form.name }}
                </span>
                <span v-else>
                    Create New Orientation
                </span>
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <div class="kt-portlet__body">
        <div class="col-12" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid}">
            <label class="form-check-label" for="name">
                {{ trans('admin.orientation-category.columns.name') }}
            </label>

            <input type="text" :disabled="$parent.is_viewing" v-model="form.name" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid }" id="name" name="name" placeholder="{{ trans('admin.orientation-category.columns.name') }}">
            <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
        </div>
    </div>
</div>