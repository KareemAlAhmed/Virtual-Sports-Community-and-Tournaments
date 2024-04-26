<template>   
    <li class="sidePost">
        <img :src="'http://127.0.0.1:8000/storage/postImage/' +  data.image_url ">
        <div class="postInfo">
            <p>{{data.name}}</p>
            <p>{{format_date(data.created_at)}}</p>
        </div>
    </li>
</template>
<script>
import moment from 'moment';
export default {
    name:"SidePost",
    props: ['data'],
    methods: { 
      format_date(value){
         if (value) {
           return moment(String(value)).format('MMM DD,YYYY')
          }
      },
   },
}
</script>
<style >
     .sidePost{
        display: flex;
        gap: 17px;
        margin-bottom: 30px;
        cursor: pointer;
    }
    
    .sidePost img{
        width: 95px;
        height: 75px;
    }
    .postInfo{
        display: flex;
        flex-direction: column;
        justify-content: space-between
    }
    .sidePost p:first-child{
        font-size: 16px;
        color: white;
        font-weight: 800;
    }
    .sidePost:hover p:first-child{
        color: black;
    }
    .sidePost p:last-child{
        font-size: 16px;
        color: white;
    }
</style>