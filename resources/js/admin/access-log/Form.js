import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

Vue.component('access-log-form', {
    mixins: [AppForm, onFormReady],
    data: function() {
        return {
            form: {

            }
        }
    }

});
