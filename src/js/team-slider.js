import './../../node_modules/slick-carousel/slick/slick.js';
import Dragdealer from './../../node_modules/dragdealer/src/dragdealer.js';
import { getElementIndex } from './utils.js';
import objectFitImages from 'object-fit-images';

$(document).ready(function()
{
    const teamProfiles = document.querySelector('.team-profiles');
    if(teamProfiles)
    {
        const teamSlider = teamProfiles.querySelector('.team-profiles__slider');

        // Slider instance
        let teamSliderInstance = $(teamSlider).slick({
            'infinite': false,
            'variableWidth': true,
            'arrows': false
        });

        // Slider
        let slideCount = teamSlider.slick.slideCount;
        let slickTrack = teamProfiles.querySelector('.team-profiles .slick-track');
        let trackXPos = getSlickTrackPosition();
        let slickSlides = teamProfiles.querySelectorAll('.team-profiles .slick-slide');
        let slidesW = getTotalSlideWidth(slickSlides);

        // Drag Nav
        const teamSliderNav = teamProfiles.querySelector('.team-profiles__slider-nav');

        // Handle
        let teamSliderHandle = teamProfiles.querySelector('.team-profiles__slider-handle');
        let disableDragdealer = false;
        let teamSliderDragdealer = new Dragdealer(teamSliderNav, {
            handleClass: 'team-profiles__slider-handle',
            steps: slideCount,
            slide: true,
            dragStartCallback: function(x, y) {
                disableDragdealer = false;
            },
            dragStopCallback: function(x, y) {
                disableDragdealer = true;

                let slideVal = (slidesW * x) / (slidesW / slideCount);
                let slideNum = (slideVal - Math.ceil(slideVal) >= 0.5) ? Math.ceil(slideVal) : Math.floor(slideVal);

                // Go to slide
                teamSliderInstance.slick('slickGoTo', slideNum);
            },
            animationCallback: function(x, y) {
                if(!disableDragdealer)
                {
                    let offsetX = (slidesW - (slidesW / slideCount)) * -x;

                    $(slickTrack).css({
                        'transform': 'translate3d('+offsetX+'px, 0px, 0px)'
                    });
                }
            }
        });

        $(teamSlider).on('afterChange', function(event, slick, currentSlide) {
            disableDragdealer = true;
            teamSliderDragdealer.setStep(currentSlide + 1, null, false);
        });

        // Modal
        const teamModal = teamProfiles.nextElementSibling;
        const teamModalMembers = teamModal.querySelectorAll('.team-profiles__modal-member');
        let teamModalActiveMember = {
            ele: null,
            index: 0
        }

        function getTotalSlideWidth(slides)
        {
            let w = 0;
            for(let i = 0; i < $(slides).length; i++)
            {
                w += slides[i].offsetWidth;
            }
            return w;
        }

        function getSlickTrackPosition()
        {
            let transformStyle = slickTrack.style.transform;
            let regExp = /\(([^)]+)\)/;
            let matches = regExp.exec(transformStyle);

            return parseInt(matches[1].split(',')[0]);
        }

        // MODAL
        if(teamSlider)
        {
            teamSlider.addEventListener('click', function(e)
            {
                e.preventDefault();

                let slide = e.target.closest('.slick-slide');
                if(!slide) return;
                let index = getElementIndex(slide);
                const member = teamModalActiveMember.ele = teamModalMembers[index];
                const image = member.querySelector('.team-profiles__modal-image img');

                teamModalActiveMember.index = index;

                document.body.classList.add('modal-active');
                teamModal.style.display = 'block';
                member.classList.add('active');

                //objectFitImages(image);
            });

            teamModal.addEventListener('click', function(e)
            {
                e.preventDefault();

                // Close Modal
                if(e.target.classList.contains('team-profiles__modal-close') || e.target.closest('.team-profiles__modal-close')) {
                    closeTeamModal();
                }

                // Next Modal
                if(e.target.classList.contains('team-profiles__modal-next') || e.target.closest('.team-profiles__modal-next')) {
                    nextTeamModal();
                }
            });

            // Close Modal
            document.body.addEventListener('mousedown', function(e)
            {
                e.stopPropagation();

                if(!teamModalActiveMember.ele) return;

                // Close Modal
                if(!e.target.closest('.team-profiles__modal')) {
                    closeTeamModal();
                }
            });
        }

        function nextTeamModal()
        {
            const newIndex = teamModalActiveMember.index == teamModalMembers.length - 1 ? 0 : teamModalActiveMember.index + 1;
            teamModalActiveMember.ele.classList.remove('active');
            teamModalActiveMember.ele = teamModalMembers[newIndex];
            teamModalActiveMember.ele.classList.add('active');
            teamModalActiveMember.index = newIndex;

        }

        function closeTeamModal()
        {
            document.body.classList.remove('modal-active');
            teamModal.style.display = 'none';
            teamModalActiveMember.ele.classList.remove('active');
            teamModalActiveMember.ele = null;
        }
    }
});