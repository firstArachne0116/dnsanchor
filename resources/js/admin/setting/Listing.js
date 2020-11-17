import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('setting-listing', {
    mixins: [AppListing, onFormReady]
});
