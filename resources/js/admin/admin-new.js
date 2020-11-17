import './bootstrap';

import 'vue-multiselect/dist/vue-multiselect.min.css';
import 'vue2-timepicker/dist/VueTimepicker.css'
//import jQuery from 'jquery';
//import tinymce from 'tinymce/tinymce';
//import 'tinymce/themes/silver';

import VueMce from 'vue-mce';

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
//import Vuikit from 'vuikit'
//import VuikitIcons from '@vuikit/icons'
import Popover from 'vue-js-popover'
//Vue.use( Vuikit )
//Vue.use( VuikitIcons )
Vue.use( Popover );
Vue.use( require( 'vue-moment' ) );
import VueRouter from 'vue-router'

let moment = require( 'moment' );

window.moment = moment;
Vue.use( VueRouter );

const router = new VueRouter( {
    mode: 'history',
    routes: [],
    hashbang: false,
    root: '/admin/',
} )

const s = require( '../store/App.js' ).default;

import './app-components/bootstrap';
import './index';
import fab from '../components/FAB';
// Import TinyMCE

// A theme is also required

//import 'craftable/dist/ui';

Vue.use(VeeValidate, {strict: true});

Vue.component( 'multiselect', Multiselect );
Vue.component( 'datetime', flatPickr );
Vue.component( 'jcc-form', require( '../components/JCCForm' ).default );
Vue.component( 'jcc-editor', require( '../components/JCCEditor' ).default );
Vue.component( 'purchase-order', require( '../components/PurchaseOrder.vue' ).default );
Vue.component( 'fab', fab );
Vue.component( 'quick-panel', require( '../components/QuickPanelComponent' ).default );
Vue.component( 'datepicker', require( 'vuejs-datepicker' ).default );
Vue.component( 'resource-listing-form-combination', require( '../components/ResourceListingFormCombination' ).default );
Vue.component( 'editable', require( '../components/EditableComponent' ).default );
Vue.component( 'gpsd-notifications', require( '../components/GPSDNotifications' ).default );
Vue.component( 'dashboard', require( '../views/Dashboard' ).default );
Vue.component( 'timesheet', require( '../views/Timesheet' ).default );
Vue.component( 'jcc-section', require( '../components/JCC/Section').default );
Vue.component( 'time-editable', require( '../components/TimeEditable').default );
Vue.component( 'number-editable', require( '../components/NumberEditable').default );

Vue.use(VModal, { dialog: true });
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);

Vue.use( VueMce );

import {mapGetters, mapMutations} from 'vuex';

new Vue({
    store: s.store,
    router,
    mixins: [Admin],
    data() {
        return {
            wideContainer: true,
            user: null,
        }
    },

    computed: {
        ...mapGetters( [ 'getUser', 'getNotificationCount', 'getNotifications' ] )
    },

    mounted() {
        this.fetchProfile();
    },

    methods: {
        ...mapMutations( [ 'setUser', 'setIsUserManager', 'setNotifications' ] ),
        fetchProfile() {
            let _this = this;

            axios.get( '/api/user' ).then( response => {
                _this.setUser( response.data );

                if ( response.data.hasOwnProperty( 'is_manager' ) ) {
                    _this.setIsUserManager( response.data.is_manager );
                }
            }).catch( error => {
                alert( 'There was an error. Please check your internet connection' );
            });

            axios.get( '/api/notifications' ).then( response => {
                _this.setNotifications( response.data );
            }).catch( error => {
                alert( 'There was an error. Please check your internet connection' );
            });
        },
        redirect(url) {
            window.location.href = url;
        }
    }
});

new Vue({
    el: '#kt_header',
    mixins: [Admin],
    store: s.store,
    router,

    computed: {
        ...mapGetters( [ 'getNotificationCount', 'getUser', 'getUserInitials' ] ),
    },

    data() {
        return {
            shouldShow: false,
            wideContainer: true,
        }
    }
});
