import {createRouter,createWebHistory} from "vue-router"
import Login from "./components/authentication/Login.vue"
import Register from "./components/authentication/Register.vue"
import NavBar from "./components/mainComp/NavBar.vue"
import DefaultLayout from "./components/mainComp/DefaultLayout.vue"
import HomePage from "./components/mainComp/HomePage.vue"
import TopsTourn from "./components/tournament/TopsTourn.vue"
import TopsGame from "./components/game/TopsGame.vue"
import TopsLeague from "./components/league/TopsLeague.vue"
import LeaguePage from "./components/league/LeaguePage.vue"
import LeagueDefaultLayout from "./components/league/LeagueDefaultLayout.vue"
import CreateLeague from "./components/league/CreateLeague.vue"
import MyLeagues from "./components/league/MyLeagues.vue"
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
                component: TopsTourn, 
                children: [
                  {
                    path: ':id', 
                    name: 'TournPage',
                    component: TopsTourn,
                  },

                  {
                    path: 'tops', 
                    name: 'Tops',
                    component: TopsTourn,
                  },
                 
                ]
              },
            {
                path: '/games', 
                component: TopsGame, 
                children: [
                  {
                    path: ':id', 
                    name: 'TopsGame',
                    component: TopsGame,
                  },

                  {
                    path: 'tops', 
                    name: 'TopsGame1',
                    component: TopsGame,
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
        ]

    }
]

const router=createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to,from,next)=>{

    store.commit('updateCurrentRoute', { route: to })


    if((to.meta.requiresAuth && !store.state.user.token) || (to.name === 'CreateLeague' && !store.state.user.token)){
        next({name:'Login'})
    }else if(store.state.user.token && (to.name ==='Login' || to.name ==='Register' )){
        next({name:'HomePage'});
    }else{
        next();
    }

  
})

export default router;