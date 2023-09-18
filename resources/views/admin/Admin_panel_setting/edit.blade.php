@extends('layouts.admin')
@section('title')
    الضبط العام للنظام
@endsection
@section('titleheader')
    قائمة الضبط
@endsection
@section('titleheader1')
    <a href="{{ route('admin_panel_settings_edit') }}"> الضبط العام</a>
@endsection
@section('titleheader2')
    تعديل
@endsection
@section('css')
    <style>
        .card {
            border: solid 1px;
            padding: 0.1rem;
        }

        .card-header {
            color: white;
            background-color: rgb(40, 50, 50);
        }

        .card-title {
            content: center;
            float: center;
            font-size: 1.1rem;
            font-weight: 400;
            margin: 0;
            margin-bottom: 0.01rem;
        }

        .form-group {
            margin-bottom: 0;

        }

        .row {
            border: solid 1px;
        }

        .form-group input {
            border: solid 1px;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> ثحديث بيانات الضبط العام للنظام </h3>
        </div>
        <div class="card-body">
            @if (@isset($data) and !@empty($data))
                <form action="{{ route('admin_panel_settings_update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label for="">اسم الشركة</label>
                                <input type="text" name="company_name" id="company_name" class="form-control"
                                    value="{{ old('company_name', $data['company_name']) }}" style="text-align: center">
                                @error('company_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" style="text-align: center">
                                <label for="">رقم الهاتف</label>
                                <input type="text" name="phones" id="phones" class="form-control"
                                    value="{{ old('phones', $data['phones']) }}" style="text-align: center">
                                @error('phones')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label for="">العنوان</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address', $data['address']) }}" style="text-align: center">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">بريد الشركة</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ old('email', $data['email']) }}" style="text-align: center">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label>بعد كم دقيقة نحسب تاخير حضور</label>
                                <input type="text" style="text-align: center" name="after_miniute_calculate_delay"
                                    id="after_miniute_calculate_delay" class="form-control"
                                    value="{{ old('after_miniute_calculate_delay', $data['after_miniute_calculate_delay']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('after_miniute_calculate_delay')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label>بعد كم دقيقة نحسب انصراف مبكر</label>
                                <input type="text" style="text-align: center"
                                    name="after_miniute_calculate_early_departure"
                                    id="after_miniute_calculate_early_departure" class="form-control"
                                    value="{{ old('after_miniute_calculate_early_departure', $data['after_miniute_calculate_early_departure']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('phones')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label>بعد كم دقيقه مجموع الانصراف المبكر او الحضور المتأخر نحصم ربع يوم </label>
                                <input type="text" style="text-align: center" name="after_miniute_quarterday"
                                    id="after_miniute_quarterday" class="form-control"
                                    value="{{ old('after_miniute_quarterday', $data['after_miniute_quarterday']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('after_miniute_quarterday')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label> بعد كم مرة تأخير او انصارف مبكر نخصم نص يوم</label>
                                <input type="text" style="text-align: center" name="after_time_half_daycut"
                                    id="after_time_half_daycut" class="form-control"
                                    value="{{ old('after_time_half_daycut', $data['after_time_half_daycut']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('after_time_half_daycut')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label> نخصم بعد كم مره تاخير او انصارف مبكر يوم كامل </label>
                                <input type="text" style="text-align: center" name="after_time_allday_daycut"
                                    id="after_time_allday_daycut" class="form-control"
                                    value="{{ old('after_time_allday_daycut', $data['after_time_allday_daycut']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('after_time_allday_daycut')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label> رصيد اجازات الموظف الشهري </label>
                                <input type="text"style="text-align: center" name="monthly_vacation_balance"
                                    id="monthly_vacation_balance" class="form-control"
                                    value="{{ old('monthly_vacation_balance', $data['monthly_vacation_balance']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('monthly_vacation_balance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label> بعد كم يوم ينزل للموظف رصيد اجازات </label>
                                <input type="text"style="text-align: center" name="after_days_begin_vacation"
                                    id="after_days_begin_vacation" class="form-control"
                                    value="{{ old('after_days_begin_vacation', $data['after_days_begin_vacation']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('after_days_begin_vacation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3"style="text-align: center">
                            <div class="form-group">
                                <label> الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور
                                    للموظف </label>
                                <input type="text"style="text-align: center" name="first_balance_begin_vacation"
                                    id="first_balance_begin_vacation" class="form-control"
                                    value="{{ old('first_balance_begin_vacation', $data['first_balance_begin_vacation']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('first_balance_begin_vacation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3"style="text-align: center">
                            <div class="form-group">
                                <label> الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور
                                    للموظف </label>
                                <input type="text"style="text-align: center" name="sanctions_value_first_abcence"
                                    id="sanctions_value_first_abcence" class="form-control"
                                    value="{{ old('sanctions_value_first_abcence', $data['sanctions_value_first_abcence']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('sanctions_value_first_abcence')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><br>
                        <div class="col-md-3"style="text-align: center">
                            <div class="form-group">
                                <label> قيمة خصم الايام بعد ثاني مرة غياب بدون اذن </label>
                                <input type="text"style="text-align: center" name="sanctions_value_second_abcence"
                                    id="sanctions_value_second_abcence" class="form-control"
                                    value="{{ old('sanctions_value_second_abcence', $data['sanctions_value_second_abcence']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('sanctions_value_second_abcence')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3"style="text-align: center">
                            <div class="form-group">
                                <label> قيمة خصم الايام بعد ثالث مرة غياب بدون اذن </label>
                                <input type="text"style="text-align: center" name="sanctions_value_thaird_abcence"
                                    id="sanctions_value_thaird_abcence" class="form-control"
                                    value="{{ old('sanctions_value_thaird_abcence', $data['sanctions_value_thaird_abcence']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('sanctions_value_thaird_abcence')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3"style="text-align: center">
                            <div class="form-group">
                                <label> قيمة خصم الايام بعد رابع مرة غياب بدون اذن </label>
                                <input type="text"style="text-align: center" name="sanctions_value_forth_abcence"
                                    id="sanctions_value_forth_abcence" class="form-control"
                                    value="{{ old('sanctions_value_forth_abcence', $data['sanctions_value_forth_abcence']) }}"
                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('sanctions_value_forth_abcence')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div><br>


                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">تعديل</button>
                        </div>
                    </div>
        </div>


        </form>
    @else
        <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
        @endif
    </div>
    </div>
@endsection
