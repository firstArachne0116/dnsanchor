import { filter } from 'lodash';
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

            filters: [],
            options: [
                {name: 'Contact ID',    value: 'id'},
                {name: 'Contact Type',  value: 'type'},
                {name: 'Contact Name',  value: 'primary_contact_name'},
                {name: 'Company Name',  value: 'company_name'},
                {name: 'Email Address', value: 'primary_contact_email'},
                // {name: 'Current Projects', value: 'current_projects'},
                // {name: 'Project Stage', value: 'project_stage'},
                {name: 'Project Ref', value: 'reference'},
                {name: 'Project Title', value: 'title'},
            ],
            project_status: [
                {
                    name: "RFQ",
                    value: "RFQ",
                },
                {
                    name: "PCQ",
                    value: "PCQ",
                },
                {
                    name: "FCQ (not signed)",
                    value: "FCQ (unsigned)",
                },
                {
                    name: "FCQ (signed) + 2 Docs sent",
                    value: "FCQ (signed) + 2 docs sent",
                },
                {
                    name: "JCP Sent",
                    value: "Job Confirmation Paperwork (JCP) sent",
                },
                {
                    name: "VC back from HK",
                    value: "Job Confirmation Paperwork (VC) back from HK",
                },
                {
                    name: "PO",
                    value: "PO",
                },
                {
                    name: "5 Docs Sent",
                    value: "5 docs sent (+ board)",
                },
                {
                    name: "AA Pending",
                    value: "AA",
                },
                {
                    name: "AA Signed",
                    value: "AA Signed",
                },
                {
                    name: "Updated PO",
                    value: "Updated PO",
                },
                {
                    name: "Ex-Factory",
                    value: "Ex-Factory (Production Completed)",
                },
                {
                    name: "Bulk Loading",
                    value: "Bulk Loading -> Shipping Docs Received",
                },
                {
                    name: "Sales Invoice",
                    value: "Sales Invoice",
                },
                {
                    name: "Account Invoice",
                    value: "Account Invoice",
                },
                {
                    name: "Product Delivered",
                    value: "Product Delivered",
                },
                {
                    name: "Vendor Invoice received and approved",
                    value: "Vendor Invoice Received and Approved",
                },
                {
                    name: "Shipping Invoice received and approved",
                    value: "Shipping Invoice Received and Approved",
                },
                {
                    name: "Packets finished",
                    value: "Packets Finished (and signed by manager)",
                },
                {
                    name: "Packets scanned",
                    value: "Packets Scanned",
                },
                {
                    name: "Job Closed Out by Accounts",
                    value: "Job Closed Out By Accounts",
                },
            ]
        };
    },
    computed: {
        availableFilters: {
            get() {
                return this.filters.filter( function ( item ) {
                    return !item.selected;
                });
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
            }))
                .then( function ( response ) {
                    console.log( response );
                })
                .catch( function ( error ) {
                    console.log( error );
                });
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

                // that.$parent.router.push( { query: { ...filters } } );

                /**
                 * Send off request for new information
                 */
                that.isLoading = true;

                axios.get( "/api/contacts", {
                    // params: that.$parent.router.currentRoute.query
                }).then( function ( response ) {
                    that.collection = response.data.data;
                    that.isLoading = false;
                });
            }, this.debounceDelay );
        }
    },
    watch: {
        // filters() {
        //     filter('search', search);
        // }
    }
});
