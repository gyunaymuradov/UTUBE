<div class="col-md-10 no-padding-right" id="search">
    <input type="hidden" id="value" value="<?= $params['value']; ?>">
    <input type="hidden" id="type" value="<?= $params['type']; ?>">
    <div id="cont">

        <?php

        if (empty($params['result'])) {
            echo "<div class='row margin-5 width-100 text-center'>
                        <h2>Nothing found!</h2>
                        <h3>Sorry, but nothing matched your search criteria. Please try again with different keyword.</h3>
                      </div>";
        } else {
            echo   "<div class='row margin-left no-padding-right remove-margin-top'>
                        <h3 class=''>Search Results:</h3>
                    </div>";
            if ($params['type'] == 'video') {
                $videos = $params['result'];

                foreach ($videos as $video) {
                    $thumbnail = $video['thumbnail_url'];
                    $id = $video['id'];
                    $title = htmlentities($video['title']);
                    $description = htmlentities($video['description']);

                    echo "<div class='row margin-5 width-100 well-sm bg-info'>
                            <div class='col-md-3'>
                                <a href='index.php?controller=video&action=watch&id=$id'><img src='$thumbnail' width='100%' height='auto'></a>
                            </div>
                            <div class='col-md-9'>
                                    <a href='index.php?controller=video&action=watch&id=$id'><h3 class='text-left'>$title</h3></a>
                                    <h4>$description</h4>
                            </div>
                        </div>";
                }
            } elseif ($params['type'] == 'user') {
                $users = $params['result'];
                foreach ($users as $user) {
                    $id = $user['id'];
                    $name = htmlentities($user['full_name']);
                    $photo = $user['user_photo_url'];
                    $username = htmlentities($user['username']);

                    echo "<div class='row margin-5 width-100 well-sm bg-info'>
                        <div class='col-md-3'>
                            <a href='index.php?controller=user&action=user&id=$id'><img src='$photo' width='100%' height='auto'></a>
                        </div>
                        <div class='col-md-8'>
                                <a href='index.php?controller=user&action=user&id=$id'><h3 class='text-left'>$username</h3></a>
                                <h3>$name</h3>
                        </div>
                      </div>";
                }
            } else {
                $playlists = $params['result'];
                foreach ($playlists as $playlist) {
                    $playlistId = $playlist['playlist_id'];
                    $playlistTitle = htmlentities($playlist['title']);
                    $playlistThumbnail = $playlist['thumbnail_url'];
                    $dateCreated = $playlist['date_added'];
                    $authorId = $playlist['creator_id'];
                    $authorName = htmlentities($playlist['username']);
                    $authorPhotoUrl = $playlist['user_photo_url'];
                    $videoCount = $playlist['video_count'];

                    echo "<div class='row margin-5 width-100 well-sm bg-info'>
                            <div class='col-md-3'>
                                <a href='index.php?controller=video&action=watch&playlist-id=$playlistId'><img src='$playlistThumbnail' width='100%' height='auto'></a>
                            </div>
                            <div class='col-md-9'>
                                <a href='index.php?controller=video&action=watch&playlist-id=$playlistId'><h4 class='text-left'>$playlistTitle</h4></a>
                                <h4>Date created: $dateCreated</h4>
                                <h4>Videos count: $videoCount</h4>
                                <h4>Author: <a href='index.php?controller=user&action=user&id=$authorId'><img src='$authorPhotoUrl' class='img-rounded' width='30' height='auto'>&nbsp;$authorName</a></h4>
                            </div>
                        </div>";
                }
            }
        }

        ?>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

    var start = 5;
    var working = false;
    $(window).scroll(function() {
        if ($(this).scrollTop() + 1 > $('body').height() - $(window).height()) {
            if (working == false) {
                working = true;
                var value = document.getElementById('value').value;
                var type = document.getElementById('type').value;
                $.ajax({
                    type: "GET",
                    url: "index.php?controller=index&action=search&start=" + start + "&value=" + value + "&type=" + type,
                    processData: false,
                    contentType: 'application/json',
                    data: '',
                    success: function(result) {
                        document.getElementById('cont').innerHTML += result;
                        start += 5;
                        setTimeout(function() {
                            working = false;
                        }, 500)
                    }
                });
            }
        }
    })

</script>