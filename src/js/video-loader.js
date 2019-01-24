import fitvids from './../../node_modules/fitvids/dist/fitvids.js';

const videoPlayers = [];
const firstScriptTag = document.getElementsByTagName('script')[0];
let youtubePlayerScript = document.createElement('script');
youtubePlayerScript.src = "https://www.youtube.com/iframe_api";
firstScriptTag.parentNode.insertBefore(youtubePlayerScript, firstScriptTag);

window.onYouTubeIframeAPIReady = function()
{
    createVideos();
}

function createVideos()
{
    const video = document.querySelector('.video-embed__video-placeholder');
    if(video)
    {
        videoPlayers.push(createVideoPlayer(video, video.dataset.id));

        fitvids();
    }
}

function createVideoPlayer(videoContainer, videoID)
{
    const props = {
        'ele': videoContainer,
        'videoID': videoID,
        'width': 560,
        'height': 315,
        'playerVars': {
            'autoplay': 0,
            'controls': 0,
            'modestbranding': 0,
            'rel': 0
        }
    }

    return new YT.Player(props.ele, {
        height: props.height,
        width: props.width,
        videoId: props.videoID,
        playerVars: props.playerVars
    });
}

// Vimeo
// var vimeoVideosList = [];
// loadVideos('Vimeo');
//
// var vimeoPlayerScript = document.createElement('script');
// vimeoPlayerScript.src = 'https://player.vimeo.com/api/player.js';
// vimeoPlayerScript.async = false;
// vimeoPlayerScript.addEventListener('load', function(){
//     onVimeoReady();
// });
//
// firstScriptTag.parentNode.insertBefore(vimeoPlayerScript, firstScriptTag);
//
// function createVimeoPlayer(playerInfo) {
//     return new Vimeo.Player(playerInfo.ele, {
//         'id': playerInfo.videoID,
//         'width': playerInfo.width,
//         'loop': false
//     });
// }
//
// function onVimeoReady() {
//     if(!vimeoVideosList) return;
//
//     for(var i = 0; i < vimeoVideosList.length; i++) {
//         var curplayer = createVimeoPlayer(vimeoVideosList[i]);
//     }
//
//     $('.c-media-module__video').fitVids();
// }


// Load More Videos
// $('.c-media-module__load-more').on('click', function(e) {
//     e.preventDefault();
//
//     var container = $(this).parents('.c-media-module__video-category');
//     var ids = container.attr('data-ids');
//     var offset = container.attr('data-offset');
//
//     console.log(ids, offset);
// });