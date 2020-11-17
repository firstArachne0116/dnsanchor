import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';
import {Datetime} from 'vue-datetime';

Vue.component('leave-request-form', {
    mixins: [AppForm, onFormReady],

    components: {
        datetime: Datetime
    },

    data: function() {
        return {
            mouseover: null,
            form: {
                period: null,
                requested_dates: [ null, ],
            }
        }
    },

    methods: {
        customFormatter( date ) {
            return moment( date ).format( 'DD/MM/YYYY h:mm:ss a' );
        },

        onSubmit( cb = null ) {
            this.$parent.fabActionSave();
        },

        onSuccess( data ) {
            this.submiting = false;

            this.$notify( {
                type: 'success',
                title: 'Success',
                text: 'Your request has been sent to an admin.'
            } );

            // Go back to
            this.$parent.$refs.resource_index.loadData(null);
            this.$parent.setTab( 'resource-index' );
        }
    }

});
