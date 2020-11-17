<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <span v-if="$parent.active_record">
                    Editing @{{ form.name }}
                </span>
                <span v-else>
                    Create New Payment Term
                </span>
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <div class="kt-portlet__body">
        <div class="form-group col-12" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid}">
            <label class="form-check-label" for="name">
                {{ trans('admin.customer-category.columns.name') }}
            </label>

            <input type="text" :disabled="$parent.is_viewing" v-model="form.name" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid }" id="name" name="name" placeholder="{{ trans('admin.customer-category.columns.name') }}">
            <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
        </div>


        <div class="form-group row" :class="{'has-danger': errors.has('default'), 'has-success': this.fields.default && this.fields.default.valid }">
            <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
                <label class="kt-checkbox">
                    <input id="default" type="checkbox" v-model="form.default" v-validate="''" data-vv-name="default" name="default_fake_element"> {{ trans('admin.remittance-info.columns.default') }}
                    <span></span>
                </label>

                <div v-if="errors.has('default')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('default') }}</div>
            </div>
        </div>

    </div>
</div>