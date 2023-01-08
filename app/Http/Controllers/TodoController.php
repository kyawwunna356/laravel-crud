<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    //read data
    function home(Request $request){
        
        $searchKey = $request->searchKey;
        $todos = Todo::when($searchKey,
        function($query,$searchKey){
                $query->where('title','like',"%$searchKey%")
                ->orWhere('description','like',"%$searchKey%");
        })->orderBy('id','desc')->paginate('4');
     

        return view('todoCreate',compact('todos'));
    }

    //create data
    function insert(Request $request){
        $this->customValidate($request);
        $data = $this->chg_to_array($request);

        if($request->hasFile('image')){
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Todo::create($data);
        return redirect()->route('todo#create')->with('todoCreated','Todo successfully created');
    }
    //detail 
    function detail($id){
        $todo = Todo::where('id',$id)->first();
        return view('detail',compact('todo'));
    }
    //edit
    function edit($id){
        $todo = Todo::where('id',$id)->first();
        return view('edit',compact('todo'));
    }

    //update
    function update(Request $request){
        
        $this->customValidate($request);
        $data = $this->chg_to_array($request);
        if($request->hasFile('image')){
            
            $oldfile = Todo::select('image')->where('id',$request->id)->first();
            $oldfile = $oldfile->image;
            if($oldfile != null){
                Storage::delete('public/'.$oldfile);
            }

            $fileName = uniqid(). $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        $id = $request->id;
        Todo::where('id',$id)->update($data);
        return redirect('/home');
    }

    //delete data
    function delete($id){
        Todo::find($id)->delete();
        return back()->with('todoDeleted','Todo Deleted');
    }

    


    private function customValidate($request){
        Validator::make($request->all(),[
            'title' => "required|min:8|unique:todos,title,$request->id",
            'description' => "required",
            'image' => 'mimes:png,jpg'
        ])->validate();
    }

    private function chg_to_array($request){
        return [
            'title' => $request->title,
            'description' => $request->description,
        
        ];
    }
}
