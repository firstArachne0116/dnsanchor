import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('project-invoice-listing', {
    mixins: [AppListing, onFormReady],
    data() {
        return {
            form: {
                name: '',
                description: '',
                quantity: '',
                unit_price: '',
                unit_cost: '',
                category: '',
            },
            applicable_lines: [],
            sales_invoice_lines: [],
            categories: [
                'Misc',
                'Prepress',
                'Shipping',
                'AA Change Orders',
                'Manufacturing',
            ],
            isEditing: false,
        }
    },

    props: [ 'projectId', 'currentTab', 'selectable', 'selectableSalesLines', 'po' ],
    methods: {
        save() {
            let _this3 = this;

            let params = {};

            if ( ! this.po ) {
                params[ 'project_id' ] = this.projectId;
            } else {
                params[ 'purchase_order_id' ] = this.projectId;
            }

            axios.post( this.url, Object.assign( {}, this.form, {params})).then( function() {
                _this3.loadData(true);
                _this3.isEditing = false;
            })
        },

        isCurrentTab( id ) {
            if ( id.constructor === Array ) {
                return id.includes( this.currentTab );
            }

            return this.currentTab === id;
        },
    },

    computed: {
        'total_cost': function() {
            let price = 0;

            for ( let item of this.collection ) {
                price += parseFloat( item.quantity ) * parseFloat( item.unit_cost );
            }

            return parseFloat( price.toFixed(2) );
        },

        'total_price': function() {
            let price = 0;

            for ( let item of this.collection ) {
                price += parseFloat( item.quantity ) * parseFloat( item.unit_price );
            }

            return parseFloat( price.toFixed(2) );
        }
    },
});
