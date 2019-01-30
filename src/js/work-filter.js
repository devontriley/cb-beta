const workFilter = document.querySelector('.module-hero__work-filter select');
const workGrid = document.querySelector('.work-grid__items');

if(workFilter)
{

    workFilter.addEventListener('select-change', function(e)
    {
        fetchWork();
    });

    // workFilter.addEventListener('change', function(e)
    // {
    //     fetchWork();
    // });

    function createXhrRequest(httpMethod, url, data, callback)
    {
        let xhr = new XMLHttpRequest();
        xhr.open(httpMethod, url);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            callback(xhr);
        };
        xhr.send(JSON.stringify(data));
    }

    function fetchWork()
    {
        const select = workFilter;
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
    }
}