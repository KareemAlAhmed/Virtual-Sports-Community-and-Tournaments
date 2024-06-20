<!-- ModalComponent.vue -->
<template>
    <div class="modal" @click="test">
      <div class="modal-content">
        <button @click="$emit('close')">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
        </button>
        <!-- Modal content -->
         <template v-if="getComments.length ==0">
            <p class="noComm">There is no comments yet.</p>
         </template>
        <CommentCard v-for="comment in getComments" :key="comment.id" :comments="comment" v-else  />
        
      </div>
    </div>
  </template>
  
  <script>
import store from '../../store'
  import CommentCard from "./CommentCard.vue"
  export default {
    name: 'CommentList',
    
    components: {
        'CommentCard': CommentCard, 
    },
    computed:{
      getComments(){
        return store.state.currentPost.comments;
      }
    },methods:{
      test(e){
        if(e.target.classList.contains("modal")){
            
          document.querySelector(".modal-content > button").click()
        }
      }
    }
  }
  </script>
  
  <style scoped>
  /* Modal styles */
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9;
  }
  
  .modal-content {
    background-color: var(--post-color);;
    /* padding: 20px; */
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    width: 50%;
    height: 90%;
    display: flex;
    flex-direction: column;
    /* gap: 15px; */
    overflow-y: scroll;
  }
  .modal button{
    position: absolute;
    right: 35px;
    top: 35px;
    cursor: pointer;
    background-color: transparent;
    border: none;
  }
  .modal button svg{
    width: 50px;
    height: 50px;
    fill: white;
    background-color: var(--post-color);;
    border-radius: 100px;
  }
  .noComm{
    font-size: 31px;
    color: white;
    font-weight: 700;
    text-align: center;
  }
  @media screen and (max-width: 600px) {
  .modal {
    align-items: flex-start;
  }
    .modal-content{
      width: calc(100% - 20px);
      margin-top: 60px;
    }
    .modal button{
      right: 10px;
      top: 5px;
    }
    .noComm{
      margin-top: 20px;
    }
}
  </style>
  