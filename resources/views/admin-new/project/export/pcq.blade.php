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
        border-top: 1px solid #c8ced3
    }

    .table-bordered, .table-bordered td {
        border: 1px solid #c8ced3
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
    @if ( $letterhead )
        <img src="{{ asset( $letterhead->getFirstMediaUrl( 'letterhead' ) ) }}" width="100%">
    @endif
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


        @php( $specCount = 0 )

        @foreach ( $project->fields as $mainKey => $spec )
            @if( $specCount === 0 )
                <hr>
            @endif

            <h2 style="font-size:16px;">{{ \App\Helpers\transform_specification_name( $mainKey ) }}</h2>
            <table class="mt-4 mb-4" width="100%">
                <tr>
                    <td width="50%">
                        <h5 class="font-weight-bolder underline">Project Materials</h5>
                        <table width="100%">
                            @foreach( $project->fields[$mainKey]['materials'] as $key => $materials )
                                <tr>
                                    <td class="font-weight-bold">{{ $key }}:</td>
                                    <td>{{ $materials ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>

                    <td width="50%">
                        <h5 class="font-weight-bolder underline">Project Specifications</h5>
                        <table width="100%">
                            @foreach( $project->fields[$mainKey]['specs'] as $key => $specification )
                                <tr>
                                    <td class="font-weight-bold">{{ $key }}:</td>
                                    <td>{{ $specification ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
            <hr>
            @php( $specCount++ )
        @endforeach


        <div class="row">
        <div class="col-12">
            <h5 class="font-weight-bolder underline">Finishing/Binding</h5>
            <p>{{ $project->finishing_information }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h5 class="font-weight-bolder underline">Packaging</h5>
            <p>{{ $project->packaging_information }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h5 class="font-weight-bolder underline">Origination</h5>
            <p>{{ $project->origination }}</p>
        </div>
    </div>


    <div class="page_break"></div>

    <div class="row page">
        <div class="col-12">
            <h5 style="font-size:16px;" class="font-weight-bolder">Prices:</h5>
            <table class="table table-bordered" width="100%">
                @foreach ( $project->lines as $line )
                    <tr>
                        <td>
                            <p class="m-0"><strong>{{ $line->name }}</strong> -
                                <strong>{{ $line->description }}</strong></p>
                            <p class="m-0">{{ $line->quantity }}@${{ $line->unit_price }}</p>
                        </td>

                        <td class="text-right">${{ $line->total_cost }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

    <hr class="mb-4">

    <table width="100%">
        <tr>
            <td width="33.333%">
                <h5 class="font-weight-bolder">Materials In Date</h5>
                <p>{{ $project->materials_in_at ? $project->materials_in_at->format( 'Y/m/d') : '-' }}</p>
            </td>
            <td width="33.333%">
                <h5 class="font-weight-bolder">FOB Date</h5>
                <p>{{ $project->fob_at ? $project->fob_at->format( 'Y/m/d') : '-' }}</p>
            </td>
            <td width="33.333%">
                <h5 class="font-weight-bolder">Delivery Date</h5>
                <p>{{ $project->delivery_at ? $project->delivery_at->format( 'Y/m/d') : '-' }}</p>
            </td>
        </tr>
    </table>

    <div class="row">
        <div class="col-12">
            <h5 class="font-weight-bolder underline">Terms</h5>
            <p>{{ $project->payment_term ? $project->payment_term->name : 'Not Yet Set' }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="font-weight-bolder underline">Notes to Vendor</h5>
            <p>{{ $project->vendor_notes }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p class="font-weight-bold">
                Regards,<br>
                John Doe
            </p>
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