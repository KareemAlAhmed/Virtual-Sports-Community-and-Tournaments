<template>
    <div className="dashboardTable">
        
            <table>
                <thead>   
                        <td>Name</td>
                        <td>MaxPlaces</td>
                        <td>RemPlaces</td>
                        <td>Rewards</td>
                        <td>SportType</td>
                        <td>Type</td>
                        <td>StartDate</td>
                        <td>EndDate</td>
                        <td>WinnerId</td>
                        <td>OrganizerId</td>
                        <td>Action</td>
                  
                </thead>
             
                <template v-for="tourn in getTourns" :key="tourn.id">
                    <tr className="dashboardDesc" @click="goToTourn($event,tourn.id,cuurentUserId)">
                        <td>{{tourn.name.length <= 11 ? tourn.name : tourn.name.slice(0,11) + "..."}}</td>
                        <td>{{tourn.maxPlaces}}</td>
                        <td>{{tourn.remainingPlaces}}</td>
                        <td>{{tourn.rewards}}</td>
                        <td>{{tourn.sportType}}</td>
                        <td>{{tourn.type}}</td>
                        <td>{{tourn.startDate}}</td>
                        <td>{{tourn.endDate}}</td>
                        <td>{{tourn.winner_id === null ? "---" : tourn.winner_id}}</td>
                        <td>{{tourn.organizer_id}}</td>
                        <td class="no-redirect">
                             <svg  @click="deleteTourn(tourn.id)" class="del no-redirect" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </td>
                    </tr>
                </template>
            </table>
            <!-- <div className="lastRow">
                <div className="lastRowPart">
                    <h4>show entries:</h4>
                    <div
                        onClick={() => setEntries(10)}
                        className={10 == showEntries ? "selectedSlider" : ""}
                    >
                        10
                    </div>
                    <div
                        onClick={() => setEntries(15)}
                        className={15 == showEntries ? "selectedSlider" : ""}
                    >
                        15
                    </div>
                    <div
                        onClick={() => setEntries(20)}
                        className={20 == showEntries ? "selectedSlider" : ""}
                    >
                        20
                    </div>
                </div>
                <div className="lastRowPart">
                    {splitedArrays.map((part, index) => (
                        <div
                            onClick={() => {
                                moveToIndex(index);
                            }}
                            className={`slider ${
                                selectedIndex == index ? "selectedSlider" : ""
                            }`}
                        >
                            {index + 1}
                        </div>
                    ))}
                </div>
            </div> -->
        </div>
</template>

<script>
import store from '../../store';
import router from '../../router';

export default {
    name:"TournamentsDash",
    computed:{
        getTourns(){
            return store.state.allTourns.tourns;
        },isLoading(){
            return store.state.allUsers.loading;
        },cuurentUserId(){
                return store.state.user.id;
            },
    },created(){
        store.dispatch("getAllTourns");
    },methods:{
        deleteTourn(tournId){
            store.dispatch("deleteTournament",tournId)           
        },goToTourn(event,tournId,userId){
            if (!event.target.classList.contains('no-redirect')) {
                store.dispatch('isJoinedTourn',{userId,tournId} )
                store.dispatch('getCurrentTourn', tournId)
            }                 
        }
    }

}
</script>

<style scoped>
.dashboardTable {
    position: relative;
    color: white;
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