<?php

    if (!empty($params['result'])) {

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