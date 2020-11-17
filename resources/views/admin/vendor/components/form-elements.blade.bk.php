<div class="col-6">
    <div class="" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid}">
        <label class="form-check-label" for="name">
            {{ trans('admin.vendor.columns.name') }}
        </label>

        <input type="text" v-model="form.name" v-validate="'required'" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid }" id="name" name="name" placeholder="{{ trans('admin.vendor.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>

   <div class="row">
       <div class="mt-3 col-6" :class="{'has-danger': errors.has('phone'), 'has-success': this.fields.phone && this.fields.phone.valid}">
           <label class="form-check-label" for="phone">
               {{ trans('admin.vendor.columns.phone') }}
           </label>

           <input type="tel" v-model="form.phone" v-validate="'required'" class="form-control" :class="{'form-control-danger': errors.has('phone'), 'form-control-success': this.fields.phone && this.fields.phone.valid }" id="phone" name="phone" placeholder="{{ trans('admin.vendor.columns.phone') }}">
           <div v-if="errors.has('phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('phone') }}</div>
       </div>

       <div class="mt-3 col-6" :class="{'has-danger': errors.has('website'), 'has-success': this.fields.website && this.fields.website.valid}">
           <label class="form-check-label" for="website">
               {{ trans('admin.vendor.columns.website') }}
           </label>

           <input type="tel" v-model="form.website" class="form-control" :class="{'form-control-danger': errors.has('website'), 'form-control-success': this.fields.website && this.fields.website.valid }" id="website" name="website" placeholder="{{ trans('admin.vendor.columns.website') }}">
           <div v-if="errors.has('website')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('website') }}</div>
       </div>
   </div>
</div>

<div class="col-12 col-md-6">
    <div class="" :class="{'has-danger': errors.has('assigned_salesperson'), 'has-success': this.fields.name && this.fields.assigned_salesperson.valid}">
        <label class="form-check-label" for="assigned_salesperson">
            {{ trans('admin.contact.columns.assigned_salesperson') }}
        </label>

        <multiselect v-model="form.assigned_salesperson" :options="sales_people" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Salesperson" label="name" track-by="name" :preselect-first="false">
            <template slot="selection" slot-scope="{ values, search, isOpen }">
                    <span class="multiselect__single" v-if="form.assigned_salesperson && form.assigned_salesperson.length && !isOpen">
                        <span v-for="(person, index) in form.assigned_salesperson">
                            <span>@{{person.name}}</span><span v-if="index+1 < form.assigned_salesperson.length">, </span>
                        </span>
                    </span>
            </template>
        </multiselect>
        <div v-if="errors.has('assigned_salesperson')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('assigned_salesperson') }}</div>
    </div>
</div>


<vk-tabs class="mt-4">
    <vk-tabs-item title="{{ trans('admin.contact.tabs.primary_contact') }}">
        <div class="container">
            <div class="row">
                <!-- Primary Contact Name -->
                <div class="col-12" :class="{'has-danger': errors.has('primary_contact_name'), 'has-success': this.fields.primary_contact_name && this.fields.primary_contact_name.valid}">
                    <label class="form-check-label" for="primary_contact_name">
                        {{ trans('admin.vendor.columns.primary_contact_name') }}
                    </label>

                    <input type="text" v-model="form.primary_contact_name" class="form-control" :class="{'form-control-danger': errors.has('primary_contact_name'), 'form-control-success': this.fields.primary_contact_name && this.fields.primary_contact_name.valid }" id="primary_contact_name" primary_contact_name="primary_contact_name" placeholder="{{ trans('admin.vendor.columns.primary_contact_name') }}">
                    <div v-if="errors.has('primary_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_name') }}</div>
                </div>

                <!-- Primary Contact Phone -->
                <div class="mt-3 col-6" :class="{'has-danger': errors.has('primary_contact_phone'), 'has-success': this.fields.primary_contact_phone && this.fields.primary_contact_phone.valid}">
                    <label class="form-check-label" for="primary_contact_phone">
                        {{ trans('admin.vendor.columns.primary_contact_phone') }}
                    </label>

                    <input type="text" v-model="form.primary_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('primary_contact_phone'), 'form-control-success': this.fields.primary_contact_phone && this.fields.primary_contact_phone.valid }" id="primary_contact_phone" primary_contact_phone="primary_contact_phone" placeholder="{{ trans('admin.vendor.columns.primary_contact_phone') }}">
                    <div v-if="errors.has('primary_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_phone') }}</div>
                </div>

                <!-- Primary Contact Phone -->
                <div class="mt-3 col-6" :class="{'has-danger': errors.has('primary_contact_email'), 'has-success': this.fields.primary_contact_email && this.fields.primary_contact_email.valid}">
                    <label class="form-check-label" for="primary_contact_email">
                        {{ trans('admin.vendor.columns.primary_contact_email') }}
                    </label>

                    <input type="text" v-model="form.primary_contact_email" class="form-control" :class="{'form-control-danger': errors.has('primary_contact_email'), 'form-control-success': this.fields.primary_contact_email && this.fields.primary_contact_email.valid }" id="primary_contact_email" primary_contact_email="primary_contact_email" placeholder="{{ trans('admin.vendor.columns.primary_contact_email') }}">
                    <div v-if="errors.has('primary_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_email') }}</div>
                </div>

                <!-- Primary Contact Address -->
                <div class="col-12 mt-3" :class="{'has-danger': errors.has('primary_contact_address'), 'has-success': this.fields.primary_contact_address && this.fields.primary_contact_address.valid}">
                    <label class="form-check-label" for="primary_contact_address">
                        {{ trans('admin.vendor.columns.primary_contact_address') }}
                    </label>

                    <textarea v-model="form.primary_contact_address" class="form-control" :class="{'form-control-danger': errors.has('primary_contact_address'), 'form-control-success': this.fields.primary_contact_address && this.fields.primary_contact_address.valid }" id="primary_contact_address" name="primary_contact_address" placeholder="{{ trans('admin.vendor.columns.primary_contact_address') }}"></textarea>
                    <div v-if="errors.has('primary_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_address') }}</div>
                </div>

            </div>
        </div>
    </vk-tabs-item>

    <vk-tabs-item title="{{ trans('admin.contact.tabs.sales_contact') }}">
        <div class="container">
            <div class="row">
                <!-- Primary Contact Name -->
                <div class="col-12" :class="{'has-danger': errors.has('sales_contact_name'), 'has-success': this.fields.sales_contact_name && this.fields.sales_contact_name.valid}">
                    <label class="form-check-label" for="sales_contact_name">
                        {{ trans('admin.vendor.columns.sales_contact_name') }}
                    </label>

                    <input type="text" v-model="form.sales_contact_name" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_name'), 'form-control-success': this.fields.sales_contact_name && this.fields.sales_contact_name.valid }" id="sales_contact_name" sales_contact_name="sales_contact_name" placeholder="{{ trans('admin.vendor.columns.sales_contact_name') }}">
                    <div v-if="errors.has('sales_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_name') }}</div>
                </div>

                <!-- Primary Contact Phone -->
                <div class="mt-3 col-6" :class="{'has-danger': errors.has('sales_contact_phone'), 'has-success': this.fields.sales_contact_phone && this.fields.sales_contact_phone.valid}">
                    <label class="form-check-label" for="sales_contact_phone">
                        {{ trans('admin.vendor.columns.sales_contact_phone') }}
                    </label>

                    <input type="text" v-model="form.sales_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_phone'), 'form-control-success': this.fields.sales_contact_phone && this.fields.sales_contact_phone.valid }" id="sales_contact_phone" sales_contact_phone="sales_contact_phone" placeholder="{{ trans('admin.vendor.columns.sales_contact_phone') }}">
                    <div v-if="errors.has('sales_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_phone') }}</div>
                </div>

                <!-- Primary Contact Phone -->
                <div class="mt-3 col-6" :class="{'has-danger': errors.has('sales_contact_email'), 'has-success': this.fields.sales_contact_email && this.fields.sales_contact_email.valid}">
                    <label class="form-check-label" for="sales_contact_email">
                        {{ trans('admin.vendor.columns.sales_contact_email') }}
                    </label>

                    <input type="text" v-model="form.sales_contact_email" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_email'), 'form-control-success': this.fields.sales_contact_email && this.fields.sales_contact_email.valid }" id="sales_contact_email" sales_contact_email="sales_contact_email" placeholder="{{ trans('admin.vendor.columns.sales_contact_email') }}">
                    <div v-if="errors.has('sales_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_email') }}</div>
                </div>

                <!-- Primary Contact Address -->
                <div class="col-12 mt-3" :class="{'has-danger': errors.has('sales_contact_address'), 'has-success': this.fields.sales_contact_address && this.fields.sales_contact_address.valid}">
                    <label class="form-check-label" for="sales_contact_address">
                        {{ trans('admin.vendor.columns.sales_contact_address') }}
                    </label>

                    <textarea v-model="form.sales_contact_address" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_address'), 'form-control-success': this.fields.sales_contact_address && this.fields.sales_contact_address.valid }" id="sales_contact_address" name="sales_contact_address" placeholder="{{ trans('admin.vendor.columns.sales_contact_address') }}"></textarea>
                    <div v-if="errors.has('sales_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_address') }}</div>
                </div>

            </div>
        </div>
    </vk-tabs-item>
    <vk-tabs-item title="{{ trans('admin.contact.tabs.design_contact') }}">
        <div class="container">
            <div class="row">
                <!-- Primary Contact Name -->
                <div class="col-12" :class="{'has-danger': errors.has('design_contact_name'), 'has-success': this.fields.design_contact_name && this.fields.design_contact_name.valid}">
                    <label class="form-check-label" for="design_contact_name">
                        {{ trans('admin.vendor.columns.design_contact_name') }}
                    </label>

                    <input type="text" v-model="form.design_contact_name" class="form-control" :class="{'form-control-danger': errors.has('design_contact_name'), 'form-control-success': this.fields.design_contact_name && this.fields.design_contact_name.valid }" id="design_contact_name" design_contact_name="design_contact_name" placeholder="{{ trans('admin.vendor.columns.design_contact_name') }}">
                    <div v-if="errors.has('design_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_name') }}</div>
                </div>

                <!-- Primary Contact Phone -->
                <div class="mt-3 col-6" :class="{'has-danger': errors.has('design_contact_phone'), 'has-success': this.fields.design_contact_phone && this.fields.design_contact_phone.valid}">
                    <label class="form-check-label" for="design_contact_phone">
                        {{ trans('admin.vendor.columns.design_contact_phone') }}
                    </label>

                    <input type="text" v-model="form.design_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('design_contact_phone'), 'form-control-success': this.fields.design_contact_phone && this.fields.design_contact_phone.valid }" id="design_contact_phone" design_contact_phone="design_contact_phone" placeholder="{{ trans('admin.vendor.columns.design_contact_phone') }}">
                    <div v-if="errors.has('design_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_phone') }}</div>
                </div>

                <!-- Primary Contact Phone -->
                <div class="mt-3 col-6" :class="{'has-danger': errors.has('design_contact_email'), 'has-success': this.fields.design_contact_email && this.fields.design_contact_email.valid}">
                    <label class="form-check-label" for="design_contact_email">
                        {{ trans('admin.vendor.columns.design_contact_email') }}
                    </label>

                    <input type="text" v-model="form.design_contact_email" class="form-control" :class="{'form-control-danger': errors.has('design_contact_email'), 'form-control-success': this.fields.design_contact_email && this.fields.design_contact_email.valid }" id="design_contact_email" design_contact_email="design_contact_email" placeholder="{{ trans('admin.vendor.columns.design_contact_email') }}">
                    <div v-if="errors.has('design_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_email') }}</div>
                </div>

                <!-- Primary Contact Address -->
                <div class="col-12 mt-3" :class="{'has-danger': errors.has('design_contact_address'), 'has-success': this.fields.design_contact_address && this.fields.design_contact_address.valid}">
                    <label class="form-check-label" for="design_contact_address">
                        {{ trans('admin.vendor.columns.design_contact_address') }}
                    </label>

                    <textarea v-model="form.design_contact_address" class="form-control" :class="{'form-control-danger': errors.has('design_contact_address'), 'form-control-success': this.fields.design_contact_address && this.fields.design_contact_address.valid }" id="design_contact_address" name="design_contact_address" placeholder="{{ trans('admin.vendor.columns.design_contact_address') }}"></textarea>
                    <div v-if="errors.has('design_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_address') }}</div>
                </div>

            </div>
        </div>
    </vk-tabs-item>
    <vk-tabs-item title="{{ trans('admin.contact.tabs.financial_contact') }}">
        <div class="container">
            <div class="row">
                <!-- Primary Contact Name -->
                <div class="col-12" :class="{'has-danger': errors.has('financial_contact_name'), 'has-success': this.fields.financial_contact_name && this.fields.financial_contact_name.valid}">
                    <label class="form-check-label" for="financial_contact_name">
                        {{ trans('admin.vendor.columns.financial_contact_name') }}
                    </label>

                    <input type="text" v-model="form.financial_contact_name" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_name'), 'form-control-success': this.fields.financial_contact_name && this.fields.financial_contact_name.valid }" id="financial_contact_name" financial_contact_name="financial_contact_name" placeholder="{{ trans('admin.vendor.columns.financial_contact_name') }}">
                    <div v-if="errors.has('financial_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_name') }}</div>
                </div>

                <!-- Primary Contact Phone -->
                <div class="mt-3 col-6" :class="{'has-danger': errors.has('financial_contact_phone'), 'has-success': this.fields.financial_contact_phone && this.fields.financial_contact_phone.valid}">
                    <label class="form-check-label" for="financial_contact_phone">
                        {{ trans('admin.vendor.columns.financial_contact_phone') }}
                    </label>

                    <input type="text" v-model="form.financial_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_phone'), 'form-control-success': this.fields.financial_contact_phone && this.fields.financial_contact_phone.valid }" id="financial_contact_phone" financial_contact_phone="financial_contact_phone" placeholder="{{ trans('admin.vendor.columns.financial_contact_phone') }}">
                    <div v-if="errors.has('financial_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_phone') }}</div>
                </div>

                <!-- Primary Contact Phone -->
                <div class="mt-3 col-6" :class="{'has-danger': errors.has('financial_contact_email'), 'has-success': this.fields.financial_contact_email && this.fields.financial_contact_email.valid}">
                    <label class="form-check-label" for="financial_contact_email">
                        {{ trans('admin.vendor.columns.financial_contact_email') }}
                    </label>

                    <input type="text" v-model="form.financial_contact_email" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_email'), 'form-control-success': this.fields.financial_contact_email && this.fields.financial_contact_email.valid }" id="financial_contact_email" financial_contact_email="financial_contact_email" placeholder="{{ trans('admin.vendor.columns.financial_contact_email') }}">
                    <div v-if="errors.has('financial_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_email') }}</div>
                </div>

                <!-- Primary Contact Address -->
                <div class="col-12 mt-3" :class="{'has-danger': errors.has('financial_contact_address'), 'has-success': this.fields.financial_contact_address && this.fields.financial_contact_address.valid}">
                    <label class="form-check-label" for="financial_contact_address">
                        {{ trans('admin.vendor.columns.financial_contact_address') }}
                    </label>

                    <textarea v-model="form.financial_contact_address" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_address'), 'form-control-success': this.fields.financial_contact_address && this.fields.financial_contact_address.valid }" id="financial_contact_address" name="financial_contact_address" placeholder="{{ trans('admin.vendor.columns.financial_contact_address') }}"></textarea>
                    <div v-if="errors.has('financial_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_address') }}</div>
                </div>

            </div>
        </div>
    </vk-tabs-item>
</vk-tabs>