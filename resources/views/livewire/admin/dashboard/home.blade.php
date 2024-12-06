<div class="hidden-sub-wrapper">
    <main class="bg-white dark:bg-dark dark:text-white dark:border-gray-500 rounded shadow-xl">

        <x-loading />

        <header class="flex justify-between p-3">
            <h1 class="text-xl">Dashboard</h1>
            <select class="form-control md:w-1/4" wire:model="currentStats">
                <option value="all">Overall statistics</option>
                <option value="current_month">This month</option>
                <option value="previous_month">Previous month</option>
                <option value="current_year">This Year</option>
                <option value="previous_year">Previous Year</option>
                <option value="current_week">This Week</option>
                <option value="previous_week">Previous Week</option>
                <option value="today">Today</option>
                <option value="yersterday">Yersterday</option>
            </select>
        </header>

        <div class="p-5">


            <div class="grid grid-cols-1">

                <div class="space-y-5">

                    <section class="grid md:grid-cols-3 gap-3">


                        <section class="bg-gray-200 rounded-xl">
                            <header class="flex justify-between items-center p-3 ">
                                <button class="bg-white p-2 px-3 rounded-lg">
                                    <i class="las la-money-bill text-xl"></i>
                                </button>
                                <h3 class="font-bold">New Orders</h3>
                            </header>
                            <footer class="flex justify-between items-center p-3 ">
                                <h3 class="header-font text-3xl font-bold">
                                    150
                                </h3>
                                <div>
                                    <i class="las la-money-bill text-xl"></i>
                                </div>
                            </footer>
                        </section>











                    </section>




                    <section class="p-5 border rounded-xl min-h-[300px]">
                        <canvas id="myChart"></canvas>
                    </section>


                </div>

            </div>

        </div>

    </main>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sept',
            'Oct',
            'Nov',
            'Dec',
        ];

        const data = {
            labels: labels,
            datasets: [{
                    label: 'Customers',
                    backgroundColor: '#E3F49A',
                    borderColor: '#E3F49A',
                    data: @json($stats['customer_time_series_analysis']),
                    lineTension: 0.4,
                    radius: 3
                },
                {
                    label: 'Sales',
                    backgroundColor: '#DCD2EE',
                    borderColor: '#DCD2EE',
                    data: @json($stats['orders_time_series_analysis']),
                    lineTension: 0.4,
                    radius: 3
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            padding: 10,
                        }
                    },
                    y: {
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            padding: 15,
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 6,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    title: {
                        display: true,
                        position: 'top',
                        align: 'start',
                        padding: {
                            left: 0
                        },
                        text: 'Graph',
                        color: '#000',
                        font: {
                            size: 20,
                            weight: 'bold',
                        }
                    },
                    subtitle: {
                        display: true,
                        position: 'bottom',
                        text: 'Sales made for year {{ date('Y') }}'
                    },

                }
            }
        };


        const ctx = document.getElementById('myChart');
        const myChart = new Chart(
            ctx,
            config,
        );
</script>
@endPush