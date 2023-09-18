@extends('layouts.admin')
@section('title')
الإدارات
@endsection
@section('titleheader')
إدارات الموظفين
@endsection
@section('titleheader1')
    <a href="{{ route('departements.index') }}">
        الشفتات</a>
@endsection
@section('titleheader2')
    عرض
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
            text-align: center;
        }
        .card-body input, option {
            border: solid 1px rgb(; 21, 16, 16);
            text-align: center;
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
        input:focus{
            transform: scale(1.2);


        }
    </style>
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> اضافة إدارة جديدة</h3>
            </div>
            <div class="card-body" style="text-align-last: center">
                <form action="{{ route('departements.store') }}" method="post">
                    @csrf
                    <div class="row">


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>إسم الإدارة</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>الهاتف</label>
                                <input type="text" name="phones" id="phones" class="form-control" value="{{ old('phones') }}">
                                @error('phones')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>الملاحظات</label>
                                <input type="text" name="notes" id="notes" class="form-control" value="{{ old('notes') }}">
                                @error('notes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label> حالة التفعيل</label>
                                <select name="active" id="active" class="form-control">
                                    <option  @if (old('active') == 1) selected @endif value="1">مفعل</option>
                                    <option @if (old('active') == 0 and old('active') != '') selected @endif value="0">معطل</option>
                                </select>
                                @error('active')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button class="btn btn-sm btn-success" type="submit" name="submit">إضافة إدارة</button>
                            <a href="{{ route('departements.index') }}" class="btn btn-danger btn-sm">إلغاء</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
