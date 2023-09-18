@extends('layouts.admin')
@section('title')
    الإدارات
@endsection
@section('titleheader')
إدارات الموظفين
@endsection
@section('titleheader1')
    <a href="{{ route('departements.index') }}">
        الإدارات</a>
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
            <div class="card-header" style="text-align: center;">
                <h3 class="card-title"></h3> إدارات الشركة </h3>
                <a href="{{ route('departements.create') }}" class="btn btn-sm btn-warning"
                    style="color: rgb(0, 0, 0);background-color:rgb(236, 255, 33);font-weight:bold;">
                    <img src="{{ asset('assets/admin/dist/img/5501851.png') }}" alt="" style="width: 24px;"> اضافة
                    جديد
                </a>
            </div>

            <div class="card-body" style="text-align: center" id="ajax_responce_serachDiv">
                @if (@isset($data) and !@empty($data) and count($data) > 0)
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <th>إسم الإدارة</th>
                            <th>الهاتف</th>
                            <th>الملاحظات</th>
                            <th> حالة التفعيل</th>
                            <th> الاضافة بواسطة</th>
                            <th style="width: 100px">العمليات</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                                <tr>
                                    <td>{{ $info->name }}</td>
                                    <td>{{ $info->phones }}</td>
                                    <td>{{ $info->notes }}</td>

                                    <td @if ($info->active == 1) class="bg-success" @else class="bg-danger" @endif>
                                        @if ($info->active == 1)
                                            مفعل
                                        @else
                                            معطل
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $dt = new DateTime($info->created_at);
                                            $date = $dt->format('Y-m-d');
                                            $time = $dt->format('h:i');
                                            $newDateTime = date('A', strtotime($time));
                                            $newDateTimeType = $newDateTime == 'AM' ? 'صباحا ' : 'مساء';
                                        @endphp
                                        {{ $date }}-
                                        {{ $time }}
                                        {{ $newDateTimeType }} <br>
                                        <span class="count">{{ $info->added->name }}</span>
                                    </td>

                                    <td style="text-align: center">

                                        <a href="{{ route('departements.edit', $info->id) }}" class="fas fa-edit"
                                            style="color: rgb(0, 255, 81);margin-left:4px; background-color:white;width:27%">
                                        </a>
                                        <a href="{{ route('departements.destroy', $info->id) }}"
                                            class="fas are_you_shur fa-trash-alt" id="are_you_shur"
                                            style="color: rgb(181, 0, 0);margin-right:4px; background-color:white;width:27%">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {{ $data->links('pagination::bootstrap-5') }}

                        </ul>
                      </nav>

                @else
                    <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
                @endif
            </div>
        </div>
    </div>

@endsection

