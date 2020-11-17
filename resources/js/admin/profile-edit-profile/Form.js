import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

import { mapGetters, mapMutations } from 'vuex';

Vue.component('profile-edit-profile-form', {
    mixins: [AppForm, onFormReady],
    computed: {
        ...mapGetters([ 'getUser', 'getUserInitials' ]),
    },
    mounted() {
    },
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

            },
            mediaCollections: ['avatar']
        }
    },
    methods: {
        ...mapMutations( [ 'setUser' ] ),

        onSuccess(data) {
            this.submiting = false;

            this.$notify({
                type: 'success',
                title: 'Success',
                text: 'We\'ve updated your account.'
            });
        }
    }
});
