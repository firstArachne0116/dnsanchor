import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('payment-term-listing', {
    mixins: [AppListing, onFormReady]
});
