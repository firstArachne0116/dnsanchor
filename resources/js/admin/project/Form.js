import Datepicker from 'vuejs-datepicker';

import {mapGetters} from 'vuex';
import {onFormReady} from '../../mixins/form';
import AppForm from '../app-components/Form/AppForm';

const config = {
    height: 200,
    inline: false,
    theme: 'modern',
    fontsize_formats: '8px 10px 12px 13px 14px 15px 16px 18px 20px 22px 24px 26px 28px 30px 34px 38px 42px 48px 54px 60px',
    plugins: 'print searchreplace autolink directionality advcode fullscreen image link media table charmap hr anchor toc insertdatetime advlist lists textcolor tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
    toolbar1: 'formatselect fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat  | code',
    image_advtab: true,
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
    ]
};

Vue.component( 'project-form', {
    mixins: [AppForm, onFormReady],
    components: {
        Datepicker
    },
    data: function () {
        return {
            config,
            clientLookupTimeout: null,
            debounceTimeout: 1000,
            activeTab: 0,
            showMainForm: true,
            templateType: 'RFQ',
            savedByAction: false,
            savedAsOfficial: false,
            moment: () => {
            },
            mediaCollections: ['jcp', 'jcp_supporting_files'],
            generate: {
                type: 'print',
                template: 'rfq',
                letterhead: null
            },
            is_mounted: false,
            fcq_signed: false,
            fcq_signed_at: moment().toDate(),
            form: {
                client: [],
                contributors: [],

                assigned_salesperson: [],
                orientation: [],
                origination: 'CTO',
                types: {},
                type: [],
                title: '',
                lines: {
                    current_page: 1,
                    data: [],
                    first_page_url: '',
                    last_page_url: '',
                    next_page_url: '',
                    prev_page_url: '',
                    path: '',
                    to: null,
                    from: null,
                    per_page: 10,
                    total: 0
                },
                aa_lines: {
                    current_page: 1,
                    data: [],
                    first_page_url: '',
                    last_page_url: '',
                    next_page_url: '',
                    prev_page_url: '',
                    path: '',
                    to: null,
                    from: null,
                    per_page: 10,
                    total: 0
                },
                finishing_information: '',
                packaging_information: '',
                origination: '',
                information_requests: '',
                materials_in_at: '',
                materials_in_at: '',
                delivery_at: '',
                ship_to: '',
                vendor_notes: '',
            },
            misc_pos: [],
            is_viewing_files: false,
            editing_misc_po: false,
            creating_misc_po: false,
            aa_content: '',
            checklist_questions: [
                {
                    label: 'RFQ',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'PCQ',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'FCQ (signed) + 2 docs sent',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Job Confirmation Paperwork (JCP) sent',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Job Confirmation Paperwork (VC) back from HK',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'PO',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: '5 docs sent (+ board)',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'AA',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'AA Signed',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Updated PO',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Ex-Factory (Production Completed)',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Bulk Loading -> Shipping Docs Received',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Sales Invoice',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Account Invoice',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Product Delivered',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Vendor Invoice Received and Approved',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Shipping Invoice Received and Approved',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Packets Finished (and signed by manager)',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Packets Scanned',
                    checked: false,
                    has_official_version: false,
                    timestamp: null
                },
                {
                    label: 'Job Closed Out By Accounts',
                    checked: false,
                    has_official_version: false,
                    timestamp: null,
                    danger: true
                }
            ],
            current_tab: 'rfq',
            onSuccessCallback: null,
            fabActions: [
                {
                    name: 'save',
                    icon: 'flaticon-doc',
                    tooltip: 'Save'
                },
                {
                    name: 'save_as_official',
                    icon: 'flaticon2-correct',
                    tooltip: 'Save as Official'
                },
                {
                    name: 'print',
                    icon: 'flaticon2-fax',
                    tooltip: 'Save & Print'
                },
                {
                    name: 'download',
                    icon: 'flaticon-download-1',
                    tooltip: 'Save & Download'
                }
            ],
            isLoading: false,
            is_filtering_files: false,
            sales_people: [],
            vendor_notes: [],
            vendor_options: [],
            clients: [],
            orientations: [],
            payment_term_options: [],
            vendor_payment_term_options: [],
            remittance_options: [],
            vendor_note_template: null,

            ran_after_init: false
        };
    },
    props: ['types', 'access', 'awaitingManagerApproval', 'isManager', 'aaContent', 'customer_id'],
    created() {
        if ( window.moment ) {
            this.moment = window.moment;
        }

        this.form.assigned_salesperson = [];
        this.form.referred_by = [];
    },
    mounted() {
        //        var tab = document.querySelector( 'ul.uk-tab' );
        //        var referenceNode = document.querySelector( '.app-header ul' );
        //
        //        tab.className += ' nav navbar-nav ml-auto';
        //
        //        referenceNode.parentNode.insertBefore( tab, referenceNode );

        let _this3 = this;

        _this3.is_mounted = true;

        this.$parent.$emit( 'gpsd:update-page', 'project:overview' );

        this.$root.$on( 'gpsd:added-file', function ( data ) {
            _this3.form.jcp_supporting_files.push( data );
        } );

        this.form.aa_content = this.aaContent;

        // if (parseInt(this.customer_id) !== -1) {
        //     console.log(this.customer_id);
        //     this.setTab('rfq');
        // }

        if (this.$parent.is_viewing || this.$parent.is_editing) {
            console.log('here');
            this.setTab('overview');
        }

        console.log( 'tree' );

        let _this = this;

        axios.all( [
            axios.get( '/api/sales-persons' ),
            axios.get( '/api/contacts' ),
            axios.get( '/api/orientations' ),
            axios.get( '/api/vendor-notes' ),
            axios.get( '/api/remittance-info' ),
            axios.get( '/api/payment-terms' ),
            axios.get( '/api/vendor-payment-terms' ),
            axios.get( '/api/vendors' )
        ] ).then( axios.spread( ( salesResponse, clientResponse, orientationsResponse, vendorNotesResponse, remittanceResponse, paymentTermsResponse, vendorPaymentTermsResponse, vendorResponse ) => {
            _this.sales_people = salesResponse.data.data;
            _this.clients = clientResponse.data.data;

            console.log(_this.customer_id);

            if (parseInt(_this.customer_id) !== -1) {
                _this.form.client = _this.clients.find(cl => cl.id === _this.customer_id);
            }

            _this.orientations = orientationsResponse.data.data;
            _this.vendor_notes = vendorNotesResponse.data.data;
            _this.remittance_options = remittanceResponse.data.data;
            _this.payment_term_options = paymentTermsResponse.data.data;
            _this.vendor_options = vendorResponse.data.data;
            _this.vendor_payment_term_options = vendorPaymentTermsResponse.data.data;

            _this.$nextTick( () => {
                _this.after_data_update();

                this.$modal.show( 'pending-review' );
            } );
        }));

        jQuery( '[data-toggle="tooltip"]' ).tooltip();
    },

    watch: {
        'form.type': function () {
            let _this = this;

            for ( let type of _this.types ) {
                let materials = {};
                let specs = {};

                let record = _this.form.fields && _this.form.fields[ type.friendly_name ] ? _this.form.fields[ type.friendly_name ] : false;

                for ( let field of type.fields.materials ) {
                    materials[ field.label ] = record && record.materials[ field.label ] ? record.materials[ field.label ] : '';
                }

                for ( let field of type.fields.specs ) {
                    specs[ field.label ] = record && record.specs[ field.label ] ? record.specs[ field.label ] : '';
                }

                _this.form.types[ type.friendly_name ] = {
                    materials,
                    specs
                };
            }
        }
    },

    methods: {
        limitText( count ) {
            return `and ${count} other clients`;
        },

        hasCompletedSection( section ) {
            return this.form && this.form.hasOwnProperty( 'approval_map' ) && this.form.approval_map.hasOwnProperty( section.toLowerCase() ) && this.form.approval_map[ section.toLowerCase() ];
        },

        getIconFilename( media ) {
            switch ( media.mime_type ) {
                case 'image/png':
                case 'image/jpeg':
                    return 'jpg.svg';
                case 'application/pdf':
                    return 'pdf.svg';
                case 'application/zip':
                    return 'zip.svg';
            }
        },

        generatePDF() {
            let _this3 = this;

            if ( _this3.templateType.toLowerCase() === 'misc po' ) {
                switch ( _this3.generate.type ) {
                    case 'download':
                        window.open( '/admin/projects/' + _this3.form.id + '/misc-po/pdf?po=' + _this3.$refs.purchase_order.form.id + '&download=true&letterhead=' + _this3.generate.letterhead );
                        break;
                    case 'pdf':
                        window.open( '/admin/projects/' + _this3.form.id + '/misc-po/pdf?po=' + _this3.$refs.purchase_order.form.id + '&letterhead=' + _this3.generate.letterhead );
                        break;
                    case 'print':
                        window.open( '/admin/projects/' + _this3.form.id + '/misc-po/print?po=' + _this3.$refs.purchase_order.form.id + '&letterhead=' + _this3.generate.letterhead );
                        break;
                }
            }
            else {
                switch ( _this3.generate.type ) {
                    case 'download':
                        window.open( '/admin/projects/' + _this3.form.id + '/' + _this3.templateType.toLowerCase() + '/pdf?download=true&letterhead=' + _this3.generate.letterhead );
                        break;
                    case 'pdf':
                        window.open( '/admin/projects/' + _this3.form.id + '/' + _this3.templateType.toLowerCase() + '/pdf?letterhead=' + _this3.generate.letterhead );
                        break;
                    case 'print':
                        window.open( '/admin/projects/' + _this3.form.id + '/' + _this3.templateType.toLowerCase() + '/print?letterhead=' + _this3.generate.letterhead );
                        break;
                }
            }
        },

        createMiscPO() {
            let _this = this;

            this.creating_misc_po = true;

            this.$nextTick( () => {
                //                _this.$refs.purchase_order.onSubmit();
            } );
        },

        editPurchaseOrder( po ) {
            this.editing_misc_po = true;

            let _this = this;

            axios.get( po.resource_url ).then( response => {
                _this.$refs.purchase_order.form = response.data;

                _this.$nextTick( () => {
                    _this.$refs.purchase_order.after_data_update();
                } );
            } ).catch( error => {
                _this.$notify( {
                    type: 'error',
                    title: 'Oops, something went wrong',
                    text: 'Please check your internet connection.'
                } );
            } );
        },

        copyTypeText( type, field, nextField ) {
            let obj = {};

            if ( nextField ) {
                obj[ nextField.label ] = this.form.types[ type.friendly_name ].materials[ field.label ];
                let local_type = Object.assign( {}, this.form.types[ type.friendly_name ].specs, obj );
                let local_types = this.form.types;

                local_types[ type.friendly_name ].specs = local_type;

                this.$forceUpdate(); // hacky
            }
        },

        intertwineProjectType( type ) {
            let materials = type.fields.materials;
            let specs = type.fields.specs;

            // mark so we can determine type
            for( let material of materials ) {
                material._type = 'material';
            }

            for( let spec of specs ) {
                spec._type = 'spec';
            }

            let result = [],
                i, l = Math.min( materials.length, specs.length );

            for ( i = 0; i < l; i++ ) {
                result.push( materials[ i ], specs[ i ] );
            }

            result.push( ...materials.slice( l ), ...specs.slice( l ) );

            return result;
        },

        addTag( newTag ) {
            const tag = {
                name: newTag,
                code: newTag.substring( 0, 2 ) + Math.floor( (Math.random() * 10000000) )
            };

            this.orientations.push( tag );
            this.form.orientation = tag;
        },

        isPendingReview( template_type ) {
            if ( this.form.status === 'AWAITING_MANAGER_APPROVAL' && this.form.template_type === template_type ) {
                return true;
            }

            return false;
        },

        confirmSaveAsOfficial( approved ) {
            let _this3 = this;

            axios.post( '/admin/projects/' + this.form.id + '/confirm', {
                approved,
                template_type: _this3.form.template_type
            } ).then( response => {
                if ( response.data.success ) {
                    if ( response.data.hasOwnProperty( 'ID' ) ) {
                        _this3.form.id = response.data.ID;
                        _this3.form.status = response.data.status;
                    }

                    if ( _this3.$refs.hasOwnProperty( 'resource_index' ) ) {
                        _this3.$refs.resource_index.loadData();
                    }

                    _this3.$notify( {
                        type: 'success',
                        title: 'Success!',
                        text: 'The ' + _this3.templateType + ' has successfully been ' + (approved ? 'confirmed as the official version.' : 'rejected.')
                    } );
                }
            } ).catch( () => {
                _this3.$notify( {
                    type: 'error',
                    title: 'Error',
                    text: 'Oops, something went wrong. Please try again later.'
                } );
            } );

            _this3.$modal.hide( 'approve-version' );
            _this3.$modal.hide( 'reject-version' );
        },

        console( item ) {
            console.log( item );
        },

        after_data_update() {
            let _this3 = this;

            this.form.types = {};

            for ( let type of this.types ) {
                let materials = {};
                let specs = {};

                let record = this.form.fields && this.form.fields[ type.friendly_name ] ? this.form.fields[ type.friendly_name ] : false;

                for ( let field of type.fields.materials ) {
                    materials[ field.label ] = record && record.materials[ field.label ] ? record.materials[ field.label ] : '';
                }

                for ( let field of type.fields.specs ) {
                    specs[ field.label ] = record && record.specs[ field.label ] ? record.specs[ field.label ] : '';
                }

                this.form.types[ type.friendly_name ] = {
                    materials,
                    specs
                };
            }

            /**
             * Update lines
             */


            /**
             * Select default vendor note
             */
            if ( this.vendor_notes && this.vendor_notes.length > 0 ) {
                let defaultVendorNotes = this.vendor_notes.filter( function ( item ) {
                    return item.default;
                } );

                if ( defaultVendorNotes.length > 0 ) {
                    this.vendor_note_template = defaultVendorNotes[ 0 ];
                    this.form.vendor_notes = this.vendor_note_template.note;
                }
            }

            let defaultRemittanceInfo = null;
            let defaultPaymentTerms = null;

            /**
             * Select default remittance info
             */
            if ( this.remittance_options && this.remittance_options.length > 0 ) {
                defaultRemittanceInfo = this.remittance_options.filter( function ( item ) {
                    return item.default;
                } );

                if ( defaultRemittanceInfo.length > 0 ) {
                    this.form.remittance_info = defaultRemittanceInfo[ 0 ];
                }
            }

            /**
             * Select default payment terms
             */
            if ( this.payment_term_options && this.payment_term_options.length > 0 ) {
                defaultPaymentTerms = this.payment_term_options.filter( function ( item ) {
                    return item.default;
                } );

                if ( defaultPaymentTerms.length > 0 ) {
                    this.form.payment_terms = defaultPaymentTerms[ 0 ];
                }
            }

            let form = this.form;

            if ( form.sales_representative_id ) {
                // sales person options
                let assigned_salesperson = this.sales_people.filter( function ( item ) {
                    return item.ID === form.sales_representative_id;
                } );

                if ( assigned_salesperson.length > 0 ) {
                    this.form.assigned_salesperson = assigned_salesperson;
                }
            }

            if ( form.vendor_id ) {
                let vendor = this.vendor_options.filter( function ( item ) {
                    return item.id === form.vendor_id;
                } );

                if ( vendor.length > 0 ) {
                    this.form.vendor = vendor[ 0 ];
                }
            }

            if ( form.vendor_payment_term_id ) {
                let vendor = this.vendor_payment_term_options.filter( function ( item ) {
                    return item.id === form.vendor_payment_term_id;
                } );

                if ( vendor.length > 0 ) {
                    this.form.vendor_payment_term = vendor[ 0 ];
                }
            }

            if ( !form.client ) {
                this.form.client = [];
            }

            if ( form.fcq_signed_at ) {
                _this3.fcq_signed = !!form.fcq_signed_at;
            }

            if ( form.orientation ) {
                let match = _this3.orientations.filter( item => {
                    return item.name === form.orientation;
                } );

                if ( match ) {
                    _this3.form.orientation = match[ 0 ];
                }
            }

            if ( form.invoice_lines_inc_po && _this3.$refs.hasOwnProperty( 'project_invoice' ) ) {
                _this3.$refs.project_invoice.applicable_lines = form.invoice_lines_inc_po;
            }

            if ( form.aa_template ) {
                _this3.aa_content = form.aa_template;
            }
            else {
                _this3.aa_content = _this3.aaContent;
            }

            _this3.$nextTick( () => {
                if ( _this3.$refs.hasOwnProperty( 'project_invoice' ) ) {
                    _this3.$refs.project_invoice.loadData();
                }

                if ( _this3.$refs.hasOwnProperty( 'aa_line_items' ) ) {
                    _this3.$refs.aa_line_items.loadData();
                }
            } );

            if ( form.project_stage_checklist ) {
                _this3.checklist_questions = form.project_stage_checklist.map( question => {
                    return Object.assign( {}, question, { timestamp: moment.unix( question.timestamp ) } );
                } );
            }
        },

        getPostData: function getPostData() {
            var _this3 = this;

            console.log( 'should be intervening' );

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

            let sales_invoice_lines_by_type = {};

            if ( _this3.$refs.hasOwnProperty( 'sales_invoice' ) && _this3.$refs.sales_invoice && _this3.$refs.sales_invoice.hasOwnProperty( 'sales_invoice_lines' ) ) {
                for ( let line of _this3.$refs.sales_invoice.sales_invoice_lines ) {
                    let info = line.split( '-' );
                    let key = info[ 0 ];

                    if ( !sales_invoice_lines_by_type.hasOwnProperty( key ) ) {
                        sales_invoice_lines_by_type[ key ] = [];
                    }

                    sales_invoice_lines_by_type[ key ].push( info[ 1 ] );
                }
            }

            // get client ID
            let objToReturn = Object.assign( {}, this.form, {
                client_id: _this3.form.client.id,
                sales_representatives: _this3.form.assigned_salesperson ? _.map( _this3.form.assigned_salesperson, 'ID' ) : [],
                orientation: _this3.form.hasOwnProperty( 'orientation' ) && _this3.form.orientation && _this3.form.orientation.hasOwnProperty( 'name' ) && _this3.form.orientation.name ? _this3.form.orientation.name : null,
                fields: _this3.form.types ? _.pick( _this3.form.types, _this3.form.type ) : {},
                redirect: !_this3.savedByAction,
                saved_as_official: _this3.savedAsOfficial,
                template_type: _this3.templateType,
                vendor_id: _this3.form.vendor && _this3.form.vendor.hasOwnProperty( 'id' ) ? _this3.form.vendor.id : null,
                vendor_payment_term_id: _this3.form.vendor_payment_term && _this3.form.vendor_payment_term.hasOwnProperty( 'id' ) ? _this3.form.vendor_payment_term.id : null,
                remittance_id: _this3.form.remittance_info && _this3.form.remittance_info.hasOwnProperty( 'id' ) ? _this3.form.remittance_info.id : null,
                payment_term_id: _this3.form.payment_terms && _this3.form.payment_terms.hasOwnProperty( 'id' ) ? _this3.form.payment_terms.id : null,
                materials_in_at: moment( _this3.form.materials_in_at ).unix(),
                fob_at: moment( _this3.form.fob_at ).unix(),
                delivery_at: moment( _this3.form.delivery_at ).unix(),
                jcp_fields: _this3.$refs.jcp.form,
                fcq_signed_at: _this3.fcq_signed && _this3.fcq_signed_at ? moment( _this3.fcq_signed_at ).unix() : null,
                invoice_lines_inc_po: _this3.$refs.hasOwnProperty( 'project_invoice' ) && _this3.$refs.project_invoice.hasOwnProperty( 'applicable_lines' ) ? _this3.$refs.project_invoice.applicable_lines : [],
                sales_invoice_lines: sales_invoice_lines_by_type,
                aa_template: _this3.aa_content,
                project_stage_checklist: _this3.checklist_questions ? _this3.checklist_questions.map( question => {
                    return Object.assign( {}, question, { timestamp: question.timestamp ? question.timestamp.unix() : null } );
                } ) : null
            } );

            if ( !_this3.$refs.hasOwnProperty( 'jcp' ) ) {
                delete objToReturn[ 'jcp_fields' ];
            }

            delete objToReturn[ 'client' ];
            delete objToReturn[ 'vendor' ];
            delete objToReturn[ 'type' ];
            delete objToReturn[ 'types' ];
            delete objToReturn[ 'remittance_info' ];
            delete objToReturn[ 'payment_terms' ];
            delete objToReturn[ 'vendor_payment_term' ];

            return objToReturn;
        },

        dateFormatter( date ) {
            return moment( date ).format( 'MMMM Do YYYY' );
        },

        clearAll() {
            this.form.client = [];
        },

        addVendorNoteTemplate() {
            let that = this;

            this.$nextTick( function () {
                if ( that.vendor_note_template ) {
                    that.form.vendor_notes = that.vendor_note_template.note;
                }
            } );
        },

        saveAsOfficial() {
            this.savedByAction = true;
            this.savedAsOfficial = true;
            this.$parent.onSubmit();
        },

        onSuccess( data ) {
            if ( this.savedByAction ) {
                this.$notify( {
                    type: 'success',
                    title: 'Success!',
                    text: 'The ' + this.templateType + ' has successfully saved.'
                } );

                if ( this.onSuccessCallback ) {
                    this.onSuccessCallback();

                    // close all modals
                    this.$modal.hide( 'save-as-official' );
                    this.$modal.hide( 'download' );
                    this.$modal.hide( 'print' );

                    // reset for the next request
                    this.onSuccessCallback = null;
                }
            }
            else {
                this.submiting = false;
                if ( data.redirect ) {
                    window.location.replace( data.redirect );
                }
            }
        },

        signedFCQ() {
            this.convenientSave();

            let _this = this;

            axios.post( '/admin/projects/' + this.form.id + '/fcq-signed', {} ).then( response => {
                if ( response.data.success ) {
                    _this.$notify( {
                        type: 'success',
                        title: 'Success',
                        text: 'We\'ve marked the FCQ as signed.'
                    } );

                    _this.fcq_signed = true;
                }
                else {
                    throw 'error';
                }
            } ).catch( error => {
                _this.$notify( {
                    type: 'error',
                    title: 'Oops, something went wrong.',
                    text: 'Please check your internet connection.'
                } );
            } );
        },

        convenientSave() {
            let _this = this;

            this.savedByAction = true;

            if ( this.creating_misc_po || this.editing_misc_po ) {
                this.$refs.purchase_order.onSubmit( data => {
                    this.onSuccess( data );

                    if ( _this.creating_misc_po ) {
                        // refresh
                        _this.form.misc_pos.push( data.purchase_order );
                    }
                    else {
                        for ( let po_index in _this.form.misc_pos ) {
                            let po = _this.form.misc_pos[ po_index ];

                            if ( po.id === data.purchase_order.id ) {
                                _this.form.misc_pos[ po_index ] = Object.assign( {}, po, data.purchase_order );
                            }
                        }
                    }

                    _this.$notify( {
                        type: 'success',
                        title: 'Success',
                        text: 'We\'ve successfully updated the purchase order.'
                    } );
                } );
            }
            else {
                this.$parent.onSubmit( ( data ) => {
                    this.onSuccess( data );

                    // reload data
                    if ( _this.$parent.$refs.hasOwnProperty( 'resource_index' ) ) {
                        _this.$parent.$refs.resource_index.loadData();
                    }

                    if ( data.hasOwnProperty( 'resource' ) ) {
                        _this.form = Object.assign( {}, _this.form, data.resource );
                        _this.$parent.active_record = data.resource;
                        _this.$parent.is_creating = false;
                        _this.$parent.is_editing = true;
                        _this.$parent.is_viewing = false;

                        _this.$router.push( '/admin/projects/' + _this.form.id + '/edit' );
                    }

                    _this.$notify( {
                        type: 'success',
                        title: 'Success',
                        text: 'We\'ve successfully updated the project.'
                    } );
                } );
            }
        },

        convenientPrint() {
            let _this3 = this;

            this.generate.type = 'print';
            this.onSuccessCallback = function () {
                _this3.generatePDF();
            };

            this.convenientSave();
        },

        convenientDownload() {
            let _this3 = this;

            this.generate.type = 'download';
            this.onSuccessCallback = function () {
                _this3.generatePDF();
            };

            this.convenientSave();
        },

        removeFile( id ) {
            let _this = this;

            axios.post( '/admin/projects/' + this.form.id + '/remove-file', {
                _method: 'delete',
                media_id: id
            } ).then( response => {
                if ( response.data.success ) {
                    _this.$notify( {
                        type: 'success',
                        title: 'Success',
                        text: 'We have deleted this media item.'
                    } );

                    _this.form = Object.assign( {}, _this.form, {
                        jcp_supporting_files: _this.form.jcp_supporting_files.filter( item => {
                            return item !== id;
                        } )
                    } );
                }
                else {
                    throw 'error';
                }
            } ).catch( err => {
                _this.$notify( {
                    type: 'error',
                    text: 'Oops, something went wrong.'
                } );
            } );
        },

        clientLookup( query ) {
            let q = query;
            let that = this;

            if ( !q ) {
                return true;
            }

            if ( this.clientLookupTimeout ) {
                clearTimeout( this.clientLookupTimeout );
            }

            this.clientLookupTimeout = setTimeout( function () {
                that.isLoading = true;

                axios.get( '/api/clients', {
                    params: {
                        q: q
                    }
                } ).then( ( response ) => {
                    that.isLoading = false;
                    that.clients = response.data.data;
                } );
            }, this.debounceTimeout );
        },

        vendorLookup( query ) {
            let q = query;
            let that = this;

            if ( !q ) {
                return true;
            }

            if ( this.vendorLookupTimeout ) {
                clearTimeout( this.vendorLookupTimeout );
            }

            this.vendorLookupTimeout = setTimeout( function () {
                that.isLoading = true;

                axios.get( '/api/vendors', {
                    params: {
                        q: q
                    }
                } ).then( ( response ) => {
                    that.isLoading = false;
                    that.vendor_options = response.data.data;
                } );
            }, this.debounceTimeout );
        },

        openModal( id ) {
            this.$modal.show( id );
        },

        closeModal( id ) {
            this.$modal.hide( id );
        },

        setTab( id, disabled ) {
            if ( disabled ) {
                return;
            }

            this.current_tab = id;
            this.$root.$emit( 'gpsd:update-page', id );

            switch ( id ) {
                case 'misc_po':
                    this.templateType = 'Misc PO';
                    break;

                default:
                    this.templateType = id.toUpperCase();
                    break;
            }
        },

        isCurrentTab( id ) {
            if ( id.constructor === Array ) {
                return id.includes( this.current_tab );
            }

            return this.current_tab === id;
        },

        toggleType( id ) {
            if ( this.form.type.includes( id ) ) {
                var index = this.form.type.indexOf( id );

                if ( index !== -1 ) {
                    this.form.type.splice( index, 1 );
                }
            }
            else {
                this.form.type.push( id );
            }
        },

        ucwords( str ) {
            return (str + '')
            .replace( /^(.)|\s+(.)/g, function ( $1 ) {
                return $1.toUpperCase();
            } );
        }


    },

    computed: {
        ...mapGetters( ['isUserManager'] ),

        friendly_template_type() {
            let parts = this.templateType.split( '_' );

            if ( parts.length === 1 ) {
                return parts[ 0 ];
            }

            return this.ucwords( (parts.join( ' ' )).toLowerCase() );
        },

        jcp_files() {
            if ( this.is_filtering_files ) {
                let _this = this;

                return this.form.jcp_supporting_files.filter( file => {
                    if ( _this.is_filtering_files === 'images' ) {
                        return file.mime_type.includes( 'image/' );
                    }
                    else if ( _this.is_filtering_files === 'documents' ) {
                        return file.mime_type.includes( 'application/' );
                    }
                    else if ( _this.is_filtering_files === 'official' ) {
                        return file.collection_name === 'official_files';
                    }
                } );
            }
            else {
                return this.form.jcp_supporting_files;
            }
        },

        total_cost() {
            if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.total_price ) {
                return 0;
            }

            return (this.$refs.project_invoice.total_cost + this.$refs.aa_line_items.total_cost);
        },

        total_value() {
            if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.total_price ) {
                return 0;
            }

            return (this.$refs.project_invoice.total_price + this.$refs.aa_line_items.total_price);
        },

        total_profit() {
            if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.total_price ) {
                return 0;
            }

            return this.total_value - this.total_cost;
        },

        total_profit_percentage() {
            if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.total_price ) {
                return 0;
            }

            let amount = (this.total_profit / this.total_cost);

            return (amount * 100).toFixed( 2 );
        },

        invoice_lines_by_category() {
            if ( !this.is_mounted || !this.$refs.project_invoice || !this.$refs.project_invoice.collection ) {
                return {};
            }

            let lines_by_categories = {};

            for ( let line of this.$refs.aa_line_items.collection ) {
                if ( !lines_by_categories.hasOwnProperty( line.category ) ) {
                    lines_by_categories[ line.category ] = [];
                }

                lines_by_categories[ line.category ].push( line );
            }

            for ( let line of this.$refs.project_invoice.collection ) {
                if ( !lines_by_categories.hasOwnProperty( line.category ) ) {
                    lines_by_categories[ line.category ] = [];
                }

                lines_by_categories[ line.category ].push( line );
            }


            return lines_by_categories;
        },

        all_line_items() {
            let lines = [];

            /*if ( this.$refs.hasOwnProperty( 'aa_line_items' ) && this.$refs.aa_line_items ) {
             let aa_line_items = this.$refs.aa_line_items;

             if ( aa_line_items.hasOwnProperty( 'collection' ) && aa_line_items.collection.length > 0 ) {
             lines = [ ...aa_line_items.collection ];
             }
             }

             if ( this.$refs.hasOwnProperty( 'project_invoice' ) && this.$refs.project_invoice ) {
             let project_invoice_line_items = this.$refs.project_invoice;

             if ( project_invoice_line_items.hasOwnProperty( 'collection' ) && project_invoice_line_items.collection.length > 0 ) {
             lines = [ ...project_invoice_line_items.collection ];
             }
             }*/

            for ( let category in this.invoice_lines_by_category ) {
                let array = this.invoice_lines_by_category[ category ];

                for ( let item of array ) {
                    item._type = 'po';
                }

                lines = lines.concat( array );
            }

            if ( this.form.misc_pos && this.form.misc_pos.length > 0 ) {
                for ( let po of this.form.misc_pos ) {
                    if ( po.lines && po.lines.length > 0 ) {
                        for ( let item of po.lines ) {
                            item._type = 'misc_po';
                        }

                        lines = lines.concat( po.lines );
                    }
                }
            }

            return lines;
        },

        show_invoice_lines: {
            get() {
                return [1, 2, 4].includes( this.activeTab );
            }
        }
    }

} );
