document.addEventListener("DOMContentLoaded", () => {
    fetchSummary();
});

function fetchSummary() {
    fetch('get_summary.php')
        .then(response => response.json())
        .then(data => {
            const summaryDiv = document.getElementById('summaryData');
            summaryDiv.innerHTML = `
                <p><strong>Total Income:</strong> 
    data.total_income</p>
                    <p><strong>Total Expenses:</strong>
{data.total_expenses}</p>
                <p><strong>Net Savings:</strong> 
    
{data.net_savings}</p>
            `;
        })
        .catch(error => console.error('Error fetching summary:', error));
}

function setGoal() {
    const name = document.getElementById('goal_name').value;
    const amount = document.getElementById('target_amount').value;
    const dueDate = document.getElementById('due_date').value;

    if (!name || !amount || !dueDate) {
        alert("Please fill all fields.");
        return;
    }

    const goalData = {
        goal_name: name,
        target_amount: amount,
        due_date: dueDate
    };

    fetch('set_goal.php', {
        method: 'POST',headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(goalData)
    })
    .then(response => response.text())
    .then(response => {
        alert("Goal set successfully!");
        document.querySelector('form').reset();
    })
    .catch(error => {
        console.error('Error setting goal:', error);
    });
}
