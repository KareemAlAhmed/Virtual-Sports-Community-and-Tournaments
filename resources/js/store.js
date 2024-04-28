import axios from "axios";
import {createStore} from "vuex"
import router from "./router";
import axiosClient from "./axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";




const store=createStore({
    state:{
        user:{
            data:{},
            token:sessionStorage.getItem("TOKEN"),
            name:sessionStorage.getItem("Name"),
            email:"",
            id:sessionStorage.getItem("Id")
        },
        posts:{
            data:{},
            loading:false
        },
        tourns:{},
        leagues:{
            data:{},
            loading:false
        },
        games:{},
        currentLeague:{
            id:sessionStorage.getItem("CurrentLeague"),
            data:{},
            members:{},
            games:[],
            loading:false,
            isJoined:false
        },
        notification:{
            show:false,
            type:"",
            message:""
        },
        currentRoute: null,
        errorMessages:{},
        currentUserLeagues:{
            joined:{},
            created:{}
        }
       
        
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
                commit("setNotify",res.data.message,"success")
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
                })
                
            .catch(err=>console.log(err))
        },logout({state,commit}){
            axiosClient.post('/logout')
            .then(res=>{               
                commit('logout')                
                if(state.currentRoute.href !="/"){
                    commit("setNotify","Logout Successully","success")
                }else{
                    state.notification.message="Logout Successully"
                    this.dispatch("notifySuccess")
                }
                router.push({name:"HomePage"})
            
            })
            .then(err=>console.log(err))
            
        },login({commit},user){
            axios.post("http://127.0.0.1:8000/api/login",user)
            .then((res)=>{
                commit("setUser",res.data)
                commit("setNotify",res.data.message,"success")
                router.push({name:"HomePage"})
            })               
            .catch(err=>{
                    commit("setNotify","Credential Incorrect","error")
                    this.dispatch("notifyError")               
                })
        },getCurrentLeague({commit,state},id){
            axios.get("http://127.0.0.1:8000/api/league/"+id)
            .then((res)=>{
                let leagueInfo=res.data
                axios.get("http://127.0.0.1:8000/api/league/"+id+"/members")
                .then((re)=>{
                    let members=re.data
                    
                    axios.get("http://127.0.0.1:8000/api/league/"+id+"/games")
                    .then((re)=>{
                        let games=re.data
                        commit("setCurrentLeague",{leagueInfo,members,games})
                        router.push("/leagues/"+id)
                   
                    })
                })
            })
        },notifySuccess(){
            toast(this.state.notification.message, {
                "theme": "dark",
                "type": "success",
                "position": "bottom-right",
                "autoClose": 2000,
                "transition": "flip",
                "dangerouslyHTMLString": true
            })
        }
        ,notifyError(){
            toast(this.state.notification.message, {
                "theme": "dark",
                "type": "error",
                "position": "bottom-right",
                "autoClose": 2000,
                "transition": "flip",
                "dangerouslyHTMLString": true
            })
        },createLeague({commit,state},leagueData){
                axiosClient.post("league/user/"+state.user.data.id,leagueData)
                    .then((re)=>{                      
                        commit("setNotify",re.data.message,"success")
                        // state.notification.message=re.data.message
                        // this.dispatch("notifySuccess")
                        router.push({name:"TopLeagues"})
                    })
                    .catch(error=>{
                        // console.log(JSON.parse(error.response.data.errors))
                     
                        console.log(error)
                        state.errorMessages=JSON.parse(error.response.data.errors);
                    })

        },deleteLeague({commit,state},leagueId){
            axiosClient.delete("league/delete/"+leagueId)
            .then((re)=>{             
                commit("setNotify",re.data.message,"success")
                router.push({name:"TopLeagues"})
            })
            .catch(error=>{
                // console.log(JSON.parse(error.response.data.errors))
            
                console.log(error)
                state.errorMessages=JSON.parse(error.response.data.errors);
            })
        },getCurrentUserLeagues({commit},id){
            axiosClient.get("user/"+id+"/leagues")
            .then((re)=>{                      
                commit("setCurrentUserLeagues",re.data)
            })
            .catch(error=>{console.log(error)})
        },joinLeague({commit,state},info){
            axiosClient.post("enroll/user/"+info.userId+"/league/"+info.leagueId)
            .then((re)=>{                      
                state.notification.message=re.data.message
                this.dispatch("notifySuccess")
                this.dispatch("getCurrentLeague",state.currentLeague.id)
            })
            .catch(error=>{
                state.notification.message=error.response.data.errors
                this.dispatch("notifyError")
                
            })
        },isJoinedLeague({commit,state},info){
            axiosClient.post("isenroll/user/"+info.userId+"/league/"+info.leagueId)
            .then((re)=>{              
                // console.log(re.data)  

                state.currentLeague.isJoined=re.data
                // this.dispatch("getCurrentLeague",state.currentLeague.id)
            })
            .catch(error=>{
                state.notification.message=error.response.data.errors
                this.dispatch("notifyError")
                
            })
        },createLeagueGames({commit,state},leagueId){
            axiosClient.post("league/" + leagueId +"/createGames")
            .then((re)=>{    
                console.log(re.data)          
                commit("updateCurrentLeagueGames",re.data.matches)
            })
            .catch(error=>{
                // state.notification.message=error.response.data.errors
                // this.dispatch("notifyError")
                console.log(error)
                
            })
        },kickUserFromLeague({commit,state},info){
            axiosClient.delete("kick/user/"+info.userId+"/league/"+info.leagueId)
            .then((r)=>{    
                let message=r.data.message
                axios.get("http://127.0.0.1:8000/api/league/"+info.leagueId+"/members")
                    .then((re)=>{                    
                        state.currentLeague.members=re.data.members
                        console.log(re)
                        axiosClient.post("league/" + info.leagueId +"/createGames")
                        .then((res)=>{    
                            state.notification.message=message
                            this.dispatch("notifySuccess")  
                            commit("updateCurrentLeagueGames",res.data.matches)
                        })
                        .catch(error=>{
                            console.log(error)
                            
                        })
                    })
                      
                // commit("updateCurrentLeagueGames",re.data.matches)
            })
            .catch(error=>{
                // state.notification.message=error.response.data.errors
                // this.dispatch("notifyError")
                console.log(error)
                
            })
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
            state.user.id=userData.user.id;
            state.user.name=userData.name;
            sessionStorage.setItem("TOKEN",userData.token);
            sessionStorage.setItem("Name",userData.name);
            sessionStorage.setItem("Id",userData.user.id);
        },
        getUser:(state,userData)=>{
          let  data=JSON.stringify(userData.user)
            state.user.data=JSON.parse(data);
            state.user.email=userData.user.email;
        },
        setPosts:(state,userData)=>{
            let  data=JSON.stringify(userData.posts)
              state.posts.data=JSON.parse(data);
              
              setTimeout(() => {
                state.posts.loading=true;
              }, 3000);
        },
        setTourns:(state,userData)=>{
            let  data=JSON.stringify(userData.tourns)
              state.tourns=JSON.parse(data);
        },
        setLeagues:(state,userData)=>{
            let  data=JSON.stringify(userData.leagues)
              state.leagues.data=JSON.parse(data);
              state.leagues.loading=true;
        },
        setGames:(state,userData)=>{
            let  data=JSON.stringify(userData.games)
              state.games=JSON.parse(data);
        },setCurrentLeague:(state,userData)=>{
            
                let  data=JSON.stringify(userData.leagueInfo.League)
                state.currentLeague.data=JSON.parse(data);
                state.currentLeague.members=userData.members.members;
                state.currentLeague.games=userData.games.Games;
                state.currentLeague.loading=true;
                sessionStorage.setItem("CurrentLeague",userData.leagueInfo.League.id);
        },setNotify(state,message,type){
            state.notification.show=true;
            state.notification.message=message;
            state.notification.type=type;
            setTimeout(() => {
                state.notification.show=false;
              }, 3000);
        },updateCurrentRoute(state, payload) {
            state.currentRoute = payload.route;
        },setCurrentUserLeagues(state,userData){
            state.currentUserLeagues.joined=userData.joined_Leagues;
            state.currentUserLeagues.created=userData.created_Leagues;
        },updateCurrentLeagueGames(state,info){
            state.currentLeague.games=info
        }
    },
    modules:{}
})

export default store;