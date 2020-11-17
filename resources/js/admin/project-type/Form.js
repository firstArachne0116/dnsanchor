import draggable from 'vuedraggable';
import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

Vue.component( 'project-type-form', {
    mixins: [ AppForm, onFormReady ],
    components: {
        draggable
    },
    data: function () {
        return {
            globalID: 30,
            form: {},
            leftFocusedID: null,
            rightFocusedID: null,
            drag: false,
            list1: [
                {
                    id: 0,
                    icon: 'pencil-square-o',
                    name: 'Text Input',
                    type: 'text'
                },
                {
                    id: 1,
                    icon: 'file-text',
                    name: 'Textarea',
                    type: 'textarea'
                },
                {
                    id: 2,
                    icon: 'database',
                    name: 'Select',
                    type: 'select'
                }
            ],
            materialFields: [],
            specFields: []
        };
    },

    methods: {
        log: function ( evt ) {
            window.console.log( evt );
        },

        after_data_update() {
            if ( this.form ) {
                let that = this;

                this.materialFields = this.form.fields.materials;
                this.specFields = this.form.fields.specs;

                this.$nextTick( function () {
                    that.materialFields = that.materialFields.map( function ( item ) {
                        let obj = that.observerClean( item );
                        let label = obj.label;

                        delete obj[ label ];

                        return Object.assign( {}, obj, { id: that.globalID++, name: label } );
                    } );

                    that.specFields = that.specFields.map( function ( item ) {
                        let obj = that.observerClean( item );
                        let label = obj.label;

                        delete obj[ label ];

                        return Object.assign( {}, obj, { id: that.globalID++, name: label } );
                    } );
                } );
            }
        },

        cloneDog( { type } ) {
            this.leftFocusedID = this.globalID++;

            let obj = {
                id: this.globalID,
                name: `${type}`,
                type,
            };

            return obj;
        },

        remove( id, side ) {
            if ( side === 'left' ) {
                this.materialFields.splice( id, 1 );
            }
            else {
                this.specFields.splice( id, 1 );
            }
        },

        copyToSpecs() {
            let that = this;

            let materials = this.materialFields.map( function( item ) {
                let obj = that.observerClean( item );

                that.specFields.push( Object.assign( {}, obj, { id: that.globalID++ } ) );
            });
        },

        observerClean( obj ) {
            return Object.keys( obj ).reduce(
                ( res, e ) => Object.assign( res, { [ e ]: obj[ e ] } ),
                {}
            )
        },

        getPostData: function getPostData() {
            var _this3 = this;

            if ( this.mediaCollections ) {
                this.mediaCollections.forEach( function ( collection, index, arr ) {
                    if ( _this3.form[ collection ] ) {
                        console.warn( 'MediaUploader warning: Media input must have a unique name, \'' + collection + '\' is already defined in regular inputs.' );
                    }

                    if ( _this3.$refs[ collection + '_uploader' ] ) {
                        _this3.form[ collection ] = _this3.$refs[ collection + '_uploader' ].getFiles();
                    }
                } );
            }

            this.form[ 'wysiwygMedia' ] = this.wysiwygMedia;

            let materials = this.materialFields.map( function ( item ) {
                switch ( item.type ) {
                    case 'select':
                        return {
                            type: item.type,
                            label: item.name,
                            options: item.options
                        };
                    default:
                        return {
                            type: item.type,
                            label: item.name
                        };
                }
            } );

            let specs = this.specFields.map( function ( item ) {
                switch ( item.type ) {
                    case 'select':
                        return {
                            type: item.type,
                            label: item.name,
                            options: item.options
                        };
                    default:
                        return {
                            type: item.type,
                            label: item.name
                        };
                }
            } );

            return Object.assign( {}, this.form, {
                fields: {
                    materials,
                    specs,
                }
            } );
        }
    }
} );
