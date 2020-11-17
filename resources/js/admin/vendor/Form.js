import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

Vue.component('vendor-form', {
    mixins: [AppForm, onFormReady],

    mounted: function () {
        this.form.assigned_salesperson = [];

        axios.all( [
            axios.get( '/api/sales-persons' ),
            axios.get( '/api/vendor-categories' )
        ] ).then( axios.spread( ( salesResponse, vendorCategoriesResponse ) => {
            this.sales_people = salesResponse.data.data;
            this.categories = vendorCategoriesResponse.data.data;
        } ) );
    },

    data: function () {
        return {
            form: {
                category: {},
                assigned_salesperson: [],
                social_media: {},
                primary_contact_communication_preferences: [],
                sales_contact_communication_preferences: [],
                design_contact_communication_preferences: [],
                financial_contact_communication_preferences: [],
            },

            active_tab: 'vendor_information',

            sales_people: [],
            categories: [],
        }
    },

    methods: {
        setTab( id ) {
            this.active_tab = id;
        },

        isCurrentTab( id ) {
            return this.active_tab === id;
        },

        after_data_update() {
            if ( this.form.hasOwnProperty( 'sales_persons' ) ) {
                this.form.assigned_salesperson = this.form.sales_persons;
            }

            if ( this.form.hasOwnProperty( 'sales_persons' ) ) {
                this.form.assigned_salesperson = this.form.sales_persons;
            }
        },
    },

});
