<?php

namespace App\Http\Controllers\Admin;
use DateInterval;
use DatePeriod;
use DateTime;
use App\Http\Controllers\Controller;
use App\Models\Monthes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Return_;
use App\Models\Finance_calenders;
use Illuminate\Support\Facades\DB;
use App\Models\Finance_sln_periods;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\finance_calenders_Request;
use App\Http\Requests\Update_finance_calenders_Request;


class Finance_calendersController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Finance_calenders::select("*")->orderby('FINANCE_YR','DESC')->paginate(PC);
        $CheckDataOpenCounter = Finance_calenders::where(['is_open' => 1])->count();
        return view('admin.Finance_calender.index',['data'=>$data,'CheckDataOpenCounter'=>$CheckDataOpenCounter]);
        }

    /**
     * Show the form for creating a new resource.
     */

     public function create()
     {
         return view('admin.Finance_calender.create');
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(finance_calenders_Request $request)
    {
    try {
    DB::beginTransaction();
    $dataToInsert['FINANCE_YR'] = $request->FINANCE_YR;
    $dataToInsert['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
    $dataToInsert['start_date'] = $request->start_date;
    $dataToInsert['end_date'] = $request->end_date;
    $dataToInsert['added_by'] = auth()->user()->id;
    $dataToInsert['com_code'] = auth()->user()->com_code;
    $falg = Finance_calenders::insert($dataToInsert);
    if ($falg) {
    $dataParent = Finance_calenders::select("id")->where($dataToInsert)->first();
    $startDate = new DateTime($request->start_date);
    $endDate = new DateTime($request->end_date);
    $dareInterval = new DateInterval('P1M');
    $datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
    foreach ($datePerioud as $date) {
    $dataMonth['finance_calenders_id'] = $dataParent['id'];
    $Montname_en = $date->format('F');
    $dataParentMonth = Monthes::select("id")->where(['name_en' => $Montname_en])->first();
    $dataMonth['MONTH_ID'] = $dataParentMonth['id'];
    $dataMonth['FINANCE_YR'] = $dataToInsert['FINANCE_YR'];
    $dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
    $dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
    $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
    $datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
    $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
    $dataMonth['com_code'] = auth()->user()->com_code;
    $dataMonth['updated_at'] = date("Y-m-d H:i:s");
    $dataMonth['created_at'] = date("Y-m-d H:i:s");
    $dataMonth['added_by'] = auth()->user()->id;
    $dataMonth['updated_by'] = auth()->user()->id;
    $dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
    $dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
    Finance_sln_periods::insert($dataMonth);
    }
    }
    DB::commit();
    return redirect()->route('finance_calenders.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
    } catch (\Exception $ex) {
    DB::rollBack();
    return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
    }
    }


    /**
     * Display the specified resource.
     */
    public function show(Finance_calenders $finance_calenders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    $data = Finance_calenders::select("*")->where(['id' => $id])->first();
    if (empty($data)) {
    return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
    }
    if ($data['is_open'] != 0) {
    return redirect()->back()->with(['error' => ' عفوا لايمكن تعديل السنة المالية في هذه الحالة']);
    }
    return view('admin.Finance_calender.update', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
public function update($id, Update_finance_calenders_Request $request)
{
try {
$data = Finance_calenders::select("*")->where(['id' => $id])->first();
if (empty($data)) {
return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
}
if ($data['is_open'] != 0) {
return redirect()->back()->with(['error' => ' عفوا لايمكن تعديل السنة المالية في هذه الحالة'])->withInput();
}
$validator=Validator::make($request->all(),[
'FINANCE_YR'=>['required',Rule::unique('finance_calenders')->ignore($id) ],
]);
if($validator->fails()){
return redirect()->back()->with(['error' => ' عفوا اسم السنة المالية مسجل من قبل'])->withInput();
}
DB::beginTransaction();
$dataToUpdate['FINANCE_YR'] = $request->FINANCE_YR;
$dataToUpdate['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
$dataToUpdate['start_date'] = $request->start_date;
$dataToUpdate['end_date'] = $request->end_date;
$dataToUpdate['updated_by'] = auth()->user()->id;
$falg = Finance_calenders::where(['id' => $id])->update($dataToUpdate);
if ($falg) {
if ($data['start_date'] != $request->start_date or $data['end_date'] != $request->end_date) {
$flagDelete = Finance_sln_periods::where(['finance_calenders_id' => $id])->delete();
if ($flagDelete) {
$startDate = new DateTime($request->start_date);
$endDate = new DateTime($request->end_date);
$dareInterval = new DateInterval('P1M');
$datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
foreach ($datePerioud as $date) {
$dataMonth['finance_calenders_id'] = $id;
$Montname_en = $date->format('F');
$dataParentMonth = Monthes::select("id")->where(['name_en' => $Montname_en])->first();
$dataMonth['MONTH_ID'] = $dataParentMonth['id'];
$dataMonth['FINANCE_YR'] = $dataToUpdate['FINANCE_YR'];
$dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
$dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
$dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
$datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
$dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
$dataMonth['com_code'] = auth()->user()->com_code;
$dataMonth['updated_at'] = date("Y-m-d H:i:s");
$dataMonth['created_at'] = date("Y-m-d H:i:s");
$dataMonth['added_by'] = auth()->user()->id;
$dataMonth['updated_by'] = auth()->user()->id;
$dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
$dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
Finance_sln_periods::insert($dataMonth);
}
}
}
}
DB::commit();
return    redirect()->route('finance_calenders.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return   redirect()->back()->with(['error' => 'عفو حدث خطأ ما ' . $ex->getMessage()]);
}
}



public function destroy($id)
{
try {
$data = Finance_calenders::select("*")->where(['id' => $id])->first();
if (empty($data)) {
return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
}
if ($data['is_open'] != 0) {
return redirect()->back()->with(['error' => ' عفوا لايمكن حذف السنة المالية في هذه الحالة']);
}
$flag = Finance_calenders::where(['id' => $id])->delete();
if ($flag) {
//this is optional in case there is no relationship
Finance_sln_periods::where(['finance_calenders_id' => $id])->delete();
}
return redirect()->route('finance_calenders.index')->with(['success' => 'تم حذف البيانات بنجاح']);
} catch (\Exception $ex) {
return redirect()->back()->with(['error' => ' عفوا حدث خطأ '] . $ex->getMessage());
}
}

function show_year_monthes(Request $request)
{
if ($request->ajax()) {
$finance_cln_periods = Finance_sln_periods::select("*")->where(['finance_calenders_id' => $request->id])->get();
Return view('admin.Finance_calender.show_year_monthes',(['finance_cln_periods'=>$finance_cln_periods]));
}
}


public function do_open($id)
{
try {
$data = Finance_calenders::select("*")->where(['id' => $id])->first();
if (empty($data)) {
return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
}
if ($data['is_open'] != 0) {
return redirect()->back()->with(['error' => ' عفوا لايمكن فتح السنة المالية في هذه الحالة']);
}
$CheckDataOpenCounter = Finance_calenders::where(['is_open' => 1])->count();
if ($CheckDataOpenCounter>0) {
return redirect()->back()->with(['error' => '   عفوا هناك بالفعل سنة مالية مازالت مفتوحة ']);
}
$dataToUpdate['is_open']=1;
$dataToUpdate['updated_by']=auth()->user()->id;
$flag = Finance_calenders::where(['id' => $id])->update($dataToUpdate);
return redirect()->route('finance_calenders.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
} catch (\Exception $ex) {
return redirect()->back()->with(['error' => ' عفوا حدث خطأ '] . $ex->getMessage());
}
}



}
