import {onFormReady} from '../../mixins/listing';import AppListing from '../app-components/Listing/AppListing';

Vue.component('timesheet-listing', {
    mixins: [AppListing, onFormReady],
    methods: {
        resendActivation(url) {
            axios.get(url).then(
                response => {
                    if(response.data.message) {
                        this.$notify({ type: 'success', title: 'Success', text: response.data.message});
                    } else if (response.data.redirect) {
                        window.location.replace(response.data.redirect);
                    }
                }
            ).catch(errors => {
                    if(errors.response.data.message) {
                        this.$notify({ type: 'error', title: 'Error!', text: errors.response.data.message})
                    }
                }
            );
        }
    },
    props: {
        'activation': {
            type: Boolean,
            required: true
        },
    }
});
