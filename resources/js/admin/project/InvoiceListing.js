import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('project-invoice-listing', {
    mixins: [AppListing, onFormReady]
});
