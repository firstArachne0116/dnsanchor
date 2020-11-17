import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('letter-head-listing', {
    mixins: [AppListing, onFormReady]
});
