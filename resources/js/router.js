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
      }

        next();
    }

  
})

export default router;