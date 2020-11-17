import {onFormReady} from '../../mixins/listing';
import AppListing from '../app-components/Listing/AppListing';

Vue.component('email-template-listing', {
    mixins: [AppListing, onFormReady]
});
