import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js'

import router from './router.js'
// import store from './store';

   
const app=createApp({

})
import HomePage from"./components/mainComp/HomePage.vue"
import NavBar from"./components/mainComp/NavBar.vue"
import DefaultLayout from"./components/mainComp/DefaultLayout.vue"
import TopsTourn from "./components/tournament/TopsTourn.vue"
import TopsGame from "./components/game/TopsGame.vue"
import TopsLeague from "./components/league/TopsLeague.vue"
app.component("home-page",HomePage)
app.component("nav-bar",NavBar)
app.component("default-layout",DefaultLayout)
app.component("tops-tourn",TopsTourn)
app.component("tops-game",TopsGame)
app.component("tops-league",TopsLeague)
// app.use(router).use(store).mount("#app")
app.use(router).mount("#app")