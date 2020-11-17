import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

Vue.component('letter-head-form', {
    mixins: [AppForm, onFormReady],
    data: function() {
        return {
            form: {

            },
            mediaCollections: [ 'letterhead' ]
        }
    }

});
