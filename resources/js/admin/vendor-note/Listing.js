import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('vendor-note-listing', {
    mixins: [AppListing, onFormReady]
});
