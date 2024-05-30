<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeliveryTime;
use Carbon\Carbon;
use App\Models\Curriculum;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.delivery');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $derivery_time = Curriculum::findOrFail($curriculumId);
        return view('delivery.create', compact('derivery_time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'curriculum_id' => 'required|exists:curriculums,id',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date',
            'end_time' => 'required|date_format:H:i',
        ]);

        DeliveryTime::create($validatedData);

        return redirect()->route('derivery_time.index')->with('success', '配信日時が登録されました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $deliveryTimes = DeliveryTime::where('curriculums_id', $id)->get();

        return view('admin.layouts.delivery', compact('curriculum', 'deliveryTimes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'delivery_from' => 'required|array',
            'delivery_from.*' => 'required|date',
            'delivery_to' => 'required|array',
            'delivery_to.*' => 'required|date|after:delivery_from.*',
        ]);

        // 既存のレコードを削除
        DeliveryTime::where('curriculums_id', $id)->delete();

        // 新しいレコードを保存
        $delivery_froms = $request->input('delivery_from');
        $delivery_tos = $request->input('delivery_to');

        foreach ($delivery_froms as $index => $delivery_from) {
            DeliveryTime::create([
                'curriculums_id' => $id,
                'delivery_from' => $delivery_from,
                'delivery_to' => $delivery_tos[$index],
            ]);
        }

        // 授業一覧ページにリダイレクト
        return redirect()->route('curriculum_list')->with('success', '配信日時が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function save(Request $request)
    {
       //
    }
    
}