import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('role-listing', {
    mixins: [AppListing, onFormReady]
});
