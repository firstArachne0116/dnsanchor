import Editable from '../../components/EditableComponent';
import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component( 'contact-listing', {
    mixins: [ AppListing, onFormReady ],
    components: {
        Editable
        //        Router
    },
    mounted() {
        let _this = this;

        // listen for refresh on filter application
        this.$root.$on( 'gpsd:refresh-datatable', collection => {
            _this.collection = collection;
        });
    },
    data: function () {
        return {
            router: null,
            show_filters_pane: false,
            filter_dropdown: [],
            activeFilters: [],
            isLoading: false,
            timeout: null,
            debounceDelay: 1000,
            filters: [
                {
                    selected: false,
                    type: 'dropdown',
                    name: 'contact_type',
                    label: 'Contact Type',
                    options: [
                        'is',
                        'is not'
                    ],
                    selectedOption: null,
                    values: [
                        { label: 'Lead', name: 'lead' },
                        { label: 'Prospect', name: 'prospect' },
                        { label: 'Client', name: 'client' }
                    ],
                    selectedValue: null
                },
                {
                    selected: false,
                    type: 'number',
                    name: 'contact_id',
                    label: 'Contact ID',
                    options: [
                        'is equal to',
                        'is not equal to',
                        'contains',
                        'does not contain'
                    ],
                    selectedOption: null,
                    selectedValue: null
                },
                {
                    selected: false,
                    type: 'text',
                    name: 'contact_name',
                    label: 'Contact Name',
                    options: [
                        'is equal to',
                        'is not equal to',
                        'contains',
                        'does not contain'
                    ],
                    selectedOption: null,
                    selectedValue: null
                },
                {
                    selected: false,
                    type: 'text',
                    name: 'company_name',
                    label: 'Company Name',
                    options: [
                        'is equal to',
                        'is not equal to',
                        'contains',
                        'does not contain'
                    ],
                    selectedOption: null,
                    selectedValue: null
                }
            ]
        };
    },
    computed: {
        availableFilters: {
            get() {
                return this.filters.filter( function ( item ) {
                    return !item.selected;
                } );
            }
        },
        applicableFilters: {
            get() {
                return this.filters.filter( function ( item ) {
                    return item.selected;
                } );
            }
        }
    },
    methods: {
        addFilter() {
            this.activeFilters.push( this.filter_dropdown );

            for ( let filter of this.filters ) {
                if ( filter.name === this.filter_dropdown.name ) {
                    filter.selected = true;
                }
            }

            this.filter_dropdown = null;
        },

        updateRecord( id, name, value ) {
            let data = {};

            data[ name ] = value;

            axios.post( '/api/contacts/' + id, Object.assign( data, {
                _method: 'patch'
            } ) )
                 .then( function ( response ) {
                     console.log( response );
                 } )
                 .catch( function ( error ) {
                     console.log( error );
                 } );
        },

        updateFilters() {
            let that = this;

            if ( this.timeout ) {
                clearTimeout( this.timeout );
            }

            this.timeout = setTimeout( function () {
                let filters = {};

                for ( let filter of that.applicableFilters ) {
                    filters[ filter.name + '[option]' ] = filter.selectedOption;
                    filters[ filter.name + '[value]' ] = filter.selectedValue;
                }

                that.$parent.router.push( { query: { ...filters } } );

                /**
                 * Send off request for new information
                 */
                that.isLoading = true;

                axios.get( "/api/contacts", {
                    params: that.$parent.router.currentRoute.query
                } ).then( function ( response ) {
                    that.collection = response.data.data;
                    that.isLoading = false;
                } );
            }, this.debounceDelay );
        }
    }
} );
