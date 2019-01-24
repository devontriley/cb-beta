import './../../node_modules/slick-carousel/slick/slick.js';

class tabSystem {
    constructor(system) {
        this.mobile = mobileDetected;
        this.tabSystem = system;
        this.tabs = this.tabSystem.querySelectorAll('.tab-system__tabs li');
        this.panels = this.tabSystem.querySelector('.tab-system__panels');

        if(this.mobile)
        {
            // Create mobile slider
            this.slider = $(this.panels).slick({
                'arrows': false,
                'dots': false,
                'variableWidth': true
            });
        }
            else
        {
            // Create tab system
            for(var i = 0; i < this.tabs.length; i++)
            {
                let index = i;
                this.tabs[i].addEventListener('click', (e) =>
                {
                    e.preventDefault();

                    this.handleTabClick(index);
                });
            }
        }

        // TODO: Switch between slider & tab system on resize
        window.onresize = () =>
        {
            this.handleResize();
        }
    }

    handleTabClick(index)
    {
        let activeTab = document.querySelector('.tab-system__tabs a[aria-selected="true"]');
        let activeContent = document.querySelector('.tab-system__panel[aria-hidden="false"]');

        let newTab = document.querySelectorAll('.tab-system__tabs a')[index];
        let tabContent = document.querySelectorAll('.tab-system__panel')[index];
        let tabHeader = tabContent.querySelector('.tab-system__content-header');

        activeTab.setAttribute('aria-selected', false);
        activeContent.setAttribute('aria-hidden', true);
        activeContent.style.display = 'none';

        newTab.setAttribute('aria-selected', true);
        tabContent.setAttribute('aria-hidden', false);
        tabContent.style.display = 'block';
        if(tabHeader)
        {
            tabHeader.setAttribute('tabindex', '-1');
            tabHeader.focus();
        }
    }

    handleResize()
    {
        console.log('resize');
    }
}

var tabSystems = document.querySelectorAll('.tab-system');
if(tabSystems)
{
    let tabSystemClasses = [];

    for(var i = 0; i < tabSystems.length; i++)
    {
        tabSystemClasses.push(new tabSystem( tabSystems[i] ));
    }
}