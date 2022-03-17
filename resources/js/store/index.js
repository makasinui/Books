import { createStore } from 'vuex'
import axios from 'axios'

export default createStore({

  state: { 
    searchValue:'',
    cart:[],
    cartCount:0,
    products:[],
    news_short:[],
    news:[],
    products_sssr:[],
    products_rus:[],
    products_asia:[]
  },
  mutations: {
    SET_SEARCH_VALUE_TO_VUEX:(state,value) =>{
      state.searchValue = value
    },
    
  },
  actions: {
    GET_SEARCH_VALUE_TO_VUEX({commit}, value) {
      commit('SET_SEARCH_VALUE_TO_VUEX',value)
    },
    GET_NEWS_SHORT_FROM_API({commit}){
      return axios('https://json-servermakasinui.herokuapp.com/news_short', {
        method:"GET"
      })
      .then((news_short) =>{
        commit('SET_NEWS_SHORT_TO_STATE',news_short.data)
        return news_short
      })
      .catch((error)=>{
        console.log(error);
        return error;
      })},

  DELETE_FROM_CART({commit}, index){
    commit('REMOVE_FROM_CART', index)
  }
},
  getters:{
    SEARCH_VALUE(state){
      return state.searchValue
    },
    NEWS_SHORT(state){
      return state.news_short;
    },
  },
  modules: {
  },

})