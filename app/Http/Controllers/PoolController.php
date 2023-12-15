<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use App\Models\PoolImages;
use Illuminate\Http\Request;
use App\Models\PoolSchedule;
use App\Models\PoolScheduleSlots;
use App\Models\PoolFeatures;
use Illuminate\Support\Facades\Auth;

class PoolController extends Controller
{
    //
    public $owner_id="";
    public function __construct()
    {
        $this->middleware('owner');
       // $this->owner_id=Auth::user()->id;
    }
    public function index()
    {
        $pools = Pool::paginate()->where('owner_id',Auth::user()->id);
        return view('owner.pool.list',compact('pools'));
    }
    public function newPool($id=false)
    {
        if($id)
        {
            $pool=Pool::find($id);
            $pool_features = PoolFeatures::where('pool_id',$id)->get();
           // echo "<pre>";print_r($pool);die();
            $data['pool']=$pool;
        }
        else{
            $data['pool']=array();
            $pool_features=array();
        }
        $data['features']=$pool_features;
        return view('owner.pool.create',$data);
    }
    // deal with add pool/ edit pool ---------------------
    public function poolaction(Request $request,$id=false)
    {
        //validate
        
        if(!$id)
        {
            $validate=$request->validate([
                "pool_name"=>"required|min:5|unique:pools",
                "short_name"=>"required|unique:pools",
                "images.*"=>"mimes:png,jpg,jpeg|required"
            ]);
        }
        else{
            $validate=$request->validate([
                "pool_name"=>"required|min:5",
                "short_name"=>"required",
                "images.*"=>"mimes:png,jpg,jpeg|required"
            ]);
        }
        $pool = new Pool();

      
        
        //save pool data in the table
        if(!$id){
        $pool = new Pool();
            $pool->pool_name=  $request->pool_name;
            $pool->short_name=  $request->short_name;
            $pool->features=  $request->features;
            $pool->rules=  $request->rules;
            $pool->owner_id=  Auth::user()->id;
            $pool->price = $request->price;
            $pool->holiday_price = $request->holiday_price;
            $pool->length            = $request->length;
            $pool->width             = $request->width;
            $pool->depth             = $request->depth;
        
            $pool->save();
        $id=$pool->id;
        }
        else{
            $pool = Pool::find($id);
           
            $pool->pool_name=  $request->pool_name;
            $pool->short_name=  $request->short_name;
            $pool->features=  $request->features;
            $pool->rules=  $request->rules;
            $pool->owner_id=  Auth::user()->id;
            $pool->price = $request->price;
            $pool->holiday_price = $request->holiday_price;
            $pool->length            = $request->length;
            $pool->width             = $request->width;
            $pool->depth             = $request->depth;
            $pool->city = $request->city;
            $pool->state = $request->state;
            $pool->address = $request->street;
            $pool->latitude = $request->latitude;
            $pool->longitude = $request->longitude;
            $pool->save();
        }
        


        //upload logo
          //upload files
          if($request->hasFile('logo'))
          {
              
              $logo = $request->file('logo');
              $filename = time().'_'.$logo->getClientOriginalName();
              $filePath = $logo->storeAs('uploads', $filename, 'public');
              $logo->move("uploads",$filePath);
              $pool->logo = $filename;
              $pool->save();
          }

        //upload header images files
        if($request->hasFile('images'))
        {
            if($id){
           //  PoolImages::where("pool_id",$id)->delete();
            }
           $files = $request->file('images');
            foreach($files as $file){
            $filename = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public');
            $file->move("uploads",$filePath);
            PoolImages::create([
            'pool_image' =>$filename,
            'pool_id'=>$id
            ]);

            }
        }

        //Pool features 
        if(count($request->feature_title)>0)
          {
            $feature_title = $request->feature_title;
            $feature_value = $request->feature_value;
            if($id)
            {
                PoolFeatures::where("pool_id",$id)->delete();
            }
               $files = $request->file('feature_icon');
               for($i=0;$i<count($feature_title);$i++){
                $filename="";
               if($files && $files[$i])
               {
                $filename = time().'_'.$files[$i]->getClientOriginalName();
                $filePath = $files[$i]->storeAs('icons', $filename, 'public');
                $files[$i]->move("icons",$filePath);
               }
               PoolFeatures::create([
               'pool_id'        =>$id,
               'feature_title'  => $feature_title[$i],
               'feature_value'  => $feature_value[$i],
               'feature_icon'   => $filename
               ]);
   
               }
          }
        return redirect(route('owner.pools.list'))->with('success', 'Pool Created Successfully!');
    }
    public function delete($id=false)
    {
        if($id)
        {
            Pool::where("id",$id)->delete();
        }
        else{
            return redirect(route('owner.pools.list'))->with('error', 'Pool id is missing!');

        }
        return redirect(route('owner.pools.list'))->with('success', 'Pool Deleted Successfully!');

    }
    public function addSchedule($id=false)
    {
        if($id)
        {
            $pool=Pool::where('id',$id)->first();
            $data['pool']=$pool;
            $events=PoolSchedule::join('pool_schedule_slots','pool_schedules.id','=','pool_schedule_slots.schedule_id')->where('pool_id',$id)->get();
        }
        else{
            $data['pool']=array();
            $events=array();
        }
        $formattedEvents=array();
        $available_date= array();
        $i=0;
        foreach($events as $event){
            $available_date[$i]=$event->date_available;
            $formattedEvents[$i]=array(
            'title' => '',
            'start' => $event->date_available,
            'end' => $event->date_available,
            'slot_id'=>$event->slot_id,
            'date_available'=>$event->date_available,
            'backgroundColor'=>"#20c997");
            $i++;
        } 
        $data['event'] = $formattedEvents;
        $data['available_date']=$available_date;
        //echo "<pre>";print_r($data['event']);die();
        return view('owner.pool.schedule',$data);
    }
    public function scheduleAction(Request $request)
    {
        //dd($request->all());
        $available_date = $request->available_date;
        $available_date = explode(",",$available_date);
        $days = ($request->day)?$request->day:array();
        $nights = ($request->night)?$request->night:array();
        if(($available_date[0])==""){
            $available_date=array_unique (array_merge ($days, $nights));
        }
      // dd(($available_date));
        $data = array();
        $i=0;
        foreach($available_date as $ad)
        {
            $data=array('pool_id'=>$request->pool_id,'date_available'=>$ad);
            $item = PoolSchedule::firstOrNew($data);
          //  dd($item->id);
            $item->save();
            
            if($item->id)
            {
                PoolScheduleSlots::where("schedule_id",$item->id)->delete();
            }
        }
        //die();
        
       // PoolScheduleSlots::truncate();
        if($days){
        foreach($days as $day)
        {
            
            $schedule_id = PoolSchedule::where('date_available',$day)->select('id')->first();
           if(isset($schedule_id)){
            //PoolScheduleSlots::where("schedule_id",$schedule_id->id)->where('slot_id',1)->delete();
            $item= PoolScheduleSlots::firstOrNew(array("schedule_id"=>$schedule_id->id,"slot_id"=>1));
            $item->save();
        }
        }
    }
    if($nights){
        //dd($nights);
        foreach($nights as $night)
        {
            $schedule_id = PoolSchedule::where('date_available',$night)->select('id')->first();
            if(isset($schedule_id)){
            $item= PoolScheduleSlots::firstOrNew(array("schedule_id"=>$schedule_id->id,"slot_id"=>2));
            $item->save();
        }
        }
    }
        return redirect(route('owner.pools.schedule',$request->pool_id))->with('success',"Schedule is saved successfully.");
    }
    public function deleteimg($id="")
    {
        if($id){
            PoolImages::where("id",$id)->delete();
           }
           
        else{
            return redirect()->back()->with('error', 'Pool id is missing!');

        }
        return redirect()->back()->with('success', 'Image delete Successfully!');
    }
}
