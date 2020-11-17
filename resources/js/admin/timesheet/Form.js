import AppForm from '../app-components/Form/AppForm';

Vue.component('timesheet-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                
            }
        }
    }

});