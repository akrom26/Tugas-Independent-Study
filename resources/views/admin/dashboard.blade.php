@extends('template.template')

@section('content')
<div class="row">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Jumlah siswa </h5>
                            <span>
                                <h4 class="fw-semibold mb-3">{{$data['student']}}</h4> <small> siswa</small>
                            </span>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-users fs-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="earning"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Sebaran Gender</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="d-flex align-items-center mb-3">
                                <p class="fs-3 mb-0">Dominan gender</p>
                            </div>
                            <h4 class="fw-semibold mb-3">{{$data['gender']['dominanGender']}}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="gender"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Sebaran Tipe Asal Sekolah</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="d-flex align-items-center mb-3">
                                <p class="fs-3 mb-0">Dominan tipe sekolah</p>
                            </div>
                            <h4 class="fw-semibold mb-3">{{$data['originSchoolType']['dominanTypeOriginSchool']}}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="originSchoolType"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Sebaran Penghasilan Orang Tua (Ayah)</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="d-flex align-items-center mb-3">
                                <p class="fs-3 mb-0">Dominan penghasilan orang tua</p>
                            </div>
                            <h4 class="fw-semibold mb-3">{{$data['fatherIncome']['dominanFatherIncome']}}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="fatherIncome"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Sebaran Penghasilan Orang Tua (Ibu)</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="d-flex align-items-center mb-3">
                                <p class="fs-3 mb-0">Dominan penghasilan orang tua</p>
                            </div>
                            <h4 class="fw-semibold mb-3">{{$data['motherIncome']['dominanMotherIncome']}}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="motherIncome"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // gender data
    var seriesGender = @json($data['gender']['series']);
    var labelsGender = @json($data['gender']['labels']);
    $(function() {
        var breakup = {
            color: "#adb5bd",
            series: seriesGender,
            labels: labelsGender,
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },

            colors: ["#0079FF", "#FF0060"],

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#gender"), breakup);
        chart.render();
    })

    // origin school data
    var seriesSchool = @json($data['originSchoolType']['series']);
    var labelsSchool = @json($data['originSchoolType']['labels']);
    $(function() {
        var breakup = {
            color: "#adb5bd",
            series: seriesSchool,
            labels: labelsSchool,
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },

            colors: ["#0079FF", "#00DFA2", "#F6FA70", "#FF0060"],

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#originSchoolType"), breakup);
        chart.render();
    })

    // fatherIncome data
    var seriesFatherIncome = @json($data['fatherIncome']['series']);
    var labelsFatherIncome = @json($data['fatherIncome']['labels']);
    $(function() {
        var breakup = {
            color: "#adb5bd",
            series: seriesFatherIncome,
            labels: labelsFatherIncome,
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },

            colors: ["#FF0060", "#F6FA70", "#00DFA2", "#0079FF", "#F29727"],

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#fatherIncome"), breakup);
        chart.render();
    })

    // motherIncome data
    var seriesMotherIncome = @json($data['motherIncome']['series']);
    var labelsMotherIncome = @json($data['motherIncome']['labels']);
    $(function() {
        var breakup = {
            color: "#adb5bd",
            series: seriesMotherIncome,
            labels: labelsMotherIncome,
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },

            colors: ["#FF0060", "#F6FA70", "#00DFA2", "#0079FF", "#F29727"],

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#motherIncome"), breakup);
        chart.render();
    })
</script>
@endsection