<div class="kt-portlet kt-portlet--tabs">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
            <ul role="tablist" class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand">
                <li class="nav-item">
                    <a @click.prevent="setTab( 'primary_contacts' )" data-toggle="tab" href="#gpsd_overview" role="tab" class="nav-link active">Primary Contact(s)
                    </a></li>
                <li class="nav-item">
                    <a @click.prevent="setTab( 'social_media' )" data-toggle="tab" href="#gpsd_rfq" role="tab" class="nav-link ">Social Media
                    </a></li>
                <li class="nav-item">
                    <a @click.prevent="setTab( 'alternative_contacts' )" data-toggle="tab" href="#gpsd_pcq" role="tab" class="nav-link">Alternative Contacts
                    </a></li>
            </ul>
        </div>
    </div>
</div>

<div id="primary_contacts" v-if="isCurrentTab( 'primary_contacts' )">
    <!-- begin::categorization-->
    <div class="kt-portlet" data-ktportlet="true" id="categorization">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Categorization
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group" :class="{'has-danger': errors.has('type'), 'has-success': this.fields.type && this.fields.type.valid}">
                            <label for="type">
                                {{ trans('admin.contact.columns.contact_type') }}
                            </label>

                            <multiselect :disabled="$parent.is_viewing" v-model="form.type" :options="options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Client Type" label="name" track-by="name" :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                    <span class="multiselect__single" v-if="form.type && form.type.length && !isOpen">@{{ form.type.length }} options selected</span>
                                </template>
                            </multiselect>
                            <div v-if="errors.has('type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type') }}</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group" :class="{'has-danger': errors.has('assigned_salesperson'), 'has-success': this.fields.name && this.fields.assigned_salesperson.valid}">
                            <label for="assigned_salesperson">
                                {{ trans('admin.contact.columns.assigned_salesperson') }}
                            </label>

                            <multiselect :disabled="$parent.is_viewing" v-model="form.assigned_salesperson" :options="sales_people" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Salesperson" label="name" track-by="name" :preselect-first="false">
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
                        <div class="form-group-last" :class="{'has-danger': errors.has('source'), 'has-success': this.fields.source && this.fields.source.valid}">
                            <label for="source">
                                {{ trans('admin.contact.columns.source') }}
                            </label>

                            <multiselect :disabled="$parent.is_viewing" v-model="form.source" :options="source_options" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Source" label="name" track-by="name" :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                    <span class="multiselect__single" v-if="form.source && form.source.length && !isOpen">@{{ form.source.length }} options selected</span>
                                </template>
                            </multiselect>
                            <div v-if="errors.has('source')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('source') }}</div>
                        </div>
                    </div>

                    <!-- Referred By -->
                    <div class="col-12 col-md-6 mt-3">
                        <div class="form-group" :class="{'has-danger': errors.has('referred_by'), 'has-success': this.fields.referred_by && this.fields.referred_by.valid}">
                            <label for="referred_by">
                                {{ trans('admin.contact.columns.referred_by') }}
                            </label>

                            <multiselect :disabled="$parent.is_viewing" v-model="form.referred_by" :options="contacts" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="referred_by" track-by="id" :preselect-first="false">
                                <template slot="option" slot-scope="props">
                                    <span>@{{ props.option.primary_contact_name || props.option.company_name }}</span>
                                </template>
                                <template slot="singleLabel" slot-scope="props">
                                    <span>@{{ props.option.primary_contact_name || props.option.company_name }}</span>
                                </template>
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


                    <div class="col-12 mt-3">
                        <div class="form-group-last">
                            <label>Time Zone</label>
                            <select :disabled="$parent.is_viewing" v-model="form.timezone" class="form-control">
                                <option data-offset="-39600" value="International Date Line West">(GMT-11:00) International Date Line West</option>
                                <option data-offset="-39600" value="Midway Island">(GMT-11:00) Midway Island</option>
                                <option data-offset="-39600" value="Samoa">(GMT-11:00) Samoa</option>
                                <option data-offset="-36000" value="Hawaii">(GMT-10:00) Hawaii</option>
                                <option data-offset="-28800" value="Alaska">(GMT-08:00) Alaska</option>
                                <option data-offset="-25200" value="Pacific Time (US &amp; Canada)">(GMT-07:00) Pacific Time (US &amp; Canada)</option>
                                <option data-offset="-25200" value="Tijuana">(GMT-07:00) Tijuana</option>
                                <option data-offset="-25200" value="Arizona">(GMT-07:00) Arizona</option>
                                <option data-offset="-21600" value="Mountain Time (US &amp; Canada)">(GMT-06:00) Mountain Time (US &amp; Canada)</option>
                                <option data-offset="-21600" value="Chihuahua">(GMT-06:00) Chihuahua</option>
                                <option data-offset="-21600" value="Mazatlan">(GMT-06:00) Mazatlan</option>
                                <option data-offset="-21600" value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                <option data-offset="-21600" value="Central America">(GMT-06:00) Central America</option>
                                <option data-offset="-18000" value="Central Time (US &amp; Canada)">(GMT-05:00) Central Time (US &amp; Canada)</option>
                                <option data-offset="-18000" value="Guadalajara">(GMT-05:00) Guadalajara</option>
                                <option data-offset="-18000" value="Mexico City">(GMT-05:00) Mexico City</option>
                                <option data-offset="-18000" value="Monterrey">(GMT-05:00) Monterrey</option>
                                <option data-offset="-18000" value="Bogota">(GMT-05:00) Bogota</option>
                                <option data-offset="-18000" value="Lima">(GMT-05:00) Lima</option>
                                <option data-offset="-18000" value="Quito">(GMT-05:00) Quito</option>
                                <option data-offset="-14400" value="Eastern Time (US &amp; Canada)">(GMT-04:00) Eastern Time (US &amp; Canada)</option>
                                <option data-offset="-14400" value="Indiana (East)">(GMT-04:00) Indiana (East)</option>
                                <option data-offset="-14400" value="Caracas">(GMT-04:00) Caracas</option>
                                <option data-offset="-14400" value="La Paz">(GMT-04:00) La Paz</option>
                                <option data-offset="-14400" value="Georgetown">(GMT-04:00) Georgetown</option>
                                <option data-offset="-10800" value="Atlantic Time (Canada)">(GMT-03:00) Atlantic Time (Canada)</option>
                                <option data-offset="-10800" value="Santiago">(GMT-03:00) Santiago</option>
                                <option data-offset="-10800" value="Brasilia">(GMT-03:00) Brasilia</option>
                                <option data-offset="-10800" value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
                                <option data-offset="-9000" value="Newfoundland">(GMT-02:30) Newfoundland</option>
                                <option data-offset="-7200" value="Greenland">(GMT-02:00) Greenland</option>
                                <option data-offset="-7200" value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
                                <option data-offset="-3600" value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
                                <option data-offset="0" value="Azores">(GMT) Azores</option>
                                <option data-offset="0" value="Monrovia">(GMT) Monrovia</option>
                                <option data-offset="0" value="UTC">(GMT) UTC</option>
                                <option data-offset="3600" value="Dublin">(GMT+01:00) Dublin</option>
                                <option data-offset="3600" value="Edinburgh">(GMT+01:00) Edinburgh</option>
                                <option data-offset="3600" value="Lisbon">(GMT+01:00) Lisbon</option>
                                <option data-offset="3600" value="London">(GMT+01:00) London</option>
                                <option data-offset="3600" value="Casablanca">(GMT+01:00) Casablanca</option>
                                <option data-offset="3600" value="West Central Africa">(GMT+01:00) West Central Africa</option>
                                <option data-offset="7200" value="Belgrade">(GMT+02:00) Belgrade</option>
                                <option data-offset="7200" value="Bratislava">(GMT+02:00) Bratislava</option>
                                <option data-offset="7200" value="Budapest">(GMT+02:00) Budapest</option>
                                <option data-offset="7200" value="Ljubljana">(GMT+02:00) Ljubljana</option>
                                <option data-offset="7200" value="Prague">(GMT+02:00) Prague</option>
                                <option data-offset="7200" value="Sarajevo">(GMT+02:00) Sarajevo</option>
                                <option data-offset="7200" value="Skopje">(GMT+02:00) Skopje</option>
                                <option data-offset="7200" value="Warsaw">(GMT+02:00) Warsaw</option>
                                <option data-offset="7200" value="Zagreb">(GMT+02:00) Zagreb</option>
                                <option data-offset="7200" value="Brussels">(GMT+02:00) Brussels</option>
                                <option data-offset="7200" value="Copenhagen">(GMT+02:00) Copenhagen</option>
                                <option data-offset="7200" value="Madrid">(GMT+02:00) Madrid</option>
                                <option data-offset="7200" value="Paris">(GMT+02:00) Paris</option>
                                <option data-offset="7200" value="Amsterdam">(GMT+02:00) Amsterdam</option>
                                <option data-offset="7200" value="Berlin">(GMT+02:00) Berlin</option>
                                <option data-offset="7200" value="Bern">(GMT+02:00) Bern</option>
                                <option data-offset="7200" value="Rome">(GMT+02:00) Rome</option>
                                <option data-offset="7200" value="Stockholm">(GMT+02:00) Stockholm</option>
                                <option data-offset="7200" value="Vienna">(GMT+02:00) Vienna</option>
                                <option data-offset="7200" value="Cairo">(GMT+02:00) Cairo</option>
                                <option data-offset="7200" value="Harare">(GMT+02:00) Harare</option>
                                <option data-offset="7200" value="Pretoria">(GMT+02:00) Pretoria</option>
                                <option data-offset="10800" value="Bucharest">(GMT+03:00) Bucharest</option>
                                <option data-offset="10800" value="Helsinki">(GMT+03:00) Helsinki</option>
                                <option data-offset="10800" value="Kiev">(GMT+03:00) Kiev</option>
                                <option data-offset="10800" value="Kyiv">(GMT+03:00) Kyiv</option>
                                <option data-offset="10800" value="Riga">(GMT+03:00) Riga</option>
                                <option data-offset="10800" value="Sofia">(GMT+03:00) Sofia</option>
                                <option data-offset="10800" value="Tallinn">(GMT+03:00) Tallinn</option>
                                <option data-offset="10800" value="Vilnius">(GMT+03:00) Vilnius</option>
                                <option data-offset="10800" value="Athens">(GMT+03:00) Athens</option>
                                <option data-offset="10800" value="Istanbul">(GMT+03:00) Istanbul</option>
                                <option data-offset="10800" value="Minsk">(GMT+03:00) Minsk</option>
                                <option data-offset="10800" value="Jerusalem">(GMT+03:00) Jerusalem</option>
                                <option data-offset="10800" value="Moscow">(GMT+03:00) Moscow</option>
                                <option data-offset="10800" value="St. Petersburg">(GMT+03:00) St. Petersburg</option>
                                <option data-offset="10800" value="Volgograd">(GMT+03:00) Volgograd</option>
                                <option data-offset="10800" value="Kuwait">(GMT+03:00) Kuwait</option>
                                <option data-offset="10800" value="Riyadh">(GMT+03:00) Riyadh</option>
                                <option data-offset="10800" value="Nairobi">(GMT+03:00) Nairobi</option>
                                <option data-offset="10800" value="Baghdad">(GMT+03:00) Baghdad</option>
                                <option data-offset="14400" value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
                                <option data-offset="14400" value="Muscat">(GMT+04:00) Muscat</option>
                                <option data-offset="14400" value="Baku">(GMT+04:00) Baku</option>
                                <option data-offset="14400" value="Tbilisi">(GMT+04:00) Tbilisi</option>
                                <option data-offset="14400" value="Yerevan">(GMT+04:00) Yerevan</option>
                                <option data-offset="16200" value="Tehran">(GMT+04:30) Tehran</option>
                                <option data-offset="16200" value="Kabul">(GMT+04:30) Kabul</option>
                                <option data-offset="18000" value="Ekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                <option data-offset="18000" value="Islamabad">(GMT+05:00) Islamabad</option>
                                <option data-offset="18000" value="Karachi">(GMT+05:00) Karachi</option>
                                <option data-offset="18000" value="Tashkent">(GMT+05:00) Tashkent</option>
                                <option data-offset="19800" value="Chennai">(GMT+05:30) Chennai</option>
                                <option data-offset="19800" value="Kolkata">(GMT+05:30) Kolkata</option>
                                <option data-offset="19800" value="Mumbai">(GMT+05:30) Mumbai</option>
                                <option data-offset="19800" value="New Delhi">(GMT+05:30) New Delhi</option>
                                <option data-offset="19800" value="Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura</option>
                                <option data-offset="20700" value="Kathmandu">(GMT+05:45) Kathmandu</option>
                                <option data-offset="21600" value="Astana">(GMT+06:00) Astana</option>
                                <option data-offset="21600" value="Dhaka">(GMT+06:00) Dhaka</option>
                                <option data-offset="21600" value="Almaty">(GMT+06:00) Almaty</option>
                                <option data-offset="21600" value="Urumqi">(GMT+06:00) Urumqi</option>
                                <option data-offset="23400" value="Rangoon">(GMT+06:30) Rangoon</option>
                                <option data-offset="25200" value="Novosibirsk">(GMT+07:00) Novosibirsk</option>
                                <option data-offset="25200" value="Bangkok">(GMT+07:00) Bangkok</option>
                                <option data-offset="25200" value="Hanoi">(GMT+07:00) Hanoi</option>
                                <option data-offset="25200" value="Jakarta">(GMT+07:00) Jakarta</option>
                                <option data-offset="25200" value="Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                <option data-offset="28800" value="Beijing">(GMT+08:00) Beijing</option>
                                <option data-offset="28800" value="Chongqing">(GMT+08:00) Chongqing</option>
                                <option data-offset="28800" value="Hong Kong">(GMT+08:00) Hong Kong</option>
                                <option data-offset="28800" value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
                                <option data-offset="28800" value="Singapore">(GMT+08:00) Singapore</option>
                                <option data-offset="28800" value="Taipei">(GMT+08:00) Taipei</option>
                                <option data-offset="28800" value="Perth">(GMT+08:00) Perth</option>
                                <option data-offset="28800" value="Irkutsk">(GMT+08:00) Irkutsk</option>
                                <option data-offset="28800" value="Ulaan Bataar">(GMT+08:00) Ulaan Bataar</option>
                                <option data-offset="32400" value="Seoul">(GMT+09:00) Seoul</option>
                                <option data-offset="32400" value="Osaka">(GMT+09:00) Osaka</option>
                                <option data-offset="32400" value="Sapporo">(GMT+09:00) Sapporo</option>
                                <option data-offset="32400" value="Tokyo">(GMT+09:00) Tokyo</option>
                                <option data-offset="32400" value="Yakutsk">(GMT+09:00) Yakutsk</option>
                                <option data-offset="34200" value="Darwin">(GMT+09:30) Darwin</option>
                                <option data-offset="34200" value="Adelaide">(GMT+09:30) Adelaide</option>
                                <option data-offset="36000" value="Canberra">(GMT+10:00) Canberra</option>
                                <option data-offset="36000" value="Melbourne">(GMT+10:00) Melbourne</option>
                                <option data-offset="36000" value="Sydney">(GMT+10:00) Sydney</option>
                                <option data-offset="36000" value="Brisbane">(GMT+10:00) Brisbane</option>
                                <option data-offset="36000" value="Hobart">(GMT+10:00) Hobart</option>
                                <option data-offset="36000" value="Vladivostok">(GMT+10:00) Vladivostok</option>
                                <option data-offset="36000" value="Guam">(GMT+10:00) Guam</option>
                                <option data-offset="36000" value="Port Moresby">(GMT+10:00) Port Moresby</option>
                                <option data-offset="36000" value="Solomon Is.">(GMT+10:00) Solomon Is.</option>
                                <option data-offset="39600" value="Magadan">(GMT+11:00) Magadan</option>
                                <option data-offset="39600" value="New Caledonia">(GMT+11:00) New Caledonia</option>
                                <option data-offset="43200" value="Fiji">(GMT+12:00) Fiji</option>
                                <option data-offset="43200" value="Kamchatka">(GMT+12:00) Kamchatka</option>
                                <option data-offset="43200" value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
                                <option data-offset="43200" value="Auckland">(GMT+12:00) Auckland</option>
                                <option data-offset="43200" value="Wellington">(GMT+12:00) Wellington</option>
                                <option data-offset="46800" value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end::categorization-->

    <!-- begin::company-->
    <div class="kt-portlet" data-ktportlet="true" id="company">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Company Information
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <!-- Company Name -->
                    <div class="mt-3 col-12 form-group" :class="{'has-danger': errors.has('company_name'), 'has-success': this.fields.company_name && this.fields.company_name.valid}">
                        <label for="company_name">
                            {{ trans('admin.vendor.columns.company_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.company_name" class="form-control" :class="{'form-control-danger': errors.has('company_name'), 'form-control-success': this.fields.company_name && this.fields.company_name.valid }" id="company_name" name="company_name" placeholder="{{ trans('admin.vendor.columns.company_name') }}">
                        <div v-if="errors.has('company_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('company_name') }}</div>
                    </div>

                    <!-- Company Name -->
                    <div class="mt-3 col-6 form-group" :class="{'has-danger': errors.has('website'), 'has-success': this.fields.website && this.fields.website.valid}">
                        <label for="website">
                            {{ trans('admin.vendor.columns.website') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.website" class="form-control" :class="{'form-control-danger': errors.has('website'), 'form-control-success': this.fields.website && this.fields.website.valid }" id="website" name="website" placeholder="{{ trans('admin.vendor.columns.website') }}">
                        <div v-if="errors.has('website')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('website') }}</div>
                    </div>

                    <!-- Company Phone -->
                    <div class="mt-3 col-6 form-group" :class="{'has-danger': errors.has('company_phone'), 'has-success': this.fields.company_phone && this.fields.company_phone.valid}">
                        <label for="company_phone">
                            {{ trans('admin.vendor.columns.company_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.company_phone" class="form-control" :class="{'form-control-danger': errors.has('company_phone'), 'form-control-success': this.fields.company_phone && this.fields.company_phone.valid }" id="company_phone" name="company_phone" placeholder="{{ trans('admin.vendor.columns.company_phone') }}">
                        <div v-if="errors.has('company_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('company_phone') }}</div>
                    </div>

                    <!-- Company Address -->
                    <div class="mt-3 col-6 form-group-last" :class="{'has-danger': errors.has('company_address'), 'has-success': this.fields.company_address && this.fields.company_address.valid}">
                        <label for="company_address">
                            {{ trans('admin.vendor.columns.company_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.company_address" class="form-control" :class="{'form-control-danger': errors.has('company_address'), 'form-control-success': this.fields.company_address && this.fields.company_address.valid }" id="company_address" name="company_address" placeholder="{{ trans('admin.vendor.columns.company_address') }}"></textarea>
                        <div v-if="errors.has('company_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('company_address') }}</div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="mt-3 col-6 form-group-last" :class="{'has-danger': errors.has('shipping_address'), 'has-success': this.fields.shipping_address && this.fields.shipping_address.valid}">
                        <label for="shipping_address">
                            {{ trans('admin.vendor.columns.shipping_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.shipping_address" class="form-control" :class="{'form-control-danger': errors.has('shipping_address'), 'form-control-success': this.fields.shipping_address && this.fields.shipping_address.valid }" id="shipping_address" name="shipping_address" placeholder="{{ trans('admin.vendor.columns.shipping_address') }}"></textarea>
                        <div v-if="errors.has('shipping_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_address') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end::company-->


    <!-- begin::primary-->
    <div class="kt-portlet" data-ktportlet="true" id="primary_contact">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    <span class="d-block">Primary Contact #1</span>

                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <!-- Primary Contact Name -->
                    <div class="col-12">
                        <label for="primary_contact_name">
                            {{ trans('admin.vendor.columns.primary_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.primary_contact_name" class="form-control" placeholder="{{ trans('admin.vendor.columns.primary_contact_name') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_name') }}</div>--}}
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6">
                        <label for="primary_contact_phone">
                            {{ trans('admin.vendor.columns.primary_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.primary_contact_phone" class="form-control" id="primary_contact_phone" placeholder="{{ trans('admin.vendor.columns.primary_contact_phone') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_phone') }}</div>--}}
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6">
                        <label for="primary_contact_email">
                            {{ trans('admin.vendor.columns.primary_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.primary_contact_email" class="form-control" placeholder="{{ trans('admin.vendor.columns.primary_contact_email') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_email') }}</div>--}}
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 mt-3">
                        <label for="primary_contact_address">
                            {{ trans('admin.vendor.columns.primary_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.primary_contact_address" class="form-control" name="primary_contact_address" placeholder="{{ trans('admin.vendor.columns.primary_contact_address') }}"></textarea>
                        {{--                                   <div v-if="errors.has('primary_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_address') }}</div>--}}
                    </div>

                    <div class="col-12 mt-3">
                        <label>Preferred Communication</label>

                        <div class="container-fluid mt-2">
                            <div class="kt-checkbox-inline row text-left">
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.primary_contact_communication_preferences" value="email" type="checkbox"> Email
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.primary_contact_communication_preferences" value="sms" type="checkbox"> SMS
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.primary_contact_communication_preferences" value="phone" type="checkbox"> Phone
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.primary_contact_communication_preferences" value="do not disturb" type="checkbox"> Do Not Disturb
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.primary_contact_communication_preferences" value="never contact" type="checkbox"> Never Contact
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- end::primary-->

    <!-- begin::primary-->
    <div class="kt-portlet" data-ktportlet="true" id="secondary_contact">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    <span class="d-block">Primary Contact #2</span>

                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <!-- Primary Contact Name -->
                    <div class="col-12">
                        <label for="primary_contact_name">
                            {{ trans('admin.vendor.columns.primary_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.secondary_contact_name" class="form-control" placeholder="{{ trans('admin.vendor.columns.primary_contact_name') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_name') }}</div>--}}
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6">
                        <label for="primary_contact_phone">
                            {{ trans('admin.vendor.columns.primary_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.secondary_contact_phone" class="form-control" id="primary_contact_phone" placeholder="{{ trans('admin.vendor.columns.primary_contact_phone') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_phone') }}</div>--}}
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6">
                        <label for="primary_contact_email">
                            {{ trans('admin.vendor.columns.primary_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.secondary_contact_email" class="form-control" placeholder="{{ trans('admin.vendor.columns.primary_contact_email') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_email') }}</div>--}}
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 mt-3">
                        <label for="primary_contact_address">
                            {{ trans('admin.vendor.columns.primary_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.secondary_contact_address" class="form-control" name="primary_contact_address" placeholder="{{ trans('admin.vendor.columns.primary_contact_address') }}"></textarea>
                        {{--                                   <div v-if="errors.has('primary_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_address') }}</div>--}}
                    </div>

                    <div class="col-12 mt-3">
                        <label>Preferred Communication</label>

                        <div class="container-fluid mt-2">
                            <div class="kt-checkbox-inline row text-left">
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.secondary_contact_communication_preferences" value="email" type="checkbox"> Email
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.secondary_contact_communication_preferences" value="sms" type="checkbox"> SMS
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.secondary_contact_communication_preferences" value="phone" type="checkbox"> Phone
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.secondary_contact_communication_preferences" value="do not disturb" type="checkbox"> Do Not Disturb
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.secondary_contact_communication_preferences" value="never contact" type="checkbox"> Never Contact
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- end::primary-->
</div>

<div id="social_media" v-if="isCurrentTab( 'social_media' )">
    <!-- begin::company-->
    <div class="kt-portlet" data-ktportlet="true" id="company">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Social Media URLs
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="kt-section__body">
                            <div class="row">
                                <!-- Facebook -->
                                <div class="mt-3 col-6" :class="{'has-danger': errors.has('facebook'), 'has-success': this.fields.facebook && this.fields.facebook.valid}">
                                    <label for="facebook">
                                        {{ trans('admin.vendor.columns.facebook') }}
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="bg-transparent border-0 input-group-text"><i style="font-size:24px;" class="flaticon-facebook-logo-button"></i></span>
                                        </div>
                                        <input :disabled="$parent.is_viewing" type="text" v-model="form.social_media.facebook" class="form-control" :class="{'form-control-danger': errors.has('facebook'), 'form-control-success': this.fields.facebook && this.fields.facebook.valid }" id="facebook" name="facebook" placeholder="{{ trans('admin.vendor.columns.facebook') }}">
                                    </div>
                                    <div v-if="errors.has('facebook')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('facebook') }}</div>
                                </div>

                                <!-- Facebook -->
                                <div class="mt-3 col-6" :class="{'has-danger': errors.has('twitter'), 'has-success': this.fields.twitter && this.fields.twitter.valid}">
                                    <label for="twitter">
                                        {{ trans('admin.vendor.columns.twitter') }}
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="bg-transparent border-0 input-group-text"><i style="font-size:24px;" class="flaticon-twitter-logo-button"></i></span>
                                        </div>
                                        <input :disabled="$parent.is_viewing" type="text" v-model="form.social_media.twitter" class="form-control" :class="{'form-control-danger': errors.has('twitter'), 'form-control-success': this.fields.twitter && this.fields.twitter.valid }" id="twitter" name="twitter" placeholder="{{ trans('admin.vendor.columns.twitter') }}">
                                    </div>
                                    <div v-if="errors.has('twitter')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('twitter') }}</div>
                                </div>

                                <!-- Instagram -->
                                <div class="mt-3 col-6" :class="{'has-danger': errors.has('instagram'), 'has-success': this.fields.instagram && this.fields.instagram.valid}">
                                    <label for="instagram">
                                        {{ trans('admin.vendor.columns.instagram') }}
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="bg-transparent border-0 input-group-text"><i style="font-size:24px;" class="flaticon-instagram-logo"></i></span>
                                        </div>
                                        <input :disabled="$parent.is_viewing" type="text" v-model="form.social_media.instagram" class="form-control" :class="{'form-control-danger': errors.has('instagram'), 'form-control-success': this.fields.instagram && this.fields.instagram.valid }" id="instagram" name="instagram" placeholder="{{ trans('admin.vendor.columns.instagram') }}">
                                    </div>
                                    <div v-if="errors.has('instagram')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('instagram') }}</div>
                                </div>

                                <!-- Youtube -->
                                <div class="mt-3 col-6" :class="{'has-danger': errors.has('youtube'), 'has-success': this.fields.youtube && this.fields.youtube.valid}">
                                    <label for="youtube">
                                        {{ trans('admin.vendor.columns.youtube') }}
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="bg-transparent border-0 input-group-text"><i style="font-size:24px;" class="flaticon-youtube"></i></span>
                                        </div>
                                        <input :disabled="$parent.is_viewing" type="text" v-model="form.social_media.youtube" class="form-control" :class="{'form-control-danger': errors.has('youtube'), 'form-control-success': this.fields.youtube && this.fields.youtube.valid }" id="youtube" name="youtube" placeholder="{{ trans('admin.vendor.columns.youtube') }}">
                                    </div>
                                    <div v-if="errors.has('youtube')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('youtube') }}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end::company-->

</div>

<div id="alternative_contacts" v-if="isCurrentTab( 'alternative_contacts' )">
    <!-- begin::sales-->
    <div class="kt-portlet" data-ktportlet="true" id="company">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Sales Contact Information
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <!-- Primary Contact Name -->
                    <div class="col-12" :class="{'has-danger': errors.has('sales_contact_name'), 'has-success': this.fields.sales_contact_name && this.fields.sales_contact_name.valid}">
                        <label for="sales_contact_name">
                            {{ trans('admin.vendor.columns.sales_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.sales_contact_name" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_name'), 'form-control-success': this.fields.sales_contact_name && this.fields.sales_contact_name.valid }" id="sales_contact_name" sales_contact_name="sales_contact_name" placeholder="{{ trans('admin.vendor.columns.sales_contact_name') }}">
                        <div v-if="errors.has('sales_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_name') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6" :class="{'has-danger': errors.has('sales_contact_phone'), 'has-success': this.fields.sales_contact_phone && this.fields.sales_contact_phone.valid}">
                        <label for="sales_contact_phone">
                            {{ trans('admin.vendor.columns.sales_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.sales_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_phone'), 'form-control-success': this.fields.sales_contact_phone && this.fields.sales_contact_phone.valid }" id="sales_contact_phone" sales_contact_phone="sales_contact_phone" placeholder="{{ trans('admin.vendor.columns.sales_contact_phone') }}">
                        <div v-if="errors.has('sales_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_phone') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6" :class="{'has-danger': errors.has('sales_contact_email'), 'has-success': this.fields.sales_contact_email && this.fields.sales_contact_email.valid}">
                        <label for="sales_contact_email">
                            {{ trans('admin.vendor.columns.sales_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.sales_contact_email" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_email'), 'form-control-success': this.fields.sales_contact_email && this.fields.sales_contact_email.valid }" id="sales_contact_email" sales_contact_email="sales_contact_email" placeholder="{{ trans('admin.vendor.columns.sales_contact_email') }}">
                        <div v-if="errors.has('sales_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_email') }}</div>
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 mt-3" :class="{'has-danger': errors.has('sales_contact_address'), 'has-success': this.fields.sales_contact_address && this.fields.sales_contact_address.valid}">
                        <label for="sales_contact_address">
                            {{ trans('admin.vendor.columns.sales_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.sales_contact_address" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_address'), 'form-control-success': this.fields.sales_contact_address && this.fields.sales_contact_address.valid }" id="sales_contact_address" name="sales_contact_address" placeholder="{{ trans('admin.vendor.columns.sales_contact_address') }}"></textarea>
                        <div v-if="errors.has('sales_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_address') }}</div>
                    </div>

                    <div class="col-12 mt-3">
                        <label>Preferred Communication</label>

                        <div class="container-fluid mt-2">
                            <div class="kt-checkbox-inline row text-left">
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.sales_contact_communication_preferences" value="email" type="checkbox"> Email
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.sales_contact_communication_preferences" value="sms" type="checkbox"> SMS
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.sales_contact_communication_preferences" value="phone" type="checkbox"> Phone
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.sales_contact_communication_preferences" value="do not disturb" type="checkbox"> Do Not Disturb
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.sales_contact_communication_preferences" value="never contact" type="checkbox"> Never Contact
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end::sales-->

    <!-- begin::design-->
    <div class="kt-portlet" data-ktportlet="true" id="company">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Design Contact Information
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <!-- Primary Contact Name -->
                    <div class="col-12" :class="{'has-danger': errors.has('design_contact_name'), 'has-success': this.fields.design_contact_name && this.fields.design_contact_name.valid}">
                        <label for="design_contact_name">
                            {{ trans('admin.vendor.columns.design_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.design_contact_name" class="form-control" :class="{'form-control-danger': errors.has('design_contact_name'), 'form-control-success': this.fields.design_contact_name && this.fields.design_contact_name.valid }" id="design_contact_name" design_contact_name="design_contact_name" placeholder="{{ trans('admin.vendor.columns.design_contact_name') }}">
                        <div v-if="errors.has('design_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_name') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6" :class="{'has-danger': errors.has('design_contact_phone'), 'has-success': this.fields.design_contact_phone && this.fields.design_contact_phone.valid}">
                        <label for="design_contact_phone">
                            {{ trans('admin.vendor.columns.design_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.design_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('design_contact_phone'), 'form-control-success': this.fields.design_contact_phone && this.fields.design_contact_phone.valid }" id="design_contact_phone" design_contact_phone="design_contact_phone" placeholder="{{ trans('admin.vendor.columns.design_contact_phone') }}">
                        <div v-if="errors.has('design_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_phone') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6" :class="{'has-danger': errors.has('design_contact_email'), 'has-success': this.fields.design_contact_email && this.fields.design_contact_email.valid}">
                        <label for="design_contact_email">
                            {{ trans('admin.vendor.columns.design_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.design_contact_email" class="form-control" :class="{'form-control-danger': errors.has('design_contact_email'), 'form-control-success': this.fields.design_contact_email && this.fields.design_contact_email.valid }" id="design_contact_email" design_contact_email="design_contact_email" placeholder="{{ trans('admin.vendor.columns.design_contact_email') }}">
                        <div v-if="errors.has('design_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_email') }}</div>
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 mt-3" :class="{'has-danger': errors.has('design_contact_address'), 'has-success': this.fields.design_contact_address && this.fields.design_contact_address.valid}">
                        <label for="design_contact_address">
                            {{ trans('admin.vendor.columns.design_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.design_contact_address" class="form-control" :class="{'form-control-danger': errors.has('design_contact_address'), 'form-control-success': this.fields.design_contact_address && this.fields.design_contact_address.valid }" id="design_contact_address" name="design_contact_address" placeholder="{{ trans('admin.vendor.columns.design_contact_address') }}"></textarea>
                        <div v-if="errors.has('design_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_address') }}</div>
                    </div>

                    <div class="col-12 mt-3">
                        <label>Preferred Communication</label>

                        <div class="container-fluid mt-2">
                            <div class="kt-checkbox-inline row text-left">
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.design_contact_communication_preferences" value="email" type="checkbox"> Email
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.design_contact_communication_preferences" value="sms" type="checkbox"> SMS
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.design_contact_communication_preferences" value="phone" type="checkbox"> Phone
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.design_contact_communication_preferences" value="do not disturb" type="checkbox"> Do Not Disturb
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.design_contact_communication_preferences" value="never contact" type="checkbox"> Never Contact
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end::design-->

    <!-- begin::financial-->
    <div class="kt-portlet" data-ktportlet="true" id="company">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Financial Contact Information
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <!-- Primary Contact Name -->
                    <div class="col-12" :class="{'has-danger': errors.has('financial_contact_name'), 'has-success': this.fields.financial_contact_name && this.fields.financial_contact_name.valid}">
                        <label for="financial_contact_name">
                            {{ trans('admin.vendor.columns.financial_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.financial_contact_name" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_name'), 'form-control-success': this.fields.financial_contact_name && this.fields.financial_contact_name.valid }" id="financial_contact_name" financial_contact_name="financial_contact_name" placeholder="{{ trans('admin.vendor.columns.financial_contact_name') }}">
                        <div v-if="errors.has('financial_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_name') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6" :class="{'has-danger': errors.has('financial_contact_phone'), 'has-success': this.fields.financial_contact_phone && this.fields.financial_contact_phone.valid}">
                        <label for="financial_contact_phone">
                            {{ trans('admin.vendor.columns.financial_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.financial_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_phone'), 'form-control-success': this.fields.financial_contact_phone && this.fields.financial_contact_phone.valid }" id="financial_contact_phone" financial_contact_phone="financial_contact_phone" placeholder="{{ trans('admin.vendor.columns.financial_contact_phone') }}">
                        <div v-if="errors.has('financial_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_phone') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="mt-3 col-6" :class="{'has-danger': errors.has('financial_contact_email'), 'has-success': this.fields.financial_contact_email && this.fields.financial_contact_email.valid}">
                        <label for="financial_contact_email">
                            {{ trans('admin.vendor.columns.financial_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.financial_contact_email" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_email'), 'form-control-success': this.fields.financial_contact_email && this.fields.financial_contact_email.valid }" id="financial_contact_email" financial_contact_email="financial_contact_email" placeholder="{{ trans('admin.vendor.columns.financial_contact_email') }}">
                        <div v-if="errors.has('financial_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_email') }}</div>
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 mt-3" :class="{'has-danger': errors.has('financial_contact_address'), 'has-success': this.fields.financial_contact_address && this.fields.financial_contact_address.valid}">
                        <label for="financial_contact_address">
                            {{ trans('admin.vendor.columns.financial_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.financial_contact_address" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_address'), 'form-control-success': this.fields.financial_contact_address && this.fields.financial_contact_address.valid }" id="financial_contact_address" name="financial_contact_address" placeholder="{{ trans('admin.vendor.columns.financial_contact_address') }}"></textarea>
                        <div v-if="errors.has('financial_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_address') }}</div>
                    </div>

                    <div class="col-12 mt-3">
                        <label>Preferred Communication</label>

                        <div class="container-fluid mt-2">
                            <div class="kt-checkbox-inline row text-left">
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.financial_contact_communication_preferences" value="email" type="checkbox"> Email
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.financial_contact_communication_preferences" value="sms" type="checkbox"> SMS
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.financial_contact_communication_preferences" value="phone" type="checkbox"> Phone
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.financial_contact_communication_preferences" value="do not disturb" type="checkbox"> Do Not Disturb
                                    <span></span>
                                </label>
                                <label class="kt-checkbox col">
                                    <input :disabled="$parent.is_viewing" v-model="form.financial_contact_communication_preferences" value="never contact" type="checkbox"> Never Contact
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end::financial-->
</div>
