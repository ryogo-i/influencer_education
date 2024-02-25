<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;

class CurriculumController extends Controller
{
    public function showCurriculum($id) {
        $curriculum = Curriculum::find($id);


        return view('user.delivery', compact('curriculum'));
    }

}
