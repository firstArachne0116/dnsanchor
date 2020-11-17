<template>
    <div>
        <jcc-section :toggle="true" label="Job Confirmation Paperwork" info="Complete Set" v-model="checkbox">
            <p>Inner section test</p>
            <jcc-section :toggle="true" label="Job Confirmation Paperwork" info="Complete Set" v-model="checkbox">
                <p>Inner-Inner section test</p>
            </jcc-section>
        </jcc-section>
    </div>
</template>

<style lang="scss">
    .vue-popover {
        position: fixed;
    }
</style>

<script>
    //    import vue2Dropzone from 'vue2-dropzone';
    //    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    var _vue2Dropzone = require( 'vue2-dropzone' );

    var _vue2Dropzone2 = _interopRequireDefault( _vue2Dropzone );

    function _interopRequireDefault( obj ) {
        return obj && obj.__esModule ? obj : { default: obj };
    }

    module.exports = {
        name: 'jcc-form',

        components: {
            Dropzone: _vue2Dropzone2.default,
        },

        //        components: {
        //            vueDropzone: vue2Dropzone
        //        },

        data() {
            return {
                template: function template() {
                    return '\n              <div class="dz-preview dz-file-preview">\n                  <div class="dz-image">\n                      <img data-dz-thumbnail />\n                  </div>\n                  <div class="dz-details">\n                    <div class="dz-size"><span data-dz-size></span></div>\n                    <div class="dz-filename"></div>\n                  </div>\n                  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\n                  <div class="dz-error-message"><span data-dz-errormessage></span></div>\n                  <div class="dz-success-mark"><i class="fa fa-check"></i></div>\n                  <div class="dz-error-mark"><i class="fa fa-close"></i></div>\n              </div>\n          ';
                },

                dropzoneOptions: {
                    headers: { "X-CSRF-TOKEN": window.axios.defaults.headers.common[ 'X-CSRF-TOKEN' ] }

                },
                checkbox: true,
                active_field: null,
                form: {
                    sections: {},
                },
                jcc_fields: [
                    {
                        "key": "jcp",
                        "title": "Job-confirmation paperwork",
                        "subtitle": "(complete set)",
                        "checked": true,
                        "fields": [
                            {
                                "key": "jcc_cover_sheet",
                                "type": "checkbox",
                                "label": "JCC cover sheet - this page"
                            },
                            {
                                "key": "vendor_confirmation",
                                "type": "checkbox",
                                "label": "VC (Vendor Confirmation)"
                            },
                            {
                                "key": "request_for_quotation",
                                "type": "checkbox",
                                "label": "RFQ (Request for Quotation)",
                                "has_uploads": true
                            },
                            {
                                "key": "final_customer_quote",
                                "type": "checkbox",
                                "label": "FCQ (Final Customer Quote)",
                                "has_uploads": true,
                                "class": "col-6"
                            },
                            {
                                "key": "date_fcq_signed",
                                "type": "datepicker",
                                "label": "Date FCQ Signed",
                                "class": "col-6"
                            },
                            {
                                "key": "client_card",
                                "type": "checkbox",
                                "label": "CC (client card)",
                                "has_uploads": true
                            },
                            {
                                "key": "jcw_at_fcq",
                                "type": "checkbox",
                                "label": "JCW (Job Cost Worksheet) - 'JCW at FCQ'",
                                "has_uploads": true
                            },
                            {
                                "key": "vq_vendor_quotation",
                                "type": "checkbox",
                                "label": "VQ (vendor quotation)",
                                "has_uploads": true,
                                "children": [
                                    {
                                        "key": "vq_actual_quote",
                                        "type": "checkbox",
                                        "label": "Actual quote from vendor"
                                    },
                                    {
                                        "key": "vq_alits_email",
                                        "type": "checkbox",
                                        "label": "Alit's email(s)"
                                    },
                                    {
                                        "key": "vq_markup_spreadsheet",
                                        "type": "checkbox",
                                        "label": "Markup spreadsheet"
                                    },
                                    {
                                        "key": "vq_vendor",
                                        "type": "text",
                                        "label": "Vendor"
                                    }
                                ]
                            },
                            {
                                "key": "vq_shipper_quotation",
                                "type": "checkbox",
                                "label": "SQ (shipper quotation)",
                                "has_uploads": true,
                                "children": [
                                    {
                                        "key": "sq_actual_quote",
                                        "type": "checkbox",
                                        "label": "Actual quote from shipper"
                                    },
                                    {
                                        "key": "sq_alices_rate_chart",
                                        "type": "checkbox",
                                        "label": "Alice's rate email(s)"
                                    },
                                    {
                                        "key": "sq_markup_spreadsheet",
                                        "type": "checkbox",
                                        "label": "Freight Calculator"
                                    },
                                    {
                                        "key": "sq_shipper",
                                        "type": "text",
                                        "label": "Shipper"
                                    }
                                ]
                            },

                            //

                            {
                                "key": "quotation_from_additional_vendor",
                                "type": "checkbox",
                                "label": "Quotation from additional vendor- prepress, sourced items, etc.",
                                "class": "col-6",
                            },

                            {
                                "key": "additional_vendor",
                                "type": "text",
                                "label": "Additional Vendor",
                                "class": "col-6",
                            },
                        ]
                    },

                    // Reprint
                    {
                        "key": "reprint",
                        "title": "Reprint",
                        "subtitle": "(of a job we previously printed)",
                        "checked": null,
                        "fields": [
                            {
                                "key": "history_client_card",
                                "type": "checkbox",
                                "label": "History from client card ( app > client card > scroll to bottom to see list of reference numbers associated with that client )",
                                "children": [
                                    {
                                        "key": "prior_job_ref",
                                        "type": "text",
                                        "label": "Prior job's ref",
                                        "class": "col-3"
                                    },
                                    {
                                        "key": "prior_job_title",
                                        "type": "text",
                                        "label": "Prior job's title",
                                        "class": "col-9"
                                    },
                                ]
                            },
                            {
                                "key": "history_from_jcw_app",
                                "type": "checkbox",
                                "label": "History from JCW ( app > invoice > final invoice > JCW )",
                                "children": [
                                    {
                                        "key": "client_unit_price",
                                        "type": "checkbox",
                                        "label": "Client unit price",
                                        "class": "col-2"
                                    },
                                    {
                                        "key": "client_base_unit_price",
                                        "type": "text",
                                        "label": "Client's base unit price, plus relevant AA amounts",
                                        "class": "col-10",
                                    },

                                    // our unit cost
                                    {
                                        "key": "our_unit_cost",
                                        "type": "checkbox",
                                        "label": "Our unit cost",
                                        "class": "col-2"
                                    },
                                    {
                                        "key": "our_base_unit_cost",
                                        "type": "text",
                                        "label": "Our base unit cost plus relevant AA amounts",
                                        "class": "col-10"
                                    },

                                    // our shipping unit cost
                                    {
                                        "key": "our_shipping_unit_cost",
                                        "type": "checkbox",
                                        "label": "Our shipping unit cost",
                                        "class": "col-2"
                                    },
                                    {
                                        "key": "our_shipping_unit_cost_text",
                                        "type": "text",
                                        "label": "",
                                        "class": "col-4"
                                    },
                                    {
                                        "key": "client_price_incl",
                                        "type": "checkbox",
                                        "label": "Client price included shipping",
                                        "class": "col-3"
                                    },
                                    {
                                        "key": "client_price_fob",
                                        "type": "checkbox",
                                        "label": "Client price was FOB",
                                        "class": "col-3"
                                    },

                                    // quality ordered
                                    {
                                        "key": "quantity_ordered",
                                        "type": "checkbox",
                                        "label": "Quantity Ordered",
                                        "class": "col-2"
                                    },
                                    {
                                        "key": "quantity_ordered_text",
                                        "type": "text",
                                        "label": "estimate the rounded base quantity without runons",
                                        "class": "col-10"
                                    },

                                    // runons quantity
                                    {
                                        "key": "runons_quantity",
                                        "type": "checkbox",
                                        "label": "Runons Quantity",
                                        "class": "col-2"
                                    },
                                    {
                                        "key": "runons_quantity_text",
                                        "type": "text",
                                        "label": "guesstimate a rounded number for the runons quantity ordered",
                                        "class": "col-10"
                                    },

                                    // runons percent
                                    {
                                        "key": "runons_percent",
                                        "type": "checkbox",
                                        "label": "Runons Percent",
                                        "class": "col-2"
                                    },
                                    {
                                        "key": "runons_percent_text",
                                        "type": "text",
                                        "label": "% (divide quantity ordered by guesstimated runons; round to integer)",
                                        "class": "col-10"
                                    },

                                    // date of final invoice
                                    {
                                        "key": "date_of_final_invoice",
                                        "type": "checkbox",
                                        "label": "Date of final invoice",
                                        "class": "col-2"
                                    },
                                    {
                                        "key": "date_of_final_invoice_text",
                                        "type": "text",
                                        "label": "",
                                        "class": "col-4"
                                    },

                                    // prior job's print vendor
                                    {
                                        "key": "prior_jobs_print_vendor",
                                        "type": "checkbox",
                                        "label": "Prior job's vendor print",
                                        "class": "col-2"
                                    },
                                    {
                                        "key": "prior_jobs_print_vendor_text",
                                        "type": "text",
                                        "label": "",
                                        "class": "col-4"
                                    },

                                    // notes to other vendor
                                    {
                                        "key": "notes_re_other_vendors",
                                        "type": "checkbox",
                                        "label": "Notes re other vendors, etc.:",
                                        "class": "col-3"
                                    },
                                    {
                                        "key": "notes_re_other_vendors_text",
                                        "type": "text",
                                        "label": "",
                                        "class": "col-9"
                                    },
                                ]
                            },
                        ]
                    },

                    // Other
                    {
                        "key": "paper_brand",
                        "title": "Paper Brand",
                        "subtitle": "<span></span>",
                        "checked": true,
                        "fields": [
                            {
                                "key": "paper_brand_client_flexible",
                                "type": "checkbox",
                                "label": "Client flexible",
                                "class": "col-4"
                            },
                            {
                                "key": "paper_brand_client_not_flexible",
                                "type": "checkbox",
                                "label": "Client not flexible",
                                "class": "col-4"
                            },
                            {
                                "key": "paper_brand_brand_specified",
                                "type": "text",
                                "label": "Brand Specified",
                                "class": "col-4",
                                "break": true,
                            },
                        ]
                    },

                    // Prepress
                    {
                        "key": "prepress",
                        "title": "Prepress",
                        "subtitle": "(may include required color separation)",
                        "checked": true,
                        "fields": [
                            {
                                "key": "prepress_ctp",
                                "type": "checkbox",
                                "label": "CTP - direct computer-to-plate output",
                                "class": "col-4"
                            },
                            {
                                "key": "prepress_printed_digital_proofs",
                                "type": "checkbox",
                                "label": "With printed digital proofs",
                                "class": "col-4"
                            },
                            {
                                "key": "prepress_wet_proofs",
                                "type": "checkbox",
                                "label": "With wet proofs",
                                "class": "col-4",
                                "break": true,
                            },
                            {
                                "key": "prepress_file_uploads",
                                "type": "checkbox",
                                "label": "Client to upload PDFs/native files (high-res images; links; zipped font files) via FTP or link",
                                "class": "col-7",
                            },
                            {
                                "key": "prepress_file_uploads_textarea",
                                "type": "text",
                                "label": "",
                                "class": "col-5",
                            },
                            {
                                "key": "prepress_client_templates",
                                "type": "checkbox",
                                "label": "Client already has templates (or US office has them from HK and will forward them to client)",
                                "class": "col-12",
                            },
                            {
                                "key": "prepress_client_requires_templates",
                                "type": "checkbox",
                                "label": "Client needs templates:",
                                "class": "col-12",
                                "children": [
                                    {
                                        "key": "prepress_client_requires_templates_pdfs",
                                        "type": "checkbox",
                                        "label": "PDFs",
                                        "class": "col-4",
                                    },
                                    {
                                        "key": "prepress_client_requires_templates_native_files",
                                        "type": "checkbox",
                                        "label": "Native files (software/version)",
                                        "class": "col-auto",
                                    },
                                    {
                                        "key": "prepress_client_requires_templates_native_files_text",
                                        "type": "text",
                                        "label": "",
                                        "class": "col",
                                        "auto_expand": true,
                                    },
                                ],
                            },
                        ]
                    },

                    // Dummies
                    {
                        "key": "dummies",
                        "title": "Dummies",
                        "subtitle": "(if one or more were made prior to job confirmation)",
                        "checked": true,
                        "fields": [
                            {
                                "key": "vendor_that_made_dummies",
                                "type": "checkbox",
                                "label": "Vendor that made the dummy(ies)",
                                "class": "col-4"
                            },
                            {
                                "key": "vendor_that_made_dummies_textarea",
                                "type": "text",
                                "label": "",
                                "class": "col-8"
                            },
                            {
                                "key": "prepress_wet_proofs",
                                "type": "checkbox",
                                "label": "With wet proofs",
                                "class": "col-4",
                                "break": true,
                            },
                            {
                                "key": "prepress_file_uploads",
                                "type": "checkbox",
                                "label": "Client to upload PDFs/native files (high-res images; links; zipped font files) via FTP or link",
                                "class": "col-7",
                            },
                            {
                                "key": "prepress_file_uploads_textarea",
                                "type": "text",
                                "label": "",
                                "class": "col-5",
                            },
                            {
                                "key": "prepress_client_templates",
                                "type": "checkbox",
                                "label": "Client already has templates (or US office has them from HK and will forward them to client)",
                                "class": "col-12",
                            },
                            {
                                "key": "prepress_client_requires_templates",
                                "type": "checkbox",
                                "label": "Client needs templates:",
                                "class": "col-12",
                                "children": [
                                    {
                                        "key": "prepress_client_requires_templates_pdfs",
                                        "type": "checkbox",
                                        "label": "PDFs",
                                        "class": "col-4",
                                    },
                                    {
                                        "key": "prepress_client_requires_templates_native_files",
                                        "type": "checkbox",
                                        "label": "Native files (software/version)",
                                        "class": "col-auto",
                                    },
                                    {
                                        "key": "prepress_client_requires_templates_native_files_text",
                                        "type": "text",
                                        "label": "",
                                        "class": "col",
                                        "auto_expand": true,
                                    },
                                ],
                            },
                        ]
                    },

                ]
            }
        },

        props: ['savedData', 'projectId'],

        computed: {
            'csrf_token': function () {
                return window.axios.defaults.headers.common[ 'X-CSRF-TOKEN' ];
            }
        },

        methods: {
            triggerChange( item ) {
                let _checked = item.target.checked;
                let _id = item.target.getAttribute( 'id' );

                if ( _checked ) {
                    Vue.set( this.form, _id, {} );
                }
                else {
                    Vue.set( this.form, _id, null );
                    //                    this.form[_id] = null;
                }
            },

            emitUploadNotification( file, response ) {
                //                console.log(response);
                if ( response.success ) {
                    this.$root.$emit( 'gpsd:added-file', response.data );
                }
            },

            openFieldModal( id, field ) {
                this.active_field = field;
                this.$modal.show( id );
            },

            closeFieldModal( id ) {
                this.active_field = null;
                this.$modal.hide( id );
            },

            dateFormatter( date ) {
                return moment( date ).format( 'MMMM Do YYYY' );
            },
        },

        mounted() {
            let _this3 = this;

            if ( Object.keys( this.form.sections ).length === 0 ) {
                for ( let section of this.jcc_fields ) {
                    if ( section.hasOwnProperty( 'checked' ) ) {
                        let _local = {};

                        _local[ section.key ] = section.checked;

                        this.form.sections = Object.assign( {}, this.form.sections, _local );
                    }
                }
            }

            console.log( JSON.stringify( this.jcc_fields ) );

            if ( this.savedData ) {
                this.form = Object.assign( {}, this.form, this.savedData );
            }

            window.refresh = () => {
                _this3.$forceUpdate();
            };
        }
    }
</script>
