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
        $anniversaries = Anniversary::select()
            ->where('user_id', auth()->id())
            ->orderBy('updated_at', "DESC")
            ->get();

        return view('anniversary.index')->with([
            'anniversaries' => $anniversaries,
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
        $remindTime = $request->getRemindTime($request->date, $request->reminder, $request->unit);

        $anniversary = new Anniversary([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'reminder' => $remindTime,
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
        $remindTime = $request->getRemindTime($request->date, $request->reminder, $request->unit);

        $anniversary->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'reminder' => $remindTime,
            'user_id' => auth()->id(),
        ]);

        return $this->index()->with([
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
        $oldName = $anniversary->title;
        $anniversary->delete();
        return $this->index()->with([
            'message_success' => "<b>" . $oldName . "</b> が削除されました。"
        ]);
    }
}
