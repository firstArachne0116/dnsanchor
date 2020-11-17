<template>
    <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="200" data-mobile-height="200">
        <div v-if="getNotificationCount === 0" class="kt-grid kt-grid--ver" style="min-height: 200px;">
            <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                    All caught up!
                    <br>No new notifications.
                </div>
            </div>
        </div>
        <a v-for="(notification, index) in getNotifications" :key="'it_'+index" v-else :href="notification.data.url + '?read=' + notification.id" class="kt-notification__item">
            <div class="kt-notification__item-icon">
                <i class="flaticon2-line-chart kt-font-success"></i>
            </div>
            <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                    <span v-if="notification.type === constants.MANAGER_LEAVE_REQUEST">
                        <strong>{{ notification.data['requesting-user'].full_name }}</strong> has put in a request for leave.
                    </span>
                    <span v-if="notification.type === constants.MANAGER_PROJECT">
                        <strong>{{ notification.data['requesting-user'].full_name }}</strong> has made changes to <strong>{{ notification.data.project.title }}</strong> and has marked it as an official version.
                    </span>
                    <span v-else>Unknown</span>
                </div>
                <div class="kt-notification__item-time">
                    {{ notification.created_at | moment("from", "now") }}
                </div>
            </div>
        </a>
    </div>
</template>

<script>
    import { mapGetters, mapMutations } from 'vuex';

    const constants = require( '../admin/notification-constants' ).default;

    export default {
        name: 'gpsd-notifications',

        computed: {
            ...mapGetters( [ 'getUser', 'getNotifications', 'getNotificationCount' ] )
        },

        methods: {
            ...mapMutations,
        },

        data() {
            return {
                constants
            }
        },
    };
</script>

<style scoped>

</style>
