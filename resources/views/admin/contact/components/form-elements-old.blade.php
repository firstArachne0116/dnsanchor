<div class="row">
    <div class="col-12 col-md-6">
        <div class="" :class="{'has-danger': errors.has('type'), 'has-success': this.fields.type && this.fields.type.valid}">
            <label class="form-check-label" for="type">
                {{ trans('admin.contact.columns.contact_type') }}
            </label>

            <multiselect v-model="form.type" :options="options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Client Type" label="name" track-by="name" :preselect-first="false">
                <template slot="selection" slot-scope="{ values, search, isOpen }">
                    <span class="multiselect__single" v-if="form.type && form.type.length && !isOpen">@{{ form.type.length }} options selected</span>
                </template>
            </multiselect>
            <div v-if="errors.has('type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type') }}</div>
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

    <!-- Contact Source -->
    <div class="col-12 col-md-6 mt-3">
        <div class="" :class="{'has-danger': errors.has('source'), 'has-success': this.fields.source && this.fields.source.valid}">
            <label class="form-check-label" for="source">
                {{ trans('admin.contact.columns.source') }}
            </label>

            <multiselect v-model="form.source" :options="source_options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Source" label="name" track-by="name" :preselect-first="false">
                <template slot="selection" slot-scope="{ values, search, isOpen }">
                    <span class="multiselect__single" v-if="form.source && form.source.length && !isOpen">@{{ form.source.length }} options selected</span>
                </template>
            </multiselect>
            <div v-if="errors.has('source')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('source') }}</div>
        </div>
    </div>

    <!-- Referred By -->
    <div class="col-12 col-md-6 mt-3">
        <div class="" :class="{'has-danger': errors.has('referred_by'), 'has-success': this.fields.referred_by && this.fields.referred_by.valid}">
            <label class="form-check-label" for="referred_by">
                {{ trans('admin.contact.columns.referred_by') }}
            </label>

            <multiselect v-model="form.referred_by" :options="contacts" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="referred_by" label="name" track-by="name" :preselect-first="false">
                <template slot="selection" slot-scope="{ values, search, isOpen }">
                    <span class="multiselect__single" v-if="form.referred_by && form.referred_by.length && !isOpen">
                        <span v-for="(contact, index) in form.referred_by">
                            <span>@{{contact.name}}</span><span v-if="index+1 < form.referred_by.length">, </span>
                        </span></span>
                </template>
            </multiselect>
            <div v-if="errors.has('referred_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('referred_by') }}</div>
        </div>
    </div>

</div>

<!-- S -->
<div class="row mt-3 card-header">
    <i style="line-height:1.5;" class="fa fa-user-circle-o"></i>
    {{ trans('admin.contact.labels.contact_details') }}
</div>
<div class="row">
    <!-- Company Name -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('company_name'), 'has-success': this.fields.company_name && this.fields.company_name.valid}">
        <label class="form-check-label" for="company_name">
            {{ trans('admin.vendor.columns.company_name') }}
        </label>

        <input type="text" v-model="form.company_name" class="form-control" :class="{'form-control-danger': errors.has('company_name'), 'form-control-success': this.fields.company_name && this.fields.company_name.valid }" id="company_name" name="company_name" placeholder="{{ trans('admin.vendor.columns.company_name') }}">
        <div v-if="errors.has('company_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('company_name') }}</div>
    </div>

    <!-- Company Phone -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('company_phone'), 'has-success': this.fields.company_phone && this.fields.company_phone.valid}">
        <label class="form-check-label" for="company_phone">
            {{ trans('admin.vendor.columns.company_phone') }}
        </label>

        <input type="text" v-model="form.company_phone" class="form-control" :class="{'form-control-danger': errors.has('company_phone'), 'form-control-success': this.fields.company_phone && this.fields.company_phone.valid }" id="company_phone" name="company_phone" placeholder="{{ trans('admin.vendor.columns.company_phone') }}">
        <div v-if="errors.has('company_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('company_phone') }}</div>
    </div>

    <!-- Company Address -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('company_address'), 'has-success': this.fields.company_address && this.fields.company_address.valid}">
        <label class="form-check-label" for="company_address">
            {{ trans('admin.vendor.columns.company_address') }}
        </label>

        <textarea v-model="form.company_address" class="form-control" :class="{'form-control-danger': errors.has('company_address'), 'form-control-success': this.fields.company_address && this.fields.company_address.valid }" id="company_address" name="company_address" placeholder="{{ trans('admin.vendor.columns.company_address') }}"></textarea>
        <div v-if="errors.has('company_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('company_address') }}</div>
    </div>

    <!-- Shipping Address -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('shipping_address'), 'has-success': this.fields.shipping_address && this.fields.shipping_address.valid}">
        <label class="form-check-label" for="shipping_address">
            {{ trans('admin.vendor.columns.shipping_address') }}
        </label>

        <textarea v-model="form.shipping_address" class="form-control" :class="{'form-control-danger': errors.has('shipping_address'), 'form-control-success': this.fields.shipping_address && this.fields.shipping_address.valid }" id="shipping_address" name="shipping_address" placeholder="{{ trans('admin.vendor.columns.shipping_address') }}"></textarea>
        <div v-if="errors.has('shipping_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_address') }}</div>
    </div>
</div>

<!-- Social Media -->
<div class="row mt-3 card-header">
    <i style="line-height:1.5;" class="fa fa-facebook"></i>
    {{ trans('admin.contact.labels.social_media') }}
</div>
<div class="row">
    <!-- Facebook -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('facebook'), 'has-success': this.fields.facebook && this.fields.facebook.valid}">
        <label class="form-check-label" for="facebook">
            {{ trans('admin.vendor.columns.facebook') }}
        </label>

        <div class="input-group">
            <div class="input-group-append">
                <span class="bg-transparent border-0 input-group-text"><i style="font-size:24px;" class="fa fa-facebook-official"></i></span>
            </div>
            <input type="text" v-model="form.facebook" class="form-control" :class="{'form-control-danger': errors.has('facebook'), 'form-control-success': this.fields.facebook && this.fields.facebook.valid }" id="facebook" name="facebook" placeholder="{{ trans('admin.vendor.columns.facebook') }}">
        </div>
        <div v-if="errors.has('facebook')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('facebook') }}</div>
    </div>

    <!-- Facebook -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('twitter'), 'has-success': this.fields.twitter && this.fields.twitter.valid}">
        <label class="form-check-label" for="twitter">
            {{ trans('admin.vendor.columns.twitter') }}
        </label>

        <div class="input-group">
            <div class="input-group-append">
                <span class="bg-transparent border-0 input-group-text"><i style="font-size:24px;" class="fa fa-twitter-square"></i></span>
            </div>
            <input type="text" v-model="form.twitter" class="form-control" :class="{'form-control-danger': errors.has('twitter'), 'form-control-success': this.fields.twitter && this.fields.twitter.valid }" id="twitter" name="twitter" placeholder="{{ trans('admin.vendor.columns.twitter') }}">
        </div>
        <div v-if="errors.has('twitter')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('twitter') }}</div>
    </div>

    <!-- Instagram -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('instagram'), 'has-success': this.fields.instagram && this.fields.instagram.valid}">
        <label class="form-check-label" for="instagram">
            {{ trans('admin.vendor.columns.instagram') }}
        </label>

        <div class="input-group">
            <div class="input-group-append">
                <span class="bg-transparent border-0 input-group-text"><i style="font-size:24px;" class="fa fa-instagram"></i></span>
            </div>
            <input type="text" v-model="form.instagram" class="form-control" :class="{'form-control-danger': errors.has('instagram'), 'form-control-success': this.fields.instagram && this.fields.instagram.valid }" id="instagram" name="instagram" placeholder="{{ trans('admin.vendor.columns.instagram') }}">
        </div>
        <div v-if="errors.has('instagram')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('instagram') }}</div>
    </div>

    <!-- Youtube -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('youtube'), 'has-success': this.fields.youtube && this.fields.youtube.valid}">
        <label class="form-check-label" for="youtube">
            {{ trans('admin.vendor.columns.youtube') }}
        </label>

        <div class="input-group">
            <div class="input-group-append">
                <span class="bg-transparent border-0 input-group-text"><i style="font-size:24px;" class="fa fa-youtube"></i></span>
            </div>
            <input type="text" v-model="form.youtube" class="form-control" :class="{'form-control-danger': errors.has('youtube'), 'form-control-success': this.fields.youtube && this.fields.youtube.valid }" id="youtube" name="youtube" placeholder="{{ trans('admin.vendor.columns.youtube') }}">
        </div>
        <div v-if="errors.has('youtube')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('youtube') }}</div>
    </div>
</div>

<div class="row mt-3 card-header"></div>

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