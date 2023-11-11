<style>

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

<li class="sidePost">
    <img src="<?php echo asset("storage/postImage/" . $firstSide->image_url) ?>" >
    <div class="postInfo">
        <p>{{$firstSide->content}}</p>
        <p>{{date('F  j, Y', strtotime($firstSide->created_at))}}</p>
    </div>
</li>