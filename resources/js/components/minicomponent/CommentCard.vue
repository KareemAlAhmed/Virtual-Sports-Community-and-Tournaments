<template>
  <div class="comment">
        <router-link :to="/userProfile/+comments.user.id">
            <div class="userImage">
                <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/' +comments.user.image_url" alt="http://127.0.0.1:8000/storage/images.jpeg">
            </div>
        </router-link>


        <div class="commentInfo">
            <div class="username">
                
                <p>{{comments.user.name }}</p>
            </div>
            <div class="content">
                <p>{{ comments.text }}</p>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    name:"CommentCard",
    props: ['comments'],
    
}
</script>

<style scoped>
.comment{
    color: white;
    display: flex;
    gap: 15px;
}
.comment p{color: white;}
.comment a{
    align-self: flex-start;
}
</style>