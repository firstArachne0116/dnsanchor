import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

Vue.component('customer-category-form', {
    mixins: [AppForm, onFormReady],
    data: function() {
        return {
            form: {
                name:  '' ,

            }
        }
    }

});
