<?php

namespace App\Http\Controllers\Admin;

use App\Models\LetterHead;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function App\Helpers\create_pdf_from_project;
use function App\Helpers\get_view_from_project_type;

/**
 * Class PDFController
 *
 * @package App\Http\Controllers\Admin
 */
class PDFController extends Controller
{
    /**
     * @param $project_id
     * @param $type
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $project_id, $type ) {
        return create_pdf_from_project( $project_id, $type );
    }

    /**
     * @param $project_id
     * @param $type
     *
     * @return \Illuminate\Http\Response
     */
    public function print( $project_id, $type ) {
        return create_pdf_from_project( $project_id, $type, false );
    }
}
