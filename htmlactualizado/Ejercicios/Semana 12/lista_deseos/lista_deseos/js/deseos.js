document.addEventListener('DOMContentLoaded', function () {
  const taskForm = document.getElementById('task-form');
  const taskList = document.getElementById('task-list');

  function loadTasks() {
      fetch('api_tasks.php', {
          method: 'GET'
      })
      .then(response => response.json())
      .then(tasks => {
          renderTasks(tasks);
      })
      .catch(error => console.error('Error al cargar tareas:', error));
  }

  function addTask(task) {
      fetch('api_tasks.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify(task),
      })
      .then(response => response.json())
      .then(data => {
          if (data.message) {
              loadTasks();
          } else {
              console.error('Error al agregar tarea:', data.error);
          }
      })
      .catch(error => console.error('Error al agregar tarea:', error));
  }

  function updateTask(task) {
      fetch('api_tasks.php', {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify(task),
      })
      .then(response => response.json())
      .then(data => {
          if (data.message) {
              loadTasks();
          } else {
              console.error('Error al actualizar tarea:', data.error);
          }
      })
      .catch(error => console.error('Error al actualizar tarea:', error));
  }

  function deleteTask(id) {
      fetch('api_tasks.php', {
          method: 'DELETE',
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify({ id }),
      })
      .then(response => response.json())
      .then(data => {
          if (data.message) {
              loadTasks();
          } else {
              console.error('Error al eliminar tarea:', data.error);
          }
      })
      .catch(error => console.error('Error al eliminar tarea:', error));
  }

  function renderTasks(tasks) {
      taskList.innerHTML = '';
      tasks.forEach(task => {
          const taskCard = document.createElement('div');
          taskCard.className = 'col-md-4 mb-3';
          taskCard.innerHTML = `
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">${task.title}</h5>
                      <p class="card-text">${task.description}</p>
                      <p class="card-text"><small class="text-muted">Due: ${task.dueDate}</small></p>
                  </div>
                  <div class="card-footer d-flex justify-content-between">
                      <button class="btn btn-secondary btn-sm edit-task" data-id="${task.id}">Edit</button>
                      <button class="btn btn-danger btn-sm delete-task" data-id="${task.id}">Delete</button>
                  </div>
              </div>
          `;
          taskList.appendChild(taskCard);
      });

      document.querySelectorAll('.edit-task').forEach(button => {
          button.addEventListener('click', handleEditTask);
      });

      document.querySelectorAll('.delete-task').forEach(button => {
          button.addEventListener('click', function () {
              const taskId = parseInt(this.dataset.id);
              deleteTask(taskId);
          });
      });
  }

  function handleEditTask(event) {
      const taskId = parseInt(event.target.dataset.id);

      fetch('api_tasks.php', {
          method: 'GET'
      })
      .then(response => response.json())
      .then(tasks => {
          const task = tasks.find(t => t.id === taskId);
          if (task) {
              document.getElementById('task-id').value = task.id;
              document.getElementById('task-title').value = task.title;
              document.getElementById('task-desc').value = task.description;
              document.getElementById('due-date').value = task.dueDate;

              const modal = new bootstrap.Modal(document.getElementById('taskModal'));
              modal.show();
          }
      });
  }

  taskForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const taskId = document.getElementById('task-id').value;
      const title = document.getElementById('task-title').value;
      const description = document.getElementById('task-desc').value;
      const dueDate = document.getElementById('due-date').value;

      const taskData = {
          id: taskId ? parseInt(taskId) : undefined,
          title,
          description,
          dueDate
      };

      if (taskId) {
          updateTask(taskData);
      } else {
          addTask(taskData);
      }

      document.getElementById('task-id').value = '';
      taskForm.reset();
      const modal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
      modal.hide();
  });

  loadTasks();
});
