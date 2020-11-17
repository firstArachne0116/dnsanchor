import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('remittance-info-listing', {
    mixins: [AppListing, onFormReady]
});
