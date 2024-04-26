import axios from "axios";
import {createStore} from "vuex"
import router from "./router";



const store=createStore({
    state:{
        user:{
            data:{},
            token:sessionStorage.getItem("TOKEN"),
            name:sessionStorage.getItem("Name"),
            email:"",
        },
        posts:{},
        tourns:{},
        leagues:{},
        games:{}
    },
    getters:{},
    actions:{
         register({commit},user){
            axios.post("http://127.0.0.1:8000/api/register",JSON.stringify(user),{
                headers:{
                    "Content-Type":"application/json",
                    Accept:"application/json"
                }
            })
            .then((res)=>{
                commit("setUser",res.data);
                router.push({name:"HomePage"})
            }).catch(err=>console.log(err))
            
            
        },getCurrentUser({commit},user){
            axios.get("http://127.0.0.1:8000/api/user/"+user)
                .then((res)=>{
                    commit("getUser",res.data)})
                .catch(err=>console.log(err))
        },getPosts({commit}){
            axios.get("http://127.0.0.1:8000/api/posts/")
            .then((res)=>{
                commit("setPosts",res.data)
                return res.data})
                
            .catch(err=>console.log(err))
        },getTourns({commit}){
            axios.get("http://127.0.0.1:8000/api/tournament/all")
            .then((res)=>{
                commit("setTourns",res.data)
                return res.data})
                
            .catch(err=>console.log(err))
        }
        ,getGames({commit}){
            axios.get("http://127.0.0.1:8000/api/game/all")
            .then((res)=>{
                commit("setGames",res.data)
                return res.data})
                
            .catch(err=>console.log(err))
        
        },getLeagues({commit}){
            axios.get("http://127.0.0.1:8000/api/league/all")
            .then((res)=>{
                commit("setLeagues",res.data)
                return res.data})
                
            .catch(err=>console.log(err))
        },logout({commit}){
            axios.get("http://127.0.0.1:8000/api/league/all")
            .then((res)=>{
                commit("setLeagues",res.data)
                return res.data})
                
            .catch(err=>console.log(err))
        },login({commit},user){
            axios.post("http://127.0.0.1:8000/api/login",user)
            .then((res)=>{
                commit("setUser",res.data)
                router.push({name:"HomePage"})
            })
                
            .catch(err=>console.log(err))
        }
    },
    mutations:{
        logout:(state)=>{
            state.user.token=null,
            state.user.data={},
            sessionStorage.removeItem("TOKEN");
            sessionStorage.removeItem("Name");
        },
        setUser:(state,userData)=>{
            state.user.token=userData.token;
            state.user.data=userData.user;
            state.user.name=userData.name;
            sessionStorage.setItem("TOKEN",userData.token);
            sessionStorage.setItem("Name",userData.name);
        },
        getUser:(state,userData)=>{
          let  data=JSON.stringify(userData.user)
            console.log(data)
            console.log(JSON.parse(data))
            state.user.data=JSON.parse(data);
            state.user.email=userData.user.email;
        },
        setPosts:(state,userData)=>{
            let  data=JSON.stringify(userData.posts)
              state.posts=JSON.parse(data);
        },
        setTourns:(state,userData)=>{
            let  data=JSON.stringify(userData.tourns)
              state.tourns=JSON.parse(data);
        },
        setLeagues:(state,userData)=>{
            let  data=JSON.stringify(userData.leagues)
              state.leagues=JSON.parse(data);
        },
        setGames:(state,userData)=>{
            let  data=JSON.stringify(userData.games)
              state.games=JSON.parse(data);
        },
    },
    modules:{}
})

export default store;