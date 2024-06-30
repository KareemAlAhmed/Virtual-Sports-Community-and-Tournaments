import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js'

import router from './router.js'
import store from './store';

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

import VueChatScroll from 'vue3-chat-scroll';

const token = localStorage.getItem('auth_token'); // Assuming you store the token in localStorage

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "local",
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost:"127.0.0.1",
    wsPort: 6001,
    forceTLS: false,
    disableStats:true,
    auth: {
        headers: {
          Authorization: `Bearer ${token}`,
        },
    }
});

const app=createApp({

})
import HomePage from"./components/mainComp/HomePage.vue"
import NavBar from"./components/mainComp/NavBar.vue"
import DefaultLayout from"./components/mainComp/DefaultLayout.vue"
import TopsTourn from "./components/tournament/TopsTourn.vue"
import TopsGame from "./components/game/TopsGame.vue"
import TopsLeague from "./components/league/TopsLeague.vue"
import GameSummary from "./components/game/GameSummary.vue"
app.component("home-page",HomePage)
app.use(VueChatScroll);
app.component("nav-bar",NavBar)
app.component("default-layout",DefaultLayout)
app.component("tops-tourn",TopsTourn)
app.component("tops-game",TopsGame)
app.component("tops-league",TopsLeague)
app.component("game-summary",GameSummary)
// app.use(router).use(store).mount("#app")
app.use(router).mount("#app")