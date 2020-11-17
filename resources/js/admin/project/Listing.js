import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('project-listing', {
    mixins: [AppListing, onFormReady],

    methods: {

    }
});
