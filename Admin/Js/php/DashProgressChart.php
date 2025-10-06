<script>
  const ctx = document.getElementById('projectsChart').getContext('2d');
  const projectsChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: <?= json_encode($dates) ?>,
          datasets: [{
              label: 'Projects Created',
              data: <?= json_encode($projectsPerDay) ?>,
              backgroundColor: 'rgba(125, 89, 240, 0.7)',
              borderColor: 'rgba(125, 89, 240, 1)',
              borderWidth: 2,
              borderRadius: 8,
              barPercentage: 0.6
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: { display: false },
              tooltip: { mode: 'index', intersect: false }
          },
          scales: {
              x: {
                  grid: { display: false },
                  ticks: { color: '#e5e7eb', font: { weight: '500' } }
              },
              y: {
                  beginAtZero: true,
                  grid: { drawBorder: false, color: 'rgba(255,255,255,0.1)' },
                  ticks: { stepSize: 1, color: '#e5e7eb', font: { weight: '500' } }
              }
          }
      }
  });
  </script>