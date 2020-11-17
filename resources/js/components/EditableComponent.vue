<template>
    <span>
        <span @click.stop="enableEditing" v-if="!editing">
            <span v-if="value">{{ value }} <i style="opacity:0.25" class="flaticon2-pen"></i></span>
            <span v-else-if="text">{{ text }} <i style="opacity:0.25" class="flaticon2-pen"></i></span>
            <span style="font-style:italic;opacity:0.45;" v-else>Click here to edit</span>
        </span>
        <div v-else>
            <input @click.stop="" class="form-control" ref="text" type="text" v-model="value" @blur="submit" @keyup.enter="submit">
        </div>
    </span>
</template>

<script>
    module.exports = {
        name: 'editable',

        data() {
            return {
                editing: false,
                old_value: '',
                value: '',

                timeout: null,
            }
        },

        props: [ 'text', 'recordUrl', 'recordName', 'onUpdate' ],

        methods: {

            debounce( func, wait, immediate ) {
                let _this = this;

                var timeout = this.timeout;
                return function () {
                    var context = this, args = arguments;
                    var later = function () {
                        _this.timeout = null;
                        if ( !immediate ) func.apply( context, args );
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout( timeout );
                    _this.timeout = setTimeout( later, wait );
                    if ( callNow ) func.apply( context, args );
                };
            },

            enableEditing() {
                let _this = this;

                this.old_value = this.value;
                this.editing = true;

                this.$nextTick( () => {
                    // focus textbox
                    _this.$refs.text.focus();
                } )
            },

            submit() {
                let _this = this;

                this.editing = false;

                if ( this.old_value !== this.value ) {
                    // update record if not identical to current value
                    this.debounce( function () {
                        _this.onUpdate( _this.recordUrl, _this.recordName, _this.value );
                    }, 250 )();
                }
            }
        },

        mounted() {
            this.value = this.text;
        },

        watch: {
            text() {
                this.value = this.text;
            }
        }
    }
</script>