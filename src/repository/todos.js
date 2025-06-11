import api from "../services/api.js";

const TodosRepository = {
    async getAll() {
        return await api('/todo');
    },

    async create(description) {
        return await api('/todo', {
            method: 'POST',
            body: JSON.stringify({ description })
        });
    },

    async getById(id) {
        return await api(`/todo/${id}`);
    },

    async update(id, description) {
        return await api(`/todo/${id}`, {
            method: 'PUT',
            body: JSON.stringify({ description })
        });
    },

    async delete(id) {
        return await api(`/todo/${id}`, {
            method: 'DELETE'
        });
    },

    async updateStatus(id, completed) {
        return await api(`/todo/${id}`, {
            method: 'PUT',
            body: JSON.stringify({ completed })
        });
    }
};

export default TodosRepository;