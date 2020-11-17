import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('vendor-payment-term-listing', {
    mixins: [AppListing, onFormReady]
});
