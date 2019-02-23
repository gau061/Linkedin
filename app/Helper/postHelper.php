<?php

// use File;
// use Image;

/* GET IAMGE UPLOAD */
function getFeedImage($image,$prefix='') {
    if($prefix != '')
        $prefix = $prefix.'-';
    $img = defaultImage($prefix);

    if(empty($image) && is_null($image)) 
        return $img;

    $data = unserialize($image);
    $path   = $data['image_path'];
    $img_nm = $data['image_name'];

    if(Storage::disk('feed')->exists($path.'/'.$prefix.$img_nm)) {
        $img = Storage::disk('feed')->url($path.'/'.$prefix.$img_nm);       
    }   
    return $img;
}
/* FEED IAMGE UPLOAD */
function updateFeedImage($image,$prefix='post')
{
	$width=800;
	$height=800;

	$path = 'images/'.date('Y').'/'.date('m'); 
    $storepath = Storage::disk('feed')->path($path);
    
	if (!is_dir($storepath)) {
        \File::makeDirectory($storepath,0777,true);
    }
    if (!empty($image)) {
        $imageName = $prefix.'-'.time().'-'.str_random(5).'.'.$image->getClientOriginalExtension();

        $upload_image = Image::make($image->getRealPath())->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $upload_image->save($storepath.'/'.$imageName);

        $thumb = Image::make($storepath.'/'.$imageName)->fit('300','300')->save($storepath.'/'.'thumb'.'-'.$imageName);

        $post_image = ['image_path' => $path.'/','image_name'=>$imageName];
        return serialize($post_image);
    } else {
        return 'null';
    }
    
}
/* FEED IAMGE REMOVE */
function removeFeedImage($image) {
    if(empty($image) && is_null($image)) 
        return false;

    $data = unserialize($image);
    $path   = $data['image_path'];
    $img_nm = $data['image_name'];
    // dd($path.$img_nm);
    if(Storage::disk('feed')->exists($path.$img_nm)){        
        Storage::disk('feed')->delete($path.$img_nm);
    }    
    if(Storage::disk('feed')->exists($path.'thumb-'.$img_nm)){        
        Storage::disk('feed')->delete($path.'thumb-'.$img_nm);
    }
    return true;
}
/* UPLOAD FEED ARTICAL IMAGE */
function updateFeedArticleImage($image){
    $width=1200;
    $height=400;
    $prefix='Article';

    $path = 'article/'.date('Y').'/'.date('m'); 
    $storepath = Storage::disk('feed')->path($path);
    
    if (!is_dir($storepath)) {
        \File::makeDirectory($storepath,0777,true);
    }
    if (!empty($image)) {
        $imageName = $prefix.'-'.time().'-'.str_random(5).'.'.$image->getClientOriginalExtension();

        $upload_image = Image::make($image->getRealPath())->fit($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $upload_image->save($storepath.'/'.$imageName);

        $thumb = Image::make($storepath.'/'.$imageName)->fit('600','200')->save($storepath.'/'.'thumb'.'-'.$imageName);

        $post_image = ['image_path' => $path.'/','image_name'=>$imageName];
        return serialize($post_image);
    } else {
        return 'null';
    }
}
/* REMOVE FEED ARTICAL IMAGE */
function removeArticalImage($image) {
    if(empty($image) && is_null($image)) 
        return false;

    $data = unserialize($image);
    $path   = $data['image_path'];
    $img_nm = $data['image_name'];


    if(Storage::disk('feed')->exists($path.$img_nm)){        
        Storage::disk('feed')->delete($path.$img_nm);
    }    
    if(Storage::disk('feed')->exists($path.'thumb-'.$img_nm)){                
        Storage::disk('feed')->delete($path.'thumb-'.$img_nm);
    }    
    return true;
}

/* UPLOAD FEED VIDEO */
// function updateFeeVideo($postVideo,$prefix='pVideo')
// {
// 	$path = 'video/'.date('Y').'/'.date('m'); 
//     $storepath = Storage::disk('feed')->path($path);
    
//     if (!is_dir($storepath)) {
//         \File::makeDirectory($storepath,0777,true);
//     }

//     if (!empty($postVideo)) {

//         $videoName = $prefix.'-'.time().'-'.str_random(5).'.'.$postVideo->getClientOriginalExtension();
//         $uploadFile = \Storage::disk('feed')->put($path.'/'.$videoName, file_get_contents($postVideo->getRealPath()));

//         if($uploadFile) {
//             return $post_video = ['video_path' => $path.'/','video_name'=>$videoName, 'video_formate'=>$postVideo->getClientOriginalExtension() ];
//             //return serialize($post_video);
//         } else {
//             return 'null';
//         }

//     }
// }

function postStatus($status)
{
    if($status==1):
        return 'Friends';
    elseif($status==2):
        return 'Only Me';
    else:
        return 'Public';
    endif;
}

function dateFormat($datetime){

    $last_access = strtotime($datetime);
    $now = time();
    $last_midnight = $now - ($now % (24*60*60));
    if ($last_access >= $last_midnight) {
        $return = "Today";
    } elseif ($last_access >= ($last_midnight-(24*60*60))) {
        $return = "Yesterday";
    }else{
        $return = \Carbon\carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('jS F, Y');
    }
    return $return . ' at '.\Carbon\carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('g:i a');
}

function post_comment($post_id){
    $feeddata = \DB::table('post_comments')
                ->select('post_comments.*', 'frontusers.firstname', 'frontusers.lastname', 'frontusers.profile_pic')
                ->join('frontusers', 'frontusers.id', '=', 'post_comments.commenter_user_id')
                ->where('feed_post_id', $post_id)->get();
    return $feeddata;
}

function post_like($post_id, $user_id){
    $feeddata = \DB::table('post_likes')
                // ->select('post_likes.*', 'frontusers.firstname', 'frontusers.lastname', 'frontusers.profile_pic')
                // ->join('frontusers', 'frontusers.id', '=', 'post_likes.liker_user_id')
                ->where('liker_user_id', $user_id)
                ->where('feed_post_id', $post_id)->first();
    if(!empty($feeddata)){
        return 1;
    }else{
        return 0;        
    }
}

/*Group Feed Likes*/
function Postgroup_like($post_id, $user_id){
    $feeddata = \DB::table('grouppost_likes')
                // ->select('post_likes.*', 'frontusers.firstname', 'frontusers.lastname', 'frontusers.profile_pic')
                // ->join('frontusers', 'frontusers.id', '=', 'post_likes.liker_user_id')
                ->where('liker_user_id', $user_id)
                ->where('feed_post_id', $post_id)->first();
    if(!empty($feeddata)){
        return 1;
    }else{
        return 0;        
    }
}
/*End Group Feed Likes */
/*Group Feed Comments*/
function Postgroup_comment($post_id){
    $feeddata = \DB::table('grouppost_comments')
                ->select('grouppost_comments.*', 'frontusers.firstname', 'frontusers.lastname', 'frontusers.profile_pic')
                ->join('frontusers', 'frontusers.id', '=', 'grouppost_comments.commenter_user_id')
                ->where('feed_post_id', $post_id)->get();
    return $feeddata;
}
/*End Group Feed Comments*/

function getVideo($video,$prefix=''){
    if($prefix != '')
        $prefix = $prefix.'-';

    if(empty($video) && is_null($video)) 
        return $vdo = '/public/upload/default/video-not-found.jpg';

    $data = unserialize($video);
    $path   = $data['video_path'];
    $video_nm   = $data['video_name'];
    $newpath = str_replace(asset('/'),'',$path);

    if(! \File::exists('public/'.$newpath.$prefix.$video_nm)) {
     $vdo = '/public/upload/default/video-not-found.jpg';
     return $vdo;
    }    
    return $video_data = asset('/public/'.$path).'/'.$prefix.$video_nm;
}



function parseVideos($videoString = null){
    // return data
    $videos = array();
    if (!empty($videoString)) {
        // split on line breaks
        $videoString = stripslashes(trim($videoString));
        $videoString = explode("\n", $videoString);
        $videoString = array_filter($videoString, 'trim');
        // check each video for proper formatting
        foreach ($videoString as $video) {
            // check for iframe to get the video url
            if (strpos($video, 'iframe') !== FALSE) {
                // retrieve the video url
                $anchorRegex = '/src="(.*)?"/isU';
                $results = array();
                if (preg_match($anchorRegex, $video, $results)) {
                    $link = trim($results[1]);
                }
            } else {
                // we already have a url
                $link = $video;
            }
            // if we have a URL, parse it down
            if (!empty($link)) {
                // initial values
                $video_id = NULL;
                $videoIdRegex = NULL;
                $results = array();
                // check for type of youtube link
                if (strpos($link, 'youtu') !== FALSE) {
                    if (strpos($link, 'youtube.com') !== FALSE) {
                        if (strpos($link, 'youtube.com/watch') !== FALSE) {
                            $videoIdRegex = '/[\?\&]v=([^\?\&]+)/';
                        }else{
                            // works on:
                            // http://www.youtube.com/embed/VIDEOID
                            // http://www.youtube.com/embed/VIDEOID?modestbranding=1&amp;rel=0
                            // http://www.youtube.com/v/VIDEO-ID?fs=1&amp;hl=en_US
                            ///[\?\&]v=([^\?\&]+)/                        
                            $videoIdRegex = '/youtube.com\/(?:embed|v){1}\/([a-zA-Z0-9_]+)\??/i';
                        }
                    } else if (strpos($link, 'youtu.be') !== FALSE) {
                        // works on:
                        // http://youtu.be/daro6K6mym8
                        $videoIdRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
                    }
                    if ($videoIdRegex !== NULL) {
                        if (preg_match($videoIdRegex, $link, $results)) {
                            $video_str = 'http://www.youtube.com/embed/%s?autoplay=0';
                            $thumbnail_str = 'http://img.youtube.com/vi/%s/2.jpg';
                            $fullsize_str = 'http://img.youtube.com/vi/%s/0.jpg';
                            $video_id = $results[1];
                            $video_type = 'youtube';
                        }
                    }
                }
                // handle vimeo videos
                else if (strpos($video, 'vimeo') !== FALSE) {
                    if (strpos($video, 'player.vimeo.com') !== FALSE) {
                        // works on:
                        // http://player.vimeo.com/video/37985580?title=0&amp;byline=0&amp;portrait=0
                        $videoIdRegex = '/player.vimeo.com\/video\/([0-9]+)\??/i';
                    } else {
                        // works on:
                        // http://vimeo.com/37985580
                        $videoIdRegex = '/vimeo.com\/([0-9]+)\??/i';
                    }
                    if ($videoIdRegex !== NULL) {
                        if (preg_match($videoIdRegex, $link, $results)) {
                            $video_id = $results[1];
                            // get the thumbnail
                            try {
                                $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
                                if (!empty($hash) && is_array($hash)) {
                                    $video_str = 'https://player.vimeo.com/video/%s';
                                    $thumbnail_str = $hash[0]['thumbnail_small'];
                                    $fullsize_str = $hash[0]['thumbnail_large'];
                                    $video_type = 'vimeo';
                                } else {
                                    // don't use, couldn't find what we need
                                    unset($video_id);
                                }
                            } catch (Exception $e) {
                                unset($video_id);
                            }
                        }
                    }
                }
                // check if we have a video id, if so, add the video metadata
                if (!empty($video_id)) {
                    // add to return
                    $videos = array(
                        'url' => sprintf($video_str, $video_id),
                        'fullsize' => sprintf($fullsize_str, $video_id),
                        'video_type' => sprintf($video_type, $video_id),
                    );
                }else{
                    $videos = array(
                        'url' => null,
                        'fullsize' => null,
                        'video_type' => '0',
                    );
                }
            }
        }
    }
    // return array of parsed videos
    return $videos;
}