import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

Vue.component('remittance-info-form', {
    mixins: [AppForm, onFormReady],
    data: function() {
        return {
            form: {
                name:  '' ,
                default:  false ,
            }
        }
    }

});
