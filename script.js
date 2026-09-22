const taskForm = document.getElementById("taskForm");


const taskInput = document.getElementById("taskInput");


// Check task before submitting

taskForm.addEventListener("submit", function (event) {

    if (taskInput.value.trim() === "") {

        event.preventDefault();

        alert("Please enter a task.");

        taskInput.focus();
    }

});

