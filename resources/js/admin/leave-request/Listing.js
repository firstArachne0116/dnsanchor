import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('leave-request-listing', {
    mixins: [AppListing, onFormReady]
});
