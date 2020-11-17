import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

Vue.component('admin-user-form', {
    mixins: [AppForm, onFormReady],
    data: function() {
        return {
            form: {
                first_name:  '' ,
                last_name:  '' ,
                email:  '' ,
                password:  '' ,
                activated:  false ,
                forbidden:  false ,
                language:  '' ,
            }
        }
    },

    methods: {
        getPostData() {
            let copy = Object.assign( {}, this.form );

            if ( copy.hasOwnProperty( 'password' ) && copy.password.length <= 4 ) {
                delete copy.password;
            }

            return copy;
        }
    }
});
