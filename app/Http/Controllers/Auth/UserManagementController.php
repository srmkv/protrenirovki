<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\BzuCalcRequest;
use App\Http\Requests\NutritionRequest;
use App\Models\Approach;
use App\Models\BjuParametres;
use App\Models\DayFood;
use App\Models\DayForFood;
use App\Models\Dish;
use App\Models\Energy;
use App\Models\FoodDish;
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
use Hamcrest\DiagnosingMatcher;
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
        $bjuParametres = BjuParametres::where('user_id', Auth::user()->id)
            ->latest()
            ->first();
        return view('auth.tools.index', compact('bjuParametres'));
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

    public function nutrition(Request $request)
    {
        if($request->has('dish_id')){
            $dish = Dish::all()->random();
            $foodDish = FoodDish::where('dish_id', $request->dish_id)->first();
            $foodDish->update(['dish_id' => $dish->id]);
        }

        if($request->has('add_dish')){
            $dish = Dish::all()->random();
            FoodDish::create([
                'day_food_id' => $request->add_dish,
                'dish_id' => $dish->id
                             ]);
        }



        if($request->has('del_dish_id')){
            $foodDish = FoodDish::where('dish_id', $request->del_dish_id)->first();
            $foodDish->delete();
        }

        if($request->has('dishCount') and $request->has('date')){
            $dishCount = $request->dishCount;
            $date = $request->date;
            $dayFood = DayFood::create([
                'user_id' => Auth::user()->id,
                'date' => $date
                ]);
            $dishes = Dish::all()->random($dishCount);

            foreach ($dishes as $dish){
                FoodDish::create([
                    'day_food_id' => $dayFood->id,
                    'dish_id' => $dish->id
                    ]);
            }

        }

        if(!$request->has('dishCount') and !$request->has('date')
            and !$request->has('dish_id') and !$request->has('del_dish_id')
            and !$request->has('add_dish')
        ){
            $energy = Energy::where('user_id', Auth::user()->id)->latest()->first();
            return view('auth.nutrition.index', compact('energy'));
        }


        $energy = Energy::where('user_id', Auth::user()->id)->latest()->first();
        $date = DayFood::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
        $dishes = Dish::join('food_dishes', 'food_dishes.dish_id', '=', 'dishes.id')
            ->where('day_food_id', $date->id)
            ->get();

        $sumEnergy = 0;
        foreach ($dishes as $dish){
            $sumEnergy += $dish->energy;
        }

        $differenceEnergy = $energy->energy - $sumEnergy;

        return view('auth.nutrition.index', compact('dishes', 'date', 'energy', 'differenceEnergy'));

    }


    public function food()
    {
        $days = DayFood::where('user_id', Auth::user()->id)->OrderBy('date', 'desc')->get();
        $energy = Energy::where('user_id', Auth::user()->id)->first();
        return view('auth.food.index', compact('days', 'energy'));
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
        $energy = Energy::where('user_id', Auth::user()->id)->first();
        $day = DayFood::findOrFail($id);
        $dishes = Dish::join('food_dishes', 'food_dishes.dish_id', '=', 'dishes.id')
            ->where('day_food_id', $id)
            ->get();

        $sumEnergy = 0;
        foreach ($dishes as $dish){
            $sumEnergy += $dish->energy;
        }

        $differenceEnergy = $energy->energy - $sumEnergy;

        return view('auth.food.day', compact('day', 'dishes', 'energy', 'differenceEnergy'));
    }

    public function addRandomFood($date_id){
        $dish = Dish::all()->random();

        FoodDish::create([
            'day_food_id' => $date_id,
            'dish_id' => $dish->id
            ]);;

        return back();
    }

    public function changeRandomFood($date_id, $dish_id){
        $userDish = FoodDish::where('dish_id', $dish_id)->where('day_food_id', $date_id )->first();
        $dish = Dish::all()->random(1);
        $userDish->dish_id = $dish[0]->id;
        $userDish->save();
        return back();
    }

    public function deleteFood($date_id, $dish_id){
        $userDish = FoodDish::where('dish_id', $dish_id)->where('day_food_id', $date_id )->first();
        $userDish->delete();
        return back();
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

    public function bzu_calc(BzuCalcRequest $request){
        $data = $request->validated();

        $kkal = 10 * $data['weight_now'] + 6.25 * $data['height'] - 5 * $data['age'];

        if($data['gender'] == 'men'){
            $kkal += 5;
        }
        elseif($data['gender'] == 'women'){
            $kkal -= 161;
        }

        $kkal = round($kkal * (float)$data['activity'] * (float)$data['goal']);

        $bzu['protein'] = round($kkal * 0.3 / 4);
        $bzu['fat'] = round($kkal * 0.3 / 9);
        $bzu['carbohydrate'] = round($kkal * 0.4 / 4);

        $energy = Energy::updateOrCreate([
            'user_id' => Auth::user()->id,],[
            'energy' => $kkal,
            'protein' => $bzu['protein'],
            'fat' => $bzu['fat'],
            'carbohydrate' => $bzu['carbohydrate']
            ]);

        BjuParametres::updateOrCreate([
            'user_id' => Auth::user()->id,],[
            'goal' => $data['goal'],
            'weight_now' => $data['weight_now'],
            'height' => $data['height'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'activity' => $data['activity'],
            'desired_weight' => $data['desired_weight']
            ]);

        return view('auth.tools.bzu', compact('kkal', 'bzu'));

    }

}
