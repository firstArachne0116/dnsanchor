require( 'bootstrap' );

import './bootstrap-old';

import 'vue-multiselect/dist/vue-multiselect.min.css';
//import jQuery from 'jquery';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect';
import VeeValidate from 'vee-validate';
import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import { Admin } from 'craftable';
import VModal from 'vue-js-modal'
import Vue from 'vue';
import Vuikit from 'vuikit'
import VuikitIcons from '@vuikit/icons'
import Popover from 'vue-js-popover'

Vue.use( Vuikit )
Vue.use( VuikitIcons )
Vue.use( Popover )

import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';

Vue.component('multiselect', Multiselect);
Vue.component( 'timepicker', Timepicker );
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', flatPickr);
Vue.component('jcc-form', require( '../components/JCCForm' ).default );
Vue.use(VModal, { dialog: true });
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);


new Vue({
    mixins: [Admin],
});

new Vue({
    el: '#notifications',
    mixins: [Admin],
    data() {
        return {
            shouldShow: false,
        }
    }
});
