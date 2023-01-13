@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="card col-6 mt-2" style="max-width: 45%;">
                <div class="card-header" style="max-height: 4em;">
                    Year / Topics
                </div>
                <div class="card-body">
                    <canvas id="rows4" style="width: auto!important;height:auto!important;"></canvas>
                </div>
            </div>
            <div class="card col-6 mt-2 ml-4" style="width: 45%;">
                <div class="card-header" style="max-height: 4em;">
                    <div class="dropdown">
                        <p class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Area
                        </p>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" id="region" href="#">Region</a>
                            <a class="dropdown-item" id="countries" href="#">Countries</a>
                            <a class="dropdown-item" id="cities" href="#">Cities</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="rows1" style="width: auto!important;height:auto!important;"></canvas>
                    <canvas id="rows2" style="width: auto!important;height:auto!important;"></canvas>
                    <canvas id="rows3" style="width: auto!important;height:auto!important;"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-6 mt-2" style="max-width: 45%;">
                <div class="card-header" style="max-height: 4em;">
                    Lorem Ipsum
                </div>
                <div class="card-body" style="overflow: auto">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                    release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                    software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>
            
            <div class="card col-6 mt-2 ml-4" style="width: 45%;">
                <div class="card-header" style="max-height: 4em;">
                    Topics / Data Counts
                </div>
                <div class="card-body">
                    <canvas id="rows5" style="width: auto!important;height:auto!important;"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-4 mt-2" style="max-width: 18.7em;">
                <div class="card-header" style="max-height: 4em;">
                    Relevance / Topics
                </div>
                <div class="card-body">
                    <canvas id="rows6" style="width: auto!important;height:auto!important;"></canvas>
                </div>
            </div>
            <div class="card col-4 mt-2 ml-4" style="width: 25%;">
                <div class="card-header" style="max-height: 4em;">
                    Likelyhood / Topics
                </div>
                <div class="card-body">
                    <canvas id="rows8" style="width: auto!important;height:auto!important;"></canvas>
                </div>
            </div>
            <div class="card col-4 mt-2 ml-4" style="width: 25%;">
                <div class="card-header" style="max-height: 4em;">
                    Intensity / Topics
                </div>
                <div class="card-body">
                    <canvas id="rows7" style="width: auto!important;height:auto!important;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#rows1').show(500);
            $('#rows2').hide();
            $('#rows3').hide();
            $('#dropdownMenuButton').text('Region / Topics');
        });

        $('#region').on('click', function() {
            $('#rows1').show(500);
            $('#rows2').hide(500);
            $('#rows3').hide(500);
            $('#dropdownMenuButton').text('Region / Topics');
        });

        $('#countries').on('click', function() {
            $('#rows1').hide(500);
            $('#rows2').show(500);
            $('#rows3').hide(500);
            $('#dropdownMenuButton').text('Countries / Topics');
        });

        $('#cities').on('click', function() {
            $('#rows1').hide(500);
            $('#rows2').hide(500);
            $('#rows3').show(500);
            $('#dropdownMenuButton').text('Cities / Topics');
        });

        async function fetchRegion() {
            const response = await fetch('/api/data_region');
            const datapoints = await response.json();
            return datapoints;
        }

        fetchRegion().then(datapoints => {
            const ctx = document.getElementById('rows1').getContext('2d');
            var coloR = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (let i = 0; i < datapoints.length; i++) {
                coloR.push(dynamicColors());
            }
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: datapoints.map(datapoint => datapoint.region_name),
                    datasets: [{
                        label: 'Topics',
                        data: datapoints.map(datapoint => datapoint.length),
                        backgroundColor: coloR,
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                        },
                    },
                    legend: {
                        display: false //This will do the task
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });

        async function fetchCountries() {
            const response = await fetch('/api/data_countries');
            const datapoints = await response.json();
            return datapoints;
        }

        fetchCountries().then(datapoints => {
            const ctx = document.getElementById('rows2').getContext('2d');
            var coloR = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (let i = 0; i < datapoints.length; i++) {
                coloR.push(dynamicColors());
            }
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: datapoints.map(datapoint => datapoint.country_name),
                    datasets: [{
                        label: 'Topics',
                        data: datapoints.map(datapoint => datapoint.length),
                        backgroundColor: coloR,
                        borderColor: 'white',
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                        },
                    },
                    legend: {
                        display: false //This will do the task
                    },
                }
            });
        });

        async function fetchCities() {
            const response = await fetch('/api/data_cities');
            const datapoints = await response.json();
            return datapoints;
        }

        fetchCities().then(datapoints => {
            const ctx = document.getElementById('rows3').getContext('2d');
            var coloR = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (let i = 0; i < datapoints.length; i++) {
                coloR.push(dynamicColors());
            }
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: datapoints.map(datapoint => datapoint.city_name),
                    datasets: [{
                        label: 'Topics',
                        data: datapoints.map(datapoint => datapoint.length),
                        backgroundColor: coloR,
                        // backgroundColor: ["red", "blue", "green", "blue", "red", "blue"], 
                        borderColor: 'white',
                        // borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                        },
                    },
                    legend: {
                        display: false //This will do the task
                    }
                }
            });
        });

        async function fetchEndYear() {
            const response = await fetch('/api/data_end_year');
            const datapoints = await response.json();
            return datapoints;
        }

        fetchEndYear().then(datapoints => {
            const ctx = document.getElementById('rows4').getContext('2d');
            var coloR = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (let i = 0; i < datapoints.length; i++) {
                coloR.push(dynamicColors());
            }
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: datapoints.map(datapoint => datapoint.end_year),
                    datasets: [{
                        label: 'Year',
                        data: datapoints.map(datapoint => datapoint.length),
                        backgroundColor: coloR,
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                        },
                    }
                }
            });
        });

        async function fetchTopics() {
            const response = await fetch('/api/data_topics');
            const datapoints = await response.json();
            return datapoints;
        }

        fetchTopics().then(datapoints => {
            const ctx = document.getElementById('rows5').getContext('2d');
            var coloR = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (let i = 0; i < datapoints.length; i++) {
                coloR.push(dynamicColors());
            }
            const chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: datapoints.map(datapoint => datapoint.topic_name),
                    datasets: [{
                        label: 'Topics',
                        data: datapoints.map(datapoint => datapoint.length),
                        backgroundColor: coloR
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                        },
                    },
                    legend: {
                        display: false //This will do the task
                    }
                }
            });
        });

        async function fetchRelevance() {
            const response = await fetch('/api/data_relevance');
            const datapoints = await response.json();
            return datapoints;
        }

        fetchRelevance().then(datapoints => {
            const ctx = document.getElementById('rows6').getContext('2d');
            var coloR = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (let i = 0; i < datapoints.length; i++) {
                coloR.push(dynamicColors());
            }
            const chart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: datapoints.map(datapoint => datapoint.relevance),
                    datasets: [{
                        label: 'Topics',
                        data: datapoints.map(datapoint => datapoint.length),
                        backgroundColor: coloR
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                        },
                    },
                    legend: {
                        display: false //This will do the task
                    }
                }
            });
        });

        async function fetchIntensity() {
            const response = await fetch('/api/data_intensity');
            const datapoints = await response.json();
            return datapoints;
        }

        fetchIntensity().then(datapoints => {
            const ctx = document.getElementById('rows7').getContext('2d');
            var coloR = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (let i = 0; i < datapoints.length; i++) {
                coloR.push(dynamicColors());
            }
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: datapoints.map(datapoint => datapoint.intensity),
                    datasets: [{
                        label: 'Topics',
                        data: datapoints.map(datapoint => datapoint.length),
                        backgroundColor: coloR
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                        },
                    },
                    legend: {
                        display: false //This will do the task
                    }
                }
            });
        });

        async function fetchLikelyhood() {
            const response = await fetch('/api/data_likelihood');
            const datapoints = await response.json();
            return datapoints;
        }

        fetchLikelyhood().then(datapoints => {
            const ctx = document.getElementById('rows8').getContext('2d');
            var coloR = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (let i = 0; i < datapoints.length; i++) {
                coloR.push(dynamicColors());
            }
            const chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: datapoints.map(datapoint => datapoint.likelihood),
                    datasets: [{
                        label: 'Topics',
                        data: datapoints.map(datapoint => datapoint.length),
                        backgroundColor: coloR,
                        borderColor: 'gray',
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                        },
                    },
                    legend: {
                        display: false //This will do the task
                    }
                }
            });
        });
    </script>
@endsection
