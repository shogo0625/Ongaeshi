<?php

namespace App\Http\Controllers;

use App\Anniversary;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAnniversary;
use App\Http\Requests\EditAnniversary;

class AnniversaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $future_anniversaries = \App\Anniversary::getAnniversariesDependingOnTime('future');
        $past_anniversaries = \App\Anniversary::getAnniversariesDependingOnTime('past');

        return view('anniversary.index')->with([
            'future_anniversaries' => $future_anniversaries,
            'past_anniversaries' => $past_anniversaries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anniversary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnniversary $request)
    {
        $remind_time = $request->getRemindTime($request->date, $request->reminder, $request->unit);

        $anniversary = new Anniversary([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'reminder' => $remind_time,
            'user_id' => auth()->id(),
        ]);
        $anniversary->save();
        return $this->index()->with([
            'message_success' => "<b>" . $anniversary->title . "</b> が恩返しリストへ追加されました。"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function show(Anniversary $anniversary)
    {
        return view('anniversary.show')->with([
            'anniversary' => $anniversary,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function edit(Anniversary $anniversary)
    {
        return view('anniversary.edit')->with([
            'anniversary' => $anniversary,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function update(EditAnniversary $request, Anniversary $anniversary)
    {
        $remind_time = $request->getRemindTime($request->date, $request->reminder, $request->unit);

        $anniversary->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'reminder' => $remind_time,
            'user_id' => auth()->id(),
        ]);

        return redirect('/anniversary')->with([
            'message_success' => "<b>" . $anniversary->title . "</b> が更新されました。"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anniversary $anniversary)
    {
        $old_name = $anniversary->title;
        $anniversary->delete();
        return redirect('/anniversary')->with([
            'message_success' => "<b>" . $old_name . "</b> が削除されました。"
        ]);
    }
}
