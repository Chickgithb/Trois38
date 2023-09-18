<?php

namespace App\Http\Controllers\Admin;

use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartementsRequest;
use JetBrains\PhpStorm\Deprecated;

class DepartementController extends Controller
{
    public function index(){
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Departement(), array("*"),array('com_code' => $com_code), 'id','DESC',PC);
        return view('admin.Departements.index',['data'=>$data]);

    }

    public function create(){
        return view('admin.Departements.create');
    }

    public function store(DepartementsRequest $request){
        try{
            $com_code = auth()->user()->com_code;
            $checkExists = get_cols_where_row(new Departement(),array('id'),array("com_code"=>$com_code, 'name'=>$request->name));
            if(!empty($checkExists)){
                return redirect()->back()->with(['error'=>'إسم الإدارة مسجل من قبل'])->withInput();
            }

            DB::beginTransaction();

            $dataToinsert['name'] = $request->name;
            $dataToinsert['phones'] =$request->phones;
            $dataToinsert['notes'] =$request->notes;
            $dataToinsert['active'] =$request->active;
            $dataToinsert['added_by'] = auth()->user()->id;
            $dataToinsert['com_code'] = $com_code;
            insert(new Departement(),$dataToinsert);

            DB::commit();

            return redirect()->route('departements.index')->with(['success'=>'ثم ادخال البيانات بنجاح']);

        }catch(\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'عفوا لا يمكن الوصول إلى المعلومات'.$ex->getMessage()])->withInput();
        }
    }


    public function edit($id){
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Departement(),array("*"),array("com_code"=>$com_code,'id'=>$id));
        if(empty($data)){
            return redirect()->back()->withInput(['error'=>'عفوا لا يمكن الوصول إلى البيانات'])->withInput();

        }
        return view('admin.Departements.edit',['data'=>$data]);
    }

    public function update($id, DepartementsRequest $request){
        try{
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Departement(),array("*"),array("com_code"=>$com_code,'id'=>$id));
            if(empty($data)){
                return redirect()->back()->with(['error'=>'عفوا لا يمكن الوصول إلى البيانات'])->withInput();
            }
            $checkExists = Departement::select("id")->where('com_code','=',$com_code)->where('name','=',$request->name)->where('id','!=',$id)->first();
            if(!empty($checkExists)){
                return redirect()->back()->with(['error' => 'عفوا اسم الادارة مسجل من قبل !'])->withInput();
            }
                DB::beginTransaction();
                $dataToupdate['name'] =$request->name;
                $dataToupdate['phones'] =$request->phones;
                $dataToupdate['notes'] =$request->notes;
                $dataToupdate['active'] =$request->active;
                $dataToupdate['updated_by'] = auth()->user()->id;
                update(new Departement(),$dataToupdate,array("com_code"=>$com_code,'id'=>$id));
                DB::commit();
                return redirect()->route('departements.index')->with(['success'=>'ثم تعديل البيانات بنجاح']);

        }catch(\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'عفوا هناك خطأ ما'.$ex->getMessage()])->withInput();
        }
    }

    public function destroy($id){
        try{
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Departement(),array('*'),array("com_code"=>$com_code,'id'=>$id));
            if(empty($data)){
                return redirect()->back()->with(['error'=>'عفوا لا يمكن الوصول إلى البيانات'])->withInput();
            }
            DB::beginTransaction();
            destroy(new Departement(),array('com_code'=>$com_code,'id'=>$id));
            DB::commit();

            return redirect()->route('departements.index')->with(['success'=>'تم حذف البيانات بنجاح']);

        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'عفوا هناك خطأ ما'.$ex->getMessage()])->withInput();
        }
    }
}
