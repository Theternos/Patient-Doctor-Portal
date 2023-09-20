<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hospital Statistics</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width: 80%; margin: 0 auto;">
        <canvas id="hospitalChart"></canvas>
    </div>

    <script>
        // Function to get day name for a given date
        function getDayName(date) {
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return days[date.getDay()];
        }

        // Get today's date
        const today = new Date();

        // Generate labels for the past 7 days
        const labels = [];
        for (let i = 6; i >= 0; i--) {
            const pastDate = new Date(today);
            pastDate.setDate(today.getDate() - i);
            labels.push(getDayName(pastDate));
        }

        const config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Dataset 1',
                        data: [45, 32, 56, 43, 67, 54, 75], // Replace with your hospital data
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.5)',
                        yAxisID: 'y',
                    },
                    {
                        label: 'Dataset 2',
                        data: [25, 42, 35, 62, 48, 55, 67], // Replace with your hospital data
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.5)',
                        yAxisID: 'y1',
                    },
                    {
                        label: 'Dataset 3',
                        data: [2, 24, 55, 12, 78, 35, 47], // Replace with your hospital data
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 255, 0, 0.5)',
                        yAxisID: 'y2',
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Hospital Statistics - Last 7 Days'
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        },
                    },
                }
            },
        };

        const ctx = document.getElementById('hospitalChart').getContext('2d');
        new Chart(ctx, config);

        // Code to display top 3 reported diseases
        const top3Diseases = [{
                name: 'Disease A',
                count: 85
            },
            {
                name: 'Disease B',
                count: 72
            },
            {
                name: 'Disease C',
                count: 65
            }
            // Add more diseases and counts as needed
        ];

        // Display the top 3 diseases
        top3Diseases.forEach((disease, index) => {
            console.log(`Top ${index + 1}: ${disease.name} - ${disease.count} cases`);
        });
    </script>
</body>

</html>