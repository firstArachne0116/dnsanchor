import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('project-invoice-line-listing', {
    mixins: [AppListing, onFormReady],
    props: [ 'editing' ],
    data() {
        return {

        }
    }
});
