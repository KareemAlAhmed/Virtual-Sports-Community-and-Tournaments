import {createRouter,createWebHistory} from "vue-router"
import Login from "./components/authentication/Login.vue"
import Register from "./components/authentication/Register.vue"
import NavBar from "./components/mainComp/NavBar.vue"
import DefaultLayout from "./components/mainComp/DefaultLayout.vue"
import HomePage from "./components/mainComp/HomePage.vue"
import TopsTourn from "./components/tournament/TopsTourn.vue"
import TopsGame from "./components/game/TopsGame.vue"
import TopsLeague from "./components/league/TopsLeague.vue"
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
                path:"/tournaments/tops",
                name: 'TopsTourn',
                component:TopsTourn,
                // redirect:"/tournament/tops",
                children:[
                    // {
                    //     path:"tournaments/tops",
                    //     name: 'TopsTourn',
                    //     component:TopsTourn,
                    //     meta:{isGuest:true}
                    // },
                ]
            },

            {
                path:"/leagues/tops",
                name: 'TopsLeague',
                component:TopsLeague,
                // redirect:"/tournament/tops",
            },
            {
                path:"/games/tops",
                name: 'TopsGame',
                component:TopsGame,
                // redirect:"/tournament/tops",

            },
        ]

    }
]

const router=createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to,from,next)=>{
    if(to.meta.requiresAuth && !store.state.user.token){
        next({name:'Login'})
    }else if(store.state.user.token && (to.name ==='Login' || to.name ==='Register')){
        next({name:'HomePage'});
    }else{
        next();
    }
})

export default router;