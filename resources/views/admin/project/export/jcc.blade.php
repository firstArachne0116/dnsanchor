@php
    $fields_JSON = <<<TEXT
[{"key":"jcp","title":"Job-confirmation paperwork","subtitle":"(complete set)","checked":true,"fields":[{"key":"jcc_cover_sheet","type":"checkbox","label":"JCC cover sheet - this page"},{"key":"vendor_confirmation","type":"checkbox","label":"VC (Vendor Confirmation)"},{"key":"request_for_quotation","type":"checkbox","label":"RFQ (Request for Quotation)","has_uploads":true},{"key":"final_customer_quote","type":"checkbox","label":"FCQ (Final Customer Quote)","has_uploads":true,"class":"col-6"},{"key":"date_fcq_signed","type":"datepicker","label":"Date FCQ Signed","class":"col-6"},{"key":"client_card","type":"checkbox","label":"CC (client card)","has_uploads":true},{"key":"jcw_at_fcq","type":"checkbox","label":"JCW (Job Cost Worksheet) - 'JCW at FCQ'","has_uploads":true},{"key":"vq_vendor_quotation","type":"checkbox","label":"VQ (vendor quotation)","has_uploads":true,"children":[{"key":"vq_actual_quote","type":"checkbox","label":"Actual quote from vendor"},{"key":"vq_alits_email","type":"checkbox","label":"Alit's email(s)"},{"key":"vq_markup_spreadsheet","type":"checkbox","label":"Markup spreadsheet"},{"key":"vq_vendor","type":"text","label":"Vendor"}]},{"key":"vq_shipper_quotation","type":"checkbox","label":"SQ (shipper quotation)","has_uploads":true,"children":[{"key":"sq_actual_quote","type":"checkbox","label":"Actual quote from shipper"},{"key":"sq_alices_rate_chart","type":"checkbox","label":"Alice's rate email(s)"},{"key":"sq_markup_spreadsheet","type":"checkbox","label":"Freight Calculator"},{"key":"sq_shipper","type":"text","label":"Shipper"}]},{"key":"quotation_from_additional_vendor","type":"checkbox","label":"Quotation from additional vendor- prepress, sourced items, etc.","class":"col-6"},{"key":"additional_vendor","type":"text","label":"Additional Vendor","class":"col-6"}]},{"key":"reprint","title":"Reprint","subtitle":"(of a job we previously printed)","checked":null,"fields":[{"key":"history_client_card","type":"checkbox","label":"History from client card ( app > client card > scroll to bottom to see list of reference numbers associated with that client )","children":[{"key":"prior_job_ref","type":"text","label":"Prior job's ref","class":"col-3"},{"key":"prior_job_title","type":"text","label":"Prior job's title","class":"col-9"}]},{"key":"history_from_jcw_app","type":"checkbox","label":"History from JCW ( app > invoice > final invoice > JCW )","children":[{"key":"client_unit_price","type":"checkbox","label":"Client unit price","class":"col-2"},{"key":"client_base_unit_price","type":"text","label":"Client's base unit price, plus relevant AA amounts","class":"col-10"},{"key":"our_unit_cost","type":"checkbox","label":"Our unit cost","class":"col-2"},{"key":"our_base_unit_cost","type":"text","label":"Our base unit cost plus relevant AA amounts","class":"col-10"},{"key":"our_shipping_unit_cost","type":"checkbox","label":"Our shipping unit cost","class":"col-2"},{"key":"our_shipping_unit_cost_text","type":"text","label":"","class":"col-4"},{"key":"client_price_incl","type":"checkbox","label":"Client price included shipping","class":"col-3"},{"key":"client_price_fob","type":"checkbox","label":"Client price was FOB","class":"col-3"},{"key":"quantity_ordered","type":"checkbox","label":"Quantity Ordered","class":"col-2"},{"key":"quantity_ordered_text","type":"text","label":"estimate the rounded base quantity without runons","class":"col-10"},{"key":"runons_quantity","type":"checkbox","label":"Runons Quantity","class":"col-2"},{"key":"runons_quantity_text","type":"text","label":"guesstimate a rounded number for the runons quantity ordered","class":"col-10"},{"key":"runons_percent","type":"checkbox","label":"Runons Percent","class":"col-2"},{"key":"runons_percent_text","type":"text","label":"% (divide quantity ordered by guesstimated runons; round to integer)","class":"col-10"},{"key":"date_of_final_invoice","type":"checkbox","label":"Date of final invoice","class":"col-2"},{"key":"date_of_final_invoice_text","type":"text","label":"","class":"col-4"},{"key":"prior_jobs_print_vendor","type":"checkbox","label":"Prior job's vendor print","class":"col-2"},{"key":"prior_jobs_print_vendor_text","type":"text","label":"","class":"col-4"},{"key":"notes_re_other_vendors","type":"checkbox","label":"Notes re other vendors, etc.:","class":"col-3"},{"key":"notes_re_other_vendors_text","type":"text","label":"","class":"col-9"}]}]},{"key":"paper_brand","title":"Paper Brand","subtitle":"<span></span>","checked":true,"fields":[{"key":"paper_brand_client_flexible","type":"checkbox","label":"Client flexible","class":"col-4"},{"key":"paper_brand_client_not_flexible","type":"checkbox","label":"Client not flexible","class":"col-4"},{"key":"paper_brand_brand_specified","type":"text","label":"Brand Specified","class":"col-4","break":true}]},{"key":"prepress","title":"Prepress","subtitle":"(may include required color separation)","checked":true,"fields":[{"key":"prepress_ctp","type":"checkbox","label":"CTP - direct computer-to-plate output","class":"col-4"},{"key":"prepress_printed_digital_proofs","type":"checkbox","label":"With printed digital proofs","class":"col-4"},{"key":"prepress_wet_proofs","type":"checkbox","label":"With wet proofs","class":"col-4","break":true},{"key":"prepress_file_uploads","type":"checkbox","label":"Client to upload PDFs/native files (high-res images; links; zipped font files) via FTP or link","class":"col-7"},{"key":"prepress_file_uploads_textarea","type":"text","label":"","class":"col-5"},{"key":"prepress_client_templates","type":"checkbox","label":"Client already has templates (or US office has them from HK and will forward them to client)","class":"col-12"},{"key":"prepress_client_requires_templates","type":"checkbox","label":"Client needs templates:","class":"col-12","children":[{"key":"prepress_client_requires_templates_pdfs","type":"checkbox","label":"PDFs","class":"col-4"},{"key":"prepress_client_requires_templates_native_files","type":"checkbox","label":"Native files (software/version)","class":"col-auto"},{"key":"prepress_client_requires_templates_native_files_text","type":"text","label":"","class":"col","auto_expand":true}]}]}]
TEXT;

    $fields = json_decode( $fields_JSON, true );

    $map = [];

    foreach ( $fields as $section ) {
        $_section = [];

        $_section[ 'title' ] = $section[ 'title' ];
        $_section[ 'subtitle' ] = $section[ 'subtitle' ];
        $_section[ 'checked' ] = $section[ 'checked' ];

        $rows = [];
        $lastRowIndex = null;

        foreach( $section[ 'fields' ] as $key => $field ) {
            $prev = isset( $section[ 'fields' ][ $key - 1 ] ) ? $section[ 'fields' ][ $key - 1 ] : null;
            $next = isset( $section[ 'fields' ][ $key + 1 ] ) ? $section[ 'fields' ][ $key + 1 ] : null;

            if ( ! isset( $field[ 'class' ] ) ) {
                $rows[] = [$field];
                $lastRowIndex = null;
            } else {
                if ( $lastRowIndex === null ) {
                    $lastRowIndex = count( $rows );
                }

                $rows[ $lastRowIndex ] = [ $field ];

                if ( $next && ! isset( $next[ 'class' ] ) ) {
                    $lastRowIndex = null;
                }
            }
        }

        $_section[ 'rows' ] = $rows;

        $map[] = $_section;
    }

    dd( $map );
@endphp
<style>
    /* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 11px;
        font-family: sans-serif;
        vertical-align: baseline;
    }

    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
        display: block;
    }

    body {
        line-height: 1;
    }

    ol, ul {
        list-style: none;
    }

    blockquote, q {
        quotes: none;
    }

    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    *, ::after, ::before {
        box-sizing: border-box
    }

    html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        margin: 1em 0;
        font-size: 11px;
    }

    body {
        margin: 1em 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 11px;
        font-weight: 400;
        line-height: 1.5;
        color: #23282c;
        text-align: left;
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
    }

    hr {
        box-sizing: content-box;
        height: 0;
        overflow: visible;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1)
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    strong {
        font-weight: bolder
    }

    a {
        color: #4273fa;
        text-decoration: none;
        background-color: transparent
    }

    table {
        border-collapse: collapse
    }

    ::-webkit-file-upload-button {
        font: inherit;
        -webkit-appearance: button
    }

    h5 {
        margin-top: 0;
        margin-bottom: .5rem;
        font-weight: 500;
        line-height: 1.2;
        font-size: 1.09375rem
    }

    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto
    }

    @media (min-width: 576px) {
        .container {
            max-width: 540px
        }
    }

    @media (min-width: 768px) {
        .container {
            max-width: 720px
        }
    }

    @media (min-width: 992px) {
        .container {
            max-width: 960px
        }
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 1140px
        }
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px
    }

    .col-12, .col-4, .col-6 {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px
    }

    .col-4 {
        flex: 0 0 33.3333333333%;
        max-width: 33.3333333333%
    }

    .col-6 {
        flex: 0 0 50%;
        max-width: 50%
    }

    .col-12 {
        flex: 0 0 100%;
        max-width: 100%
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #23282c
    }

    .table td {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #000
    }

    .table th {
        padding: 0.375rem .75rem;
        vertical-align: top;
        border-top: 1px solid #000;
        font-weight: bold;
    }

    .table tfoot td {
        font-weight: bold;
    }

    .table-bordered, .table-bordered th,
    .table-bordered, .table-bordered td {
        border: 1px solid #000
    }

    .m-0 {
        margin: 0 !important
    }

    .mt-4 {
        margin-top: 1.5rem !important
    }

    .mb-4 {
        margin-bottom: 1.5rem !important
    }

    .text-right {
        text-align: right !important
    }

    .font-weight-bold {
        font-weight: 700 !important
    }

    .font-weight-bolder {
        font-weight: bolder !important
    }

    @media all and (-ms-high-contrast: none) {
        html {
            display: flex;
            flex-direction: column
        }
    }

    @media (max-width: 991px) {
        td:nth-of-type(2) {
            overflow: hidden
        }
    }

    .page_break {
        page-break-before: always;
    }

    .checkbox {
        display: inline-block;
        border: 1px solid #000;
        width: 15px;
        height: 15px;
        float: left;
        margin-right: 10px;
        margin-top: 4px;

    }

    td > * {
        /*margin-right: 10px;*/
    }

    @if( $project->status === 'DRAFT_VERSION' )
    .page_break:before,
    .container:before{
        position: absolute;
        top: 400px;
        left: 50px;
        content: 'DRAFT VERSION';
        font-size: 80px;
        z-index: -1000;
        display: block;
        transform: rotate(-45deg);
        font-weight: bold;
        color: red;
        opacity: .1;
    }
    @endif
</style>

<div class="container">

    <h1 style="margin-bottom:20px;font-size:1.2em;">JCC</h1>

    <table width="100%">
        <tr>
            <td style="width:15%" class="font-weight-bold">Project Title(s):</td>
            <td style="width:85%">{{ $project->title }}</td>
        </tr>
        <tr>
            <td style="width:15%" class="font-weight-bold">Extent:</td>
            <td style="width:85%">{{ $project->extent }}</td>
        </tr>
        <tr>
            <td style="width:15%" class="font-weight-bold">Trim Size:</td>
            <td style="width:85%">{{ $project->trim_size }}</td>
        </tr>
        <tr>
            <td style="width:15%" class="font-weight-bold">Orientation:</td>
            <td style="width:85%">{{ $project->orientation }}</td>
        </tr>
    </table>


        <div class="row page">
            <div class="col-12">
                <table style="margin-top:30px;" class="table table-bordered" width="100%">
                    <tbody>
                        @php
                            $total_unit_cost = 0;
                            $total_unit_price = 0;
                            $total_quantity = 0;
                            $total_line_total = 0;
                        @endphp

                        @foreach ( $fields as $line )
                            <tr>
                                <td>
                                    <div class="checkbox"></div>
                                    <h2 style="font-size:13px;">{{ $line['title'] }}</h2>
                                    <span>{{ $line['subtitle'] }}</span>
                                </td>
                            </tr>

                            <tr>
                                @foreach ( $line[ 'fields' ] as $field )
                                    <td style="padding-left:20px;">
                                        <div class="checkbox"></div>
                                        <h2 style="font-size:13px;">{{ $field['label'] }}</h2>
                                    </td>
                                @endforeach
                            </tr>

                            @break
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


</div>

@if( $print )
{{--<script type="text/javascript"> try {--}}
{{--        this.print();--}}
{{--    } catch ( e ) {--}}
{{--        window.onload = window.print;--}}
{{--    } </script>--}}
@endif
