<template>
    <span>
        <span @click.stop="enableEditing" v-if="!editing">
            <span v-if="time">{{ timeFormatter(time) }} <i style="opacity:0.25" class="flaticon2-pen"></i></span>
            <span v-else-if="value">{{ timeFormatter(value) }} <i style="opacity:0.25" class="flaticon2-pen"></i></span>
            <span style="font-style:italic;opacity:0.45;" v-else><i style="opacity:0.25" class="flaticon2-pen"></i></span>
        </span>
        <div v-else>
            <input @click.stop="" class="form-control" ref="value" type="time" v-model="time" @blur="submit" @keyup.enter="submit" step="300">
        </div>
    </span>
</template>

<script>
    module.exports = {
        name: 'time-editable',

        data() {
            return {
                editing: false,
                old_value: '',

                time: null,
            }
        },

        props: [ 'value', 'date', 'onUpdate' ],

        methods: {

            enableEditing() {
                let _this = this;

                this.old_value = this.time;
                this.editing = true;

                this.$nextTick( () => {
                    _this.$refs.value.focus();
                } )
            },

            submit() {
                let _this = this;

                this.editing = false;

                if ( this.old_value !== this.time ) {
                    // update record if not identical to current value
                    _this.$emit('input', _this.time);
                    setTimeout(() => {
                        _this.onUpdate(_this.date);
                    }, 100);
                }
            },

            toTwoDigit(num, zero = '00') {
                if (num == 0) return zero;
                if (num > 9) return num + '';
                return '0' + num;
            },

            timeFormatter(time) {
                if (!time) return '';
                const hr = parseInt(time.split(':')[0]), min = parseInt(time.split(':')[1]);
                console.log(hr, min);
                if (hr >= 12) return this.toTwoDigit(hr - 12, '12') + ':' + this.toTwoDigit(min) + ' PM';
                return this.toTwoDigit(hr, '12') + ':' + this.toTwoDigit(min) + ' AM';
            }
        },

        mounted() {
            this.time = this.value;
        },

        watch: {
            value() {
                this.time = this.value;
            }
        }
    }
</script>
