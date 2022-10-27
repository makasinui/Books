import axios from 'axios';
import { createStore } from 'vuex'


export const store = createStore({
    state: {
        authors: null,
        sections: null,
        user: null,
    },
    mutations: {
        setUser(state, data) {
            state.user = Object.assign({}, data);
        },
        setAuthors(state, data) {
            state.authors = data;
        },
        setSections(state, data) {
            state.sections = data;
        }
    },
    getters: {
        isLoading(state) {
            return state.loading;
        }
    },
    actions: {
        async getUser({ state, commit }) {
            if (state.user) return true;

            await axios.get('/api/user')
            .then(({data})=>{
                commit('setUser', data);
            })
            .catch(() => {
                commit('setUser', {});
            })
        },
        async getAuthors({ state, commit }) {
            await axios.get("/api/authors")
            .then(({data}) => {
                commit('setAuthors', data.data);
            })
            .catch((e) => {
                commit('setAuthors', data);
            });
        },
        async getSections({ state, commit }) {
            await axios.get("/api/sections")
            .then(({data}) => {
                commit('setSections', data.data);
            })
            .catch((e) => {
                commit('setSecitons', {});
            });
        },

        async deleteBook({ state, commit }, id) {
            const { data } = await axios.delete("/api/books/" + id);
            return data;
        },
        async deleteSection({ state, commit }, id) {
            const { data } = await axios.delete("/api/sections/" + id);
            return data;
        },
        async deleteAuthor({ state, commit }, id) {
            const { data } = await axios.delete("/api/authors/" + id);
            return data;
        }
        
    }
});