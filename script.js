document.addEventListener("DOMContentLoaded", function() {

    // Task Adding Functionality
    document.querySelector('#push').addEventListener('click', addTask);
    document.querySelector('#taskInput').addEventListener('keypress', function(event) {
        if (event.key === "Enter") {
            addTask(); 
        }
    });

    function addTask() {
        var taskInput = document.querySelector('#taskInput').value.trim(); 
        if (taskInput === "") {
            alert("Please enter a task");
        } else {
            var taskList = document.querySelector('#tasks');
            var newTask = document.createElement('div');
            newTask.classList.add('task');
            newTask.innerHTML = `
                <span class="taskname">${taskInput}</span>
                <button class="delete">
                    <i class="fas fa-trash" style="color: #b31e68;"></i>
                </button>
            `;
            taskList.appendChild(newTask); 
            document.querySelector('#taskInput').value = "";

            // Delete task event
            newTask.querySelector('.delete').addEventListener('click', function() {
                newTask.remove(); 
            });

            // Mark task as completed
            newTask.addEventListener('click', function() {
                newTask.classList.toggle('completed');
            });
        }
    }

    // Accordion functionality (show/hide content when header is clicked)
    document.querySelectorAll('h2').forEach(function(header) {
        header.addEventListener('click', function() {
            const content = this.nextElementSibling;
            content.style.display = (content.style.display === 'none') ? 'block' : 'none';
        });
    });

    // Form Validation (Optional)
    document.querySelector('#submitForm').addEventListener('click', function(event) {
        var name = document.querySelector('#name').value;
        if (!name.trim()) {
            event.preventDefault();
            alert("Name field is required!");
        }
    });

    // Smooth Scroll to anchor links
    document.querySelectorAll('a').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            if (this.hash !== "") {
                e.preventDefault();
                var target = document.querySelector(this.hash);
                window.scrollTo({
                    top: target.offsetTop - 50, 
                    behavior: "smooth"
                });
            }
        });
    });

    // Modal functionality (Open and close modal)
    document.querySelector('#openModalButton').addEventListener('click', function() {
        document.querySelector('#modal').style.display = 'block';
    });

    document.querySelector('#closeModalButton').addEventListener('click', function() {
        document.querySelector('#modal').style.display = 'none';
    });

});
