// Store all todos here
let todos = [];

// Get DOM elements
const form = document.getElementById('todo-form');
const input = document.getElementById('todo-input');
const list = document.getElementById('todo-list');


// Load existing todos from localStorage
function loadTodos() {
  const saved = localStorage.getItem('todos');

  if (!saved) {
    todos = [];
    return;
  }

  todos = JSON.parse(saved);

  // Clear current list in DOM
  list.innerHTML = '';

  // Render each todo
  todos.forEach((todo) => {
    const li = createTodoItem(todo);
    list.appendChild(li);
  });
}


// Save todos to localStorage
function saveTodos() {
  const json = JSON.stringify(todos);
  localStorage.setItem('todos', json);
}


// Create one todo <li> element from a todo object
function createTodoItem(todo) {
  const li = document.createElement('li');
  li.classList.add('todo-item');
  li.dataset.id = todo.id; // Store id in the li

  const checkbox = document.createElement('input');
  checkbox.type = 'checkbox';
  checkbox.checked = todo.completed;

  const span = document.createElement('span');
  span.classList.add('todo-text');
  span.textContent = todo.text;

  const actions = document.createElement('div');
  actions.classList.add('todo-actions');

  const editBtn = document.createElement('button');
  editBtn.textContent = 'Edit';
  editBtn.classList.add('edit-btn');

  const deleteBtn = document.createElement('button');
  deleteBtn.textContent = 'Delete';
  deleteBtn.classList.add('delete-btn');

  actions.appendChild(editBtn);
  actions.appendChild(deleteBtn);

  li.appendChild(checkbox);
  li.appendChild(span);
  li.appendChild(actions);

  if (todo.completed) {
    li.classList.add('completed');
  }

  return li;
}


// Add new task
form.addEventListener('submit', (event) => {
  event.preventDefault(); 
  const text = input.value.trim();

  if (text === '') {
    return;
  }

  // Create todo object
  const todo = {
    id: Date.now(),
    text: text,
    completed: false
  };
  todos.push(todo);
  // Save to localStorage
  saveTodos();
  const li = createTodoItem(todo);
  list.appendChild(li);
  input.value = '';
});


// Handle checkbox, delete, and edit in ONE listener
list.addEventListener('click', (event) => {
  const target = event.target;
  const li = target.closest('.todo-item');

  if (!li) {
    return;
  }

  const id = Number(li.dataset.id);

  // 1. Checkbox: mark complete / incomplete
  if (target.type === 'checkbox') {
    const todo = todos.find(function (t) {
      return t.id === id;
    });

    if (!todo) return;

    todo.completed = target.checked;

    if (todo.completed) {
      li.classList.add('completed');
    } else {
      li.classList.remove('completed');
    }

    saveTodos();
  }

  // 2. Delete: ONLY if completed
  if (target.matches('button.delete-btn')) {
    const todo = todos.find(function (t) {
      return t.id === id;
    });

    if (!todo) return;

    // Check completed status before deleting
    if (!todo.completed) {
      alert('For you to delete a task Complete it first.');
      return;
    }

    // Remove from array
    todos = todos.filter((t) => {
      return t.id !== id;
    });

    // Remove from DOM
    li.remove();

    // Save new array
    saveTodos();
  }

  // 3. Edit (using prompt)
  if (target.matches('button.edit-btn')) {
    const todo = todos.find( (t) => {
      return t.id === id;
    });

    if (!todo) return;

    const newText = prompt('Edit your task:', todo.text);

    if (newText !== null) {
      const trimmed = newText.trim();
      if (trimmed !== '') {
        todo.text = trimmed;

        const span = li.querySelector('.todo-text');
        span.textContent = trimmed;

        saveTodos();
      }
    }
  }
});


// Initial load
loadTodos();
