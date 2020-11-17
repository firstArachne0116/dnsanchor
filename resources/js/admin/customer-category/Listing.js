import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('customer-category-listing', {
    mixins: [AppListing, onFormReady]
});
