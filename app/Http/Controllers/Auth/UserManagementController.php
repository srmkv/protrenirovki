<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Approach;
use App\Models\DayForFood;
use App\Models\Dish;
use App\Models\PeriodDay;
use App\Models\PeriodTraining;
use App\Models\Statistics;
use App\Models\StatisticValues;
use App\Models\Tarif;
use App\Models\TrainingDay;
use App\Models\UserDish;
use App\Models\UserImage;
use App\Models\Waist;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{

    public function progress()
    {
        $afterPhoto = UserImage::where([
            ['user_id', Auth::user()->id],
            ['type', 'after']
            ])
            ->latest()
            ->first();

        $beforePhoto = UserImage::where([
            ['user_id', Auth::user()->id],
            ['type', 'before']
            ])
            ->latest()
            ->first();

        $singlePhoto = UserImage::where([
            ['user_id', Auth::user()->id],
            ['type', 'single']
            ])
            ->latest()
            ->first();



        $weight = Weight::where('user_id', Auth::user()->id)->get();
        $waist = Waist::where('user_id', Auth::user()->id)->get();
        $statisticValue = StatisticValues::where('user_id', Auth::user()->id)->get();

        $weights = '';
        foreach ($weight as $w)
        {
            $weights .= $w->weight .', ';
        }
        $waists = '';
        foreach ($waist as $w)
        {
            $waists .= $w->waist .', ';
        }
        $statisticValues = '';
        foreach ($statisticValue as $s)
        {
            $statisticValues .= $s->value .', ';
        }

        $statistic = Statistics::where('user_id', Auth::user()->id)->first();


        return view('auth.dashboard', compact('beforePhoto', 'afterPhoto', 'singlePhoto', 'weights', 'waists', 'statistic', 'statisticValues'));
    }

    public function photoStore(Request $request)
    {
        request()->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
        }

        $image = UserImage::create([
            'user_id' => Auth::user()->id,
            'photo' => $postImage,
            'type' => $request->type
            ]);


        return redirect()->route('progress');
    }

     public function weightStore(Request $request)
    {
        request()->validate([
            'weight' => 'required|integer|between:1,200',
            'date' => 'required',
        ]);

        Weight::create([
            'user_id' => Auth::user()->id,
            'weight' => $request->weight,
            'date' => $request->date,
            ]);


        return redirect()->route('progress');
    }

    public function waistStore(Request $request)
    {
        request()->validate([
            'waist' => 'required|between:1,500',
            'date' => 'required',
        ]);

        Waist::create([
            'user_id' => Auth::user()->id,
            'waist' => $request->waist,
            'date' => $request->date,
            ]);


        return redirect()->route('progress');
    }

    public function profile()
    {
        return view('auth.laravel-examples.user-profile');
    }

    public function profileStore(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $user = Auth::user();

        $user->update($request->all());


        return redirect()->route('profile');
    }

    public function passwordChange(Request $request)
    {
        request()->validate([
            'oldpassword' => 'required',
            'password' => 'required',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->update();


        return redirect()->route('profile');
    }

    public function profilePhotoStore(Request $request)
    {
        request()->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
        }

        $user = Auth::user();
        $user->photo = $postImage;
        $user->save();

        return redirect()->route('profile');
    }

    public function statisticStore(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'variable' => 'required',
        ]);

        Statistics::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'variable' => $request->variable,
            ]);


        return redirect()->route('progress');
    }

     public function valueStore(Request $request)
    {
        request()->validate([
            'value' => 'required|between:1,500',
            'date' => 'required',
        ]);

        StatisticValues::create([
            'user_id' => Auth::user()->id,
            'value' => $request->value,
            'date' => $request->date,
            ]);


        return redirect()->route('progress');
    }

    public function tools()
    {
        return view('auth.tools.index');
    }

    public function consultations()
    {
        return view('auth.consultations.index');
    }

    public function rates()
    {
        $rates = Tarif::OrderBy('sort', 'asc')->get();
        return view('auth.rates.index', compact('rates'));
    }

    public function workouts()
    {
        return view('auth.workouts.index');
    }

    public function nutrition()
    {
        $dishes = Dish::paginate(30);
        return view('auth.nutrition.index', compact('dishes'));
    }


    public function food()
    {
        $days = DayForFood::where('user_id', Auth::user()->id)->OrderBy('date', 'desc')->get();
        return view('auth.food.index', compact('days'));
    }

    public function ratesChange($id)
    {
        $rate = Tarif::findOrFail($id);
        $user = Auth::user();
        $user->traffic = $rate->name;
        $user->save();
        return back();
    }


    public function DayForFoodStore(Request $request)
    {
        request()->validate([
            'kkal' => 'required|between:1,10000',
            'date' => 'required',
        ]);

        DayForFood::create([
            'user_id' => Auth::user()->id,
            'kkal' => $request->kkal,
            'date' => $request->date,
            ]);


        return redirect()->route('food');
    }

    public function foodDay($id)
    {
        $day = DayForFood::findOrFail($id);
        $periods = PeriodDay::where('day_id', $id)->get();

        return view('auth.food.day', compact('day', 'periods'));
    }

    public function periodDay($id, Request $request){
        request()->validate([
            'name' => 'required',
        ]);

        PeriodDay::create([
            'day_id' => $id,
            'name' => $request->name
        ]);

        return redirect()->route('food.day',$id);
    }

    public function dishStore($id, Request $request){
        request()->validate([
            'period_day_id' => 'required',
            'name' => 'required',
            'gram'=> 'required|between:1,10000',
            'protein'=> 'required|between:1,10000',
            'fat'=> 'required|between:1,10000',
            'energy'=> 'required|between:1,10000',
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
        }

        UserDish::create([
            'period_day_id' => $request->period_day_id,
            'name' => $request->name,
            'gram'=> $request->gram,
            'protein'=> $request->protein,
            'fat'=> $request->fat,
            'energy'=> $request->energy,
            'photo' => $postImage,
        ]);

        return redirect()->route('food.day',$id);
    }

    public function training()
    {
        $days = TrainingDay::where('user_id', Auth::user()->id)->OrderBy('date', 'desc')->get();
        return view('auth.training.index', compact('days'));
    }

    public function DayTrainingStore(Request $request)
    {
        request()->validate([
            'description' => 'required',
            'date' => 'required',
        ]);

        TrainingDay::create([
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'date' => $request->date,
            ]);

        return redirect()->route('training');
    }

    public function trainingDay($id){
        $day = TrainingDay::findOrFail($id);
        $periods = PeriodTraining::where('training_day_id', $id)->get();

        return view('auth.training.day', compact('day', 'periods'));
    }

     public function periodTrainingStore($id, Request $request){
        request()->validate([
            'name' => 'required',
        ]);

        PeriodTraining::create([
            'training_day_id' => $id,
            'name' => $request->name
        ]);

        return redirect()->route('training.day',$id);
    }

    public function approachStore($id, Request $request){
        request()->validate([
            'period_training_id' => 'required',
            'kg'=> 'required|between:1,10000',
            'repeat'=> 'required|between:1,10000',
        ]);

        Approach::create([
            'period_training_id' => $request->period_training_id,
            'kg' => $request->kg,
            'repeat'=> $request->repeat,
        ]);

        return redirect()->route('training.day',$id);
    }
}
