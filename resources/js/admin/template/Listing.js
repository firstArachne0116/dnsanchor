import {onFormReady} from '../../mixins/listing';
import AppListing from '../app-components/Listing/AppListing';

Vue.component('template-listing', {
    mixins: [AppListing, onFormReady]
});
