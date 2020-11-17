<script>
    import Router from 'vue-router';

    var pluralize = require( 'pluralize' );

    export default {
        name: 'resource-listing-form-combination',

        mounted() {
            let _this = this;

            this.$watch(
                () => {
                    return this.$refs.resource_index.collection
                },
                ( val ) => {
                    jQuery( '[data-toggle="tooltip"]' ).tooltip();
                }
            );

            //set up router
            this.router = new Router( {
                routes: []
            } );

            // enable editing
            if ( this.$attrs.hasOwnProperty( 'create' ) && this.$attrs.create ) {
                _this.setTab( 'resource-create' );

                _this.active_record = null;

                _this.is_editing = false;
                _this.is_viewing = false;
                _this.is_creating = true;
            }

            if ( this.$attrs.hasOwnProperty( 'edit' ) && this.$attrs.edit ) {
                _this.setTab( 'resource-create' );

                _this.active_record = _this.$attrs.edit;

                _this.is_editing = true;
                _this.is_viewing = false;
                _this.is_creating = false;

                _this.$on( 'form-ready', payload => {
                    _this.$nextTick( () => {
                        _this.$refs.resource_create.setRecord( _this.$attrs.edit );

                        if ( _this.$refs.resource_create.hasOwnProperty( 'after_data_update' ) ) {
                            _this.$refs.resource_create.after_data_update();
                        }

                        jQuery( '[data-toggle="tooltip"]' ).tooltip();
                    });
                });
            }

            jQuery( '[data-toggle="tooltip"]' ).tooltip();
        },

        data: function () {
            return {
                active_tab: 'resource-index',
                active_record: null,
                timeout: null,
                is_viewing: false,
                is_editing: false,
                is_creating: false,
                has_used_edit_prop: false,
                router: null,
                fabActions: [
                    {
                        name: 'save',
                        icon: 'flaticon-doc',
                        tooltip: 'Save'
                    },
                    {
                        name: 'save_new',
                        icon: 'flaticon2-checking',
                        tooltip: 'Save & New'
                    },
                    {
                        name: 'save_exit',
                        icon: 'flaticon-reply',
                        tooltip: 'Save & Exit'
                    },
                ],
                fabActionsViewingMode: [
                    {
                        name: 'edit',
                        icon: 'flaticon2-pen',
                        tooltip: 'Edit'
                    },
                    {
                        name: 'delete',
                        icon: 'flaticon2-checking',
                        tooltip: 'Delete'
                    },
                ],
            }
        },

        methods: {

            debounce( func, wait, immediate ) {
                var timeout;
                return function () {
                    var context = this, args = arguments;
                    var later = function () {
                        timeout = null;
                        if ( !immediate ) func.apply( context, args );
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout( timeout );
                    timeout = setTimeout( later, wait );
                    if ( callNow ) func.apply( context, args );
                };
            },

            /**
             * FAB Actions
             */
            fabActionSave() {
                let _this = this;

                if ( this.$refs.hasOwnProperty( 'resource_create' ) ) {
                    // don't do anything once saved
                    this.onSubmit( () => {
                        _this.$refs.resource_index.loadData();

                        _this.$refs.resource_create.$notify({
                            type: 'success',
                            title: 'Success!',
                            text: 'This record has been successfully updated.',
                        });
                    } );
                }
            },

            fabActionSaveAndNew() {
                let _this = this;

                if ( this.$refs.hasOwnProperty( 'resource_create' ) ) {
                    this.onSubmit( () => {
                        // momentarily switch tabs to reset element state
                        _this.setTab( 'non-existent' );

                        _this.$nextTick( () => {
                            _this.$refs.resource_index.loadData();

                            _this.setTab( 'resource-create' );

                            _this.$refs.resource_create.$notify( {
                                type: 'success',
                                title: 'Success!',
                                text: 'This record has been successfully updated.',
                            } );
                        });
                    } );
                }
            },

            fabActionSaveAndExit() {
                let _this = this;

                if ( this.$refs.hasOwnProperty( 'resource_create' ) ) {
                    this.onSubmit( () => {
                        _this.$refs.resource_index.loadData();

                        // switch to resource index
                        _this.setTab( 'resource-index' );

                        _this.$refs.resource_create.$notify( {
                            type: 'success',
                            title: 'Success!',
                            text: 'This record has been successfully updated.',
                        } );
                    } );
                }
            },

            handleFormSubmit() {
                if ( this.is_viewing ) {
                    return;
                }

            },

            fabActionEdit(url) {
                this.editRecord( url );
            },

            fabActionDelete( url ) {
                this.deleteRecord( url );
            },

            deleteRecord: function deleteItem( url ) {
                var _this2 = this.$refs.resource_index;

                this.$modal.show( 'dialog', {
                    title: 'Warning!',
                    text: 'Do you really want to delete this item?',
                    buttons: [
                        { title: 'No, cancel.' }, {
                            title: '<span class="btn-dialog text-warning">Yes, delete.<span>',
                            handler: function handler() {
                                _this2.$modal.hide( 'dialog' );
                                axios.post( url, {
                                    _method: 'DELETE'
                                } ).then( function ( response ) {
                                    _this2.loadData();
                                    _this2.$notify( {
                                        type: 'success',
                                        title: 'Success!',
                                        text: response.data.message ? response.data.message : 'Item successfully deleted.'
                                    } );
                                }, function ( error ) {
                                    _this2.$notify( {
                                        type: 'error',
                                        title: 'Error!',
                                        text: error.response.data.message ? error.response.data.message : 'An error has occured.'
                                    } );
                                } );
                            }
                        }
                    ]
                } );
            },

            editRecord( url ) {
                let _this = this;

                axios.get( url ).then( response => {
                    _this.is_viewing = false;
                    _this.is_editing = true;
                    _this.is_creating = false;

                    let data = response.data.data;

                    _this.setTab( 'resource-create' );
                    _this.active_record = data;

                    _this.$nextTick( () => {
                        _this.$refs.resource_create.setRecord(data);

                        if (_this.$refs.resource_create.hasOwnProperty( 'after_data_update' ) ) {
                            _this.$refs.resource_create.after_data_update();
                        }

                        jQuery( '[data-toggle="tooltip"]' ).tooltip();
                    });
                });
            },

            viewRecord( url ) {
                let _this = this;

                _this.is_viewing = true;
                _this.is_editing = false;
                _this.is_creating = false;

                axios.get( url ).then( response => {
                    let data = response.data.data;

                    _this.setTab( 'resource-create' );
                    _this.active_record = data;

                    _this.$nextTick( () => {
                        _this.$refs.resource_create.form = Object.assign( {}, _this.$refs.resource_create.form, data );

                        if ( _this.$refs.resource_create.hasOwnProperty( 'after_data_update' ) ) {
                            _this.$refs.resource_create.after_data_update();
                        }
                    });
                });
            },

            submitCreateForm() {
                let _this = this;

                if ( this.$refs.hasOwnProperty( 'resource_index' ) ) {
                    let resource_index = _this.$refs.resource_index;
                    // submit form
                    this.onSubmit( () => {
                        // reload data
                        resource_index.loadData();
                    });
                }
            },

            getSlugFromRef( ref, ending) {
                let name = this.$refs[ref].$options.name;

                if ( name.substring( ( name.length - ending.length ) ) === ending ) {
                    return pluralize( name.substring( 0, ( ( name.length - ending.length ) - 1 ) ) ); // remove extra character for -
                }

                return pluralize( name );
            },

            setTab( id ) {
                let _this = this;

                // hide any showing tooltips
                jQuery( '[data-toggle="tooltip"], .tooltip' ).tooltip( "hide" );

                _this.active_record = null;

                this.active_tab = id;

                this.$nextTick( () => {
                    switch ( id ) {
                        case 'resource-index':
                            this.$router.push( '/admin/' + this.getSlugFromRef( 'resource_index', 'listing' ) );
                            break;
                    }

                    if ( id === 'resource-create' && !_this.is_editing && !_this.is_viewing ) {
                        // make sure to reset all ids to avoid accidental saving
                        _this.is_creating = true;
                        _this.is_editing = false;
                        _this.is_viewing = false;

                        _this.active_record = null;
                    }

                    jQuery( '[data-toggle="tooltip"]' ).tooltip();
                });
            },

            isTabShowing( id ) {
                return this.active_tab === id;
            },

            /**
             * Override the BaseForm method to reload the
             * datatable once finished.
             *
             * @param data
             */
            onSuccess( data, cb = null ) {
                let _this = this;

                this.submiting = false;

                if ( ! cb ) {
                    // switch back to index
                    this.setTab( 'resource-index' );
                }

                this.$nextTick( () => {
                    // reset any "active records"
//                    _this.active_record = null;

                    if ( cb ) {
                        cb(data);
                    }
                });
            },

            onSubmit: function onSubmit( cb = null ) {
                if ( this.$refs.hasOwnProperty( 'resource_create' ) && this.$refs.resource_create.onSuccessCallback ) {
                    this.$refs.resource_create.onSubmit(cb);
                }

                var _this4 = this.$refs.resource_create;
                let _this = this;

                if ( this.is_viewing ) {
                    return _this.$notify( {
                        type: 'error',
                        title: 'Error!',
                        text: 'You are in viewing mode. You cannot save.',
                    });
                }

                return this.$validator.validateAll().then( function ( result ) {
                    if ( !result ) {
                        _this4.$notify( {
                            type: 'error',
                            title: 'Error!',
                            text: 'The form contains invalid fields.'
                        } );
                        return false;
                    }

                    var data = _this4.form;
                    if ( !_this4.sendEmptyLocales ) {
                        data = _.omit( _this4.form, _this4.locales.filter( function ( locale ) {
                            return _.isEmpty( _this4.form[ locale ] );
                        } ) );
                    }

                    _this4.submiting = true;

                    let _data = _this4.getPostData();

                    if ( _this4.hasOwnProperty( 'modifyPostData' ) ) {
                        _data = _this4.modifyPostData( _data );
                    }

                    axios.post( _this.active_record ? _this.active_record.resource_url : _this4.action, _data ).then( function ( response ) {
                        _this4.submiting = false;

                        return _this.onSuccess( response.data, cb );
                    } ).catch( function ( errors ) {
                        console.log({errors});
                        return _this4.onFail( errors.response.data.errors );
                    } );
                } );
            },

            /**
             * Process update from editable component
             */
            updateRecord( url, name, value ) {
                var _this4 = this.$refs.resource_index;

                // create data object
                let data = {};
                data[ name ] = value;

                axios.post( url, data ).then( function ( response ) {
                    _this4.$notify( {
                        type: 'success',
                        title: 'Success!',
                        text: 'The record has been updated.'
                    } );
                } ).catch( function ( errors ) {
                    console.log( errors );
                } );
            }
        },
    }
</script>
