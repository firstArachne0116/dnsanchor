import Vuex from 'vuex';
import Vue from 'vue';

Vue.use( Vuex );

const store = new Vuex.Store( {
    state: {
        user: {
            first_name: '',
            last_name: '',
        },
        notifications: [],
        currently_clocked_in: false,
        clocked_in_today: false,
        is_manager: true,
    },
    getters: {
        getUser( state ) {
            return state.user;
        },

        getUserInitials( state ) {
            return state.user.first_name.charAt(0) + state.user.last_name.charAt(0);
        },

        getNotifications( state ) {
            return state.notifications;
        },

        getNotificationCount( state ) {
            return state.notifications.length;
        },

        getUserClockedInToday( state ) {
            return state.clocked_in_today;
        },

        getUserClockedIn( state ) {
            return state.currently_clocked_in;
        },

        isUserManager( state ) {
            return state.is_manager;
        }
    },
    mutations: {
        setUser( state, payload ) {
            state.user = payload;
        },

        setNotifications( state, payload ) {
            state.notifications = payload;
        },

        setUserClockedInToday( state, payload ) {
            state.clocked_in_today = payload;
        },

        setUserClockedIn( state, payload ) {
            state.currently_clocked_in = payload;
        },

        setIsUserManager( state, payload ) {
            state.is_manager = payload;
        }
    }
} );

export default { store };
