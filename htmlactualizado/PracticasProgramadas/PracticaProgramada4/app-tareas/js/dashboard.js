
let currentTaskId = null;

document.addEventListener('DOMContentLoaded', function() {

    const tasks = [
        {
            id: 1,
            title: "Complete project report",
            description: "Prepare and submit the project report",
            dueDate: "2024-12-01"
        },
        {
            id: 2,
            title: "Team Meeting",
            description: "Get ready for the season",
            dueDate: "2024-12-01"
        },
        {
            id: 3,
            title: "Code Review",
            description: "Check partners code",
            dueDate: "2024-12-01"
        }
    ];

    function loadTasks() {
        const taskList = document.getElementById('task-list');
        taskList.innerHTML = '';
        tasks.forEach(function(task) {
            const taskCard = document.createElement('div');
            taskCard.className = 'col-md-4 mb-3';
            taskCard.innerHTML = `
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">${task.title}</h5>
                    <p class="card-text">${task.description}</p>
                    <p class="card-text"><small class="text-muted">Due: ${task.dueDate}</small></p>
                    <div id="comments-list-${task.id}"></div>
                    <input type="text" id="new-comment-${task.id}" class="form-control mt-2" placeholder="Add a comment">
                    <button class="btn btn-primary btn-sm mt-2" id="add-comment-${task.id}">Add Comment</button>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-secondary btn-sm edit-task" data-id="${task.id}">Edit</button>
                    <button class="btn btn-danger btn-sm delete-task" data-id="${task.id}">Delete</button>
                </div>
            </div>
            `;
            taskList.appendChild(taskCard);

            const addCommentButton = document.getElementById(`add-comment-${task.id}`);
            addCommentButton.addEventListener('click', function() {
                addComment(task.id);
            });
        });

        document.querySelectorAll('.edit-task').forEach(function(button) {
            button.addEventListener('click', handleEditTask);
        });
        document.querySelectorAll('.delete-task').forEach(function(button) {
            button.addEventListener('click', handleDeleteTask);
        });
    }

    function addComment(taskId) {
        const commentInput = document.getElementById(`new-comment-${taskId}`);
        const commentText = commentInput.value.trim();

        if (commentText) {
            const commentsList = document.getElementById(`comments-list-${taskId}`);
            const commentDiv = document.createElement('div');
            commentDiv.classList.add('d-flex', 'justify-content-between', 'mb-2');
            commentDiv.innerHTML = `
                <span>${commentText}</span>
                <button class="btn btn-danger btn-sm" onclick="deleteComment(this)">Delete</button>
            `;
            commentsList.appendChild(commentDiv);
            commentInput.value = '';
        }
    }

    window.deleteComment = function(button) {
        const commentDiv = button.closest('div');
        commentDiv.remove();
    };

    function handleEditTask(event) {
        const taskId = parseInt(event.target.dataset.id);
        const task = tasks.find(t => t.id === taskId);
        if (task) {
            document.getElementById('task-id').value = task.id;
            document.getElementById('task-title').value = task.title;
            document.getElementById('task-desc').value = task.description;
            document.getElementById('due-date').value = task.dueDate;

            currentTaskId = taskId;
            const modal = new bootstrap.Modal(document.getElementById('taskModal'));
            modal.show();
        }
    }

    function handleDeleteTask(event) {
        const taskId = parseInt(event.target.dataset.id);
        const taskIndex = tasks.findIndex(t => t.id === taskId);
        if (taskIndex !== -1) {
            tasks.splice(taskIndex, 1);
            loadTasks();
        }
    }

    document.getElementById('task-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const taskTitle = document.getElementById('task-title').value.trim();
        const taskDesc = document.getElementById('task-desc').value.trim();
        const dueDate = document.getElementById('due-date').value;

        if (!taskTitle || !taskDesc || !dueDate) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        if (currentTaskId) {
            const taskIndex = tasks.findIndex(t => t.id === parseInt(currentTaskId));
            tasks[taskIndex] = {
                id: parseInt(currentTaskId),
                title: taskTitle,
                description: taskDesc,
                dueDate: dueDate
            };
        } else {
            const newTask = {
                id: tasks.length > 0 ? Math.max(...tasks.map(t => t.id)) + 1 : 1,
                title: taskTitle,
                description: taskDesc,
                dueDate: dueDate
            };
            tasks.push(newTask);
        }

        document.getElementById('task-id').value = '';
        currentTaskId = null;
        e.target.reset();

        loadTasks();

        const modal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
        if (modal) modal.hide();
    });

    loadTasks();
});
