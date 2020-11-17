<?php

namespace App\Http\Controllers;

use App\Models\Apple;
use Illuminate\Http\Request;

date_default_timezone_set('Asia/Tashkent');

class AppleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store()
    {
        request()->validate([
            'color' => 'required|max:10',
        ]);
        $number = rand(1, 10);
        for($i=1; $i<=$number; $i++) {
            $color = request()->input('color');
            $apple = new Apple();
            $apple->color = $color;
            $apple->save();
        };
        return redirect('/dashboard');
    }

    public function fall(Request $request)
    {
        $apple= Apple::firstWhere('id', request()->id);
        if($apple->date_of_falling == null) {
            $apple->date_of_falling = date("Y-m-d H:i:s");
            $apple->status = 1;
            $apple->save();
        }
        else
            return view('error', ['error' => 'This apple is already on the ground. ']);
        //dd($request);
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apple  $apple
     * @return \Illuminate\Http\Response
     */
    public function show(Apple $apple)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apple  $apple
     * @return \Illuminate\Http\Response
     */
    public function edit(Apple $apple)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apple  $apple
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $eaten = request()->percent;
        $apple= Apple::firstWhere('id', request()->id);
            if ($apple->status != 0 && $apple->status != 2) {
                $current_time = strtotime("now");
                $time_of_falling = strtotime($apple->date_of_falling);
                if($time_of_falling+18000 <= $current_time){
                    $apple->status=2;
                    $apple->save();
                    return view('error', ['error' => 'Apple is already rotten. ']);
                }
                $total = $apple->percentage + $eaten;
                if ($total <= 100) {
                    $apple->percentage = $total;
                    $apple->save();
                } else
                    return view('error', ['error' => 'Don\'t you know that maximum percentage is 100!? Enter less percent. ']);
            } else
                return view('error', ['error' => 'Can\'t be eaten because it is not on the ground. ']);
            //dd($request);
            return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apple  $apple
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $apple= Apple::firstWhere('id', request()->id);
        if($apple->percentage == 100 || $apple->status == 2){
            Apple::destroy($apple->id);
            return redirect('/dashboard');
        }
        else
            return view('error', ['error' => 'Can\'t be deleted as it is not eaten or rotten. ']);
    }
}
