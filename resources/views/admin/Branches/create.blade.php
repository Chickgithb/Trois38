@extends('layouts.admin')
@section('title')
الفروع
@endsection
@section('titleheader')
    السنوات المالية
@endsection
@section('titleheader1')
    <a href="{{ route('branches.index') }}">الفروع</a>
@endsection
@section('titleheader2')
    اضافة
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
        .count{
            background-color: rgb(236, 255, 33);
            color: #000;
            font-weight: bold;
            border-radius: 3px;

        }
        .price{
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
        <div class="card-header" style="text-align: center;background-image: linear-gradient(to bottom right, #0100EC, #FB36F4);color:white">
            <h3 class="card-title"></h3>تكوين سنة فروع جديدة</h3>
        </div>
        <div class="card-body" style="text-align:center">

                <form action="{{ route('branches.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-2" style="text-align: center;">
                            <div class="form-group">
                                <label>كود الفرع</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')  }}"    >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group"  style="text-align: center">
                                <label>العنوان</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" >
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label>البريد</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" >
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group"  style="text-align: center">
                                <label>الهاتف</label>
                                <input type="text" name="phones" id="phones" class="form-control" value="{{ old('phones') }}" >
                                @error('phones')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group"  style="text-align: center">
                                <label>حالة التفعيل</label>
                                <select name="active" id="active" class="form-control">
                                    <option  selected value ="1">مفعل</option>
                                    <option value="0">غير مفعل</option>
                                </select>
                                @error('active')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="submit" style="margin-right: 10px;">أضف الفرع</button>
                                <a href="{{ route('branches.index') }}" class="btn btn-sm btn-info" style="font-weight: bolder; font-size:19px">الغاء</a>
                            </div>
                        </div>


                    </div>

                </form>

        </div>
    </div>
</div>
@endsection

