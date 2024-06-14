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
            id:sessionStorage.getItem("Id"),
            acheivements:{
                tournsWon:{},
                leaguesWon:{},
                gamesWon:{},
                loading:false
            }
            
        },
        posts:{
            data:{},
            loading:false
        },
        tourns:{
            data:{},
            loading:false
        },
        leagues:{
            data:{},
            loading:false
        },
        games:{},
        currentUserGames:{
            games:{},
            loading:false
        },
        currentLeague:{
            id:sessionStorage.getItem("CurrentLeague"),
            data:{},
            members:{},
            games:[],
            loading:false,
            isJoined:false
        },
        currentTourn:{
            id:sessionStorage.getItem("currentTourn"),
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
        selectedTab:"Tourns",
        currentRoute: null,
        errorMessages:{},
        currentUserLeagues:{
            joined:{},
            created:{}
        },
        currentUserTourns:{
            joined:{},
            created:{}
        },allUsers:{
            loading:false,
            users:{}
        },allGames:{
            loading:false,
            games:{}
        },allTourns:{
            loading:false,
            tourns:{}
        },allLeagues:{
            loading:false,
            leagues:{}
        },isGuest:sessionStorage.getItem("Id") == null ? true : false, 
        currentDash:{
            users:false,
            tourns:false,
            leagues:false,
            games:false,
            createTourn:false,
            createLeague:false,
        },userProfileData:{}
        
    },
    getters:{},
    actions:{
        getPosts({commit}){
            axios.get("http://127.0.0.1:8000/api/posts/")
            .then((res)=>{
                commit("setPosts",res.data)
                return res.data})
                
            .catch(err=>console.log(err))
        },getTourns({commit}){
            axios.get("http://127.0.0.1:8000/api/tournament/all")
            .then((res)=>{commit("setTourns",res.data)})
            .catch(err=>console.log(err))
        }
        ,getGames({commit}){
            axios.get("http://127.0.0.1:8000/api/game/all")
            .then((res)=>{
                commit("setGames",res.data)
                return res.data})
                
            .catch(err=>console.log(err))
        
        },getLeagues({commit}){
            axios.get("http://127.0.0.1:8000/api/leagues/all")
            .then((res)=>{
                commit("setLeagues",res.data)
                })
                
            .catch(err=>console.log(err))
        },getCurrentUser({commit},user){
            axios.get("http://127.0.0.1:8000/api/user/"+user)
                .then((res)=>{
                    commit("getUser",res.data)})
                .catch(err=>console.log(err))
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
        },getCurrentTourn({commit,state},id){
            axios.get("http://127.0.0.1:8000/api/tournament/"+id)
            .then((res)=>{
                let tournInfo=res.data
                axios.get("http://127.0.0.1:8000/api/tournament/"+id+"/members")
                .then((re)=>{
                    let members=re.data
                    
                    axios.get("http://127.0.0.1:8000/api/tournament/"+id+"/games")
                    .then((re)=>{
                        let games=re.data
                        commit("setCurrentTourn",{tournInfo,members,games})
                        router.push("/tournaments/"+id)
                   
                    })
                })
            })
        },register({commit},user){
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
            .catch(err=>console.log(err))
            
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
        },getUserProf({commit},userId){
            axios.get("http://127.0.0.1:8000/api/user/"+userId)
            .then((res)=>{
                this.commit("setUserProfileData",res.data.user)
            })               
            .catch(err=>{
                    console.log(err)              
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
                        state.notification.message=re.data.message
                        this.dispatch("notifySuccess")
                    })
                    .catch(error=>{
                        state.errorMessages=JSON.parse(error.response.data.errors);
                    })

        },deleteLeague({commit,state},leagueId){
            axiosClient.delete("league/delete/"+leagueId)
            .then((re)=>{             
                commit("setNotify",re.data.message,"success")
                router.push({name:"TopLeagues"})
            })
            .catch(error=>{
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
                if(state.currentLeague.id != ""){
                    state.currentLeague.isJoined=true;
                }
                this.dispatch("notifySuccess")
                this.dispatch("getCurrentLeague",state.currentLeague.id)
            })
            .catch(error=>{
                if(error.response.status === 401){
                    state.notification.message="You Need To Sign in First!"
                }else{
                    state.notification.message=error.response.data.errors
                }
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
                commit("updateCurrentLeagueGames",re.data.matches)
            })
            .catch(error=>{
                 state.notification.message=error.response.data.errors
                 this.dispatch("notifyError")
              
                
            })
        },kickUserFromLeague({commit,state},info){
            state.currentLeague.isJoined=false;
            axiosClient.delete("kick/user/"+info.userId+"/league/"+info.leagueId)
            .then((r)=>{    
                let message=r.data.message
                axios.get("http://127.0.0.1:8000/api/league/"+info.leagueId+"/members")
                    .then((re)=>{                    
                        state.currentLeague.members=re.data.members
                        axiosClient.post("league/" + info.leagueId +"/createGames")
                        .then((res)=>{    
                            state.notification.message=message
                            this.dispatch("notifySuccess")  
                            commit("updateCurrentLeagueGames",res.data.matches)
                        })
                        .catch(error=>{
                            console.log(error)
                            commit("updateCurrentLeagueGames",[])
                        })
                    })
            })
            .catch(error=>{
                console.log(error)              
            })
        },createTourn({commit,state},tournData){
            axiosClient.post("tournament/user/"+state.user.data.id,tournData)
                .then((re)=>{       
                    state.notification.message=re.data.message
                    this.dispatch("notifySuccess")  

                })
                .catch(error=>{
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
                state.errorMessages=JSON.parse(error.response.data.errors);
            })
        },joinTourn({commit,state},info){
                axiosClient.post("enroll/user/"+info.userId+"/tournament/"+info.tournId)
            .then((re)=>{                      
                state.notification.message=re.data.message
                if(state.currentTourn.id != ""){
                    state.currentTourn.isJoined=true;
                }
                this.dispatch("notifySuccess")
                this.dispatch("getCurrentTourn",info.tournId)
            })
            .catch(error=>{
                console.log(error.response.status)
                if(error.response.status === 401){
                    state.notification.message="You Need To Sign in First!"
                }else{
                state.notification.message=error.response.data.errors
                }
                this.dispatch("notifyError")
                
            })
        },isJoinedTourn({commit,state},info){
            axiosClient.post("isenroll/user/"+info.userId+"/tournament/"+info.tournId)
            .then((re)=>{              
                state.currentTourn.isJoined=re.data
            })
            .catch(error=>{
                state.notification.message=error.response.data.errors
                this.dispatch("notifyError")
                
            })
        },getCurrentUserTournaments({commit},id){
            axiosClient.get("user/"+id+"/tourns")
            .then((re)=>{                    
                commit("setCurrentUserTournaments",re.data)
            })
            .catch(error=>{console.log(error)})
        },createTournGames({commit,state},tournId){
            axiosClient.post("tournament/" + tournId +"/createGames")
            .then((re)=>{             
                commit("updateCurrentTournamentsGames",re.data.matches)
                
            })
            .catch(error=>{
                state.notification.message=error.response.data.errors
                this.dispatch("notifyError")
            
                
            })
        },deleteTourn({commit,state},tournId){
            axiosClient.delete("tournament/delete/"+tournId)
            .then((re)=>{             
                commit("setNotify",re.data.message,"success")
                router.push({name:"TopTourns"})
            })
            .catch(error=>{
                state.errorMessages=JSON.parse(error.response.data.errors);
            })
        },kickUserFromTourn({commit,state},info){
            state.currentTourn.isJoined=false;
            axiosClient.delete("kick/user/"+info.userId+"/tournament/"+info.tournId)
            .then((r)=>{    
                let message=r.data.message
                axios.get("http://127.0.0.1:8000/api/tournament/"+info.tournId+"/members")
                    .then((re)=>{                    
                        state.currentTourn.members=re.data.members
                        axiosClient.post("tournament/" + info.tournId +"/createGames")
                        .then((res)=>{    
                            state.notification.message=message
                            this.dispatch("notifySuccess")  
                            commit("updateCurrentTournamentsGames",res.data.matches)
                        })
                        .catch(error=>{
                            console.log(error)
                            commit("updateCurrentTournamentsGames",[])
                        })
                    })
            })
            .catch(error=>{
                console.log(error)              
            })
        },getAllGames({commit,state}){
            axios.get("http://127.0.0.1:8000/api/game/all")
            .then(re=>{
                commit("updateAllGamesData",re.data.games);
            })
            .catch(err=>console.log(err))
        },getUserGames({state,commit},userId){
            axios.get("http://127.0.0.1:8000/api/"+userId+"/games")
            .then(re=>{
                commit("getUserGames",re.data);
            })
            .catch(err=>console.log(err))
        },getAllUsers({state,commit}){
           
            axios.get("http://127.0.0.1:8000/api/users/all")
            .then(re=>{
                commit("getAllUsers",re.data.users);
            })
            .catch(err=>console.log(err))
        },getAllTourns({state,commit}){
           
            axios.get("http://127.0.0.1:8000/api/tourns/all")
            .then(re=>{
                commit("getAllTourns",re.data.tourns);
            })
            .catch(err=>console.log(err))
        },getAllLeagues({state,commit}){         
            axios.get("http://127.0.0.1:8000/api/leagues/all")
            .then(re=>{
                commit("getAllLeagues",re.data.leagues);
            })
            .catch(err=>console.log(err))
        },deleteUser({commit,dispatch,state},userId){
            axiosClient.delete('user/' + userId+'/delete')
            .then(res=>{                                      
                    state.notification.message=res.data.message
                    this.dispatch("notifySuccess") 
                    this.dispatch("getAllUsers")         
            })
            .catch(err=>console.log(err))
        },deleteTournament({commit,dispatch,state},tournId){
            axiosClient.delete('tournament/delete/' + tournId)
            .then(res=>{                                      
                    state.notification.message=res.data.message
                    this.dispatch("notifySuccess") 
                    this.dispatch("getAllTourns")         
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },deleteLeagues({commit,dispatch,state},leagueId){
            axiosClient.delete('league/delete/' + leagueId)
            .then(res=>{                                      
                    state.notification.message=res.data.message
                    this.dispatch("notifySuccess") 
                    this.dispatch("getAllLeagues")         
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },deleteGames({commit,dispatch,state},gamesId){
            axiosClient.delete('game/'+gamesId+'/delete')
            .then(res=>{                                      
                    state.notification.message=res.data.message
                    this.dispatch("notifySuccess") 
                    this.dispatch("getAllGames")         
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
                console.log(err)
            })
        },getUserAcheivements({commit,dispatch,state},userId){
            axios.get("http://127.0.0.1:8000/api/user/"+userId+"/winningLeagues")
            .then(re1=>{
               let leagues=re1.data.Leagues;
                axios.get("http://127.0.0.1:8000/api/user/"+userId+"/winningTournaments")
                    .then(re2=>{
                        let tourns=re2.data.Tournaments;
                        axios.get("http://127.0.0.1:8000/api/user/"+userId+"/winningGames")
                            .then(re3=>{
                                let  games=re3.data.Games;
                                commit("setUserAcheivements",{leagues,tourns,games});
                            })
                            .catch(err3=>console.log(err3))
                    })
                    .catch(err2=>console.log(err2))
            })
            .catch(err1=>console.log(err1))
        },createPost({commit,dispatch,state},info){
            axiosClient.post("post/user/"+info.id,info)
            .then(res=>{      
                    console.log(res)                                
                    state.notification.message=res.data.message
                    this.dispatch("notifySuccess") 
                    this.dispatch("getPosts")         
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
                console.log(err)
            })
        },likeOrUnlikePost({commit,dispatch,state},info){
            axiosClient.put("post/"+info.postId+"/user/"+info.userId+"/like",info)
            .then(res=>{      
                               
            })
            .catch(err=>{
                console.log(err)
            })
        }
    },
    mutations:{
        logout:(state)=>{
            state.user.token=null,
            state.user.data={},
            sessionStorage.removeItem("TOKEN");
            sessionStorage.removeItem("Name");
            sessionStorage.removeItem("Id");
            state.user.id=null;
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
              state.tourns.data=JSON.parse(data);
              state.tourns.loading=true;
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
        },setCurrentTourn:(state,userData)=>{          
                let  data=JSON.stringify(userData.tournInfo.Tournament)
                state.currentTourn.data=JSON.parse(data);
                state.currentTourn.members=userData.members.members;
                state.currentTourn.games=userData.games.Games;
                state.currentTourn.loading=true;
                sessionStorage.setItem("currentTourn",userData.tournInfo.Tournament.id);
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
        },setCurrentUserTournaments(state,userData){
            state.currentUserTourns.joined=userData.joined_Tourns;
            state.currentUserTourns.created=userData.created_Tourns;
        },updateCurrentTournamentsGames(state,info){
            state.currentTourn.games=info
        },updateAllGamesData(state,info){
            state.allGames.loading=true;
            state.allGames.games=info;
        },getUserGames(state,info){
            state.currentUserGames.games=info;
            state.currentUserGames.loading=true;
        },getAllUsers(state,info){
            state.allUsers.loading=true;
            state.allUsers.users=info;
        },getAllTourns(state,info){
            state.allTourns.loading=true;
            state.allTourns.tourns=info;
        },getAllLeagues(state,info){
            state.allLeagues.loading=true;
            state.allLeagues.leagues=info;
        },setUserAcheivements(state,info){
            state.user.acheivements.leaguesWon=info.leagues;
            state.user.acheivements.tournsWon=info.tourns;
            state.user.acheivements.gamesWon=info.games;
            state.user.acheivements.loading=true;
        },setSelectedTab(state,tab){
            state.selectedTab=tab;
        },setUserProfileData(state,info){
            state.userProfileData=info;
        }
    },
    modules:{}
})

export default store;