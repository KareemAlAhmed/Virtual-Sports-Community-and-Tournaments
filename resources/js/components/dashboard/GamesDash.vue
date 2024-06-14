<template>
    <div className="dashboardTable">
        
            <table>
                <thead>   
                        <td>User1</td>
                        <td>User2</td>
                        <td>Score1</td>
                        <td>Score2</td>
                        <td>SportType</td>
                        <td>gameType</td>
                        <td>CompetetionType</td>
                        <td>Date</td>
                        <td>WinnerId</td>
                        <td>Action</td>
                  
                </thead>
                <template v-for="game in displayGames" :key="game.id">
                    <tr className="dashboardDesc">
                        <td>{{game.firstUserName.length <= 11 ? game.firstUserName : game.firstUserName.slice(0,11) + "..."}}</td>
                        <td>{{game.secondUserName.length <= 11 ? game.secondUserName : game.secondUserName.slice(0,11) + "..."}}</td>
                        <td>{{game.firstUserScore === null ? "---" : game.firstUserScore}}</td>
                        <td>{{game.secondUserScore  === null ? "---" : game.secondUserScore}}</td>
                        <td>{{game.sportType}}</td>
                        <td>{{game.gameType}}</td>
                        <td>{{game.competetionType}}({{ game.tournaments_id ===null ? game.leagues_id :game.tournaments_id}})</td>
                        <td>{{game.date}}</td>
                        <td>{{game.winner_id === null ? "---" : game.winner_id}}</td>
                        <td class="no-redirect">
                             <svg  @click="deleteGame(game.id)" class="del no-redirect" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </td>
                    </tr>
                </template>
            </table>
            <div className="lastRow">
                <div className="lastRowPart">
                    <h4>show entries:</h4>
                    <div
                        @click="setEntry(10)"
                        :class="10 == getEntry ? 'selectedSlider' :'' "
                    >
                        10
                    </div>
                    <div
                         @click="setEntry(15)"
                         :class="15 == getEntry ? 'selectedSlider' :'' "
                    >
                        15
                    </div>
                    <div
                        @click="setEntry(20)"
                        :class="20 == getEntry ? 'selectedSlider' :'' "
                    >
                        20
                    </div>
                </div>
                <div className="lastRowPart">
                    <div v-for="x in getNb" :key="x"                   
                        :class="getIndex == x ? 'slider selectedSlider' :'slider'"
                        @click="selectedIndex =x">

                            {{ x }}
                    </div>
 
                </div>
            </div> 
        </div>
</template>

<script>
import store from '../../store';
import router from '../../router';

export default {
    name:"GamesDash",
    data(){
        return{
            entries:10,
            selectedIndex:1,
        }
    },
    computed:{
        getGames(){
            return store.state.allGames.games;
        },isLoading(){
            return store.state.allGames.loading;
        },cuurentUserId(){
            return store.state.user.id;
        },displayGames(){
            let ent=this.getEntry
            let tourns=  this.getGames.length ==  undefined ? this.getGames :this.getGames.slice((this.getIndex -1) * ent, ent* this.getIndex)
            return tourns;
        },
        getEntry(){
            return this.entries;
        },getNb(){
            let len=this.getGames.length ?? 0;
            let page= len / this.getEntry;
            return page <=1 ? 1 : Math.ceil(page);
        },getIndex(){
            return this.selectedIndex
        }
    },created(){
        store.dispatch("getAllGames");
    },methods:{
        deleteGame(gameId){
            store.dispatch("deleteGames",gameId)           
        },setEntry(entry){
            this.entries=entry,
            this.selectedIndex=1;
        }
    }

}
</script>

<style scoped>
.dashboardTable {
    position: relative;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;

}

.dashboardTable table {
    width: 100%;
    border-spacing: 0;
}
thead td{
    font-weight: 600;
    font-size: 16px;
    padding: 5px 0 5px 10px;
    border-bottom: 1px solid white;
}
thead td:last-child{
    padding-right: 5px;
}
.dashboardDesc td {
    padding: 20px 9px;
    font-size: 19px;
    border-bottom: 1px solid white;
}

tr:hover {
    background-color: #1f1f1f;
    cursor: pointer;
}

.selectedSlider {
    background-color: var(--effect-color);
}

.lastRow {
    position: relative;
    bottom: 0;
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.lastRowPart {
    display: flex;
    align-items: center;
    padding: 10px;
}

.lastRowPart div {
    padding: 10px;
    margin: 0 10px;
    border-radius: 5px;
    cursor: pointer;
}

.lastRowPart div:hover {
    background-color: var(--light-color);

}

.dashBtn:hover {
    background-color: var(--dark-color);
}
.dashboardDesc{
    border: 1px solid white;
}
.del{
    fill: #cc0000;
    display: flex;
    width: 22px;
}

</style>