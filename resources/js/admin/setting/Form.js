import {onFormReady} from '../../mixins/form';import AppForm from '../app-components/Form/AppForm';
import {SlickList, SlickItem} from 'vue-slicksort';

Vue.component('setting-form', {
    mixins: [AppForm, onFormReady],
    components: {
        SlickItem,
        SlickList
    },
    data: function() {
        return {
            tag: '',
            items: [],
            form: {

            }
        }
    },

    mounted() {
        if ( this.form.type === 'list' && this.form.value ) {
            this.items = this.form.value;
        }
    },

    methods: {
        addTag(){
            this.items.push( this.tag );
            this.tag = '';
        },

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

            if ( this.form.type === 'list' ) {
                this.form.value = this.items;
            }

            return this.form;
        },
    }

});
