const workFilter = document.querySelector('.module-hero__work-filter select');
const workGrid = document.querySelector('.work-grid__items');

if(workFilter)
{
    workFilter.addEventListener('change', function(e){
        const select = this;
        const termID = select.value;
        const data = {
            action: 'wp_query',
            payload: {
                post_type: 'work',
                orderby: 'menu_order',
                order: 'DESC',
                tax_query: [
                    {
                        taxonomy: 'work_categories',
                        field: 'term_id',
                        terms: termID
                    }
                ]
            }
        };

        const createXhrRequest = function( httpMethod, url, data, callback )
        {
            let xhr = new XMLHttpRequest();
            xhr.open(httpMethod, url);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                callback(xhr);
            };
            xhr.send(JSON.stringify(data));
        }

        createXhrRequest(
            'POST',
            ajaxurl+'?action='+data.action,
            data,
            function(xhr)
            {
                if(xhr.status == 200 && xhr.readyState == 4) {
                    let response = JSON.parse(xhr.response);
                    let html = [];

                    console.log(response);

                    // Clear work html
                    workGrid.innerHTML = '';
                    console.log('clear html');

                    // Create new html
                    for(var i = 0; i < response.length; i++)
                    {
                        let post = response[i];

                        html.push(['<div class="work-grid__item">',
                                '<a href="'+post.permalink+'" class="cover-link"></a>',
                                '<p class="work-grid__item-tag">'+post.terms[0].name+'</p>',
                                '<header>',
                                '<p class="work-grid__item-client">'+post.client_name+'</p>',
                                '<p class="work-grid__item-copy">'+post.post_title+'</p>',
                                '</header>',
                                '<img class="work-grid__item-image" src="'+post.thumbnail+'" />']);
                    }

                    // Insert new html
                    for(var i = 0; i < html.length; i++)
                    {
                        $(workGrid).append(html[i].join(''));
                    }
                }
            }
        );

        // AJAX request to get the matching work items
        // $.ajax({
        //     'url': ajaxurl,
        //     'method': 'POST',
        //     'data': {
        //         action: 'wp_query',
        //         payload: payload
        //     },
        //     'error': function(xhr, status, error) {
        //         console.log(status, error);
        //     },
        //     'success': function(data) {
        //         console.log(data);
        //     }
        // });
    });
}