import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';

Vue.component('role-form', {
    mixins: [AppForm, onFormReady],

    props: [ 'permissions' ],

    data: function() {
        return {
            permission_ids: [],
            form: {
                name: '' ,
                guard_name: '' ,
                permissions: [],
            }
        }
    },

    methods: {
        getPostData: function getPostData() {
            var _this3 = this;

            if ( this.mediaCollections ) {
                this.mediaCollections.forEach( function ( collection, index, arr ) {
                    if ( _this3.form[ collection ] ) {
                        console.warn( "MediaUploader warning: Media input must have a unique name, '" + collection + "' is already defined in regular inputs." );
                    }

                    if ( _this3.$refs[ collection + '_uploader' ] ) {
                        _this3.form[ collection ] = _this3.$refs[ collection + '_uploader' ].getFiles();
                    }
                } );
            }
            this.form[ 'wysiwygMedia' ] = this.wysiwygMedia;

            return Object.assign({}, this.form, {
                permissions: this.form.permission_ids,
                permission_ids: undefined,
            });
        },
    }
});
