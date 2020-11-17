<div class="form-group row align-items-center" :class="{'has-danger': errors.has('project_id'), 'has-success': this.fields.project_id && this.fields.project_id.valid }">
    <label for="project_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.project_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.project_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('project_id'), 'form-control-success': this.fields.project_id && this.fields.project_id.valid}" id="project_id" name="project_id" placeholder="{{ trans('admin.purchase-order.columns.project_id') }}">
        <div v-if="errors.has('project_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('project_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('origination'), 'has-success': this.fields.origination && this.fields.origination.valid }">
    <label for="origination" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.origination') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.origination" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('origination'), 'form-control-success': this.fields.origination && this.fields.origination.valid}" id="origination" name="origination" placeholder="{{ trans('admin.purchase-order.columns.origination') }}">
        <div v-if="errors.has('origination')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('origination') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('delivery_at'), 'has-success': this.fields.delivery_at && this.fields.delivery_at.valid }">
    <label for="delivery_at" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.delivery_at') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.delivery_at" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('delivery_at'), 'form-control-success': this.fields.delivery_at && this.fields.delivery_at.valid}" id="delivery_at" name="delivery_at" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('delivery_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('delivery_at') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('materials_in_at'), 'has-success': this.fields.materials_in_at && this.fields.materials_in_at.valid }">
    <label for="materials_in_at" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.materials_in_at') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.materials_in_at" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('materials_in_at'), 'form-control-success': this.fields.materials_in_at && this.fields.materials_in_at.valid}" id="materials_in_at" name="materials_in_at" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('materials_in_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('materials_in_at') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('fob_at'), 'has-success': this.fields.fob_at && this.fields.fob_at.valid }">
    <label for="fob_at" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.fob_at') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.fob_at" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('fob_at'), 'form-control-success': this.fields.fob_at && this.fields.fob_at.valid}" id="fob_at" name="fob_at" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('fob_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fob_at') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('payment_term_id'), 'has-success': this.fields.payment_term_id && this.fields.payment_term_id.valid }">
    <label for="payment_term_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.payment_term_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.payment_term_id" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('payment_term_id'), 'form-control-success': this.fields.payment_term_id && this.fields.payment_term_id.valid}" id="payment_term_id" name="payment_term_id" placeholder="{{ trans('admin.purchase-order.columns.payment_term_id') }}">
        <div v-if="errors.has('payment_term_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('payment_term_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('remittance_id'), 'has-success': this.fields.remittance_id && this.fields.remittance_id.valid }">
    <label for="remittance_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.remittance_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.remittance_id" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('remittance_id'), 'form-control-success': this.fields.remittance_id && this.fields.remittance_id.valid}" id="remittance_id" name="remittance_id" placeholder="{{ trans('admin.purchase-order.columns.remittance_id') }}">
        <div v-if="errors.has('remittance_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remittance_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('additional_comments'), 'has-success': this.fields.additional_comments && this.fields.additional_comments.valid }">
    <label for="additional_comments" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.additional_comments') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.additional_comments" v-validate="''" id="additional_comments" name="additional_comments" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('additional_comments')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('additional_comments') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_shipping_to'), 'has-success': this.fields.customer_shipping_to && this.fields.customer_shipping_to.valid }">
    <label for="customer_shipping_to" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.customer_shipping_to') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.customer_shipping_to" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_shipping_to'), 'form-control-success': this.fields.customer_shipping_to && this.fields.customer_shipping_to.valid}" id="customer_shipping_to" name="customer_shipping_to" placeholder="{{ trans('admin.purchase-order.columns.customer_shipping_to') }}">
        <div v-if="errors.has('customer_shipping_to')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_shipping_to') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('vendor_notes'), 'has-success': this.fields.vendor_notes && this.fields.vendor_notes.valid }">
    <label for="vendor_notes" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.vendor_notes') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.vendor_notes" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('vendor_notes'), 'form-control-success': this.fields.vendor_notes && this.fields.vendor_notes.valid}" id="vendor_notes" name="vendor_notes" placeholder="{{ trans('admin.purchase-order.columns.vendor_notes') }}">
        <div v-if="errors.has('vendor_notes')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('vendor_notes') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('packaging_information'), 'has-success': this.fields.packaging_information && this.fields.packaging_information.valid }">
    <label for="packaging_information" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.packaging_information') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.packaging_information" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('packaging_information'), 'form-control-success': this.fields.packaging_information && this.fields.packaging_information.valid}" id="packaging_information" name="packaging_information" placeholder="{{ trans('admin.purchase-order.columns.packaging_information') }}">
        <div v-if="errors.has('packaging_information')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('packaging_information') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('finishing_information'), 'has-success': this.fields.finishing_information && this.fields.finishing_information.valid }">
    <label for="finishing_information" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.finishing_information') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.finishing_information" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('finishing_information'), 'form-control-success': this.fields.finishing_information && this.fields.finishing_information.valid}" id="finishing_information" name="finishing_information" placeholder="{{ trans('admin.purchase-order.columns.finishing_information') }}">
        <div v-if="errors.has('finishing_information')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('finishing_information') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('extent'), 'has-success': this.fields.extent && this.fields.extent.valid }">
    <label for="extent" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.extent') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.extent" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('extent'), 'form-control-success': this.fields.extent && this.fields.extent.valid}" id="extent" name="extent" placeholder="{{ trans('admin.purchase-order.columns.extent') }}">
        <div v-if="errors.has('extent')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('extent') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('type'), 'has-success': this.fields.type && this.fields.type.valid }">
    <label for="type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.type" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('type'), 'form-control-success': this.fields.type && this.fields.type.valid}" id="type" name="type" placeholder="{{ trans('admin.purchase-order.columns.type') }}">
        <div v-if="errors.has('type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('information_requests'), 'has-success': this.fields.information_requests && this.fields.information_requests.valid }">
    <label for="information_requests" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.information_requests') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.information_requests" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('information_requests'), 'form-control-success': this.fields.information_requests && this.fields.information_requests.valid}" id="information_requests" name="information_requests" placeholder="{{ trans('admin.purchase-order.columns.information_requests') }}">
        <div v-if="errors.has('information_requests')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('information_requests') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('trim_size'), 'has-success': this.fields.trim_size && this.fields.trim_size.valid }">
    <label for="trim_size" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.trim_size') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.trim_size" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('trim_size'), 'form-control-success': this.fields.trim_size && this.fields.trim_size.valid}" id="trim_size" name="trim_size" placeholder="{{ trans('admin.purchase-order.columns.trim_size') }}">
        <div v-if="errors.has('trim_size')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('trim_size') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid }">
    <label for="quantity" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.quantity') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.quantity" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid}" id="quantity" name="quantity" placeholder="{{ trans('admin.purchase-order.columns.quantity') }}">
        <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': this.fields.title && this.fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': this.fields.title && this.fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.purchase-order.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('template_type'), 'has-success': this.fields.template_type && this.fields.template_type.valid }">
    <label for="template_type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.template_type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.template_type" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('template_type'), 'form-control-success': this.fields.template_type && this.fields.template_type.valid}" id="template_type" name="template_type" placeholder="{{ trans('admin.purchase-order.columns.template_type') }}">
        <div v-if="errors.has('template_type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('template_type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('approval_requested_by'), 'has-success': this.fields.approval_requested_by && this.fields.approval_requested_by.valid }">
    <label for="approval_requested_by" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.approval_requested_by') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.approval_requested_by" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('approval_requested_by'), 'form-control-success': this.fields.approval_requested_by && this.fields.approval_requested_by.valid}" id="approval_requested_by" name="approval_requested_by" placeholder="{{ trans('admin.purchase-order.columns.approval_requested_by') }}">
        <div v-if="errors.has('approval_requested_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('approval_requested_by') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('approved_manager_id'), 'has-success': this.fields.approved_manager_id && this.fields.approved_manager_id.valid }">
    <label for="approved_manager_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.approved_manager_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.approved_manager_id" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('approved_manager_id'), 'form-control-success': this.fields.approved_manager_id && this.fields.approved_manager_id.valid}" id="approved_manager_id" name="approved_manager_id" placeholder="{{ trans('admin.purchase-order.columns.approved_manager_id') }}">
        <div v-if="errors.has('approved_manager_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('approved_manager_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('sales_representative_id'), 'has-success': this.fields.sales_representative_id && this.fields.sales_representative_id.valid }">
    <label for="sales_representative_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.sales_representative_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.sales_representative_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('sales_representative_id'), 'form-control-success': this.fields.sales_representative_id && this.fields.sales_representative_id.valid}" id="sales_representative_id" name="sales_representative_id" placeholder="{{ trans('admin.purchase-order.columns.sales_representative_id') }}">
        <div v-if="errors.has('sales_representative_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_representative_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('contact_id'), 'has-success': this.fields.contact_id && this.fields.contact_id.valid }">
    <label for="contact_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.contact_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.contact_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('contact_id'), 'form-control-success': this.fields.contact_id && this.fields.contact_id.valid}" id="contact_id" name="contact_id" placeholder="{{ trans('admin.purchase-order.columns.contact_id') }}">
        <div v-if="errors.has('contact_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('contact_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('vendor_id'), 'has-success': this.fields.vendor_id && this.fields.vendor_id.valid }">
    <label for="vendor_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.vendor_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.vendor_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('vendor_id'), 'form-control-success': this.fields.vendor_id && this.fields.vendor_id.valid}" id="vendor_id" name="vendor_id" placeholder="{{ trans('admin.purchase-order.columns.vendor_id') }}">
        <div v-if="errors.has('vendor_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('vendor_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('approved_at'), 'has-success': this.fields.approved_at && this.fields.approved_at.valid }">
    <label for="approved_at" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.purchase-order.columns.approved_at') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.approved_at" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('approved_at'), 'form-control-success': this.fields.approved_at && this.fields.approved_at.valid}" id="approved_at" name="approved_at" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('approved_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('approved_at') }}</div>
    </div>
</div>


