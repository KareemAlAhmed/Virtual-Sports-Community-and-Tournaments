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
            },
            posts:{},
            followers:sessionStorage.getItem("followers")!=null ? JSON.parse(sessionStorage.getItem("followers")) : [],
            followed:sessionStorage.getItem("followers")!=null ? JSON.parse(sessionStorage.getItem("followed")) : [],
            followingRequestsToUser:sessionStorage.getItem("followers")!=null ?  JSON.parse(sessionStorage.getItem("followingRequestsToUser")) : [],
            followingRequestsFromUser:sessionStorage.getItem("followers")!=null ? JSON.parse(sessionStorage.getItem("followingRequestsFromUser")) : [],
            contacts:sessionStorage.getItem("contacts")!=null ? JSON.parse(sessionStorage.getItem("contacts")) : [],

        },
        posts:{
            data:{},
            loading:false
        },allUsers:{
            loading:false,
            users:{}
        },allTourns:{
            loading:false,
            tourns:{}
        },allLeagues:{
            loading:false,
            leagues:{}
        },allGames:{
            loading:false,
            games:{}
        },
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
            isJoined:false,
            winnerId:null
        },
        currentTourn:{
            id:sessionStorage.getItem("currentTourn"),
            data:{},
            members:{},
            games:[],
            loading:false,
            isJoined:false,
            winnerId:null
        },
        notification:{
            show:false,
            type:"",
            message:""
        },currentUserLeagues:{
            joined:{},
            created:{}
        },currentUserTourns:{
            joined:{},
            created:{}
        },selectedTab:"Tourns",
        currentRoute: null,
        errorMessages:{},    
        isGuest:sessionStorage.getItem("Id") == null ? true : false, 
        currentDash:{
            users:false,
            tourns:false,
            leagues:false,
            games:false,
            createTourn:false,
            createLeague:false,
        },userProfileData:{}
        ,userSocialInfo:{
            followers:[],
            following:[],
            followRequestsToUser:[],
            followRequestsFromUser:[]
        }
        ,commentStatus:false
        ,currentPost:{
            comments:{},
            loading:false,
            data:{}
        },postToEditId:sessionStorage.getItem("postToEditId"),
        currentUser:{
            followed:false,
            requestSent:false,
        },currentSocialOpt:{
            follower:false,
            following:false,
            followingRequests:false,
            findUser:false,
        },currentSearch:{
            data:{},
            loading:false,
        },currrentMessagingUser:{
            data:sessionStorage.getItem("messgingUser")!=null ? JSON.parse(sessionStorage.getItem("messgingUser")) : [],
            msgs:[]         
        }
    },
    getters:{},
    actions:{
        register({commit},user){
            axios.post("http://127.0.0.1:8000/api/register",user)
            .then((res)=>{
                commit("setUser",res.data);             
                commit("setNotify",res.data.message,"success")
                // router.push({name:"HomePage"})
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
            
        },login({commit,state},user){
            axios.post("http://127.0.0.1:8000/api/login",user)
            .then((res)=>{
                commit("setUser",res.data)
                commit("updateUserSocial",res.data)
                this.dispatch("getContact",res.data.user.id)
 
                state.notification.message=res.data.message
                // this.dispatch("notifySuccess")
                // setTimeout(()=>{
                store.dispatch("getCurrentUserSocial",res.data.user.id)
                router.push({name:"HomePage"})
                // },1000)
            })               
            .catch(err=>{
                console.log(err)
                commit("setNotify","Credential Incorrect","error")
                this.dispatch("notifyError")               
            })
        },getPosts({commit}){
            axios.get("http://127.0.0.1:8000/api/posts/")
            .then((res)=>{
                commit("setPosts",res.data)
                return res.data
            }) 
            .catch(err=>console.log(err))
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
        },getCurrentUserLeagues({commit},id){
            axiosClient.get("user/"+id+"/leagues")
            .then((re)=>{                      
                commit("setCurrentUserLeagues",re.data)
            })
            .catch(error=>{console.log(error)})
        },getCurrentUserTournaments({commit},id){
            axiosClient.get("user/"+id+"/tourns")
            .then((re)=>{                    
                commit("setCurrentUserTournaments",re.data)
            })
            .catch(error=>{console.log(error)})
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
        },notifyError(){
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
        },deleteLeagues({commit,dispatch,state},leagueId){//for Dashboard
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
                state.currentLeague.isJoined=re.data
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
                    if(error.response.data.status == 403){
                        state.notification.message=error.response.data.errors
                        this.dispatch("notifyError")
                    }else{
                    state.errorMessages=JSON.parse(error.response.data.errors);
                    }
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
        },deleteTournament({commit,dispatch,state},tournId){//for Dashboard
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
        },createTournGames({commit,state},tournId){
            axiosClient.post("tournament/" + tournId +"/createGames")
            .then((re)=>{             
                commit("updateCurrentTournamentsGames",re.data.matches)     
            })
            .catch(error=>{
                state.notification.message=error.response.data.errors
                this.dispatch("notifyError")       
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
        },deleteUser({commit,dispatch,state},userId){
            axiosClient.delete('user/' + userId+'/delete')
            .then(res=>{                                      
                state.notification.message=res.data.message
                this.dispatch("notifySuccess") 
                this.dispatch("getAllUsers")         
            })
            .catch(err=>console.log(err))
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
            axiosClient.post("post/user/"+info.get("id"),info)
            .then(res=>{                                     
                state.notification.message=res.data.message
                this.dispatch("notifySuccess") 
                this.dispatch("getPosts")         
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },deletePost({commit,dispatch,state},postId){
            axiosClient.delete("post/"+postId+"/delete")
            .then(res=>{      
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")  
                this.dispatch("getPosts") 
            })
            .catch(err=>{
                console.log(err)
            })
        },editPost({commit,dispatch,state},info){
            axiosClient.post("post/"+info.get("id")+"/edit",info)
            .then(res=>{      
                state.notification.message=res.data.message
                this.dispatch("notifySuccess") 
                router.push({name:"HomePage"})  
            })
            .catch(err=>{
                console.log(err)
            })
        },getPost({commit,dispatch,state},id){
            axios.get("http://127.0.0.1:8000/api/post/"+id)
            .then(res=>{      
                this.commit("setCurrentPostData",res.data.Post)

            })
            .catch(err=>{
                console.log(err)
            })
        },sharePost({commit,dispatch,state},info){
            axiosClient.post("post/"+info.postId+"/sharedBy/"+info.userId)
            .then(res=>{      
                console.log(res.data)
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")   
                this.dispatch("getPosts")
                window.scrollTo(0, 0)
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },getUserPosts({commit,dispatch,state},id){
            axios.get("http://127.0.0.1:8000/api/user/"+id+"/posts")
            .then(res=>{      
                this.commit("setCurrentUserPost",res.data.Posts)
            })
            .catch(err=>{
                console.log(err)
            })
        },likeAPost({commit,dispatch,state},info){
            axiosClient.post("user/"+info.userId+"/like/post/"+info.postId,info)
            .then(res=>{})
            .catch(err=>{
                console.log(err)
            })
        },UnlikeAPost({commit,dispatch,state},info){
            axiosClient.delete("user/"+info.userId+"/unlike/post/"+info.postId,info)
            .then(res=>{})
            .catch(err=>{
                console.log(err)
            })
        },simulateLeague({commit,dispatch,state},leagueId){
            axiosClient.post("league/"+leagueId+"/simulate")
            .then(res=>{      
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")   
                this.dispatch("getCurrentLeague",leagueId)   
            })
            .catch(err=>{
                console.log(err)
            })
        },simulateTourn({commit,dispatch,state},id){
            axiosClient.post("tournament/"+id+"/simulate")
            .then(res=>{      
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")   
                this.dispatch("getCurrentTourn",id)   
            })
            .catch(err=>{
                console.log(err)
            })
        },placeComment({commit,dispatch,state},info){
            axiosClient.post("user/"+info.userId+"/commentOn/post/"+info.postId,info)
            .then(res=>{      
                this.commit("setCommentStatus",true);
            })
            .catch(err=>{
                state.notification.message=JSON.parse(err.response.data.errors)["text"]
                this.dispatch("notifyError")
                this.commit("setCommentStatus",false);
    
            })
        },deleteComment({commit,dispatch,state},info){
            axiosClient.delete("delete/comment/"+info.commentId)
            .then(res=>{      
                this.dispatch("getCurrentPostComments",info.postId)
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")   
            })
            .catch(err=>{
                console.log(err)
            })
        },editComment({commit,dispatch,state},info){
            axiosClient.put("update/comment/"+info.id,info)
            .then(res=>{      
                this.dispatch("getCurrentPostComments",info.postId)
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")   
            })
            .catch(err=>{
                console.log(err)
            })
        },getCurrentPostComments({commit,dispatch,state},postId){
            axios.get("http://127.0.0.1:8000/api/post/"+postId+"/comments")
            .then(res=>{
                this.commit("setCurrentPost",res.data)
                console.log(res.data)
            })
            .catch(err=>{
                console.log(err)
            })
        },getCurrentUserSocial({commit,dispatch,state},userId){
            axios.get("http://127.0.0.1:8000/api/user/"+ userId +"/getFollowers")
            .then(res=>{
                let followers=res.data.followers;
                axios.get("http://127.0.0.1:8000/api/user/"+ userId +"/getFollowed").
                then(re=>{
                    let followed=re.data.following;
                    axiosClient.get("user/"+ userId + "/getFollowingReqguest")
                    .then(re2=>{
                        let requestsTo=re2.data.toUser
                        let requestsFrom=re2.data.fromUser
                        console.log(requestsTo)
                        console.log(requestsFrom)
                        if(state.user.id != null && userId == state.user.id){
                            this.commit("updateUserSocial",{followers,followed,requestsTo,requestsFrom})
                        }else{
                            this.commit("setUserSocialInfo",{followers,followed,requestsTo,requestsFrom})
                        }
                    }).catch(err=> console.log(err))
                }).catch(error=> console.log(error))
            }).catch(errors=> console.log(errors))
        },createFollowingRequest({commit,dispatch,state},info){
            axiosClient.post("user/"+info.followerId+"/follow/"+info.followedId)
            .then(res=>{      
                this.commit("setCurrentUserRequest",true)
                this.commit("setCurrentUserFollowed",false)
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")   
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },cancelFollowingRequest({commit,dispatch,state},info){
            axiosClient.delete("user/"+info.followerId+"/cancelFollowingOf/"+info.followedId)
            .then(res=>{      

                this.commit("setCurrentUserRequest",false) 
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")   
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },unfollow({commit,dispatch,state},info){
            axiosClient.delete("user/"+info.followerId+"/unfollow/"+info.followedId)
            .then(res=>{      
                this.commit("setCurrentUserFollowed",false)
 
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")   
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },isFollowingTrue({commit,dispatch,state},info){
            axiosClient.get("user/"+info.currentID+"/isFollowing/"+info.userId)
            .then(res=>{      
                this.commit("setCurrentUserFollowed",res.data) 
            })
            .catch(err=>{
                console.log(err)
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },isFollowRequested({commit,dispatch,state},info){
            axiosClient.get("user/"+info.currentID+"/isFollowRequest/"+info.userId)
            .then(res=>{      
                this.commit("setCurrentUserRequest",res.data)   
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
            })
        },acceptFollowRequest({commit,dispatch,state},info){
            axiosClient.put("user/"+info.followedId+"/accept/requestOf/"+info.followerId)
            .then(res=>{      
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
                console.log(err)
            })
        },denyFollowRequest({commit,dispatch,state},info){
            axiosClient.put("user/"+info.followedId+"/deny/requestOf/"+info.followerId)
            .then(res=>{      
                state.notification.message=res.data.message
                this.dispatch("notifySuccess")
            })
            .catch(err=>{
                state.notification.message=err.response.data.errors
                this.dispatch("notifyError")
                console.log(err)
            })
        },searchUser({commit,dispatch,state},info){
            axios.get("/api/search/user/"+info)
            .then(re=>{
                let data=re.data;
                let loading =true;
                this.commit("setCurrentSearch",{data,loading})
            })
            .catch(err=>console.log(err))
        },sendMessage({commit,dispatch,state},info){
            axiosClient.post("user/"+info.id+"/send/To/"+info.receiverId,info)
            .then(res=>{      
                this.dispatch("getContact",info.id)
            })
            .catch(err=>{
                console.log(err)
            })
        },getContact({commit,dispatch,state},userId){
            axiosClient.get("user/"+userId+"/contacts")
            .then(res=>{      
                this.commit("setUserContacts",res.data)

            })
            .catch(err=>{
                console.log(err)
            })
        },
    },
    mutations:{
        logout:(state)=>{
            state.user.token=null,
            state.user.data={},
            sessionStorage.removeItem("TOKEN");
            sessionStorage.removeItem("Name");
            sessionStorage.removeItem("Id");
            sessionStorage.removeItem("followers")
            sessionStorage.removeItem("followed")
            sessionStorage.removeItem("followingRequestsToUser")
            sessionStorage.removeItem("followingRequestsFromUser")
            sessionStorage.removeItem("contacts")
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
            // router.push({name:"HomePage"})
        },updateUserSocial(state,userData){
            state.user.followers=userData.followers;
            state.user.followed=userData.followed;
            state.user.followingRequestsToUser=userData.requestsTo;
            state.user.followingRequestsFromUser=userData.requestsFrom;

            sessionStorage.setItem("followers", userData.followers != null ? JSON.stringify(userData.followers) : null)
            sessionStorage.setItem("followed", userData.followed != null  ? JSON.stringify(userData.followed) : null)
            sessionStorage.setItem("followingRequestsToUser",userData.requestsTo != null  ? JSON.stringify(userData.requestsTo) : null)
            sessionStorage.setItem("followingRequestsFromUser", userData.requestsFrom != null  ?JSON.stringify(userData.requestsFrom) : null)

        },updateUserSocialOneByOne(state,info){
            if(info.type=="requestToUser"){
                let list=state.user.followingRequestsToUser;
                list.push(info.user)       
                sessionStorage.setItem("followingRequestsToUser",JSON.stringify(list));
            }
            if(info.type=="requestFromUser"){
                let list=state.user.followingRequestsFromUser;
                list.push(info.receiver)       
                sessionStorage.setItem("followingRequestsFromUser",JSON.stringify(list));
            }
            if(info.type=="unfollowReceiver"){
                let list=state.user.followers;      
                let newLIst = list.filter(function (e) {
                    return e.id != info.user.id;
                });    
                sessionStorage.setItem("followers",JSON.stringify(newLIst));
           }
            if(info.type=="unfollowSender"){
                let list=state.user.followed;      
                let newLIst = list.filter(function (e) {
                    return e.id != info.receiver.id;
                });    
                sessionStorage.setItem("followed",JSON.stringify(newLIst));
           }
            if(info.type=="acceptReq" || info.type=="denyReq" || info.type=="requestToUserCancel"){
                let list=state.user.followingRequestsToUser;
                let newLIst = list.filter(function (e) {
                    return e.id != info.user.id;
                });    
                sessionStorage.setItem("followingRequestsToUser",JSON.stringify(newLIst));
               if(info.type=="acceptReq"){
                    let list2=state.user.followers;
                    list2.push(info.user)       
                    sessionStorage.setItem("followers",JSON.stringify(list2));
               }
            }

            
            if(info.type=="sendedReqDenied" ||info.type=="requestFromUserCancel" || info.type=="sendedReqAccepted"){
                let list=state.user.followingRequestsFromUser;
                let newLIst = list.filter(function (e) {
                    return e.id != info.receiver.id;
                });     
                sessionStorage.setItem("followingRequestsFromUser", JSON.stringify(newLIst))
                if(info.type=="sendedReqAccepted"){
                    let list=state.user.followed;
                    list.push(info.receiver)       
                    sessionStorage.setItem("followed",JSON.stringify(list));
                }

            }

            
        },getUser:(state,userData)=>{
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
        },setUserSocialInfo(state,info){
            state.userSocialInfo.followers=info.followers;
            state.userSocialInfo.followed=info.followed;
            state.userSocialInfo.followingRequestsToUser=info.requestsTo;
            state.userSocialInfo.followRequestsFromUser=info.requestsFrom;
        },setCommentStatus(state,info){
            state.commentStatus=info
        },setCurrentPost(state,info){
            state.currentPost.comments=info.comments;
            state.currentPost.loading=true;
        },setCurrentPostData(state,info){
            state.currentPost.data=info;
        },setCurrentUserPost(state,info){
            state.user.posts=info;
        },setCurrentUserFollowed(state,isFollowed){
            state.currentUser.followed=isFollowed;
        },setCurrentUserRequest(state,isRequested){
            state.currentUser.requestSent=isRequested;
        },setCurrentSearch(state,info){
            state.currentSearch.data=info.data
            state.currentSearch.loading=info.loading
        },setCurrrentMessagingUser(state,info){
            state.currrentMessagingUser.data=info

            sessionStorage.setItem("messgingUser",info != null ? JSON.stringify(info) : null)
        },setCurrrentMessagingUserData(state,info){
            state.currrentMessagingUser.msgs=info.chat
        },setUserContacts(state,info){
            state.user.contacts=info;
            sessionStorage.setItem("contacts", info != null ? JSON.stringify(info) : null)
        }
    },
    modules:{}
})

export default store;