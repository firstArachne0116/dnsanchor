<template>
    <div>
        <h1 class="kt-heading">Employee Area</h1>
        <div v-if="!getUserClockedIn">You have not clocked in today. Would you like to clock in? <a href="#" @click.prevent="setUserClockedIn( true )">Yes</a></div>
    </div>
</template>

<script>
    import {mapGetters,mapMutations} from 'vuex';

    export default {
        data() {
            return {

            };
        },

        computed: {
            ...mapGetters( [ 'getUserClockedInToday', 'getUserClockedIn' ] ),
        },

        methods: {
            ...mapMutations([ 'setUserClockedInToday', 'setUserClockedIn' ] ),
        }
    };
</script>
