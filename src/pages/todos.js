import Auth from "../services/auth.js";
import location from "../services/location.js";
import loading from "../services/loading.js";
import TodosRepository from "../repository/todos.js";
import Form from "../components/form.js";

const init = async () => {
    const { ok: isLogged } = await Auth.me();

    if (!isLogged) {
        return location.login();
    } else {
        loading.stop();
    }

    const todoListEl = document.getElementById('todo-list');
    const formEl = document.getElementById('todo-form');

    new Form(formEl, {
        'description': (value) => {
            if (!value) {
                return 'Description is required';
            }
            if (value.length < 3) {
                return 'Description must be at least 3 characters';
            }
            if (value.length > 100) {
                return 'Description must be less than 100 characters';
            }
            return false;
        }
    }, async (values) => {
        loading.start();
        try {
            const response = await TodosRepository.create(values.description);
            if (response.ok) {
                await renderTodos();
                formEl.reset();
            }
        } catch (error) {
            console.error('Error creating todo:', error);
        } finally {
            loading.stop();
        }
    });

const renderTodos = async () => {
    loading.start();
    try {
        const response = await TodosRepository.getAll();
        if (response.ok) {
            const todos = response.data;
            todoListEl.innerHTML = '';
            todos.forEach(todo => {
                const todoEl = document.createElement('div');
                todoEl.className = 'todo-item';
                todoEl.innerHTML = `
                    <input
                        type="checkbox"
                        class="todo-item__checkbox"
                        data-todo-id="${todo.id}"
                        ${todo.completed ? 'checked' : ''}
                    >
                    <span class="todo-item__description">${todo.description}</span>
                    <button class="todo-item__delete" data-todo-id="${todo.id}">Delete</button>
                `;
                todoListEl.appendChild(todoEl);
            });

            document.querySelectorAll('.todo-item__delete').forEach(button => {
                button.addEventListener('click', async () => {
                    const todoId = button.getAttribute('data-todo-id');
                    loading.start();
                    try {
                        const response = await TodosRepository.delete(todoId);
                        if (response.ok) {
                            await renderTodos();
                        }
                    } catch (error) {
                        console.error('Error deleting todo:', error);
                    } finally {
                        loading.stop();
                    }
                });
            });

            document.querySelectorAll('.todo-item__checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', async (event) => {
                    const todoId = checkbox.getAttribute('data-todo-id');
                    const completed = checkbox.checked;
                    loading.start();
                    try {
                        const response = await TodosRepository.updateStatus(todoId, completed);
                        if (!response.ok) {
                            checkbox.checked = !completed;
                        }
                    } catch (error) {
                        console.error('Error updating todo status:', error);
                        checkbox.checked = !completed;
                    } finally {
                        loading.stop();
                    }
                });
            });
        }
    } catch (error) {
        console.error('Error fetching todos:', error);
    } finally {
        loading.stop();
    }
};

    await renderTodos();
};

if (document.readyState === 'loading') {
    document.addEventListener("DOMContentLoaded", init);
} else {
    init();
};