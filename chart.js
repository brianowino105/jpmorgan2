<canvas id="budgetChart" width="400" height="200"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
fetch('get_summary.php')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('budgetChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Income', 'Expenses', 'Savings'],
                datasets: [{
                    label: 'Budget Overview',
                    data: [data.total_income, data.total_expenses, data.net_savings],
                    backgroundColor: ['#4CAF50', '#F44336', '#2196F3']
                }]
            }
        });
    });
</script>
