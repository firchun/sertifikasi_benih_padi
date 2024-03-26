<canvas id="myChart" width="400" height="100"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: '/chart',
            success: function(response) {
                // Menggunakan data yang diterima dari respons Ajax
                const newData = {
                    labels: response.labels,
                    datasets: [{
                            label: 'Lulus',
                            data: response.failed,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Gagal',
                            data: response.passed,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                };

                // Konfigurasi Chart.js
                const configcart = {
                    type: 'bar',
                    data: newData,
                    options: {
                        indexAxis: 'x',
                        elements: {
                            bar: {
                                borderWidth: 2,
                            }
                        },
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                            title: {
                                display: true,
                                text: 'Grafik Sertifikasi Benih Padi'
                            }
                        }
                    }
                };

                // Inisialisasi grafik menggunakan Chart.js
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, configcart);
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
    });
</script>
