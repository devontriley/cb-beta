class styledSelect
{
    constructor(select)
    {
        this.select = $(select);
        this.label = this.select.siblings('label');
        this.numberOfOptions = this.select.children('option').length;
        this.selected = this.select.children('option:selected');
        this.field = this.select.parents('.field');

        this.selectChange = new CustomEvent('select-change');

        if(this.selected.text() == this.select.children('option').first().text())
        {
            this.selected = '';
        }

        if(this.label[0])
        {
            this.label[0].classList.add('visually-hidden');
        }

        // Setup select div
        this.select.addClass('select-hidden');
        this.select.wrap('<div class="select"></div>');
        this.select.after('<div class="select-styled"></div>');
        this.styledSelect = this.select.next('div.select-styled');
        this.styledSelect.html('<span class="label">' + this.label[0].innerText + ' </span> <span class="value">' + this.select.children('option').eq(0).text() + '</span>');

        // Add svg filter icon
        let svgElem = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svgElem.setAttribute('width', '19px');
        svgElem.setAttribute('height', '15px');

        // Check if svg has classList for IE11
        if(svgElem.classList) {
            svgElem.classList.add('select-filter');
        } else if (svgElem.getAttribute) {
            svgElem.setAttribute('class', 'select-filter');
        }

        let useElem = document.createElementNS('http://www.w3.org/2000/svg', 'use');
        useElem.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', '#select-filter-icon');
        svgElem.appendChild(useElem);

        $(this.styledSelect[0]).prepend(svgElem);
        // this.styledSelect[0].prepend(svgElem);

        // Add svg arrow
        svgElem = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svgElem.setAttribute('width', '10px');
        svgElem.setAttribute('height', '6px');
        // Check if svg has classList for IE11
        if(svgElem.classList) {
            svgElem.classList.add('select-arrow');
        } else if (svgElem.getAttribute) {
            svgElem.setAttribute('class', 'select-arrow');
        }
        useElem = document.createElementNS('http://www.w3.org/2000/svg', 'use');
        useElem.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', '#chevron-down');
        svgElem.appendChild(useElem);
        this.styledSelect[0].appendChild(svgElem);

        // Create options
        this.list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter(this.styledSelect);

        for (let i = 0; i < this.numberOfOptions; i++)
        {
            $('<li />', {
                text: this.select.children('option').eq(i).text(),
                rel: this.select.children('option').eq(i).val()
            }).appendTo(this.list);
        }

        this.listItems = this.list.children('li');

        if(this.selected !== '')
        {
            this.styledSelect.text(this.selected.text());
            this.select.val(this.selected.text());
        }

        this.styledSelect.click(function(e)
        {
            this.open(e);
        }.bind(this));

        this.styledSelect.parents('.select').focus(function(e)
        {
            this.open(e);
        }.bind(this));

        this.styledSelect.parents('.select').blur(function(e)
        {
            this.close(e);
        }.bind(this));

        this.listItems.click(function(e)
        {
            this.selectOption(e);
        }.bind(this));

        $(document).click(function()
        {
            this.close();
        }.bind(this));
    }

    open(e)
    {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function()
        {
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        this.styledSelect.toggleClass('active');
        this.list.toggle();
    }

    close()
    {
        this.styledSelect.removeClass('active');
        this.list.hide();
    }

    selectOption(e)
    {
        e.stopPropagation();
        let value = $(e.target).attr('rel');

        $('.label', this.styledSelect).text(this.label[0].innerText);
        $('.value', this.styledSelect).text($(e.target).text());
        this.styledSelect.removeClass('active');
        this.select.val(value);
        this.list.hide();

        this.select[0].dispatchEvent(this.selectChange);
    }
}

function createStyledSelects(selects)
{
    let styledSelectsArr = [];

    for(let i = 0; i < selects.length; i++)
    {
        styledSelectsArr[i] = new styledSelect(selects[i]);
    }
}

let styledSelects = document.querySelectorAll('select');

if(styledSelects.length)
{
    createStyledSelects(styledSelects);
}