<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <span v-if="$parent.active_record">
                    Viewing @{{ form.name }}
                </span>
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <div class="kt-portlet__body">
        <div class="col-12 form-group" :class="{'has-danger': errors.has('status'), 'has-success': this.fields.status && this.fields.status.valid}">
            <label class="form-check-label" for="status">
                Status
            </label>

            <input type="text" :disabled="$parent.is_viewing" v-model="form.status" class="form-control" :class="{'form-control-danger': errors.has('status'), 'form-control-success': this.fields.status && this.fields.status.valid }" id="status" name="status" placeholder="Status">
            <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
        </div>
        
        <div class="col-12 form-group" :class="{'has-danger': errors.has('username'), 'has-success': this.fields.username && this.fields.username.valid}">
            <label class="form-check-label" for="username">
                Username
            </label>

            <input type="text" :disabled="$parent.is_viewing" v-model="form.username" class="form-control" :class="{'form-control-danger': errors.has('username'), 'form-control-success': this.fields.username && this.fields.username.valid }" id="username" name="username" placeholder="Username">
            <div v-if="errors.has('username')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('username') }}</div>
        </div>
        
        <div class="col-12 form-group" :class="{'has-danger': errors.has('url'), 'has-success': this.fields.url && this.fields.url.valid}">
            <label class="form-check-label" for="url">
                URL
            </label>

            <input type="text" :disabled="$parent.is_viewing" v-model="form.url" class="form-control" :class="{'form-control-danger': errors.has('url'), 'form-control-success': this.fields.url && this.fields.url.valid }" id="url" name="url" placeholder="URL">
            <div v-if="errors.has('url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('url') }}</div>
        </div>
        
        <div class="col-12 form-group" :class="{'has-danger': errors.has('ip_address'), 'has-success': this.fields.ip_address && this.fields.ip_address.valid}">
            <label class="form-check-label" for="ip_address">
                IP Address
            </label>
 
            <input type="text" :disabled="$parent.is_viewing" v-model="form.ip_address" class="form-control" :class="{'form-control-danger': errors.has('ip_address'), 'form-control-success': this.fields.ip_address && this.fields.ip_address.valid }" id="ip_address" name="ip_address" placeholder="IP Address">
            <div v-if="errors.has('ip_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ip_address') }}</div>
        </div>
        
        <div class="col-12 form-group-last" :class="{'has-danger': errors.has('user_agent'), 'has-success': this.fields.user_agent && this.fields.user_agent.valid}">
            <label class="form-check-label" for="user_agent">
               User Agent
            </label>

            <input type="text" :disabled="$parent.is_viewing" v-model="form.user_agent" class="form-control" :class="{'form-control-danger': errors.has('user_agent'), 'form-control-success': this.fields.user_agent && this.fields.user_agent.valid }" id="user_agent" name="user_agent" placeholder="User Agent">
            <div v-if="errors.has('user_agent')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_agent') }}</div>
        </div>
    </div>
</div>