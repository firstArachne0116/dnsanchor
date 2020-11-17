import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('access-log-listing', {
    mixins: [AppListing, onFormReady]
});
