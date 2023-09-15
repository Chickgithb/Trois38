@extends('layouts.admin')
@section('title')
الضبط العام للنظام
@endsection
@section('titleheader')
قائمة الضبط
@endsection
@section('titleheader1')
<a href="{{ route('admin_panel_settings') }}"> الضبط العام</a>
@endsection
@section('titleheader2')
عرض
@endsection
@section('css')
<style>
    .card{
        background-color: rgb(49, 48, 51)
    }
table .width30{
    padding: 0;
    width: 500px;
    background-color: rgb(59, 74, 74);
    color: white;
}
table .boddy{
    padding: 0;
    width: 230px;
    background-color: dimgray;
    color: white;
}
.card-header{
    color: white;
    background-color: rgb(40, 50, 50);

}

</style>
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header" style="text-align: center;">
         <h3 class="card-title"></h3>  بيانات الضبط العام للنظام </h3>
      </div>
      <div class="card-body" style="text-align:center">
         @if(@isset($data) and !@empty($data))
         <table id="example2" class="table table-bordered table-hover">
            <tr>
               <td class="width30">اسم الشركة</td>
               <td class="boddy"> {{ $data['company_name'] }}</td>
               <td class="width30"> حالة التفعيل</td>
               <td class="boddy"> @if($data['saysem_status']==1) مفعل@else غير مفعل  @endif</td>
            </tr>

            <tr>
               <td class="width30">هاتف الشركة</td>
               <td class="boddy"> {{ $data['phones'] }}</td>
               <td class="width30">عنوان الشركة</td>
               <td class="boddy"> {{ $data['address'] }}</td>
            </tr>
            <tr>

            </tr>
            <tr>
               <td class="width30">بريد الشركة</td>
               <td class="boddy"> {{ $data['email'] }}</td>
               <td class="width30"> بعد كم دقيقة نحسب تاخير حضور</td>
               <td class="boddy"> {{ $data['after_miniute_calculate_delay'] }}</td>
            </tr>
            <tr>

            </tr>
            <tr>
               <td class="width30"> بعد كم دقيقة نحسب انصراف مبكر	</td>
               <td class="boddy"> {{ $data['after_miniute_calculate_delay'] }}</td>
               <td class="width30"> بعد كم دقيقه مجموع الانصراف المبكر او الحضور المتأخر نحصم ربع يوم	</td>
               <td class="boddy"> {{ $data['after_miniute_quarterday'] }}</td>
            </tr>
            <tr>

            </tr>
            <tr>
               <td class="width30"> بعد كم مرة تأخير او انصارف مبكر نخصم نص يوم	</td>
               <td class="boddy"> {{ $data['after_time_half_daycut'] }}</td>
               <td class="width30">نخصم بعد كم مره تاخير او انصارف مبكر يوم كامل	</td>
               <td class="boddy"> {{ $data['after_time_allday_daycut'] }}</td>
            </tr>
            <tr>

            </tr>
            <tr>
               <td class="width30">رصيد اجازات الموظف الشهري	</td>
               <td class="boddy"> {{ $data['monthly_vacation_balance'] }}</td>
               <td class="width30">بعد كم يوم ينزل للموظف رصيد اجازات	</td>
               <td class="boddy"> {{ $data['after_days_begin_vacation'] }}</td>
            </tr>
            <tr>

            </tr>
            <tr>
               <td class="width30">الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور للموظف	</td>
               <td class="boddy"> {{ $data['first_balance_begin_vacation'] }}</td>
               <td class="width30">قيمة خصم الايام بعد اول مرة غياب بدون اذن	</td>
               <td class="boddy"> {{ $data['sanctions_value_first_abcence'] }}</td>
            </tr>
            <tr>

            </tr>
            <tr>
               <td class="width30">قيمة خصم الايام بعد ثاني مرة غياب بدون اذن	  	</td>
               <td class="boddy"> {{ $data['sanctions_value_second_abcence'] }}</td>
               <td class="width30">قيمة خصم الايام بعد ثالث مرة غياب بدون اذن	 	</td>
               <td class="boddy"> {{ $data['sanctions_value_thaird_abcence'] }}</td>
            </tr>
            <tr>

            </tr>
            <tr>
               <td class="width30">قيمة خصم الايام بعد رابع مرة غياب بدون اذن	 	</td>
               <td class="boddy"> {{ $data['sanctions_value_forth_abcence'] }}</td>
            </tr>

               <td colspan="2" class="text-right">  <a href="{{ route('admin_panel_settings_edit') }}" class="btn btn-sm btn-danger">تعديل</a> </td>

         </table>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>
@endsection
