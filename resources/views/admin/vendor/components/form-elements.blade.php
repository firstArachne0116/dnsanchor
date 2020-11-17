<div class="kt-portlet kt-portlet--tabs">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
            <ul role="tablist" class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand">
                <li class="nav-item">
                    <a @click.prevent="setTab( 'vendor_information' )" data-toggle="tab" href="#" role="tab" class="nav-link active">Vendor Information
                    </a></li>
                <li class="nav-item">
                    <a @click.prevent="setTab( 'primary_contact' )" data-toggle="tab" href="#gpsd_overview" role="tab" class="nav-link">Primary Contact
                    </a></li>
                <li class="nav-item">
                    <a @click.prevent="setTab( 'alternative_contacts' )" data-toggle="tab" href="#gpsd_pcq" role="tab" class="nav-link">Alternative Contacts
                    </a></li>
            </ul>
        </div>
    </div>
</div>

<div id="vendor_information" v-if="isCurrentTab( 'vendor_information' )">
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
                        <div class="form-group" :class="{'has-danger': errors.has('assigned_salesperson'), 'has-success': this.fields.name && this.fields.assigned_salesperson.valid}">
                            <label for="assigned_salesperson">
                                {{ trans('admin.contact.columns.assigned_salesperson') }}
                            </label>

                            <multiselect :disabled="$parent.is_viewing" v-model="form.assigned_salesperson" :options="sales_people" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Salesperson" label="full_name" track-by="id" :preselect-first="false"></multiselect>
                            <div v-if="errors.has('assigned_salesperson')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('assigned_salesperson') }}</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group" :class="{'has-danger': errors.has('category_id'), 'has-success': this.fields.name && this.fields.category_id.valid}">
                            <label for="category_id">
                                Vendor Category
                            </label>

                            <multiselect :disabled="$parent.is_viewing" v-model="form.category" :options="categories" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Vendor Category" label="name" track-by="name" :preselect-first="false"></multiselect>
                            <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('category_id') }}</div>
                        </div>
                    </div>

                    <div class="col-12 form-group">
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
                    Vendor Information
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <!-- Company Name -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid}">
                        <label for="name">
                            {{ trans('admin.vendor.columns.name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.name" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid }" id="name" name="name" placeholder="{{ trans('admin.vendor.columns.name') }}">
                        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
                    </div>

                    <!-- Company Name -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('website'), 'has-success': this.fields.website && this.fields.website.valid}">
                        <label for="website">
                            {{ trans('admin.vendor.columns.website') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.website" class="form-control" :class="{'form-control-danger': errors.has('website'), 'form-control-success': this.fields.website && this.fields.website.valid }" id="website" name="website" placeholder="{{ trans('admin.vendor.columns.website') }}">
                        <div v-if="errors.has('website')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('website') }}</div>
                    </div>

                    <!-- Company Phone -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('phone'), 'has-success': this.fields.phone && this.fields.phone.valid}">
                        <label for="phone">
                            {{ trans('admin.vendor.columns.phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.phone" class="form-control" :class="{'form-control-danger': errors.has('phone'), 'form-control-success': this.fields.phone && this.fields.phone.valid }" id="phone" name="phone" placeholder="{{ trans('admin.vendor.columns.phone') }}">
                        <div v-if="errors.has('phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('phone') }}</div>
                    </div>

                    <!-- Company fax -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('fax'), 'has-success': this.fields.fax && this.fields.fax.valid}">
                        <label for="fax">
                            {{ trans('admin.vendor.columns.fax') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.fax" class="form-control" :class="{'form-control-danger': errors.has('fax'), 'form-control-success': this.fields.fax && this.fields.fax.valid }" id="fax" name="fax" placeholder="{{ trans('admin.vendor.columns.fax') }}">
                        <div v-if="errors.has('fax')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fax') }}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end::company-->

    <!-- begin::billing information-->
    <div class="kt-portlet" data-ktportlet="true" id="company">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Vendor Billing Information
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">
                    <!-- Suite -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('suite'), 'has-success': this.fields.suite && this.fields.suite.valid}">
                        <label for="suite">
                            {{ trans('admin.vendor.columns.suite') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.suite" class="form-control" :class="{'form-control-danger': errors.has('suite'), 'form-control-success': this.fields.suite && this.fields.suite.valid }" id="suite" suite="suite" placeholder="{{ trans('admin.vendor.columns.suite') }}">
                        <div v-if="errors.has('suite')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('suite') }}</div>
                    </div>

                    <!-- Street -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('billing_address_street'), 'has-success': this.fields.billing_address_street && this.fields.billing_address_street.valid}">
                        <label for="billing_address_street">
                            {{ trans('admin.vendor.columns.billing_address_street') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.billing_address_street" class="form-control" :class="{'form-control-danger': errors.has('billing_address_street'), 'form-control-success': this.fields.billing_address_street && this.fields.billing_address_street.valid }" id="billing_address_street" billing_address_street="billing_address_street" placeholder="{{ trans('admin.vendor.columns.billing_address_street') }}">
                        <div v-if="errors.has('billing_address_street')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_street') }}</div>
                    </div>

                    <!-- City -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('billing_address_city'), 'has-success': this.fields.billing_address_city && this.fields.billing_address_city.valid}">
                        <label for="billing_address_city">
                            {{ trans('admin.vendor.columns.billing_address_city') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.billing_address_city" class="form-control" :class="{'form-control-danger': errors.has('billing_address_city'), 'form-control-success': this.fields.billing_address_city && this.fields.billing_address_city.valid }" id="billing_address_city" billing_address_city="billing_address_city" placeholder="{{ trans('admin.vendor.columns.billing_address_city') }}">
                        <div v-if="errors.has('billing_address_city')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_city') }}</div>
                    </div>

                    <!-- State -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('billing_address_state'), 'has-success': this.fields.billing_address_state && this.fields.billing_address_state.valid}">
                        <label for="billing_address_state">
                            {{ trans('admin.vendor.columns.billing_address_state') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.billing_address_state" class="form-control" :class="{'form-control-danger': errors.has('billing_address_state'), 'form-control-success': this.fields.billing_address_state && this.fields.billing_address_state.valid }" id="billing_address_state" billing_address_state="billing_address_state" placeholder="{{ trans('admin.vendor.columns.billing_address_state') }}">
                        <div v-if="errors.has('billing_address_state')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_state') }}</div>
                    </div>

                    <!-- ZIP -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('billing_address_zip_code'), 'has-success': this.fields.billing_address_zip_code && this.fields.billing_address_zip_code.valid}">
                        <label for="billing_address_zip_code">
                            {{ trans('admin.vendor.columns.billing_address_zip_code') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.billing_address_zip_code" class="form-control" :class="{'form-control-danger': errors.has('billing_address_zip_code'), 'form-control-success': this.fields.billing_address_zip_code && this.fields.billing_address_zip_code.valid }" id="billing_address_zip_code" billing_address_zip_code="billing_address_zip_code" placeholder="{{ trans('admin.vendor.columns.billing_address_zip_code') }}">
                        <div v-if="errors.has('billing_address_zip_code')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_zip_code') }}</div>
                    </div>

                    <!-- Country -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('billing_address_country'), 'has-success': this.fields.billing_address_country && this.fields.billing_address_country.valid}">
                        <label for="billing_address_country">
                            {{ trans('admin.vendor.columns.billing_address_country') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.billing_address_country" class="form-control" :class="{'form-control-danger': errors.has('billing_address_country'), 'form-control-success': this.fields.billing_address_country && this.fields.billing_address_country.valid }" id="billing_address_country" billing_address_country="billing_address_country" placeholder="{{ trans('admin.vendor.columns.billing_address_country') }}">
                        <div v-if="errors.has('billing_address_country')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_country') }}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end::billing information-->

    <!-- begin::notes-->
    <div class="kt-portlet" data-ktportlet="true" id="company">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Notes
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <!-- begin::Step 1-->
                <div class="row">

                    <!-- Country -->
                    <div class="col-12 form-group" :class="{'has-danger': errors.has('notes'), 'has-success': this.fields.notes && this.fields.notes.valid}">
                        <label for="notes">
                            {{ trans('admin.vendor.columns.notes') }}
                        </label>

                        <textarea rows="7" :disabled="$parent.is_viewing" v-model="form.notes" class="form-control" :class="{'form-control-danger': errors.has('notes'), 'form-control-success': this.fields.notes && this.fields.notes.valid }" id="notes" placeholder="{{ trans('admin.vendor.columns.notes') }}"></textarea>
                        <div v-if="errors.has('notes')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('notes') }}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end::notes-->



</div>

<div id="primary_contact" v-if="isCurrentTab( 'primary_contact' )">
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
                    <div class="form-group col-12">
                        <label for="primary_contact_name">
                            {{ trans('admin.vendor.columns.primary_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.primary_contact_name" class="form-control" placeholder="{{ trans('admin.vendor.columns.primary_contact_name') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_name') }}</div>--}}
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="form-group col-6">
                        <label for="primary_contact_phone">
                            {{ trans('admin.vendor.columns.primary_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.primary_contact_phone" class="form-control" id="primary_contact_phone" placeholder="{{ trans('admin.vendor.columns.primary_contact_phone') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_phone') }}</div>--}}
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="form-group col-6">
                        <label for="primary_contact_email">
                            {{ trans('admin.vendor.columns.primary_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.primary_contact_email" class="form-control" placeholder="{{ trans('admin.vendor.columns.primary_contact_email') }}">
                        {{--                                   <div v-if="errors.has('primary_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_email') }}</div>--}}
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 form-group">
                        <label for="primary_contact_address">
                            {{ trans('admin.vendor.columns.primary_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.primary_contact_address" class="form-control" name="primary_contact_address" placeholder="{{ trans('admin.vendor.columns.primary_contact_address') }}"></textarea>
                        {{--                                   <div v-if="errors.has('primary_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('primary_contact_address') }}</div>--}}
                    </div>

                    <div class="col-12 form-group">
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
                    <div class="form-group col-12" :class="{'has-danger': errors.has('sales_contact_name'), 'has-success': this.fields.sales_contact_name && this.fields.sales_contact_name.valid}">
                        <label for="sales_contact_name">
                            {{ trans('admin.vendor.columns.sales_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.sales_contact_name" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_name'), 'form-control-success': this.fields.sales_contact_name && this.fields.sales_contact_name.valid }" id="sales_contact_name" sales_contact_name="sales_contact_name" placeholder="{{ trans('admin.vendor.columns.sales_contact_name') }}">
                        <div v-if="errors.has('sales_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_name') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('sales_contact_phone'), 'has-success': this.fields.sales_contact_phone && this.fields.sales_contact_phone.valid}">
                        <label for="sales_contact_phone">
                            {{ trans('admin.vendor.columns.sales_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.sales_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_phone'), 'form-control-success': this.fields.sales_contact_phone && this.fields.sales_contact_phone.valid }" id="sales_contact_phone" sales_contact_phone="sales_contact_phone" placeholder="{{ trans('admin.vendor.columns.sales_contact_phone') }}">
                        <div v-if="errors.has('sales_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_phone') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('sales_contact_email'), 'has-success': this.fields.sales_contact_email && this.fields.sales_contact_email.valid}">
                        <label for="sales_contact_email">
                            {{ trans('admin.vendor.columns.sales_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.sales_contact_email" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_email'), 'form-control-success': this.fields.sales_contact_email && this.fields.sales_contact_email.valid }" id="sales_contact_email" sales_contact_email="sales_contact_email" placeholder="{{ trans('admin.vendor.columns.sales_contact_email') }}">
                        <div v-if="errors.has('sales_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_email') }}</div>
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 form-group" :class="{'has-danger': errors.has('sales_contact_address'), 'has-success': this.fields.sales_contact_address && this.fields.sales_contact_address.valid}">
                        <label for="sales_contact_address">
                            {{ trans('admin.vendor.columns.sales_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.sales_contact_address" class="form-control" :class="{'form-control-danger': errors.has('sales_contact_address'), 'form-control-success': this.fields.sales_contact_address && this.fields.sales_contact_address.valid }" id="sales_contact_address" name="sales_contact_address" placeholder="{{ trans('admin.vendor.columns.sales_contact_address') }}"></textarea>
                        <div v-if="errors.has('sales_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sales_contact_address') }}</div>
                    </div>

                    <div class="col-12 form-group">
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
                    <div class="form-group col-12" :class="{'has-danger': errors.has('design_contact_name'), 'has-success': this.fields.design_contact_name && this.fields.design_contact_name.valid}">
                        <label for="design_contact_name">
                            {{ trans('admin.vendor.columns.design_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.design_contact_name" class="form-control" :class="{'form-control-danger': errors.has('design_contact_name'), 'form-control-success': this.fields.design_contact_name && this.fields.design_contact_name.valid }" id="design_contact_name" design_contact_name="design_contact_name" placeholder="{{ trans('admin.vendor.columns.design_contact_name') }}">
                        <div v-if="errors.has('design_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_name') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('design_contact_phone'), 'has-success': this.fields.design_contact_phone && this.fields.design_contact_phone.valid}">
                        <label for="design_contact_phone">
                            {{ trans('admin.vendor.columns.design_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.design_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('design_contact_phone'), 'form-control-success': this.fields.design_contact_phone && this.fields.design_contact_phone.valid }" id="design_contact_phone" design_contact_phone="design_contact_phone" placeholder="{{ trans('admin.vendor.columns.design_contact_phone') }}">
                        <div v-if="errors.has('design_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_phone') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('design_contact_email'), 'has-success': this.fields.design_contact_email && this.fields.design_contact_email.valid}">
                        <label for="design_contact_email">
                            {{ trans('admin.vendor.columns.design_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.design_contact_email" class="form-control" :class="{'form-control-danger': errors.has('design_contact_email'), 'form-control-success': this.fields.design_contact_email && this.fields.design_contact_email.valid }" id="design_contact_email" design_contact_email="design_contact_email" placeholder="{{ trans('admin.vendor.columns.design_contact_email') }}">
                        <div v-if="errors.has('design_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_email') }}</div>
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 form-group" :class="{'has-danger': errors.has('design_contact_address'), 'has-success': this.fields.design_contact_address && this.fields.design_contact_address.valid}">
                        <label for="design_contact_address">
                            {{ trans('admin.vendor.columns.design_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.design_contact_address" class="form-control" :class="{'form-control-danger': errors.has('design_contact_address'), 'form-control-success': this.fields.design_contact_address && this.fields.design_contact_address.valid }" id="design_contact_address" name="design_contact_address" placeholder="{{ trans('admin.vendor.columns.design_contact_address') }}"></textarea>
                        <div v-if="errors.has('design_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('design_contact_address') }}</div>
                    </div>

                    <div class="col-12 form-group">
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
                    <div class="form-group col-12" :class="{'has-danger': errors.has('financial_contact_name'), 'has-success': this.fields.financial_contact_name && this.fields.financial_contact_name.valid}">
                        <label for="financial_contact_name">
                            {{ trans('admin.vendor.columns.financial_contact_name') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.financial_contact_name" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_name'), 'form-control-success': this.fields.financial_contact_name && this.fields.financial_contact_name.valid }" id="financial_contact_name" financial_contact_name="financial_contact_name" placeholder="{{ trans('admin.vendor.columns.financial_contact_name') }}">
                        <div v-if="errors.has('financial_contact_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_name') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('financial_contact_phone'), 'has-success': this.fields.financial_contact_phone && this.fields.financial_contact_phone.valid}">
                        <label for="financial_contact_phone">
                            {{ trans('admin.vendor.columns.financial_contact_phone') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.financial_contact_phone" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_phone'), 'form-control-success': this.fields.financial_contact_phone && this.fields.financial_contact_phone.valid }" id="financial_contact_phone" financial_contact_phone="financial_contact_phone" placeholder="{{ trans('admin.vendor.columns.financial_contact_phone') }}">
                        <div v-if="errors.has('financial_contact_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_phone') }}</div>
                    </div>

                    <!-- Primary Contact Phone -->
                    <div class="form-group col-6" :class="{'has-danger': errors.has('financial_contact_email'), 'has-success': this.fields.financial_contact_email && this.fields.financial_contact_email.valid}">
                        <label for="financial_contact_email">
                            {{ trans('admin.vendor.columns.financial_contact_email') }}
                        </label>

                        <input :disabled="$parent.is_viewing" type="text" v-model="form.financial_contact_email" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_email'), 'form-control-success': this.fields.financial_contact_email && this.fields.financial_contact_email.valid }" id="financial_contact_email" financial_contact_email="financial_contact_email" placeholder="{{ trans('admin.vendor.columns.financial_contact_email') }}">
                        <div v-if="errors.has('financial_contact_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_email') }}</div>
                    </div>

                    <!-- Primary Contact Address -->
                    <div class="col-12 form-group" :class="{'has-danger': errors.has('financial_contact_address'), 'has-success': this.fields.financial_contact_address && this.fields.financial_contact_address.valid}">
                        <label for="financial_contact_address">
                            {{ trans('admin.vendor.columns.financial_contact_address') }}
                        </label>

                        <textarea :disabled="$parent.is_viewing" v-model="form.financial_contact_address" class="form-control" :class="{'form-control-danger': errors.has('financial_contact_address'), 'form-control-success': this.fields.financial_contact_address && this.fields.financial_contact_address.valid }" id="financial_contact_address" name="financial_contact_address" placeholder="{{ trans('admin.vendor.columns.financial_contact_address') }}"></textarea>
                        <div v-if="errors.has('financial_contact_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('financial_contact_address') }}</div>
                    </div>

                    <div class="col-12 form-group">
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
