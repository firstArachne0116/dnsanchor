<template>
    <div>
        <input type="checkbox"
               v-bind:value="selected"
               v-on:input="selected = $event.target.value" v-if="toggle">
        <h3 data-toggle="tooltip" :title="info">{{ label }}</h3>

        <div>
            <slot />
        </div>
    </div>
</template>

<style lang="scss">
    .vue-popover {
        position: fixed;
    }
</style>

<script>
    const JccHelpers = require( '../../mixins/jcc-helper' ).default;

    module.exports = {
        name: 'jcc-section',

        mixins: [JccHelpers ],

        props: {
            value: [ String, Boolean, Array ],

            info: {
                type: String
            },

            label: {
                type: String
            },

            toggle: {
                type: Boolean
            }
        },
        data() {
            return {
                selected: false
            };
        },


        methods: {
            update( value ) {
                this.$emit( 'input', value );
            }
        }
    };
</script>
