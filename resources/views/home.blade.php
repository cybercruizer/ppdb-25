@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <x-adminlte-callout theme="success" title="Pendaftar per Jurusan">
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-info-box title="SEMUA PENDAFTAR" text="{{ $siswadu }} / {{ $siswa->count() }}"
                        icon="fas fa-lg fa-users text-light" icon-theme="gradient-purple" />
                </div>
                <div class="col-md-3">
                    <x-adminlte-info-box title="PERHOTELAN" text="{{ $data[6]['sub_value'] }} / {{ $data[6]['value'] }}"
                        icon="fas fa-lg fa-hotel text-light" icon-theme="gradient-orange" />
                </div>
                <div class="col-md-3">
                    <x-adminlte-info-box title="KULINER" text="{{ $data[5]['sub_value'] }} / {{ $data[5]['value'] }}"
                        icon="fas fa-lg fa-utensils text-light" icon-theme="gradient-pink" />
                </div>
                <div class="col-md-3">
                    <x-adminlte-info-box title="TPM" text="{{ $data[1]['sub_value'] }} / {{ $data[1]['value'] }}"
                        icon="fas fa-lg fa-cogs text-light" icon-theme="gradient-red" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-info-box title="TKR" text="{{ $data[2]['sub_value'] }} / {{ $data[2]['value'] }}"
                        icon="fas fa-lg fa-car-side text-light" icon-theme="gradient-green" />
                </div>
                <div class="col-md-3">
                    <x-adminlte-info-box title="TKJ" text="{{ $data[0]['sub_value'] }} / {{ $data[0]['value'] }}"
                        icon="fas fa-lg fa-desktop text-light" icon-theme="gradient-blue" />
                </div>
                <div class="col-md-3">
                    <x-adminlte-info-box title="TSM" text="{{ $data[3]['sub_value'] }} / {{ $data[3]['value'] }}"
                        icon="fas fa-lg fa-motorcycle text-light" icon-theme="gradient-orange" />
                </div>
                <div class="col-md-3">
                    <x-adminlte-info-box title="TITL" text="{{ $data[4]['sub_value'] }} / {{ $data[4]['value'] }}"
                        icon="fas fa-lg fa-bolt text-light" icon-theme="gradient-yellow" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-info-box title="Aksi Peduli" text="{{ $ap }}" icon="fas fa-lg fa-gift text-light"
                        icon-theme="gradient-green" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-info-box title="Pondok" text="{{ $pondok }}" icon="fas fa-lg fa-building text-light"
                        icon-theme="gradient-blue" />
                </div>
            </div>
        </x-adminlte-callout>

        <x-adminlte-callout theme="info" title="Grafik Pendaftar">
            <div class="container">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </x-adminlte-callout>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <x-adminlte-card title="Distribusi JK (sudah DU)" theme="navy" icon="fas fa-lg fa-fan" collapsible>

                    <table class="table table-striped">
                        <thead>
                            <tr class="table-warning">
                                <th scope="col">Jurusan</th>
                                <th scope='col'>L</th>
                                <th scope='col'>P</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>TKJ</td>
                                <td>{{ $data[0]['tkjL'] }}</td>
                                <td>{{ $data[0]['tkjP'] }}</td>
                            </tr>
                            <tr>
                                <td>TPM</td>
                                <td>{{ $data[1]['tpmL'] }}</td>
                                <td>{{ $data[1]['tpmP'] }}</td>
                            </tr>
                            <tr>
                                <td>TKR</td>
                                <td>{{ $data[2]['tkrL'] }}</td>
                                <td>{{ $data[2]['tkrP'] }}</td>
                            </tr>
                            <tr>
                                <td>TSM</td>
                                <td>{{ $data[3]['tsmL'] }}</td>
                                <td>{{ $data[3]['tsmP'] }}</td>
                            </tr>
                            <tr>
                                <td>TITL</td>
                                <td>{{ $data[4]['titlL'] }}</td>
                                <td>{{ $data[4]['titlP'] }}</td>
                            </tr>
                            <tr>
                                <td>KULINER</td>
                                <td>{{ $data[5]['kulinerL'] }}</td>
                                <td>{{ $data[5]['kulinerP'] }}</td>
                            </tr>
                            <tr>
                                <td>PERHOTELAN</td>
                                <td>{{ $data[6]['perhotelanL'] }}</td>
                                <td>{{ $data[6]['perhotelanP'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </x-adminlte-card>
            </div>
            <div class="col-md-6 col-sm-12">
                <x-adminlte-card title="Distribusi ukuran baju" theme="navy" icon="fas fa-lg fa-fan" collapsible>

                    <table class="table table-striped">
                        <thead>
                            <tr class="table-warning">
                                <th scope="col">Jurusan</th>
                                <th scope='col'>XXL</th>
                                <th scope='col'>XL</th>
                                <th scope='col'>L</th>
                                <th scope='col'>M</th>
                                <th scope='col'>S</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (['TKJ', 'TPM', 'TKR', 'TSM', 'TITL', 'KUL', 'PHT'] as $jurusan)
                                <tr>
                                    <td>{{ $jurusan }}</td>
                                    <td>{{ $dataUkuran[$jurusan]['XXL'] ?? 0 }}</td>
                                    <td>{{ $dataUkuran[$jurusan]['XL'] ?? 0 }}</td>
                                    <td>{{ $dataUkuran[$jurusan]['L'] ?? 0 }}</td>
                                    <td>{{ $dataUkuran[$jurusan]['M'] ?? 0 }}</td>
                                    <td>{{ $dataUkuran[$jurusan]['S'] ?? 0 }}</td>
                                </tr>
                            @endforeach
                            <tr class="table-success">
                                <td>TOTAL</td>
                                @foreach (['XXL', 'XL', 'L', 'M', 'S'] as $uk)
                                    <td>{{$totalUkuran[$uk] ?? 0}}</td>
                                @endforeach
                            </tr>


                        </tbody>
                    </table>
                </x-adminlte-card>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('myChart').getContext('2d');
                var data = @json($data);

                var labels = data.map(item => item.label);
                var values = data.map(item => item.value);
                var sub_values = data.map(item => item.sub_value);

                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pendaftar',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Daftar Ulang',
                            data: sub_values,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
        $(document).ready(function() {
            $('.rupiah').mask("#.##0", {
                reverse: true
            });
        });
    </script>

@stop
