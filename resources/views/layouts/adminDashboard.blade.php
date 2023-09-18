@extends('layouts.admin')
@section('title')
الرئيسية
@endsection
{{-- @section('titleheader')
  القائمة الرئيسية
@endsection
@section('titleheader1')
    <a href="{{ route('admin.dashboard') }}">
        الرئيسية</a>
@endsection
@section('titleheader2')
    عرض
@endsection
@section('css')

@endsection --}}
@section('content')
<div style="background-image: url({{ asset('assets/admin/dist/img/laptop.jpg')}});
width:100%; height:530px; background-size: cover;">

</div>
@endsection
