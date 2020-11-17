<style>
    /* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,7
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

    :root {
        --blue: #20a8d8;
        --indigo: #6610f2;
        --purple: #6f42c1;
        --pink: #e83e8c;
        --red: #f86c6b;
        --orange: #f8cb00;
        --yellow: #ffc107;
        --green: #4dbd74;
        --teal: #20c997;
        --cyan: #17a2b8;
        --white: #fff;
        --gray: #73818f;
        --gray-dark: #2f353a;
        --light-blue: #63c2de;
        --primary: #4273FA;
        --secondary: #c8ced3;
        --success: #60CF7D;
        --info: #63c2de;
        --warning: #F5BE30;
        --danger: #FE3F61;
        --light: #f0f3f5;
        --dark: #2f353a;
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace
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

    .table th,
    .table td {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #c8ced3
    }

    .table th {
        border-top: 0;
        padding-top: .375rem;
        padding-bottom: .375rem;
    }

    .table-bordered, .table-bordered th,
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
            overflow: hidden;
        }
    }


    @if( $project->status !== 'OFFICIAL_VERSION' )
    .page_break:before,
    .container:before {
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

        <h1 style="margin-bottom:20px;font-size:1.2em;">Job Cost Worksheet</h1>
        <table width="100%">
        <tr>
            <td style="width:25%" class="font-weight-bold">Project Title(s):</td>
            <td style="width:85%">{{ $project->title }}</td>
        </tr>
        <tr>
            <td style="width:25%" class="font-weight-bold">Job Reference Number:</td>
            <td style="width:85%">{{ $project->reference }}</td>
        </tr>
    </table>

    <hr>

    @foreach ( $project->linesGroupedByCategory() as $category => $lines )
    <h2 style="font-size:16px;">{{ \App\Helpers\transform_specification_name( $category ) }}</h2>
            <table style="margin-top:10px;" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Retail Price</th>
                        <th>Line Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_unit_cost = 0;
                        $total_unit_price = 0;
                        $total_quantity = 0;
                        $total_line_total = 0;
                    @endphp

                    @foreach ( $lines as $line )
                        <tr>
                            <td>
                                <strong>{{ $line->name }}</strong>
                            </td>

                            <td>{{ $line->description }}</td>
                            <td>{{ $line->quantity }}</td>
                            <td>{{ $line->unit_cost }}</td>
                            <td>{{ $line->unit_price }}</td>
                            <td class="text-right">${{ $line->total_cost }}</td>

                            @php
                                $total_unit_cost += $line->unit_cost;
                                $total_unit_price += $line->unit_price;
                                $total_quantity += $line->quantity;
                                $total_line_total += $line->total_cost;
                            @endphp
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>{{ $total_quantity }}</td>
                        <td>{{ $total_unit_cost }}</td>
                        <td>{{ $total_unit_price }}</td>
                        <td class="text-right">${{ $total_line_total }}</td>
                    </tr>
                </tfoot>
            </table>
    <hr>
    @endforeach

        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td style="width:25%" class="font-weight-bold">Job Cost:</td>
                        <td style="width:85%">${{ $project->total_cost }}</td>
                    </tr>
                    <tr>
                        <td style="width:25%" class="font-weight-bold">Job Value/Price (to client):</td>
                        <td style="width:85%">${{ $project->total_price_to_client }}</td>
                    </tr>
                    <tr>
                        <td style="width:25%" class="font-weight-bold">Total Profit:</td>
                        <td style="width:85%">${{ $project->total_profit }}</td>
                    </tr>
                    <tr>
                        <td style="width:25%" class="font-weight-bold">True % Profit:</td>
                        <td style="width:85%">{{ number_format( $project->true_percentage_profit, 2 ) }}%</td>
                    </tr>
                </table>

            </div>
        </div>


        <div class="row">
        <div class="col-12">
            <hr style="margin-top:20px;">
            <p style="margin-top:20px;">Generated on: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
            <p class="font-weight-bold">
                Regards,<br>
                John Doe
            </p>
        </div>
    </div>


</div>

@if( $print )
{{--    <script type="text/javascript"> try {--}}
{{--            this.print();--}}
{{--        } catch ( e ) {--}}
{{--            window.onload = window.print;--}}
{{--        } </script>--}}
@endif
