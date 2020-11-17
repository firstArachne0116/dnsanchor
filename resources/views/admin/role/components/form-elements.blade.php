<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <span v-if="$parent.active_record">
                    Editing @{{ form.name }}
                </span>
                <span v-else>
                    Create New Role
                </span>
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <div class="kt-portlet__body">
        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
            <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.role.columns.name') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.role.columns.name') }}">
                <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
            </div>
        </div>

{{--        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('guard_name'), 'has-success': this.fields.guard_name && this.fields.guard_name.valid }">--}}
{{--            <label for="guard_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.role.columns.guard_name') }}</label>--}}
{{--            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
{{--                <input type="text" v-model="form.guard_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('guard_name'), 'form-control-success': this.fields.guard_name && this.fields.guard_name.valid}" id="guard_name" name="guard_name" placeholder="{{ trans('admin.role.columns.guard_name') }}">--}}
{{--                <div v-if="errors.has('guard_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('guard_name') }}</div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="form-group row ">
            <label class="col-form-label text-md-right col-md-2">{{ trans( 'admin.role.columns.permissions') }}</label>

            <div class="col-md-10">
                <div v-for="permission in permissions" :key="permission.id">
                    <label class="kt-checkbox">
                        <input v-model="form.permission_ids" :id="'permission' + permission.id" :value="permission.id" type="checkbox"> @{{ permission.name }}
                        <span></span>
                    </label>
                </div>
            </div>
        </div>

    </div>
</div>