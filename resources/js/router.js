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
import store from "./store"
const routes=[

    {
        path:"/",
        name: 'DefaultLayout',
        component:DefaultLayout,
        // redirect:"",
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
                }, {
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
      if(to.name ==='dash'){
        next({name:'UsersDash'});
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
        next();
    }

  
})

export default router;