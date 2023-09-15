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



.card-body{
    display: flex;
    display: inline-block;
    background-image: linear-gradient(to bottom right, #FDABDD, #374A5A);
}

</style>
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header" style="text-align: center;background-image: linear-gradient(to bottom right, #0100EC, #FB36F4);color:white">
            <h3 class="card-title"></h3>تكوين سنة مالية جديدة</h3>
        </div>
        <div class="card-body" style="text-align:center">

                <form action="{{ route('finance_calenders.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3" style="text-align: center;">
                            <div class="form-group">
                                <label> كود السنة المالية</label>
                                <input type="text" name="FINANCE_YR" id="FINANCE_YR" class="form-control" value="{{old('FINANCE_YR')  }}"    >
                                @error('FINANCE_YR')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group"  style="text-align: center">
                                <label> وصف السنة المالية</label>
                                <input type="text" name="FINANCE_YR_DESC" id="FINANCE_YR_DESC" class="form-control" value="{{ old('FINANCE_YR_DESC') }}" >
                                @error('FINANCE_YR_DESC')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: center">
                            <div class="form-group">
                                <label> تاريخ بداية السنة المالية</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" >
                                @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group"  style="text-align: center">
                                <label> تاريخ نهاية السنة المالية</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" >
                                @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="submit" style="margin-right: 10px;">أضف السنة</button>
                            </div>
                        </div>


                    </div>

                </form>

        </div>
    </div>
</div>
@endsection

