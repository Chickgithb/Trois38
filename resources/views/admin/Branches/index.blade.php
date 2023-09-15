@extends('layouts.admin')
@section('title')
    الفروع
@endsection
@section('titleheader')
    السنوات المالية
@endsection
@section('titleheader1')
    <a href="{{ route('branches.index') }}">
        الفروع</a>
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
                <h3 class="card-title"></h3> بيانات الفروع </h3>
                <a href="{{ route('branches.create') }}" class="btn btn-sm btn-warning"
                    style="color: rgb(0, 0, 0);background-color:rgb(236, 255, 33);font-weight:bold;">
                    <img src="{{ asset('assets/admin/dist/img/5501851.png') }}" alt="" style="width: 24px;"> اضافة
                    جديد
                </a>
            </div>
            <div class="card-body" style="text-align:center">

                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <tr>
                                <th>كود الفرع</th>
                                <th> الاسم</th>
                                <th> العنوان</th>
                                <th>الهاتف</th>
                                <th>البريد</th>
                                <th>حالة التفعيل</th>
                                <th>الاضافة بواسطة</th>
                                <th>التحديث بواسطة</th>
                                <th style="width: 100px">العمليات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $info)
                                <tr>
                                    <td> {{ $info->id }} </td>
                                    <td> {{ $info->name }} </td>
                                    <td> {{ $info->address }} </td>
                                    <td> {{ $info->phones }} </td>
                                    <td> {{ $info->email }} </td>
                                    <td
                                        @if ($info->active == 1) class="bg-success"
                                    @else
                                    class="bg-danger" @endif>
                                        @if ($info->active == 1)
                                            مفعل
                                        @else
                                            غير مفعل
                                        @endif

                                    </td>
                                    <td><span class="count">{{ $info->added->name }} </span></td>
                                    <td>
                                        @if ($info->updated_by > 0)
                                            {{ $info->updatedby->name }}
                                        @else
                                            لايوجد
                                        @endif
                                        </span>
                                    </td>
                                    <td>

                                        <a href="{{ route('branches.edit', $info->id) }}" class="fas fa-edit"
                                            style="color: rgb(0, 255, 81);margin-left:4px; background-color:white;width:22%">
                                        </a>
                                        <a href="{{ route('branches.delete', $info->id) }}"
                                            class="fas are_you_shur fa-trash-alt" id="are_you_shur"
                                            style="color: rgb(181, 0, 0);margin-right:4px; background-color:white;width:22%">
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
                @endif

            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.show_year_monthes', function() {
                var id = $(this).data('id');
                jQuery.ajax({
                    url: '{{ route('finance_calenders.show_year_monthes') }}',
                    type: 'post',
                    'dataType': 'html',
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function(data) {
                        $("#show_year_monthesModalBody").html(data);
                        $("#show_year_monthesModal").modal("show");

                    },
                    error: function() {


                    },
                });
            });
        })
    </script>
@endsection
