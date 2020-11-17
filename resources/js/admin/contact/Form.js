import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';
import Multiselect from 'vue-multiselect';

Vue.component('contact-form', {
    mixins: [AppForm, onFormReady],
    components: {
        Multiselect
    },
    computed: {
        value: {
            get() {
                return this.options.filter(
                    option => this.form.type.includes( option.name )
                );
            },
            set( newSelectedOptions ) {
                this.form.type = newSelectedOptions.map( option => option.name )
            }
        },

        'filter-options': {
            get() {
                return this.filters.map( function( item ) {
                    return item.label;
                });
            }
        }
    },
    mounted: function() {
        this.form.assigned_salesperson = [];
        this.form.referred_by = [];

        axios.all([
            axios.get( '/api/sales-persons' ),
            axios.get( '/api/contacts' )
        ]).then( axios.spread( ( salesResponse, contactResponse ) => {
            this.sales_people = salesResponse.data.data;
            this.contacts = contactResponse.data.data;

            let form = this.form;

            if ( form.source ) {
                // source options
                let source = this.source_options.filter( function ( item ) {
                    return item.value === form.source;
                } );

                if ( source.length > 0 ) {
                    this.form.source = source[ 0 ];
                }
            }

            if ( form.referred_by ) {
                // source options
                let source = this.contacts.filter( function ( item ) {
                    return item.id === form.referred_by;
                } );

                if ( source.length > 0 ) {
                    this.form.referred_by = source[ 0 ];
                }
            }

            if ( form.type ) {
                // type options
                let type = this.options.filter( function ( item ) {
                    return item.value === form.type;
                } );

                if ( type.length > 0 ) {
                    this.form.type = type[ 0 ];
                }
            }

            if ( ! form.hasOwnProperty( 'social_media' ) || ! form.social_media ) {
                this.form.social_media = {};
            }
        } ) );
    },
    data: function() {
        return {
            form: {
                type: [],
                assigned_salesperson: [],
                source: [],
                referred_by: '',
                social_media: {},
                primary_contact_communication_preferences: [],
                secondary_contact_communication_preferences: [],
                sales_contact_communication_preferences: [],
                design_contact_communication_preferences: [],
                financial_contact_communication_preferences: [],
            },

            active_tab: 'primary_contacts',

            options: [
                { name: 'Lead', value: 'lead' },
                { name: 'Prospect', value: 'prospect' },
                { name: 'Client', value: 'client' },
            ],

            sales_people: [],
            contacts: [],

            source_options: [
                { name: 'Trade Show', value: 'trade show' },
                { name: 'Phone Reach Out', value: 'phone reach out' },
                { name: 'Email Reach Out', value: 'email reach out' },
                { name: 'Found us', value: 'found us' },
                { name: 'Most Recent Show', value: 'most recent show' },
                { name: 'Show History', value: 'show history' },
            ],
        }
    },

    methods: {
        setTab(id) {
            this.active_tab = id;
        },

        getPostData() {
            return Object.assign({}, this.form, { referred_by: this.form.referred_by && this.form.referred_by.hasOwnProperty( 'id' ) ? this.form.referred_by.id : null } );
        },

        isCurrentTab(id) {
            return this.active_tab === id;
        },
    },

});
