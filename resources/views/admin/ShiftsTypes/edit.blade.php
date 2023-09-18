@extends('layouts.admin')
@section('title')
    الفروع
@endsection
@section('titleheader')
    السنوات المالية
@endsection
@section('titleheader1')
    <a href="{{ route('branches.index') }}">الشفتات</a>
@endsection
@section('titleheader2')
    التعديل
@endsection
@section('css')
    <style>
        table .width30 {
            padding: 0;
            width: 500px;
            background-color: rgb(59, 74, 74);
            color: white;
        }

        table .boddy {
            padding: 0;
            width: 230px;
            background-color: dimgray;
            color: white;
        }

        .card-header {
            color: white;
            background-color: rgb(40, 50, 50);
            padding: 10px;

        }


        .table th {
            background-color: rgb(40, 50, 50);
            color: white;
            padding: 1.5px;
        }

        .table td {
            background-color: rgb(73, 75, 75);
            color: white;
            padding: 0;
        }

        .card-body {
            border: solid 1px rgb(; 21, 16, 16);
        }

        .modal-content,
        .modal-header {
            text-align: center
        }

        .modal-header {
            margin-top: 10px;
            margin-right: 390px;
            display: block;
            padding: 0;
            width: 320px;
            background-color: gray;
            border-radius: 5px;
            color: white;

        }

        .modal-footer {
            margin: 0;
            background-color: gray;
        }

        .modal-footer button {
            background-color: rgb(57, 60, 57);
        }

        .count {
            background-color: rgb(236, 255, 33);
            color: #000;
            font-weight: bold;
            border-radius: 3px;

        }

        .price {
            background-color: rgb(25, 255, 63);
            color: #000;
            font-weight: bold;
            border-radius: 3px;

        }
    </style>
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header"
                style="text-align: center;background-image: linear-gradient(to bottom right, #0100EC, #FB36F4);color:white">
                <h3 class="card-title"></h3>تعديل الشفتات </h3>
            </div>
            <div class="card-body" style="text-align:center">

                <form action="{{ route('ShitsTypes.update', $data['id']) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                               <label> نوع الشفت </label>
                               <select name="type" id="type" class="form-control">
                                  <option value="">اختر النوع</option>
                                  <option @if(old('type',$data['type'])==1) selected @endif value="1">صباحي</option>
                                  <option @if(old('type',$data['type'])==2) selected @endif value="2">مسائي</option>
                               </select>
                               @error('type')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="col-md-12">
                               <div class="form-group">
                                  <label>   يبدأ من الساعة </label>
                                  <input type="time" name="from_time" id="from_time" class="form-control" value="{{ old('from_time',$data['from_time']) }}" >
                                  @error('from_time')
                                  <span class="text-danger">{{ $message }}</span>
                                  @enderror
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="col-md-12">
                               <div class="form-group">
                                  <label>   ينتهي  الساعة </label>
                                  <input type="time" name="to_time" id="to_time" class="form-control" value="{{ old('to_time',$data['to_time']) }}" >
                                  @error('to_time')
                                  <span class="text-danger">{{ $message }}</span>
                                  @enderror
                               </div>
                            </div>
                         </div>
                         <div class="col-md-12">
                            <div class="form-group">
                               <label>    عدد الساعات</label>
                               <input type="text" name="total_hour" id="total_hour" class="form-control" value="{{ old('total_hour',$data['total_hour']) }}" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" >
                               @error('total_hour')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>
                         </div>
                        <div class="col-md-2">
                            <div class="form-group" style="text-align: center">
                                <label>حالة التفعيل</label>
                                <select name="active" id="active" class="form-control">
                                    <option @if(old('type',$data['active'])==1) selected @endif  value="1">مفعل</option>
                                    <option @if(old('type',$data['active'])==0) selected @endif  value="0">غير مفعل
                                    </option>
                                </select>
                                @error('active')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="submit"
                                    style="margin-right: 10px;">تعديل الشفت</button>
                                <a href="{{ route('branches.index') }}" class="btn btn-sm btn-info"
                                    style="font-weight: bolder; font-size:19px">الغاء</a>
                            </div>
                        </div>


                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
