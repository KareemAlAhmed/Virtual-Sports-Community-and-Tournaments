import {createRouter,createWebHistory} from "vue-router"
import Login from "./components/authentication/Login.vue"
import Register from "./components/authentication/Register.vue"
import NavBar from "./components/mainComp/NavBar.vue"
import DefaultLayout from "./components/mainComp/DefaultLayout.vue"
import HomePage from "./components/mainComp/HomePage.vue"
import TopsGame from "./components/game/TopsGame.vue"
import TopsTourn from "./components/tournament/TopsTourn.vue"
import TournBaseLaybout from "./components/tournament/TournBaseLaybout.vue"
import TournamentPage from "./components/tournament/TournamentPage.vue"
import CreateTournnament from "./components/tournament/CreateTournnament.vue"
import MyTournaments from "./components/tournament/MyTournaments.vue"
import TopsLeague from "./components/league/TopsLeague.vue"
import LeaguePage from "./components/league/LeaguePage.vue"
import LeagueDefaultLayout from "./components/league/LeagueDefaultLayout.vue"
import CreateLeague from "./components/league/CreateLeague.vue"
import MyLeagues from "./components/league/MyLeagues.vue"
import MyGames from "../js/components/game/MyGames.vue"
import DashboardDefaultLayout from "./components/dashboard/DashboardDefaultLayout.vue"
import UsersDash from "./components/dashboard/UsersDash.vue"
import TournamentsDash from "./components/dashboard/TournamentsDash.vue"
import LeaguesDash from "./components/dashboard/LeaguesDash.vue"
import GamesDash from "./components/dashboard/GamesDash.vue"
import CreateTournDash from "./components/dashboard/CreateTournDash.vue"
import CreateLeagueDash from "./components/dashboard/CreateLeagueDash.vue"
import UserPage from "./components/User/UserPage.vue"
import EditPost from "./components/minicomponent/PostEditPage.vue"
import SocialDefaultPage from "./components/social/SocialDefaultPage.vue"
import FollowerPage from "./components/social/FollowerPage.vue"
import FollowingPage from "./components/social/FollowingPage.vue"
import SearchUser from "./components/social/SearchUser.vue"
import FollowReqPage from "./components/social/FollowingRequest.vue"
import MessageDefaultPage from "./components/message/MessageDefaultLayout.vue"
import ChatRoom from "./components/message/ChatRoom.vue"
import MessageContact from "./components/message/RecentContact.vue"
import store from "./store"
const routes=[
  {
    path:"/",
    name: 'DefaultLayout',
    component:DefaultLayout,
    children:[
      {
        path:"/",
        name: 'HomePage',
        component:HomePage,
      },
      {
        path:"/login",
        name: 'Login',
        component:Login,
        meta:{isGuest:true}
      },
      {
        path:"/register",
        name: 'Register',
        component:Register,
        meta:{isGuest:true}
      },
      {
        path:"/post/:id/edit",
        name: 'EditPost',
        component:EditPost,
        meta:{isGuest:false}
      },
      {
        path:"/userProfile/:id",
        name: 'UserPage',
        component:UserPage,              
      },
      {
        path: '/tournaments', 
        component: TournBaseLaybout, 
        children: [
          {
            path: '',
            name: 'DefaultTourn',
            component: TopsTourn,
          },     
          {
            path: ':id', 
            name: 'TournPage',
            component: TournamentPage,
          },
          {
            path: 'tops', 
            name: 'TopTourns',
            component: TopsTourn,
          },
          {
            path: 'create',
            name: 'CreateTourn',
            component: CreateTournnament,
          },                                       
          {
            path: 'myTourns',
            name: 'MyTournaments',
            component: MyTournaments
          },           
        ]
      },
      {
        path: '/leagues',
        component: LeagueDefaultLayout,
        children: [
          {
            path: '',
            name: 'DefaultLeague',
            component: TopsLeague,
          },
          {
            path: ':id',
            name: 'LeaguePage',
            component: LeaguePage,
          },
          {
            path: 'tops',
            name: 'TopLeagues',
            component: TopsLeague,
          },
          {
            path: 'create',
            name: 'CreateLeague',
            component: CreateLeague,
          },              
          {
            path: 'myleague',
            name: 'MyLeagues',
            component: MyLeagues
          },
        ]
      },
      {
        path: '/games/tops', 
        name: 'TopsGame',
        component: TopsGame,
      },
      {
        path:'/games/mygames',
        name: 'MyGames',
        component: MyGames,
      }, 
      {
        path: '/dashboard',
        name:"dash",
        component: DashboardDefaultLayout,
        children: [
          {
            path: '/',
            name: 'UsersDash',
            component: UsersDash,
          },
          {
            path: 'users',
            name: 'UsersDash',
            component: UsersDash,
          },
          {
            path: 'tourns',
            name: 'TournamentsDash',
            component: TournamentsDash,
          },
          {
            path: 'leagues',
            name: 'LeaguesDash',
            component: LeaguesDash,
          },
          {
            path: 'games',
            name: 'GamesDash',
            component: GamesDash,
          },
          {
            path: 'createTourn',
            name: 'CreateTournDash',
            component: CreateTournDash,
          },
          {
            path: 'createLeague',
            name: 'CreateLeagueDash',
            component: CreateLeagueDash,
          },
        ]
      },
      {
        path: '/social',
        name:"social",
        component: SocialDefaultPage,
        meta:{isGuest:false},
        children: [
          {
            path: '/',
            name: 'FollowerPage',
            component: FollowerPage,
          },
          {
            path: 'followers',
            name: 'FollowerPage',
            component: FollowerPage,
          },
          {
            path: 'following',
            name: 'FollowingPage',
            component: FollowingPage,
          },
          {
            path: 'search',
            name: 'SearchUser',
            component: SearchUser,
          },
          {
            path: 'followingRequests',
            name: 'FollowReqPage',
            component: FollowReqPage,
          },
        ]
      },{
        path:"messages",
        name:"MessageDefaultPage",
        component:MessageDefaultPage,
        meta:{isGuest:false},
        children: [
          {
            path: 'contacts',
            name: 'MessageContact',
            component: MessageContact,
          },
          {
            path: 'chatRoom/with/:id',
            name: 'ChatRoom',
            component: ChatRoom,
          },
          
        ]
      }
    ]
  }
]

const router=createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to,from,next)=>{
  store.commit('updateCurrentRoute', { route: to })
  if((to.meta.requiresAuth && !store.state.user.token) || (to.name === 'CreateLeague' && !store.state.user.token) || (to.name === 'CreateTourn' && !store.state.user.token) || (to.name === 'dashboard' && !store.state.user.token)){
      next({name:'Login'})
  }else if(store.state.user.token && (to.name ==='Login' || to.name ==='Register' )){
      next({name:'HomePage'});
  }else{
    if(!store.state.user.token && (to.name === "social" || to.name === "FollowerPage" || to.name === "FollowingPage" || to.name === "SearchUser" )){
      next({name:'Login'})
    }
    if(to.name ==='dash'){
      next({name:'UsersDash'});
    }
    if(to.name ==='social'){
      next({name:'FollowerPage'});
    }
    if(to.name ==='UsersDash'){
      store.state.currentDash.users=true;
      store.state.currentDash.tourns=false;
      store.state.currentDash.leagues=false;
      store.state.currentDash.games=false;
      store.state.currentDash.createTourn=false;
      store.state.currentDash.createLeague=false;
    }
    if(to.name ==='TournamentsDash'){
      store.state.currentDash.users=false;
      store.state.currentDash.tourns=true;
      store.state.currentDash.leagues=false;
      store.state.currentDash.games=false;
      store.state.currentDash.createTourn=false;
      store.state.currentDash.createLeague=false;
    }
    if(to.name ==='LeaguesDash'){
      store.state.currentDash.users=false;
      store.state.currentDash.tourns=false;
      store.state.currentDash.leagues=true;
      store.state.currentDash.games=false;
      store.state.currentDash.createTourn=false;
      store.state.currentDash.createLeague=false;
    }
    if(to.name ==='GamesDash'){
      store.state.currentDash.users=false;
      store.state.currentDash.tourns=false;
      store.state.currentDash.leagues=false;
      store.state.currentDash.games=true;
      store.state.currentDash.createTourn=false;
      store.state.currentDash.createLeague=false;
    }
    if(to.name ==='CreateTournDash'){
      store.state.currentDash.users=false;
      store.state.currentDash.tourns=false;
      store.state.currentDash.leagues=false;
      store.state.currentDash.games=false;
      store.state.currentDash.createTourn=true;
      store.state.currentDash.createLeague=false;
    }
    if(to.name ==='CreateLeagueDash'){
      store.state.currentDash.users=false;
      store.state.currentDash.tourns=false;
      store.state.currentDash.leagues=false;
      store.state.currentDash.games=false;
      store.state.currentDash.createTourn=false;
      store.state.currentDash.createLeague=true;
    }
    if(to.name !=='UserPage'){
      store.state.selectedTab="Tourns";
    }

    if(to.name ==='FollowerPage'){
      store.state.currentSocialOpt.follower=true;
      store.state.currentSocialOpt.following=false;
      store.state.currentSocialOpt.followingRequests=false;
      store.state.currentSocialOpt.findUser=false;
    }
    if(to.name ==='FollowingPage'){
      store.state.currentSocialOpt.follower=false;
      store.state.currentSocialOpt.following=true;
      store.state.currentSocialOpt.followingRequests=false;
      store.state.currentSocialOpt.findUser=false;
    }
    if(to.name ==='FollowReqPage'){
      store.state.currentSocialOpt.follower=false;
      store.state.currentSocialOpt.following=false;
      store.state.currentSocialOpt.followingRequests=true;
      store.state.currentSocialOpt.findUser=false;
    }
    if(to.name ==='SearchUser'){
      store.state.currentSocialOpt.follower=false;
      store.state.currentSocialOpt.following=false;
      store.state.currentSocialOpt.followingRequests=false;
      store.state.currentSocialOpt.findUser=true;
    }


    next();
  }
  
})

export default router;