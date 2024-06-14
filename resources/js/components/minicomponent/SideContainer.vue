<template>   
  
    <div class="sideContainer">
        <h4 class="nk-widget-title"><span>Top 3 Recent</span></h4>
        <ul>
            <SidePost :data='side1' />
            <SidePost :data='side2' />
            <SidePost :data='side3' />
        </ul>
    </div>
       
</template>

<script>
  import store from '../../store'
    import SidePost from './SidePost.vue';
  export default {
    name:"SideContainer",
    components: {
        'SidePost': SidePost,
    },
    data() {
    return {
      side1: {
        name: "LESSER YEARS THIRD IN YOU’RE RULE",
        image_url: 'post-41.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      side2: {
        name: "WE FOUND A WITCH! MAY WE BURN HER?",
        image_url: 'post-31-300x169.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      side3: {
        name: "CREEPETH YOU’RE A BEHOLD HEAVEN",
        image_url: 'post-51-300x188.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      user:{
        id:1,
        name:"Kareem",
        userPic:"images.jpeg"
      }
      
    };
  },
  }
</script>
<style scoped>
.sideContainer{
    width: 30%;
    height: fit-content;
    padding: 20px 23px ;
    background-color: var(--post-color);
    

    }
    .sideContainer h4{
        
        margin-bottom: 10px;
        
        font-size: 1.22rem;
        text-transform: uppercase;
        font-family: Montserrat, sans-serif;
        font-style: normal;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
        position: relative;
        z-index: 1;
    }
    .sideContainer h4 span{
        display: inline-block;
        padding-right: 18px;
        background-color: var(--post-color);
    }
    .sideContainer h4::after{
        content: "";
        position: absolute;
        display: block;
        /* top: 36px; */
        right: 1px;
        left: 30px;
        height: 3px;
        background-color: #fff;
        z-index: -1;
        bottom: 5px;
    }
</style>
