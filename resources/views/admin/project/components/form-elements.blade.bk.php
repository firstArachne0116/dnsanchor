<div class="row">
    <div class="col-6">
        <div class="" :class="{'has-danger': errors.has('client'), 'has-success': this.fields.client && this.fields.client.valid}">
            <label class="form-check-label" for="client">
                {{ trans('admin.project.columns.client') }}
            </label>

            <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="form.client" id="ajax" label="primary_contact_name" track-by="id" placeholder="Type to search" open-direction="bottom" :options="clients" :multiple="false" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit-text="limitText" :max-height="600" :show-no-results="true" :hide-selected="false" @search-change="clientLookup">
                <template slot="tag" slot-scope="{ option, remove }">
                    <span class="custom__tag"><span>@{{ option.primary_contact_name }}</span><span class="custom__remove" @click="remove(option)">❌</span></span>
                </template>
                <template slot="clear" slot-scope="props">
                    <div class="multiselect__clear" v-if="form.client.length" @mousedown.prevent.stop="clearAll(props.search)"></div>
                </template>
                <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
            </multiselect>

{{--            <input @input="contactLookup" type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.client" v-validate="'required'" class="form-control" :class="{'form-control-danger': errors.has('client'), 'form-control-success': this.fields.client && this.fields.client.valid }" id="client" name="client" placeholder="{{ trans('admin.project.columns.client') }}">--}}
            <div v-if="errors.has('client')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('client') }}</div>
        </div>

    </div>

    <div class="col-6">
        <div class="" :class="{'has-danger': errors.has('assigned_salesperson'), 'has-success': this.fields.name && this.fields.assigned_salesperson.valid}">
            <label class="form-check-label" for="assigned_salesperson">
                {{ trans('admin.project.columns.assigned_salesperson') }}
            </label>

            <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="form.assigned_salesperson" :options="sales_people" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Salesperson" label="name" track-by="name" :preselect-first="false">
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

    <!-- Singular fields -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('title'), 'has-success': this.fields.title && this.fields.title.valid}">
        <label class="form-check-label" for="title">
            {{ trans('admin.project.columns.title') }}
        </label>

        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.title" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': this.fields.title && this.fields.title.valid }" id="title" name="title" placeholder="{{ trans('admin.project.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>

    <!-- Quantity -->
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid}">
        <label class="form-check-label" for="quantity">
            {{ trans('admin.project.columns.quantity') }}
        </label>

        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.quantity" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid }" id="quantity" name="quantity" placeholder="{{ trans('admin.project.columns.quantity') }}">
        <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
    </div>

    <!-- Trim Size -->
    <div class="mt-3 col-4" :class="{'has-danger': errors.has('trim_size'), 'has-success': this.fields.trim_size && this.fields.trim_size.valid}">
        <label class="form-check-label" for="trim_size">
            {{ trans('admin.project.columns.trim_size') }}
        </label>

        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.trim_size" class="form-control" :class="{'form-control-danger': errors.has('trim_size'), 'form-control-success': this.fields.trim_size && this.fields.trim_size.valid }" id="trim_size" name="trim_size" placeholder="{{ trans('admin.project.columns.trim_size') }}">
        <div v-if="errors.has('trim_size')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('trim_size') }}</div>
    </div>

    <!-- Extent -->
    <div class="mt-3 col-4" :class="{'has-danger': errors.has('extent'), 'has-success': this.fields.extent && this.fields.extent.valid}">
        <label class="form-check-label" for="extent">
            {{ trans('admin.project.columns.extent') }}
        </label>

        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.extent" class="form-control" :class="{'form-control-danger': errors.has('extent'), 'form-control-success': this.fields.extent && this.fields.extent.valid }" id="extent" name="extent" placeholder="{{ trans('admin.project.columns.extent') }}">
        <div v-if="errors.has('extent')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('extent') }}</div>
    </div>

    <!-- Orientation -->
    <div class="mt-3 col-4" :class="{'has-danger': errors.has('orientation'), 'has-success': this.fields.orientation && this.fields.orientation.valid}">
        <label class="form-check-label" for="orientation">
            {{ trans('admin.project.columns.orientation') }}
        </label>

        <multiselect :disabled="awaitingManagerApproval && ! isManager" :taggable="true" @tag="addTag" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" v-model="form.orientation" :options="orientations" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Orientation" label="name" track-by="id" :preselect-first="true"></multiselect>
        <div v-if="errors.has('orientation')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('orientation') }}</div>
    </div>
</div>

<div class="row mt-3 card-header">
    <i style="line-height:1.5;" class="fa fa-briefcase"></i>
    {{ trans('admin.project.labels.project_type') }}
</div>

<div class="row mt-3">
    <div v-for="type in types" class="col-3">
        <input :disabled="awaitingManagerApproval && ! isManager" type="checkbox" class="custom-control-input" :value="type.friendly_name" :id="type.friendly_name" v-model="form.type">
        <label class="col-form-label" :for="type.friendly_name">@{{ type.name }}</label>
    </div>
</div>

<div v-for="type in types" v-if="form.type.includes(type.friendly_name)">
    <div class="row mt-3 card-header">
        <i style="line-height:1.5;" class="fa fa-book"></i>
        @{{ type.name }}
    </div>

    <div class="row">
        <!-- Material -->
        <div class="col-6">
            <h6 class="mt-3">Project Materials</h6>

            <!-- Text -->
            <div v-for="field in type.fields.materials" class="mt-3">
                <label class="form-check-label" :for="field.friendly_name">
                    @{{ field.label }}
                </label>

                <div v-if="field.type === 'text'" class="form-row">
                    <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                </div>

                <div v-else-if="field.type === 'textarea'" class="form-row">
                    <textarea :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label"></textarea>
                </div>

                <div v-else-if="field.type == 'select'" class="form-row">
                    <select :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                        <option :value="option" :selected="index === 0 ? 'selected' : false" v-for="(option,index) in field.options.split('\n')">@{{ option }}</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Specs -->
        <div class="col-6">
            <h6 class="mt-3">Project Specifications</h6>
            <!-- Text -->
            <div v-for="field in type.fields.specs" class="mt-3">
                <label class="form-check-label" :for="field.friendly_name">
                    @{{ field.label }}
                </label>

                <div v-if="field.type === 'text'" class="form-row">
                    <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                </div>

                <div v-else-if="field.type === 'textarea'" class="form-row">
                    <textarea :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label"></textarea>
                </div>

                <div v-else-if="field.type == 'select'" class="form-row">
                    <select :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                        <option v-for="option in field.options.split('\n')">@{{ option }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3 card-header">
    <i style="line-height:1.5;" class="fa fa-info-circle"></i>
    {{ trans('admin.project.labels.other_information') }}
</div>

<div class="row">
    <div class="mt-3 col-6" :class="{'has-danger': errors.has('finishing_information'), 'has-success': this.fields.finishing_information && this.fields.finishing_information.valid}">
        <label class="form-check-label" for="finishing_information">
            {{ trans('admin.project.columns.finishing_information') }}
        </label>

        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.finishing_information" class="form-control" :class="{'form-control-danger': errors.has('finishing_information'), 'form-control-success': this.fields.finishing_information && this.fields.finishing_information.valid }" id="finishing_information" name="finishing_information" placeholder="{{ trans('admin.project.columns.finishing_information') }}"></textarea>
        <div v-if="errors.has('finishing_information')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('finishing_information') }}</div>
    </div>

    <div class="mt-3 col-6" :class="{'has-danger': errors.has('packaging_information'), 'has-success': this.fields.packaging_information && this.fields.packaging_information.valid}">
        <label class="form-check-label" for="packaging_information">
            {{ trans('admin.project.columns.packaging_information') }}
        </label>

        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.packaging_information" class="form-control" :class="{'form-control-danger': errors.has('packaging_information'), 'form-control-success': this.fields.packaging_information && this.fields.packaging_information.valid }" id="packaging_information" name="packaging_information" placeholder="{{ trans('admin.project.columns.packaging_information') }}"></textarea>
        <div v-if="errors.has('packaging_information')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('packaging_information') }}</div>
    </div>

    <div class="mt-3 col-6" :class="{'has-danger': errors.has('origination'), 'has-success': this.fields.origination && this.fields.origination.valid}">
        <label class="form-check-label" for="origination">
            {{ trans('admin.project.columns.origination') }}
        </label>

        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.origination" class="form-control" :class="{'form-control-danger': errors.has('origination'), 'form-control-success': this.fields.origination && this.fields.origination.valid }" id="origination" name="origination" placeholder="{{ trans('admin.project.columns.origination') }}"></textarea>
        <div v-if="errors.has('origination')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('origination') }}</div>
    </div>

    <div class="mt-3 col-6" :class="{'has-danger': errors.has('information_requests'), 'has-success': this.fields.information_requests && this.fields.information_requests.valid}">
        <label class="form-check-label" for="information_requests">
            {{ trans('admin.project.columns.information_requests') }}
        </label>

        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.information_requests" class="form-control" :class="{'form-control-danger': errors.has('information_requests'), 'form-control-success': this.fields.information_requests && this.fields.information_requests.valid }" id="information_requests" name="information_requests" placeholder="{{ trans('admin.project.columns.information_requests') }}"></textarea>
        <div v-if="errors.has('information_requests')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('information_requests') }}</div>
    </div>

    <div class="mt-3 col-4" :class="{'has-danger': errors.has('materials_in_at'), 'has-success': this.fields.materials_in_at && this.fields.materials_in_at.valid}">
        <label class="form-check-label" for="materials_in_at">
            {{ trans('admin.project.columns.materials_in_at') }}
        </label>

        <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.materials_in_at" name="materials_in_at"></datepicker>
        <div v-if="errors.has('materials_in_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('materials_in_at') }}</div>
    </div>

    <div class="mt-3 col-4" :class="{'has-danger': errors.has('fob_at'), 'has-success': this.fields.fob_at && this.fields.fob_at.valid}">
        <label class="form-check-label" for="fob_at">
            {{ trans('admin.project.columns.fob_at') }}
        </label>

        <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.fob_at" name="fob_at"></datepicker>
        <div v-if="errors.has('fob_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fob_at') }}</div>
    </div>

    <div class="mt-3 col-4" :class="{'has-danger': errors.has('delivery_at'), 'has-success': this.fields.delivery_at && this.fields.delivery_at.valid}">
        <label class="form-check-label" for="delivery_at">
            {{ trans('admin.project.columns.delivery_at') }}
        </label>

        <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.delivery_at" name="delivery_at"></datepicker>
        <div v-if="errors.has('delivery_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('delivery_at') }}</div>
    </div>

    <div class="mt-3 col-6" :class="{'has-danger': errors.has('ship_to'), 'has-success': this.fields.ship_to && this.fields.ship_to.valid}">
        <label class="form-check-label" for="ship_to">
            {{ trans('admin.project.columns.ship_to') }}
        </label>

        <textarea :readonly="awaitingManagerApproval && ! isManager" rows="4" type="number" v-model="form.ship_to" class="form-control" :class="{'form-control-danger': errors.has('ship_to'), 'form-control-success': this.fields.ship_to && this.fields.ship_to.valid }" id="ship_to" name="ship_to" placeholder="{{ trans('admin.project.columns.ship_to') }}"></textarea>
        <div v-if="errors.has('ship_to')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ship_to') }}</div>
    </div>

    <div class="mt-3 col-6" :class="{'has-danger': errors.has('vendor_notes'), 'has-success': this.fields.vendor_notes && this.fields.vendor_notes.valid}">
        <label id="vendor-notes-label" class="form-check-label" for="vendor_notes">
            {{ trans('admin.project.columns.vendor_notes') }}
        </label>

        <!-- Template Select -->
        <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="vendor_note_template" id="vendor-note-select" label="note" placeholder="Select a template" open-direction="bottom" :options="vendor_notes" :multiple="false" :searchable="true" :internal-search="true" :clear-on-select="false" :close-on-select="true" :max-height="600" :show-no-results="true" :hide-selected="false" @select="addVendorNoteTemplate"></multiselect>

        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.vendor_notes" class="form-control" :class="{'form-control-danger': errors.has('vendor_notes'), 'form-control-success': this.fields.vendor_notes && this.fields.vendor_notes.valid }" id="vendor_notes" name="vendor_notes" placeholder="{{ trans('admin.project.columns.vendor_notes') }}"></textarea>
        <div v-if="errors.has('vendor_notes')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('vendor_notes') }}</div>
    </div>

</div>
