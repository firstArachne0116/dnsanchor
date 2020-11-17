import {onFormReady} from '../../mixins/listing';
import AppListing from '../app-components/Listing/AppListing';

Vue.component('task-listing', {
    mixins: [AppListing, onFormReady]
});
