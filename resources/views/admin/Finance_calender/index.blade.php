@extends('layouts.admin')
@section('title')
    السنوات المالية
@endsection
@section('titleheader')
    السنوات المالية
@endsection
@section('titleheader1')
    <a href="{{ route('finance_calenders.index') }}">السنوات المالية</a>
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
            <div class="card-header" style="text-align: center;">
                <h3 class="card-title"></h3> بيانات السنوات المالية </h3>
                <a href="{{ route('finance_calenders.create') }}" class="btn btn-sm btn-warning" style="color: rgb(0, 0, 0);background-color:rgb(236, 255, 33);font-weight:bold;">
                    <img src="{{ asset('assets/admin/dist/img/5501851.png') }}" alt="" style="width: 24px;"> اضافة
                    جديد
                </a>
            </div>
            <div class="card-body" style="text-align:center">

                @if(@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <tr>
                                <th>كود السنة</th>
                                <th>وصف السنة</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                                <th>الاضافة بواسطة</th>
                                <th>التحديث بواسطة</th>
                                <th style="width: 200px">العمليات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ( $data as $info )
                            <tr>
                               <td> {{ $info->FINANCE_YR }} </td>
                               <td> {{ $info->FINANCE_YR_DESC }} </td>
                               <td> {{ $info->start_date }} </td>
                               <td>{{ $info->end_date }} </td>
                               <td><span class="count">{{ $info->added->name }} </span></td>
                               <td><span class="price">
                                  @if($info->updated_by>0)
                               {{ $info->updatedby->name }}
                               @else
                               لايوجد
                               @endif</span>
                                </td>
                                <td>
                                  @if($info->is_open==0)
                                        @if($CheckDataOpenCounter==0)
                                            <a href="{{ route('finance_calenders.do_open', $info->id) }}"
                                                class="fas fa-folder-open"style="color: rgb(227, 250, 21);margin-left:4px; background-color:white;width:20%">
                                            </a>
                                        @endif
                                            <a href="{{ route('finance_calenders.edit', $info->id) }}" class="fas fa-edit"
                                                style="color: rgb(0, 255, 81);margin-left:4px; background-color:white;width:20%"></a>
                                            <a href="{{ route('finance_calenders.delete', $info->id) }}"
                                                class="fas are_you_shur fa-trash-alt" id="are_you_shur"
                                                style="color: rgb(181, 0, 0);margin-right:4px; background-color:white;width:20%"></a>
                                            <button class="show_year_monthes" data-id="{{ $info->id }}">
                                                <img src="{{ asset('assets/admin/dist/img/calendar.png') }}" style="width: 24px;">
                                            </button>
                                        @else
                                            سنة مالية مفتوحة
                                        @endif
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

    <div class="modal fade" id="show_year_monthesModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h4 class="modal-title">عرض الشهور للسنة المالية</h4>
                </div>
                <div class="modal-body" id="show_year_monthesModalBody">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-light">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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


