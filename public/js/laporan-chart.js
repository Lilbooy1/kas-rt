document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('iuranChart');
    if (!canvas) {
        console.error('Canvas tidak ditemukan');
        return;
    }

    // Ambil data dari attribute canvas
    const bulanData = JSON.parse(canvas.dataset.bulan);
    const jumlahData = JSON.parse(canvas.dataset.jumlah);
    
    console.log('Data Bulan:', bulanData);
    console.log('Data Jumlah:', jumlahData);

    // Cek apakah Chart.js tersedia
    if (typeof Chart === 'undefined') {
        console.error('Chart.js tidak ditemukan');
        return;
    }

    try {
        new Chart(canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: bulanData,
                datasets: [{
                    label: 'Jumlah Iuran (Rp)',
                    data: jumlahData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
        console.log('Chart berhasil dibuat');
    } catch (error) {
        console.error('Error membuat chart:', error);
    }
});