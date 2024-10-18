@extends('adminlte::page')

@section('title', 'Дашборд')

@section('content_header')
    <h1>Дашборд</h1>
@endsection


@section('content')
    <section class="content ">
        <div class="container-fluid">

            <div class="row" >
                <div class="col-lg-3 col-6 mt-3">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$performersCount}}</h3>
                            <p>Исполнители</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('admin.performers.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6 mt-3">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$customersCount}}</h3>
                            <p>Заказчики</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.customers.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


            </div>


        </div>
    </section>
@endsection

{{-- Create a common footer --}}



