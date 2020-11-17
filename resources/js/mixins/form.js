module.exports = {
    onFormReady: {
        mounted() {
            if ( ! this.$parent.has_used_edit_prop ) {
                this.$parent.$emit( 'form-ready' );

                this.$parent.has_used_edit_prop = true;
            }

            let slug = this.$parent.getSlugFromRef( 'resource_index', 'listing' );

            if ( !this.$parent.is_editing && !this.$parent.is_viewing ) {
                this.$router.push( '/admin/' + slug + '/create' );
            }
            else {
                let _this = this;

                this.$nextTick( () => {
                    jQuery( '[data-toggle="tooltip"]' ).tooltip();

                    _this.$router.push( '/admin/' + slug + '/' + _this.form.id + '/edit' );
                });
            }
        },

        methods: {
            setRecord( payload ) {
                this.form = Object.assign( {}, this.form, payload );
            },

            switchToCreate() {
                this.is_viewing = false;
                this.is_editing = false;
                this.is_creating = true;

                this.setTab( 'resource-create' );
            },
        }
    }
}
