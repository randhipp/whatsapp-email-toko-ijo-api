<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ReceiverExport;

use Excel;

class ReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = \App\Receiver::query();

        if(isset($request->sex)) {
           $user =  $user->where('sex', (int)$request->sex);
        }

        if(isset($request->year)) {
            $user =  $user->whereYear('birth_date', $request->year);
        }

        if(isset($request->prefix)) {
            $prefix = $request->prefix;

            if($request->prefix[0] == 0)
                $prefix = str_replace('/^0/','62',$request->prefix);

            $user =  $user->where('msisdn', 'like', $prefix.'%');
        }

        if(isset($request->middle)) {
            $user =  $user->where('msisdn', 'like', '%'.$request->middle.'%');
        }

        if(isset($request->name)) {
            $user =  $user->where('full_name', 'like', '%'.str_replace(' ','%',$request->name).'%')
                            ->orWhere('user_email', 'like', '%'.str_replace(' ','%',$request->name).'%');
        }

        if(isset($request->export)) {
            $user = $user->get();
            return $this->export($user);
        }

        $user = $user->simplePaginate(50);

        return response()->json($user->appends(request()->input()),200);
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
        //
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
        //
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

    public function export($receiver)
    {
        return Excel::download(new ReceiverExport($receiver), 'receivers.xlsx');
    }
}
