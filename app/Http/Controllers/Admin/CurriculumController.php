<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function index()
    {
        // リレーションをロードしてカリキュラムを取得
        $curriculums = Curriculum::with('deliveryTimes')->get();
        $grades = Grade::all();
        return view('admin.layouts.curriculum_list', compact('curriculums'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('admin.layouts.curriculum_create', compact('grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'grades_id' => 'required|integer',
            'video_url' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image',
            'always_delivery_flg' => 'boolean',
            'delivery_from' => 'required|array',
            'delivery_from.*' => 'required|date',
            'delivery_to' => 'required|array',
            'delivery_to.*' => 'required|date|after:delivery_from.*',
        ]);

        $curriculum = new Curriculum();
        $curriculum->title = $request->input('title');
        $curriculum->video_url = $request->input('video_url');
        $curriculum->description = $request->input('description');
        $curriculum->grade_id = $request->input('grades_id');
        $curriculum->alway_delivery_flg = $request->has('always_delivery_flg') ? 1 : 0;

        // サムネイル画像の処理
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('thumbnails'), $filename);
            $curriculum->image = $filename;
        }

        $curriculum->save();

        $delivery_froms = $request->input('delivery_from');
        $delivery_tos = $request->input('delivery_to');

        foreach ($delivery_froms as $index => $delivery_from) {
            DeliveryTime::create([
                'curriculums_id' => $curriculum->id,
                'delivery_from' => $delivery_from,
                'delivery_to' => $delivery_tos[$index],
            ]);
        }

        return redirect()->route('curriculum_list')->with('success', '授業が作成されました');
    }

    public function show($id)
    {
        // 
    }


    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $grades = Grade::all();
    
        return view('admin.layouts.curriculum_edit', compact('curriculum','grades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'grades_id' => 'required|integer',
            'alway_delivery_flg' => 'boolean',
            'video_url' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image'
        ]);

        $curriculum = Curriculum::findOrFail($id);

        $curriculum -> thumbnail = $request -> input("thumbnail");
        $curriculum -> grades_id = $request -> input("grades_id");
        $curriculum -> title = $request -> input("title");
        $curriculum -> video_url = $request -> input("video_url");
        $curriculum -> description = $request -> input("description");
        $curriculum -> alway_delivery_flg = $request -> boolean("alway_delivery_flg");
        
        if ($request->hasFile('thumbnail')) {
            $filename = $request->file('thumbnail')->store('thumbnails', 'public');
            $curriculum->thumbnail = $filename;
        } else {
            $curriculum->thumbnail = $curriculum->thumbnail ?? 'default-thumbnail.jpg';
        }

        $curriculum -> save();

        return redirect() -> route('curriculum_list')->with('success', '授業が更新されました');
    }

    public function destroy($id)
    {
        // 削除ロジックをここに記述
    }

    public function showByGrade($grade_id)
    {
        $grade = Grade::findOrFail($grade_id);
        $curriculums = Curriculum::where('grade_id', $grade_id)->with('deliveryTimes')->get();
        $grades = Grade::all();

        return view('admin.layouts.curriculum_list', compact('curriculums', 'grades', 'grade'));
    }
}
