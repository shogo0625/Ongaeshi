<?php

namespace App\Http\Controllers;

use App\Anniversary;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAnniversary;

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anniversary $anniversary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anniversary $anniversary)
    {
        //
    }
}
