import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('orientation-listing', {
    mixins: [AppListing, onFormReady]
});
