<template>
    <div>
        <!--begin:: Portlet-->
        <div class="tab-content">
            <div v-cloak class="row">
                <div class="col-3">
                    <div style="position: sticky; top: 90px;">
                        <!--begin::Section-->
                        <div class="kt-portlet bg-white">
                            <ul class="kt-nav kt-nav--active-bg" id="kt_nav" role="tablist">
                                <li class="kt-nav__item">
                                    <a href="#main-details" class="kt-nav__link">
                                          <span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg>									</span>
                                        <span class="kt-nav__link-text">Main Details</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item kt-nav__item--active">
                                    <a class="kt-nav__link  dropdown-toggle" role="tab" id="kt_nav_link_1" data-toggle="collapse" href="#kt_nav_sub_1" aria-expanded=" false">
                                          <span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24" />
        <polygon fill="#000000" opacity="0.3" points="12 2 4 19 20 19" />
        <rect fill="#000000" x="11" y="11" width="2" height="11" rx="1" />
    </g>
</svg>						</span>
                                        <span class="kt-nav__link-text">Project Type(s)</span>
                                    </a>
                                    <ul class="kt-nav__sub collapse show" id="kt_nav_sub_1" role="tabpanel" aria-labelledby="m_nav_link_1" data-parent="#kt_nav">
                                        <li v-for="type in types" class="kt-nav__item">
                                            <a :href="'#' + type.friendly_name + '-' + type.id" class="kt-nav__link">
                                                <span class="kt-nav__link-bullet kt-nav__link-bullet--line"><span></span></span>
                                                <span class="kt-nav__link-text">{{ type.name }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#other-information" class="kt-nav__link">
                                          <span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg>									</span>
                                        <span class="kt-nav__link-text">Other Information</span>
                                    </a>
                                </li>

                                <li class="kt-nav__item">
                                    <a href="#pcq_information" class="kt-nav__link">
                                          <span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg>									</span>
                                        <span class="kt-nav__link-text">PCQ Information</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--end::Section-->

                    </div>

                </div>

                <div class="col-9">

                    <!-- begin::Vendor Payments-->
                    <div class="kt-portlet" data-ktportlet="true" id="vendor-details">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Vendor Details
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" :class="{'has-danger': errors.has('vendor'), 'has-success': this.fields.vendor && this.fields.vendor.valid}">
                                            <label for="vendor">
                                                Vendor
                                            </label>

                                            <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="form.vendor" label="name" track-by="id" placeholder="Type to search" open-direction="bottom" :options="vendor_options" :multiple="false" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit-text="limitText" :max-height="600" :show-no-results="true" :hide-selected="false" @search-change="vendorLookup"></multiselect>

                                            <div v-if="errors.has('vendor')" class="form-control-feedback form-text" v-cloak>{{ errors.first('vendor') }}</div>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group" :class="{'has-danger': errors.has('vendor_payment_term'), 'has-success': this.fields.vendor_payment_term && this.fields.vendor_payment_term.valid}">
                                            <label for="vendor">
                                                Vendor Payment Term
                                            </label>

                                            <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="form.vendor_payment_term" label="name" track-by="id" placeholder="Type to search" open-direction="bottom" :options="vendor_payment_term_options" :multiple="false" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit-text="limitText" :max-height="600" :show-no-results="true" :hide-selected="false" @search-change="vendorPaymentTermLookup"></multiselect>

                                            <div v-if="errors.has('vendor_payment_term')" class="form-control-feedback form-text" v-cloak>{{ errors.first('vendor_payment_term') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end::Vendor Payments-->

                    <!-- begin::Main Details-->
                    <div class="kt-portlet" data-ktportlet="true" id="main-details">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Main Details
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" :class="{'has-danger': errors.has('client'), 'has-success': this.fields.client && this.fields.client.valid}">
                                            <label for="client">
                                                Client
                                            </label>

                                            <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="form.client" id="ajax" label="primary_contact_name" track-by="id" placeholder="Type to search" open-direction="bottom" :options="clients" :multiple="false" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit-text="limitText" :max-height="600" :show-no-results="true" :hide-selected="false" @search-change="clientLookup">
                                                <template slot="tag" slot-scope="{ option, remove }">
                                                    <span class="custom__tag"><span>{{ option.primary_contact_name }}</span><span class="custom__remove" @click="remove(option)">❌</span></span>
                                                </template>
                                                <template slot="clear" slot-scope="props">
                                                    <div class="multiselect__clear" v-if="form.client.length" @mousedown.prevent.stop="clearAll(props.search)"></div>
                                                </template>
                                                <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                                            </multiselect>

                                            <div v-if="errors.has('client')" class="form-control-feedback form-text" v-cloak>{{ errors.first('client') }}</div>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group" :class="{'has-danger': errors.has('assigned_salesperson'), 'has-success': this.fields.name && this.fields.assigned_salesperson.valid}">
                                            <label for="assigned_salesperson">
                                                Assigned Salesperson
                                            </label>

                                            <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="form.assigned_salesperson" :options="sales_people" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Salesperson" label="name" track-by="name" :preselect-first="false">
                                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                    <span class="multiselect__single" v-if="form.assigned_salesperson && form.assigned_salesperson.length && !isOpen">
                        <span v-for="(person, index) in form.assigned_salesperson">
                            <span>{{person.name}}</span><span v-if="index+1 < form.assigned_salesperson.length">, </span>
                        </span>
                    </span>
                                                </template>
                                            </multiselect>
                                            <div v-if="errors.has('assigned_salesperson')" class="form-control-feedback form-text" v-cloak>{{ errors.first('assigned_salesperson') }}</div>
                                        </div>
                                    </div>

                                    <!-- Singular fields -->
                                    <div class="form-group col-6" :class="{'has-danger': errors.has('title'), 'has-success': this.fields.title && this.fields.title.valid}">
                                        <label for="title">
                                            Title
                                        </label>

                                        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.title" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': this.fields.title && this.fields.title.valid }" id="title" name="title" placeholder="Title">
                                        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>{{ errors.first('title') }}</div>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="form-group col-6" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid}">
                                        <label for="quantity">
                                            Quantity
                                        </label>

                                        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.quantity" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid }" id="quantity" name="quantity" placeholder="Quantity">
                                        <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>{{ errors.first('quantity') }}</div>
                                    </div>

                                    <!-- Trim Size -->
                                    <div class="form-group-last col-4" :class="{'has-danger': errors.has('trim_size'), 'has-success': this.fields.trim_size && this.fields.trim_size.valid}">
                                        <label for="trim_size">
                                            Trim Size
                                        </label>

                                        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.trim_size" class="form-control" :class="{'form-control-danger': errors.has('trim_size'), 'form-control-success': this.fields.trim_size && this.fields.trim_size.valid }" id="trim_size" name="trim_size" placeholder="Trim Size">
                                        <div v-if="errors.has('trim_size')" class="form-control-feedback form-text" v-cloak>{{ errors.first('trim_size') }}</div>
                                    </div>

                                    <!-- Extent -->
                                    <div class="form-group-last col-4" :class="{'has-danger': errors.has('extent'), 'has-success': this.fields.extent && this.fields.extent.valid}">
                                        <label for="extent">
                                            Extent
                                        </label>

                                        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.extent" class="form-control" :class="{'form-control-danger': errors.has('extent'), 'form-control-success': this.fields.extent && this.fields.extent.valid }" id="extent" name="extent" placeholder="Extent">
                                        <div v-if="errors.has('extent')" class="form-control-feedback form-text" v-cloak>{{ errors.first('extent') }}</div>
                                    </div>

                                    <!-- Orientation -->
                                    <div class="form-group-last col-4" :class="{'has-danger': errors.has('orientation'), 'has-success': this.fields.orientation && this.fields.orientation.valid}">
                                        <label for="orientation">
                                            Orientation
                                        </label>

                                        <!--                                        <multiselect :disabled="awaitingManagerApproval && ! isManager" :taggable="true" @tag="addTag" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" v-model="form.orientation" :options="orientations" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Orientation" label="name" track-by="id" :preselect-first="true"></multiselect>-->
                                        <div v-if="errors.has('orientation')" class="form-control-feedback form-text" v-cloak>{{ errors.first('orientation') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end::Main Details-->

                    <div v-for="type in types">
                        <!--begin::Portlet-->
                        <div class="kt-portlet" data-ktportlet="true" :id="type.friendly_name + '-' + type.id">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{ type.name }}
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-group">
                                        <a href="#">
							<span class="kt-switch kt-switch--brand mt-3">
							<label>
							<input v-model="form.type" :value="type.friendly_name" type="checkbox" name="">
							<span></span>
							</label>
							</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div v-if="form.type.includes( type.friendly_name )" class="kt-portlet__body">
                                <div class="kt-portlet__content">
                                    <div class="row kt-form">
                                        <!-- Material -->
                                        <div class="col-6">
                                            <div class="kt-section__title">
                                                <h5 @click.prevent="console(type)" class="mb-4">Project Materials</h5>
                                            </div>

                                        </div>

                                        <!-- Specs -->
                                        <div class="col-6">
                                            <div class="kt-section__title">
                                                <h5 class="mb-4">Project Specifications</h5>
                                            </div>
                                            <!-- Text -->
                                        </div>

                                        <div v-for="field in intertwineProjectType( type )" class="col-6">
                                            <div class="form-group">
                                                <div v-if="field._type === 'spec'">
                                                    <label :for="field.friendly_name">
                                                        {{ field.label }}
                                                    </label>

                                                    <div v-if="field.type === 'text'">
                                                        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                    </div>

                                                    <div v-else-if="field.type === 'textarea'">
                                                        <textarea :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label"></textarea>
                                                    </div>

                                                    <div v-else-if="field.type == 'select'">
                                                        <select :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].specs[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                            <option v-for="option in field.options.split('\n')">{{ option }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div v-else>
                                                    <!-- Text -->
                                                    <label :for="field.friendly_name">
                                                        {{ field.label }}
                                                    </label>

                                                    <div v-if="field.type === 'text'">
                                                        <input type="text" :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                    </div>

                                                    <div v-else-if="field.type === 'textarea'">
                                                        <textarea :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label"></textarea>
                                                    </div>

                                                    <div v-else-if="field.type == 'select'">
                                                        <select :readonly="awaitingManagerApproval && ! isManager" v-model="form.types[type.friendly_name].materials[field.label]" class="form-control" :id="field.friendly_name" name="text" :placeholder="field.label">
                                                            <option :value="option" :selected="index === 0 ? 'selected' : false" v-for="(option,index) in field.options.split('\n')">{{ option }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--begin::Portlet-->
                    <div class="kt-portlet" data-ktportlet="true" id="other-information">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Other Information
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="row">
                                    <div class="form-group  col-6" :class="{'has-danger': errors.has('finishing_information'), 'has-success': this.fields.finishing_information && this.fields.finishing_information.valid}">
                                        <label for="finishing_information">
                                            Finishing Information
                                        </label>

                                        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.finishing_information" class="form-control" :class="{'form-control-danger': errors.has('finishing_information'), 'form-control-success': this.fields.finishing_information && this.fields.finishing_information.valid }" id="finishing_information" name="finishing_information" placeholder="Finishing Information"></textarea>
                                        <div v-if="errors.has('finishing_information')" class="form-control-feedback form-text" v-cloak>{{ errors.first('finishing_information') }}</div>
                                    </div>

                                    <div class="form-group  col-6" :class="{'has-danger': errors.has('packaging_information'), 'has-success': this.fields.packaging_information && this.fields.packaging_information.valid}">
                                        <label for="packaging_information">
                                            Packaging Information
                                        </label>

                                        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.packaging_information" class="form-control" :class="{'form-control-danger': errors.has('packaging_information'), 'form-control-success': this.fields.packaging_information && this.fields.packaging_information.valid }" id="packaging_information" name="packaging_information" placeholder="Packaging Information"></textarea>
                                        <div v-if="errors.has('packaging_information')" class="form-control-feedback form-text" v-cloak>{{ errors.first('packaging_information') }}</div>
                                    </div>

                                    <div class="form-group col-6" :class="{'has-danger': errors.has('origination'), 'has-success': this.fields.origination && this.fields.origination.valid}">
                                        <label for="origination">
                                            Origination
                                        </label>

                                        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.origination" class="form-control" :class="{'form-control-danger': errors.has('origination'), 'form-control-success': this.fields.origination && this.fields.origination.valid }" id="origination" name="origination" placeholder="Origination"></textarea>
                                        <div v-if="errors.has('origination')" class="form-control-feedback form-text" v-cloak>{{ errors.first('origination') }}</div>
                                    </div>

                                    <div class="form-group  col-6" :class="{'has-danger': errors.has('information_requests'), 'has-success': this.fields.information_requests && this.fields.information_requests.valid}">
                                        <label for="information_requests">
                                            Information Requests
                                        </label>

                                        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.information_requests" class="form-control" :class="{'form-control-danger': errors.has('information_requests'), 'form-control-success': this.fields.information_requests && this.fields.information_requests.valid }" id="information_requests" name="information_requests" placeholder="Information Requests"></textarea>
                                        <div v-if="errors.has('information_requests')" class="form-control-feedback form-text" v-cloak>{{ errors.first('information_requests') }}</div>
                                    </div>

                                    <div class="form-group  col-4" :class="{'has-danger': errors.has('materials_in_at'), 'has-success': this.fields.materials_in_at && this.fields.materials_in_at.valid}">
                                        <label for="materials_in_at">
                                            Materials In
                                        </label>

                                        <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.materials_in_at" name="materials_in_at"></datepicker>
                                        <div v-if="errors.has('materials_in_at')" class="form-control-feedback form-text" v-cloak>{{ errors.first('materials_in_at') }}</div>
                                    </div>

                                    <div class="form-group  col-4" :class="{'has-danger': errors.has('fob_at'), 'has-success': this.fields.fob_at && this.fields.fob_at.valid}">
                                        <label for="fob_at">
                                            FOB
                                        </label>

                                        <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.fob_at" name="fob_at"></datepicker>
                                        <div v-if="errors.has('fob_at')" class="form-control-feedback form-text" v-cloak>{{ errors.first('fob_at') }}</div>
                                    </div>

                                    <div class="form-group  col-4" :class="{'has-danger': errors.has('delivery_at'), 'has-success': this.fields.delivery_at && this.fields.delivery_at.valid}">
                                        <label for="delivery_at">
                                            Delivery
                                        </label>

                                        <datepicker :disabled="awaitingManagerApproval && ! isManager" :format="dateFormatter" input-class="form-control" v-model="form.delivery_at" name="delivery_at"></datepicker>
                                        <div v-if="errors.has('delivery_at')" class="form-control-feedback form-text" v-cloak>{{ errors.first('delivery_at') }}</div>
                                    </div>

                                    <div class="form-group-last col-6" :class="{'has-danger': errors.has('ship_to'), 'has-success': this.fields.ship_to && this.fields.ship_to.valid}">
                                        <label for="ship_to">
                                            Ship To
                                        </label>

                                        <textarea :readonly="awaitingManagerApproval && ! isManager" rows="4" type="number" v-model="form.ship_to" class="form-control" :class="{'form-control-danger': errors.has('ship_to'), 'form-control-success': this.fields.ship_to && this.fields.ship_to.valid }" id="ship_to" name="ship_to" placeholder="Ship To"></textarea>
                                        <div v-if="errors.has('ship_to')" class="form-control-feedback form-text" v-cloak>{{ errors.first('ship_to') }}</div>
                                    </div>

                                    <div class="form-group-last col-6" :class="{'has-danger': errors.has('vendor_notes'), 'has-success': this.fields.vendor_notes && this.fields.vendor_notes.valid}">
                                        <label id="vendor-notes-label" for="vendor_notes">
                                            Vendor Notes
                                        </label>

                                        <!-- Template Select -->
                                        <multiselect :disabled="awaitingManagerApproval && ! isManager" v-model="vendor_note_template" id="vendor-note-select" label="note" placeholder="Select a template" open-direction="bottom" :options="vendor_notes" :multiple="false" :searchable="true" :internal-search="true" :clear-on-select="false" :close-on-select="true" :max-height="600" :show-no-results="true" :hide-selected="false" @select="addVendorNoteTemplate"></multiselect>

                                        <textarea :readonly="awaitingManagerApproval && ! isManager" type="number" v-model="form.vendor_notes" class="form-control" :class="{'form-control-danger': errors.has('vendor_notes'), 'form-control-success': this.fields.vendor_notes && this.fields.vendor_notes.valid }" id="vendor_notes" name="vendor_notes" placeholder="Vendor Notes"></textarea>
                                        <div v-if="errors.has('vendor_notes')" class="form-control-feedback form-text" v-cloak>{{ errors.first('vendor_notes') }}</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->

                    <!--begin::PCQ-->
                    <div class="kt-portlet" data-ktportlet="true" id="pcq_information">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    PCQ Information
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="row">
                                    <div class="form-group col-12" :class="{'has-danger': errors.has('additional_comments'), 'has-success': this.fields.additional_comments && this.fields.additional_comments.valid}">
                                        <label for="additional_comments">
                                            Additional Comments
                                        </label>

                                        <textarea type="number" v-model="form.additional_comments" class="form-control" :class="{'form-control-danger': errors.has('additional_comments'), 'form-control-success': this.fields.additional_comments && this.fields.additional_comments.valid }" id="additional_comments" name="additional_comments" placeholder="Additional Comments"></textarea>
                                        <div v-if="errors.has('additional_comments')" class="form-control-feedback form-text" v-cloak>{{ errors.first('additional_comments') }}</div>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <div class="" :class="{'has-danger': errors.has('remittance_info'), 'has-success': this.fields.name && this.fields.remittance_info.valid}">
                                            <label for="remittance_info">
                                                Remittance Information
                                            </label>

                                            <multiselect v-model="form.remittance_info" :options="remittance_options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Remittance Info" label="name" track-by="name" :preselect-first="false"></multiselect>
                                            <div v-if="errors.has('remittance_info')" class="form-control-feedback form-text" v-cloak>{{ errors.first('remittance_info') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <div class="" :class="{'has-danger': errors.has('payment_terms'), 'has-success': this.fields.name && this.fields.payment_terms.valid}">
                                            <label for="payment_terms">
                                                Payment Terms
                                            </label>

                                            <multiselect v-model="form.payment_terms" :options="payment_term_options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Payment Terms" label="name" track-by="name" :preselect-first="false"></multiselect>
                                            <div v-if="errors.has('payment_terms')" class="form-control-feedback form-text" v-cloak>{{ errors.first('payment_terms') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::PCQ-->

                </div>
            </div>

            <!--begin::Line Items-->
            <div class="tab-content">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <div v-cloak data-ktportlet="true" id="pcq_information">
                            <project-invoice-listing
                                :data="form.lines"
                                :url="form.resource_url + '/lines'"
                                :current-tab="current_tab"
                                :selectable="true"
                                :po="true"
                                ref="project_invoice"
                                inline-template>

                                <div class="row">
                                    <div class="col">
                                        <div class="w-100">
                                            <div class="w-100" v-cloak>
                                                <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mb-3" id="kt_subheader">
                                                    <div class="kt-subheader__main">
                                                        <h3 class="kt-subheader__title">
                                                            Line Items
                                                        </h3>
                                                        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                                        <div class="kt-subheader__group" id="kt_subheader_search">
											<span class="kt-subheader__desc" id="kt_subheader_total">
												{{ pagination.state.total }} Total </span>
                                                            <form class="kt-margin-l-20" id="kt_subheader_search_form">
                                                                <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                                                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
														<span>
															<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
																	<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
																</g>
															</svg>
														</span>
													</span>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <div class="kt-subheader__toolbar col">
                                                        <a href="javascript:void(0)" @click.prevent="isEditing = true" class="btn btn-label-brand btn-bold mr-5">Add Item</a>
                                                        <div class="col-sm-auto form-group m-0 p-0">
                                                            <select class="form-control" v-model="pagination.state.per_page">

                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="100">100</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-portlet">
                                                    <div class="kt-portlet__body kt-portlet__body--fit">
                                                        <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded mb-0">
                                                            <table class="kt-datatable__table">
                                                                <thead class="kt-datatable__head">
                                                                    <tr class="kt-datatable__row">
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Name</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Description</span></th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Quantity</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Unit Cost</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Unit Price</span></th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Category</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>Actions</span></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="kt-datatable__body">
                                                                    <tr class="kt-datatable__row" v-if="isEditing">
                                                                        <td class="kt-datatable__cell">
                                                                            <input v-model="form.name" type="text" class="form-control form-control-sm" name="name">
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <textarea v-model="form.description" class="form-control form-control-sm" name="description"></textarea>
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <input v-model="form.quantity" type="number" class="form-control form-control-sm" name="quantity">
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <input v-model="form.unit_cost" class="form-control form-control-sm" name="unit_cost">
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <input v-model="form.unit_price" class="form-control form-control-sm" name="unit_price">
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <multiselect v-model="form.category" :options="categories" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Category" :preselect-first="false"></multiselect>
                                                                        </td>
                                                                        <td class="kt-datatable__cell">
                                                                            <a class="btn btn-primary btn-sm text-white" href="#" @click.prevent="save" title="Save" role="button"><i class="fa fa-save"></i> Save</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="kt-datatable__row" v-for="(item, index) in collection">
                                                                        <td class="kt-datatable__cell">{{ item.name }}</td>
                                                                        <td class="kt-datatable__cell">{{ item.description || '-' }}</td>
                                                                        <td class="kt-datatable__cell">{{ item.quantity || '-' }}</td>
                                                                        <td class="kt-datatable__cell">{{ '$' + parseFloat( item.unit_cost ).toFixed(2) || '-' }}</td>
                                                                        <td class="kt-datatable__cell">{{ '$' + parseFloat( item.unit_price ).toFixed(2) || '-' }}</td>
                                                                        <td class="kt-datatable__cell">{{ item.category || 'Misc' }}</td>
                                                                        <td class="kt-datatable__cell">
                                            <span style="overflow: visible; position: relative; width: 80px;">
                                                <div class="dropdown">
  <a class="btn btn-sm btn-clean btn-icon btn-icon-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="flaticon-more-1"></i>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="item.resource_url + '/edit'">Edit</a>
    <a class="dropdown-item" href="#">View</a>
    <a class="dropdown-item" href="#">View Progress</a>
  </div>
</div>
                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>

                                                                <tfoot class="kt-datatable__foot">
                                                                    <tr class="kt-datatable__row">
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>-</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>-</span></th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>-</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span class="">${{ total_cost }}</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span class="">${{ total_price }}</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span>-</span>
                                                                        </th>
                                                                        <th class="kt-datatable__cell kt-datatable__cell--sort">
                                                                            <span></span></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>

                                                        <div class="row" v-if="pagination.state.total > 0">
                                                            <div class="col-sm-auto">
                                                                <pagination></pagination>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </project-invoice-listing>

                        </div>

                    </div>
                </div>
            </div>
            <!--end::Line Items-->

        </div>

        <!--end:: Portlet-->

    </div>
</template>

<style lang="scss">
    .vue-popover {
        position: fixed;
    }
</style>

<script>
    import Datepicker from 'vuejs-datepicker';
    import {mapGetters} from 'vuex';

    import AppForm from '../admin/app-components/Form/AppForm';


    export default {
        name: 'purchase-order',
        mixins: [AppForm],
        components: {
            Datepicker
        },
        data: function () {
            return {
                clientLookupTimeout: null,
                debounceTimeout: 1000,
                activeTab: 0,
                showMainForm: true,
                templateType: 'RFQ',
                savedByAction: false,
                savedAsOfficial: false,
                mediaCollections: ['jcp', 'jcp_supporting_files'],
                generate: {
                    type: 'print',
                    template: 'rfq',
                    letterhead: null
                },
                is_mounted: false,
                fcq_signed: false,
                fcq_signed_at: moment().toDate(),
                form: {
                    client: [],
                    contributors: [],

                    assigned_salesperson: [],
                    orientation: [],
                    origination: 'CTO',
                    types: {},
                    type: [],
                    title: 'Untitled Project',
                    lines: {
                        current_page: 1,
                        data: [],
                        first_page_url: '',
                        last_page_url: '',
                        next_page_url: '',
                        prev_page_url: '',
                        path: '',
                        to: null,
                        from: null,
                        per_page: 10,
                        total: 0
                    },
                    aa_lines: {
                        current_page: 1,
                        data: [],
                        first_page_url: '',
                        last_page_url: '',
                        next_page_url: '',
                        prev_page_url: '',
                        path: '',
                        to: null,
                        from: null,
                        per_page: 10,
                        total: 0
                    }
                },
                misc_po: {
                    client: [],
                    assigned_salesperson: [],
                    orientation: [],
                    origination: 'CTO',
                    types: {},
                    type: []
                },
                is_viewing_files: false,
                editing_misc_po: false,
                aa_content: '<p>Dear xxxxx,</p><p><br></p><p>Please accept this document as an addendum to the original agreement/contract, which we entered into on [Signed FCQ Effective Date]:</p><p><br></p><p>\tAdditional cost to air-­‐freight <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;printed books (<u>&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;cartons) to:</p><p><br></p><p>\t\tClientxxxxx</p><p>\t\tATTN: xxxxxxx</p><p>\t\tAddressxxxxx</p><p>\t\tCity State Zipxxxxx</p><p>\t\t(xxx) xxx-­‐xxxx</p><p><br></p><p>\tvia FedEx International Economy @ $<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>the lot</p><p><br></p><p>\tplus necessary double cartoning and transport (from China to GPSD HK for FedEx pickup) @ $<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>the lot</p><p><br></p><p>\tfor a total of $<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>the lot (based on approximate weights and measurements).</p><p><br></p><p>The above will appear on your final invoice as a Change Order item dated <span style="background-color: yellow;">xxxxxxxxxx</span>.&nbsp;</p>',
                checklist_questions: [
                    {
                        label: 'RFQ',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'PCQ',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'FCQ (signed) + 2 docs sent',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Job Confirmation Paperwork (JCP) sent',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Job Confirmation Paperwork (VC) back from HK',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'PO',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: '5 docs sent (+ board)',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'AA',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'AA Signed',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Updated PO',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Ex-Factory (Production Completed)',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Bulk Loading -> Shipping Docs Received',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Sales Invoice',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Account Invoice',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Product Delivered',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Vendor Invoice Received and Approved',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Shipping Invoice Received and Approved',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Packets Finished (and signed by manager)',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Packets Scanned',
                        checked: false,
                        has_official_version: false,
                        timestamp: null
                    },
                    {
                        label: 'Job Closed Out By Accounts',
                        checked: false,
                        has_official_version: false,
                        timestamp: null,
                        danger: true
                    }
                ],
                current_tab: 'overview',
                onSuccessCallback: null,
                fabActions: [
                    {
                        name: 'save',
                        icon: 'flaticon-doc',
                        tooltip: 'Save'
                    },
                    {
                        name: 'save_as_official',
                        icon: 'flaticon2-correct',
                        tooltip: 'Save as Official'
                    },
                    {
                        name: 'print',
                        icon: 'flaticon2-fax',
                        tooltip: 'Save & Print'
                    },
                    {
                        name: 'download',
                        icon: 'flaticon-download-1',
                        tooltip: 'Save & Download'
                    }
                ],
                isLoading: false,
                is_filtering_files: false,
                sales_people: [],
                vendor_notes: [],
                vendor_options: [],
                clients: [],
                orientations: [],
                payment_term_options: [],
                vendor_payment_term_options: [],
                remittance_options: [],
                vendor_note_template: null,

                ran_after_init: false
            };
        },
        props: ['types', 'access', 'awaitingManagerApproval', 'isManager'],
        created() {
            if ( window.moment ) {
                console.log( { moment: window.moment } );
                this.moment = window.moment;
            }

            this.form.assigned_salesperson = [];
            this.form.referred_by = [];
        },
        mounted() {

            //        var tab = document.querySelector( 'ul.uk-tab' );
            //        var referenceNode = document.querySelector( '.app-header ul' );
            //
            //        tab.className += ' nav navbar-nav ml-auto';
            //
            //        referenceNode.parentNode.insertBefore( tab, referenceNode );

            let _this3 = this;

            _this3.is_mounted = true;

            this.$parent.$emit( 'gpsd:update-page', 'project:overview' );

            this.$root.$on( 'gpsd:added-file', function ( data ) {
                _this3.form.jcp_supporting_files.push( data );
            } );

            console.log( 'tree' );

            //        this.$refs.project_navigation.$on( 'update:activeTab', function ( activeTab ) {
            //            _this3.activeTab = activeTab;
            //
            //            if ( activeTab === 8 || activeTab === 4 || activeTab === 9 || activeTab === 3 ) {
            //                _this3.showMainForm = false;
            //            }
            //            else {
            //                _this3.showMainForm = true;
            //            }
            //
            //            switch ( activeTab ) {
            //                case 0:
            //                    _this3.templateType = 'RFQ';
            //                    break;
            //                case 1:
            //                    _this3.templateType = 'PCQ';
            //                    break;
            //                case 2:
            //                    _this3.templateType = 'FCQ';
            //                    break;
            //                case 3:
            //                    _this3.templateType = 'JCP';
            //                    break;
            //                case 4:
            //                    _this3.templateType = 'PO';
            //                    break;
            //                case 5:
            //                    _this3.templateType = 'Misc PO';
            //                    break;
            //                case 6:
            //                    _this3.templateType = 'AA';
            //                    break;
            //                case 7:
            //                    _this3.templateType = 'JCW';
            //                    break;
            //            }
            //        } );

            let _this = this;

            axios.all( [
                axios.get( '/api/sales-persons' ),
                axios.get( '/api/contacts' ),
                axios.get( '/api/orientations' ),
                axios.get( '/api/vendor-notes' ),
                axios.get( '/api/remittance-info' ),
                axios.get( '/api/payment-terms' ),
                axios.get( '/api/vendor-payment-terms' ),
                axios.get( '/api/vendors' )
            ] ).then( axios.spread( ( salesResponse, clientResponse, orientationsResponse, vendorNotesResponse, remittanceResponse, paymentTermsResponse, vendorPaymentTermsResponse, vendorResponse ) => {
                _this.sales_people = salesResponse.data.data;
                _this.clients = clientResponse.data.data;
                _this.orientations = orientationsResponse.data.data;
                _this.vendor_notes = vendorNotesResponse.data.data;
                _this.remittance_options = remittanceResponse.data.data;
                _this.payment_term_options = paymentTermsResponse.data.data;
                _this.vendor_options = vendorResponse.data.data;
                _this.vendor_payment_term_options = vendorPaymentTermsResponse.data.data;

                _this.$nextTick( () => {
                    _this.after_data_update();

                    this.$modal.show( 'pending-review' );
                } );
            } ) );

            jQuery( '[data-toggle="tooltip"]' ).tooltip();
        },

        watch: {
            'form.type': function () {
                let _this = this;

                for ( let type of _this.types ) {
                    let materials = {};
                    let specs = {};

                    let record = _this.form.fields && _this.form.fields[ type.friendly_name ] ? _this.form.fields[ type.friendly_name ] : false;

                    for ( let field of type.fields.materials ) {
                        materials[ field.label ] = record && record.materials[ field.label ] ? record.materials[ field.label ] : '';
                    }

                    for ( let field of type.fields.specs ) {
                        specs[ field.label ] = record && record.specs[ field.label ] ? record.specs[ field.label ] : '';
                    }

                    _this.form.types[ type.friendly_name ] = {
                        materials,
                        specs
                    };
                }
            }
        },

        methods: {
            limitText( count ) {
                return `and ${count} other clients`;
            },

            intertwineProjectType( type ) {
                let materials = type.fields.materials;
                let specs = type.fields.specs;

                // mark so we can determine type
                for ( let material of materials ) {
                    material._type = 'material';
                }

                for ( let spec of specs ) {
                    spec._type = 'spec';
                }

                let result = [],
                    i, l = Math.min( materials.length, specs.length );

                for ( i = 0; i < l; i++ ) {
                    result.push( materials[ i ], specs[ i ] );
                }

                result.push( ...materials.slice( l ), ...specs.slice( l ) );

                return result;
            },

            generatePDF() {
                let _this3 = this;

                switch ( _this3.generate.type ) {
                    case 'download':
                        window.open( '/admin/projects/' + _this3.form.id + '/' + _this3.templateType.toLowerCase() + '/pdf?download=true&letterhead=' + _this3.generate.letterhead );
                        break;
                    case 'pdf':
                        window.open( '/admin/projects/' + _this3.form.id + '/' + _this3.templateType.toLowerCase() + '/pdf?letterhead=' + _this3.generate.letterhead );
                        break;
                    case 'print':
                        window.open( '/admin/projects/' + _this3.form.id + '/' + _this3.templateType.toLowerCase() + '/print?letterhead=' + _this3.generate.letterhead );
                        break;
                }
            },

            onSubmit( cb = null ) {
                var _this4 = this;
                var data = _this4.form;

                _this4.submiting = true;

                axios.post( _this4.form.hasOwnProperty( 'resource_url' ) ? _this4.form.resource_url : _this4.action, _this4.getPostData() ).then( function ( response ) {
                    if ( cb ) {
                        cb( response.data );
                    }

                    return _this4.onSuccess( response.data );
                } ).catch( function ( errors ) {
                    console.log({errors});
                    return _this4.onFail( errors.response.data.errors );
                } );
            },

            addTag( newTag ) {
                const tag = {
                    name: newTag,
                    code: newTag.substring( 0, 2 ) + Math.floor( (Math.random() * 10000000) )
                };

                this.orientations.push( tag );
                this.form.orientation = tag;
            },

            isPendingReview( template_type ) {
                if ( this.form.status === 'AWAITING_MANAGER_APPROVAL' && this.form.template_type === template_type ) {
                    return true;
                }

                return false;
            },

            confirmSaveAsOfficial( approved ) {
                let _this3 = this;

                axios.post( '/admin/projects/' + this.form.id + '/confirm', {
                    approved,
                    template_type: _this3.form.template_type
                } ).then( response => {
                    if ( response.data.success ) {
                        if ( response.data.hasOwnProperty( 'ID' ) ) {
                            _this3.form.id = response.data.ID;
                            _this3.form.status = response.data.status;
                        }

                        if ( _this3.$refs.hasOwnProperty( 'resource_index' ) ) {
                            _this3.$refs.resource_index.loadData();
                        }

                        _this3.$notify( {
                            type: 'success',
                            title: 'Success!',
                            text: 'The ' + _this3.templateType + ' has successfully been ' + (approved ? 'confirmed as the official version.' : 'rejected.')
                        } );
                    }
                } ).catch( () => {
                    _this3.$notify( {
                        type: 'error',
                        title: 'Error',
                        text: 'Oops, something went wrong. Please try again later.'
                    } );
                } );

                _this3.$modal.hide( 'approve-version' );
                _this3.$modal.hide( 'reject-version' );
            },

            console( item ) {
                console.log( item );
            },

            after_data_update() {
                let _this3 = this;

                this.form.types = {};

                for ( let type of this.types ) {
                    let materials = {};
                    let specs = {};

                    let record = this.form.fields && this.form.fields[ type.friendly_name ] ? this.form.fields[ type.friendly_name ] : false;

                    for ( let field of type.fields.materials ) {
                        materials[ field.label ] = record && record.materials[ field.label ] ? record.materials[ field.label ] : '';
                    }

                    for ( let field of type.fields.specs ) {
                        specs[ field.label ] = record && record.specs[ field.label ] ? record.specs[ field.label ] : '';
                    }

                    this.form.types[ type.friendly_name ] = {
                        materials,
                        specs
                    };
                }

                /**
                 * Update lines
                 */


                /**
                 * Select default vendor note
                 */
                if ( this.vendor_notes && this.vendor_notes.length > 0 ) {
                    let defaultVendorNotes = this.vendor_notes.filter( function ( item ) {
                        return item.default;
                    } );

                    if ( defaultVendorNotes.length > 0 ) {
                        this.vendor_note_template = defaultVendorNotes[ 0 ];
                        this.form.vendor_notes = this.vendor_note_template.note;
                    }
                }

                let defaultRemittanceInfo = null;
                let defaultPaymentTerms = null;

                /**
                 * Select default remittance info
                 */
                if ( this.remittance_options && this.remittance_options.length > 0 ) {
                    defaultRemittanceInfo = this.remittance_options.filter( function ( item ) {
                        return item.default;
                    } );

                    if ( defaultRemittanceInfo.length > 0 ) {
                        this.form.remittance_info = defaultRemittanceInfo[ 0 ];
                    }
                }

                /**
                 * Select default payment terms
                 */
                if ( this.payment_term_options && this.payment_term_options.length > 0 ) {
                    defaultPaymentTerms = this.payment_term_options.filter( function ( item ) {
                        return item.default;
                    } );

                    if ( defaultPaymentTerms.length > 0 ) {
                        this.form.payment_terms = defaultPaymentTerms[ 0 ];
                    }
                }

                let form = this.form;

                if ( form.sales_representative_id ) {
                    // sales person options
                    let assigned_salesperson = this.sales_people.filter( function ( item ) {
                        return item.ID === form.sales_representative_id;
                    } );

                    if ( assigned_salesperson.length > 0 ) {
                        this.form.assigned_salesperson = assigned_salesperson;
                    }
                }

                if ( form.vendor_id ) {
                    let vendor = this.vendor_options.filter( function ( item ) {
                        return item.id === form.vendor_id;
                    } );

                    if ( vendor.length > 0 ) {
                        this.form.vendor = vendor[ 0 ];
                    }
                }

                if ( form.vendor_payment_term_id ) {
                    let vendor = this.vendor_payment_term_options.filter( function ( item ) {
                        return item.id === form.vendor_payment_term_id;
                    } );

                    if ( vendor.length > 0 ) {
                        this.form.vendor_payment_term = vendor[ 0 ];
                    }
                }

                if ( !form.client ) {
                    this.form.client = [];
                }

                if ( form.fcq_signed_at ) {
                    _this3.fcq_signed = !!form.fcq_signed_at;
                }

                if ( form.orientation ) {
                    let match = _this3.orientations.filter( item => {
                        return item.name === form.orientation;
                    } );

                    if ( match ) {
                        _this3.form.orientation = match[ 0 ];
                    }
                }

                if ( form.aa_template ) {
                    _this3.aa_content = form.aa_template;
                }

                _this3.$nextTick( () => {
                    if ( _this3.$refs.hasOwnProperty( 'project_invoice' ) ) {
                        _this3.$refs.project_invoice.loadData();
                    }
                } );

                if ( form.project_stage_checklist ) {
                    _this3.checklist_questions = form.project_stage_checklist.map( question => {
                        return Object.assign( {}, question, { timestamp: moment.unix( question.timestamp ) } );
                    } );
                }

                if ( this.form.materials_in_at && this.form.materials_in_at.constructor === Number ) {
                    this.form.materials_in_at = moment.unix( this.form.materials_in_at ).toDate();
                }

                if ( this.form.fob_at && this.form.fob_at.constructor === Number ) {
                    this.form.fob_at = moment.unix( this.form.fob_at ).toDate();
                }

                if ( this.form.delivery_at && this.form.delivery_at.constructor === Number ) {
                    this.form.delivery_at = moment.unix( this.form.delivery_at ).toDate();
                }
            },

            getPostData: function getPostData() {
                var _this3 = this;

                console.log( 'should be intervening' );

                if ( this.mediaCollections ) {
                    this.mediaCollections.forEach( function ( collection, index, arr ) {
                        if ( _this3.form[ collection ] ) {
                            console.warn( 'MediaUploader warning: Media input must have a unique name, \'' + collection + '\' is already defined in regular inputs.' );
                        }

                        if ( _this3.$refs[ collection + '_uploader' ] ) {
                            _this3.form[ collection ] = _this3.$refs[ collection + '_uploader' ].getFiles();
                        }
                    } );
                }

                this.form[ 'wysiwygMedia' ] = this.wysiwygMedia;

                // get client ID
                let objToReturn = Object.assign( {}, this.form, {
                    client_id: _this3.form.client.id,
                    project_id: _this3.$parent.form.id,
                    sales_representatives: _this3.form.assigned_salesperson ? _.map( _this3.form.assigned_salesperson, 'ID' ) : [],
                    orientation: _this3.form.hasOwnProperty( 'orientation' ) && _this3.form.orientation && _this3.form.orientation.hasOwnProperty( 'name' ) && _this3.form.orientation.name ? _this3.form.orientation.name : null,
                    fields: _this3.form.types ? _.pick( _this3.form.types, _this3.form.type ) : {},
                    redirect: !_this3.savedByAction,
                    saved_as_official: _this3.savedAsOfficial,
                    template_type: _this3.templateType,
                    vendor_id: _this3.form.vendor && _this3.form.vendor.hasOwnProperty( 'id' ) ? _this3.form.vendor.id : null,
                    vendor_payment_term_id: _this3.form.vendor_payment_term && _this3.form.vendor_payment_term.hasOwnProperty( 'id' ) ? _this3.form.vendor_payment_term.id : null,
                    remittance_id: _this3.form.remittance_info && _this3.form.remittance_info.hasOwnProperty( 'id' ) ? _this3.form.remittance_info.id : null,
                    payment_term_id: _this3.form.payment_terms && _this3.form.payment_terms.hasOwnProperty( 'id' ) ? _this3.form.payment_terms.id : null,
                    materials_in_at: moment( _this3.form.materials_in_at ).unix(),
                    fob_at: moment( _this3.form.fob_at ).unix(),
                    delivery_at: moment( _this3.form.delivery_at ).unix(),
                    fcq_signed_at: _this3.fcq_signed && _this3.fcq_signed_at ? moment( _this3.fcq_signed_at ).unix() : null,
                    invoice_lines_inc_po: _this3.$refs.hasOwnProperty( 'project_invoice' ) && _this3.$refs.project_invoice.hasOwnProperty( 'applicable_lines' ) ? _this3.$refs.project_invoice.applicable_lines : []
                } );

                delete objToReturn[ 'client' ];
                delete objToReturn[ 'vendor' ];
                delete objToReturn[ 'type' ];
                delete objToReturn[ 'types' ];
                delete objToReturn[ 'remittance_info' ];
                delete objToReturn[ 'payment_terms' ];
                delete objToReturn[ 'vendor_payment_term' ];

                return objToReturn;
            },

            dateFormatter( date ) {
                return moment( date ).format( 'MMMM Do YYYY' );
            },

            clearAll() {
                this.form.client = [];
            },

            addVendorNoteTemplate() {
                let that = this;

                this.$nextTick( function () {
                    if ( that.vendor_note_template ) {
                        that.form.vendor_notes = that.vendor_note_template.note;
                    }
                } );
            },

            onSuccess( data ) {
                if ( this.savedByAction ) {
                    this.$notify( {
                        type: 'success',
                        title: 'Success!',
                        text: 'The ' + this.templateType + ' has successfully saved.'
                    } );

                    if ( this.onSuccessCallback ) {
                        this.onSuccessCallback();

                        // close all modals
                        this.$modal.hide( 'save-as-official' );
                        this.$modal.hide( 'download' );
                        this.$modal.hide( 'print' );

                        // reset for the next request
                        this.onSuccessCallback = null;
                    }
                }
                else {
                    this.submiting = false;
                    if ( data.redirect ) {
                        window.location.replace( data.redirect );
                    }
                }
            },

            clientLookup( query ) {
                let q = query;
                let that = this;

                if ( !q ) {
                    return true;
                }

                if ( this.clientLookupTimeout ) {
                    clearTimeout( this.clientLookupTimeout );
                }

                this.clientLookupTimeout = setTimeout( function () {
                    that.isLoading = true;

                    axios.get( '/api/clients', {
                        params: {
                            q: q
                        }
                    } ).then( ( response ) => {
                        that.isLoading = false;
                        that.clients = response.data.data;
                    } );
                }, this.debounceTimeout );
            },

            vendorLookup( query ) {
                let q = query;
                let that = this;

                if ( !q ) {
                    return true;
                }

                if ( this.vendorLookupTimeout ) {
                    clearTimeout( this.vendorLookupTimeout );
                }

                this.vendorLookupTimeout = setTimeout( function () {
                    that.isLoading = true;

                    axios.get( '/api/vendors', {
                        params: {
                            q: q
                        }
                    } ).then( ( response ) => {
                        that.isLoading = false;
                        that.vendor_options = response.data.data;
                    } );
                }, this.debounceTimeout );
            },

            openModal( id ) {
                this.$modal.show( id );
            },

            closeModal( id ) {
                this.$modal.hide( id );
            },

            toggleType( id ) {
                if ( this.form.type.includes( id ) ) {
                    var index = this.form.type.indexOf( id );

                    if ( index !== -1 ) {
                        this.form.type.splice( index, 1 );
                    }
                }
                else {
                    this.form.type.push( id );
                }
            }


        },

        computed: {
            ...mapGetters( ['isUserManager'] ),

            jcp_files() {
                if ( this.is_filtering_files ) {
                    let _this = this;

                    return this.form.jcp_supporting_files.filter( file => {
                        if ( _this.is_filtering_files === 'images' ) {
                            return file.mime_type.includes( 'image/' );
                        }
                        else if ( _this.is_filtering_files === 'documents' ) {
                            return file.mime_type.includes( 'application/' );
                        }
                        else if ( _this.is_filtering_files === 'official' ) {
                            return file.collection_name === 'official_files';
                        }
                    } );
                }
                else {
                    return this.form.jcp_supporting_files;
                }
            },

            total_cost() {
                if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.total_price ) {
                    return 0;
                }

                return (this.$refs.project_invoice.total_cost);
            },

            total_value() {
                if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.total_price ) {
                    return 0;
                }

                return (this.$refs.project_invoice.total_price);
            },

            total_profit() {
                if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.total_price ) {
                    return 0;
                }

                return this.total_value - this.total_cost;
            },

            total_profit_percentage() {
                if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.total_price ) {
                    return 0;
                }

                let amount = (this.total_profit / this.total_cost);

                return (amount * 100).toFixed( 2 );
            },

            invoice_lines_by_category() {
                if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.collection ) {
                    return {};
                }

                let lines_by_categories = {};

                for ( let line of this.$refs.project_invoice.collection ) {
                    if ( !lines_by_categories.hasOwnProperty( line.category ) ) {
                        lines_by_categories[ line.category ] = [];
                    }

                    lines_by_categories[ line.category ].push( line );
                }


                return lines_by_categories;
            },

            show_invoice_lines: {
                get() {
                    return [1, 2, 4].includes( this.activeTab );
                }
            }
        }
    };
</script>
