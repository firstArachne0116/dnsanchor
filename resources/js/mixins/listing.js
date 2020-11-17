module.exports = {
    onFormReady: {
        methods: {
            switchToCreate() {
                this.$parent.is_viewing = false;
                this.$parent.is_editing = false;
                this.$parent.is_creating = true;

                this.$parent.setTab( 'resource-create' );
            },
        }
    }
}
