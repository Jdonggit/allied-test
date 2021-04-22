<?php

namespace App\Http\Controllers;

use App\Models\Constellation;
use App\Services\ConstellationService;
use Illuminate\Http\Request;

class ConstellationController extends Controller
{

    public function __construct(ConstellationService $constellationService)
    {
        $this->constellationService = $constellationService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->constellationService->getBy('date', date('Y-m-d'));
        $res['date'] = date('Y-m-d');
        $res['result'] = $data;
        return response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $res = $this->constellationService->get_constellation();
        return response()->json($res);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constellation  $constellation
     * @return \Illuminate\Http\Response
     */
    public function show(Constellation $constellation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Constellation  $constellation
     * @return \Illuminate\Http\Response
     */
    public function edit(Constellation $constellation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constellation  $constellation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Constellation $constellation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Constellation  $constellation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Constellation $constellation)
    {
        //
    }
}
