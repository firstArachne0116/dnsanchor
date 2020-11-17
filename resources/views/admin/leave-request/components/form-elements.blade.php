<div>
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Request For Leave</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">


                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Date(s) requested:</label>
                                    <div class="col-lg-9 col-xl-6 mt-3 d-flex">
                                        <div class="kt-widget2__radio d-flex">
                                            <label class="kt-radio kt-radio--solid kt-radio--single m-0">
                                                <input id="period-part" name="period" value="part" v-model="form.period" type="radio">
                                                <span></span>
                                            </label> <label for="period-part">Part Day(s)</label>
                                        </div>

                                        <div class="kt-widget2__radio d-flex ml-3">
                                            <label class="kt-radio kt-radio--solid kt-radio--single m-0">
                                                <input id="period-full" name="period" value="full" v-model="form.period" type="radio">
                                                <span></span>

                                            </label> <label for="period-full">Full Day(s)</label>
                                        </div>
                                    </div>
                                </div>

                                <div @mouseenter="mouseover = index" @mouseleave="mouseover = null" v-if="form.period" v-for="(date,index) in form.requested_dates" class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <datetime class="w-100" :type="form.period === 'full' ? 'date' : 'datetime'" placeholder="Click to select a date..." input-class="form-control" v-model="form.requested_dates[index]"></datetime>
                                        <a class="d-block" v-if="mouseover === index && index !== 0" href="#" @click.prevent="() => {form.requested_dates.splice(index, 1)}">Remove</a>
                                    </div>
                                </div>

                                <div v-if="form.period" class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                    <div class="col-lg-9 col-xs-6 d-flex">
                                        <a href="#" @click.prevent="() => {form.requested_dates.push(null)}">Add Date</a>
                                    </div>
                                </div>

                                <!-- Purpose -->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Purpose:</label>
                                    <div class="col-lg-9 col-xl-6 mt-3 d-flex">
                                        <div class="kt-widget2__radio d-flex">
                                            <label class="kt-radio kt-radio--solid kt-radio--single m-0">
                                                <input id="period-personal" name="purpose" value="Personal" v-model="form.purpose" type="radio">
                                                <span></span>
                                            </label> <label for="period-personal">Personal</label>
                                        </div>

                                        <div class="kt-widget2__radio d-flex ml-3">
                                            <label class="kt-radio kt-radio--solid kt-radio--single m-0">
                                                <input id="period-medical" name="purpose" value="Health/Medical/Sick Leave" v-model="form.purpose" type="radio">
                                                <span></span>
                                            </label> <label for="period-medical">Health/Medical/Sick Leave</label>
                                        </div>

                                        <div class="kt-widget2__radio d-flex ml-3">
                                            <label class="kt-radio kt-radio--solid kt-radio--single m-0">
                                                <input id="period-vacation" name="purpose" value="Vacation" v-model="form.purpose" type="radio">
                                                <span></span>
                                            </label> <label for="period-vacation">Vacation</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Total Paid Time Off To Be Used</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="number" v-model="form.pto" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                  {{--  <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-3 col-xl-3">
                                </div>
                                <div class="col-lg-9 col-xl-9">
                                    <button type="submit" :disabled="submiting" class="btn btn-success">Update</button>&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
