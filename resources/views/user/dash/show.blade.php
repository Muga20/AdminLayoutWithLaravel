<!DOCTYPE html>
<html lang="en">
@include('user.include.header')

<body>
    <div class="container-scroller">
        @include('user.layouts.nav')
        @include('user.layouts.skin')
        @include('user.layouts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @include('user.layouts.info')
                <div class="row mt-3">
                    @include('user.dash.dashTwo')
                    @include('user.dash.dashOne')
                    @include('user.dash.recentProperties')
                    @include('user.dash.recentApartments')

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Downloads </h4>
                                <p class="card-description">
                                </p>
                                @php
                                    // Get the current month name
                                    $currentMonth = date('F');
                                @endphp
                                <div class="buttons">
                                    <div class="dropdown-item">
                                        <a href="{{ route('download.monthly.report', ['month' => strtolower($currentMonth)]) }}" class="btn btn-primary" style="background-color: crimson">
                                            Download Report for {{ $currentMonth }}
                                        </a>
                                    </div>
                                    <div class="dropdown-item">
                                        <a href="{{ route('download.yearly.report') }}" class="btn btn-secondary" style="background-color: chocolate">
                                            Download Report Full year
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Charts  </h4>
                                <p class="card-description">
                                </p>
                                <canvas id="myChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            renderChart({{ json_encode($propertiesAddedCounts) }}, {{ json_encode($propertiesBoughtCounts) }});
        });

        function renderChart(propertiesAddedCounts, propertiesBoughtCounts) {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Properties Added',
                        data: propertiesAddedCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Properties Bought',
                        data: propertiesBoughtCounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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
        }
    </script>


    @include('user.include.scripts')

</body>

</html>
