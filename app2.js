// Submit a new transaction
function addTransaction() {
    const date = document.getElementById("date").value;
    const amount = document.getElementById("amount").value;
    const type = document.getElementById("type").value;
    const category = document.getElementById("category").value;
    const description = document.getElementById("description").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "add_transaction.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        alert(this.responseText);
    };

    xhr.send(`date=${date}&amount=${amount}&type=${type}&category=${category}&description=${description}`);
}

// Submit a new goal
function setGoal() {
    const goalName = document.getElementById("goal_name").value;
    const targetAmount = document.getElementById("target_amount").value;
    const dueDate = document.getElementById("due_date").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "set_goal.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        alert(this.responseText);
    };

    xhr.send(`goal_name=${goalName}&target_amount=${targetAmount}&due_date=${dueDate}`);
}
