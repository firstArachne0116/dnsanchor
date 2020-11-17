<template>
    <div class="w-100">
        <div v-cloak>
            <div class="kt-subheader w-100 m-0 p-0 kt-grid__item mt-3 mb-3" id="kt_subheader">
                <div class="kt-subheader__main">
                    <div class="kt-subheader__group">
                        <h3 class="kt-subheader__title">
                            Pay period :
                        </h3>
                        <datepicker :format="'MM/dd/yyyy'" input-class="form-control" style="width: 120px" v-model="pay_from" name="pay_from" :disabled="readOnly"></datepicker>
                        <span>-</span>
                        <datepicker :format="'MM/dd/yyyy'" input-class="form-control" style="width: 120px" v-model="pay_to" name="pay_to" :disabled="readOnly"></datepicker>
                        <a class="btn btn-primary btn-sm text-white ml-2" href="#" @click.prevent="updatePayPeriod" title="Update" role="button"><i class="fa fa-save"></i> Update</a>
                    </div>
                </div>
            </div>

            <div class="kt-portlet mt-2" v-if="timesheet.length">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="w-100" style="overflow-x: auto">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-primary" style="color: white;">Day of the Week</th>
                                    <th class="bg-primary" style="color: white;">Date</th>
                                    <th class="bg-primary" style="color: white;">Time In</th>
                                    <th class="bg-primary" style="color: white;">Time Out</th>
                                    <th class="bg-primary" style="color: white;">Time In</th>
                                    <th class="bg-primary" style="color: white;">Time Out</th>
                                    <th class="bg-primary" style="color: white;">Total Hrs</th>
                                    <th class="bg-primary" style="color: white;">Regular Hrs</th>
                                    <th class="bg-primary" style="color: white;">Holiday Hrs</th>
                                    <th class="bg-primary" style="color: white;">Overtime Hrs</th>
                                    <th class="bg-primary" style="color: white;">Sick Hrs</th>
                                    <th class="bg-primary" style="color: white;">Vacation Hrs</th>
                                    <th class="bg-primary" style="color: white;">Total Hrs</th>
                                </tr>
                            </thead>
                            <tbody v-if="readOnly">
                                <tr v-for="item in timesheet" :key="item.date.getTime()">
                                    <th class="text-center bg-primary" style="color: white;">{{item.weekday}}</th>
                                    <td class="text-center" style="background-color: #ddffff">{{dateFormatter(item.date)}}</td>
                                    <td class="text-center">
                                        <span>{{item.time_in_1}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{item.time_out_1}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{item.time_in_2}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{item.time_out_2}}</span>
                                    </td>
                                    <td class="text-center" style="background-color: #bbddff">{{getWorkHrs(item)}}</td>
                                    <td class="text-center">
                                        <span>{{item.regular_hrs}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{item.holiday_hrs}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{item.overtime_hrs}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{item.sick_hrs}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{item.vacation_hrs}}</span>
                                    </td>
                                    <td class="text-center"><big>{{getTotalHrs(item)}}</big></td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr v-for="item in timesheet" :key="item.date.getTime()">
                                    <th class="text-center bg-primary" style="color: white;">{{item.weekday}}</th>
                                    <td class="text-center" style="background-color: #ddffff">{{dateFormatter(item.date)}}</td>
                                    <td class="text-center">
                                        <time-editable v-model="item.time_in_1" :date="item.date" :onUpdate="updateRecord"></time-editable>
                                    </td>
                                    <td class="text-center">
                                        <time-editable v-model="item.time_out_1" :date="item.date" :onUpdate="updateRecord"></time-editable>
                                    </td>
                                    <td class="text-center">
                                        <time-editable v-model="item.time_in_2" :date="item.date" :onUpdate="updateRecord"></time-editable>
                                    </td>
                                    <td class="text-center">
                                        <time-editable v-model="item.time_out_2" :date="item.date" :onUpdate="updateRecord"></time-editable>
                                    </td>
                                    <td class="text-center" style="background-color: #bbddff">{{getWorkHrs(item)}}</td>
                                    <td class="text-center">
                                        <number-editable v-model="item.regular_hrs" :date="item.date" :onUpdate="updateRecord"></number-editable>
                                    </td>
                                    <td class="text-center">
                                        <number-editable v-model="item.holiday_hrs" :date="item.date" :onUpdate="updateRecord"></number-editable>
                                    </td>
                                    <td class="text-center">
                                        <number-editable v-model="item.overtime_hrs" :date="item.date" :onUpdate="updateRecord"></number-editable>
                                    </td>
                                    <td class="text-center">
                                        <number-editable v-model="item.sick_hrs" :date="item.date" :onUpdate="updateRecord"></number-editable>
                                    </td>
                                    <td class="text-center">
                                        <number-editable v-model="item.vacation_hrs" :date="item.date" :onUpdate="updateRecord"></number-editable>
                                    </td>
                                    <td class="text-center"><big>{{getTotalHrs(item)}}</big></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters,mapMutations} from 'vuex';
import NumberEditable from '../components/NumberEditable.vue';
import TimeEditable from '../components/TimeEditable.vue';


export default {
  components: { TimeEditable, NumberEditable },
    props: ['userId', 'readOnly'],
    data() {
        return {
            weekdays: ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'],
            pay_from: null,
            pay_to: null,
            timesheet: [],
        };
    },

    mounted() {
        console.log(this.userId);
        axios.get('/api/timesheets/timesheet', {params: {userId: this.userId}}).then(data => {
            this.pay_from = data.data.pay_from;
            this.pay_to = data.data.pay_to;
            this.setTimeSheet(data.data.timesheet);
        });
    },

    methods: {
        toTwoDigit(num) {
            if (num > 9) return num + '';
            return '0' + num;
        },
        dateFormatter(dateString) {
            const date = new Date(dateString);
            return date.getFullYear() + '-' + this.toTwoDigit(date.getMonth() + 1) + '-' + this.toTwoDigit(date.getDate());
        },
        updatePayPeriod() {
            axios.post('/api/timesheets/payperiod', {userId: this.userId, pay_from: this.dateFormatter(this.pay_from), pay_to: this.dateFormatter(this.pay_to)}).then(data => {
                console.log(data.data);
                this.setTimeSheet(data.data.timesheet);
            });
        },
        nextDate(date) {
            date.setDate(date.getDate() + 1);
            return date;
        },
        setTimeSheet(data) {
            if (!data){
                this.timesheet = [];
                return;
            }
            const newTimeSheet = [];
            console.log(data);
            for (let i = (new Date(this.pay_from)); i <= (new Date(this.pay_to)) ; i = this.nextDate(i)) {
                let record = data.find(re => this.dateFormatter(re.date) === this.dateFormatter(i));
                if (!record) {
                    record = {
                        date: new Date(i.toString()),
                        regular_hrs: 0,
                        holiday_hrs: 0,
                        overtime_hrs: 0,
                        sick_hrs: 0,
                        vacation_hrs: 0,
                        time_in_1: null,
                        time_out_1: null,
                        time_in_2: null,
                        time_out_2: null,
                    };
                }
                record.date = new Date(record.date);
                record.weekday = this.weekdays[i.getDay()];
                newTimeSheet.push(record);
            }
            this.timesheet = newTimeSheet;
        },
        getWorkHour(time_in, time_out) {
            if (!time_in || !time_out) return 0;
            let min = time_out.split(':')[0] * 60.0 + time_out.split(':')[1] * 1 - time_in.split(':')[0] * 60.0 - time_in.split(':')[1] * 1;
            if (min < 0) min += 24 * 60;
            return min / 60.0;
        },
        floatPrecision(num) {
            return parseInt(num) + '.' + parseInt(num*10) % 10;
        },
        getWorkHrs(record) {
            return this.floatPrecision(this.getWorkHour(record.time_in_1, record.time_out_1) + this.getWorkHour(record.time_in_2, record.time_out_2));
        },
        getTotalHrs(record) {
            return this.floatPrecision(this.getWorkHour(record.time_in_1, record.time_out_1) + this.getWorkHour(record.time_in_2, record.time_out_2) + record.regular_hrs * 1 + record.holiday_hrs * 1 + record.overtime_hrs * 1 + record.sick_hrs * 1 + record.vacation_hrs * 1);
        },
        updateRecord(date) {
            for (let i = 0 ; i < this.timesheet.length ; i ++) {
                const item = this.timesheet[i];
                if (this.dateFormatter(item.date) === this.dateFormatter(date)) {
                    console.log(item);
                    item.user_id = this.userId;
                    axios.post('/api/timesheets/update', {...item, date: this.dateFormatter(item.date)}).then(data => {
                        console.log(data.data);
                        this.timesheet[i].id = data.data.id;
                    })
                    break;
                }
            }
        }
    },

    watch: {
        pay_from() {
            const fromDate = new Date(this.pay_from);
            const toDate = new Date(this.pay_to);
            if (fromDate > toDate) {
                this.pay_to = this.pay_from;
            }
        },
        pay_to() {
            const fromDate = new Date(this.pay_from);
            const toDate = new Date(this.pay_to);
            if (fromDate > toDate) {
                this.pay_from = this.pay_to;
            }
        }
    }
};
</script>
