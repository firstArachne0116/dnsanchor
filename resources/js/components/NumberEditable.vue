<template>
    <span>
        <span @click.stop="enableEditing" v-if="!editing">
            <span v-if="text">{{ text }} <i style="opacity:0.25" class="flaticon2-pen"></i></span>
            <span v-else-if="value">{{ text }} <i style="opacity:0.25" class="flaticon2-pen"></i></span>
            <span style="font-style:italic;opacity:0.45;" v-else><i style="opacity:0.25" class="flaticon2-pen"></i></span>
        </span>
        <div v-else>
            <input @click.stop="" class="form-control" style="max-width: 100px" ref="value" type="number" v-model="text" @blur="submit" @keyup.enter="submit" step="0.1">
        </div>
    </span>
</template>

<script>
    module.exports = {
        name: 'number-editable',

        data() {
            return {
                editing: false,
                old_value: '',

                text: null,
            }
        },

        props: [ 'value', 'date', 'onUpdate' ],

        methods: {

            enableEditing() {
                let _this = this;

                this.old_value = this.text;
                this.editing = true;

                this.$nextTick( () => {
                    _this.$refs.value.focus();
                } )
            },

            submit() {
                let _this = this;

                this.editing = false;

                if ( this.old_value !== this.text ) {
                    // update record if not identical to current value
                    _this.$emit('input', _this.text);
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

        },

        mounted() {
            this.text = this.value;
        },

        watch: {
            value() {
                this.text = this.value;
            }
        }
    }
</script>
