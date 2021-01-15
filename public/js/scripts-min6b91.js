function initEventsTeaser(){resetEventTeaserList(),$(COUNTRY_FILTER_BUTTON).click(function(){updateEventTeaserList()})}function resetEventTeaserList(){$(EVENT_LIST_ITEM).each(function(index,element){$element=$(element),0===index?($element.show(),$element.addClass("events-teaser__event-list__item--with-border")):1===index?($element.show(),$element.removeClass("events-teaser__event-list__item--with-border")):($element.hide(),$element.removeClass("events-teaser__event-list__item--with-border"))}),$(NO_EVENT_MESSAGE).hide();var $link=$(EVENTS_LINK),baseUrl=$link.data("base-url");$link.attr("href",baseUrl)}function updateEventTeaserList(){var selectedCountry=$(COUNTRY_SELECT).val();if("all"===selectedCountry)return void resetEventTeaserList();var eventFound=!1,counter=0;$(EVENT_LIST_ITEM).each(function(index,element){var $element=$(element);$element.data("country")===selectedCountry&&counter<2?($element.show(),eventFound=!0,1==++counter&&$element.addClass("events-teaser__event-list__item--with-border")):($element.hide(),$element.removeClass("events-teaser__event-list__item--with-border"))}),eventFound?$(NO_EVENT_MESSAGE).hide():$(NO_EVENT_MESSAGE).show();var $link=$(EVENTS_LINK),url=$link.data("base-url")+"?&country="+selectedCountry;$link.attr("href",url)}function checkToTopButton(){window.pageYOffset>=.5*window.innerHeight?$(".page-top").fadeIn("fast"):$(".page-top").fadeOut("fast")}function daadToTopButtonOnScroll(){var now=(new Date).getTime();now-l>400&&!scrolling&&($(this).trigger("scrollStart"),l=now),clearTimeout(t),t=setTimeout(function(){scrolling&&$(window).trigger("scrollEnd"),checkToTopButton()},300)}function clearAbbr(termElement){$(termElement).replaceWith("<span>"+termElement.text()+"</span>")}function initRefugeesFaq(){$("#faq-language-select").empty(),$(".faq-wrapper").each(function(){var optionValue=$(this).data("languageshort"),optionLabel=$(this).data("language"),optionDirection="",dir=$(this).find("*[dir]").attr("dir");void 0!==dir&&"rtl"==dir.toLowerCase()&&(optionDirection=' dir="rtl"'),$("#faq-language-select").append('<option value="'+optionValue+'"'+optionDirection+">"+optionLabel+"</option>"),$(this).hasClass("active")&&$("#faq-language-select").val(optionValue)}),$("#faq-language-select").change(function(){var chosenLanguage=$(this).val(),target=$('.faq-wrapper[data-languageshort="'+chosenLanguage+'"]');$(".faq-wrapper.active").hide(),$(target).show().addClass("active"),history.pushState(null,null,"?language="+encodeURIComponent(chosenLanguage))})}function trackShariff(shariffLink){$(".language-flag .en").hasClass("inactive");var docId=$("meta[name=X-Imperia-Live-Info]").attr("content").split("/");docId=docId[docId.length-1],void 0!==$(".shariff").data("docid")&&(docId=$(".shariff").data("docid")),void 0!==$(".shariff").data("lang")&&$(".shariff").data("lang");var plattform=$(shariffLink).parent(".shariff-button").attr("class");plattform=plattform.replace("shariff-button","").trim()}function renderVideoInformation(video){var title=$(video).data("title"),person=$(video).data("person"),quotation=$(video).data("quotation"),description=$(video).data("description"),html="<h1>"+title+"</h1>";return html+='<p class="person">'+person+"</p>",quotation&&(html+='<p class="quotation">'+quotation+"</p>"),html+='<p class="description">'+description+"</p>"}function matchHeight(){$("#start").length&&($(".row").each(function(){$(this).children(".col-lg-4").matchHeight()}),$(".teaser-row").each(function(){$(this).children("div").matchHeight()})),$("#overview").length&&$(".row").each(function(){$(this).children(".col-lg-4").matchHeight()})}function initYoutubeFrames(){$.isFunction($.fn.mediaelementplayer)&&($(".html5video video, audio").mediaelementplayer({alwaysShowControls:!0,toggleCaptionsButtonWhenOnlyOne:!0,pluginPath:".",iPhoneUseNativeControls:!0,iPadUseNativeControls:!0,AndroidUseNativeControls:!1}),$(".youtube-preview").click(function(e){var youtubeUrl=$(this).data("youtube-link"),videoId=youtubeUrl.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);videoId=videoId[1],$(this).find("img").remove(),$(this).find("span").remove(),$(this).append('<iframe class="youtube-frame" src="https://www.youtube-nocookie.com/embed/'+videoId+'?autoplay=1" frameborder="0" allowfullscreen></iframe>'),setYoutubeFrames()}),"en"==$("html").attr("lang")&&$(".youtube-preview + p").text("To play video, please click on image. Please note video host will have access to data."),$(window).resize(function(){setYoutubeFrames()}))}function setYoutubeFrames(){if($(".youtube-frame").length){var currentTeserElementWidth=$(".youtube-frame").outerWidth();$(".youtube-frame").css("height",.75*currentTeserElementWidth)}}function initFeedTeaser(){const $masonryElement=$(".js-feed-wall");$masonryElement.length&&$.getScript("https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js").done(function(){const masonryElementHeight=$masonryElement.outerHeight(),$scrollButton=$(".js-feed-scroll"),$socialFeed=$(".js-feed-feed"),socialmediaFeedHeight=$socialFeed.data("feed-height");$masonryElement.css("max-height",socialmediaFeedHeight),$masonryElement.parent().css("max-height",socialmediaFeedHeight),$masonryElement.masonry({itemSelector:".js-masonry-item",columnWidth:".js-masonry-item"}),masonryElementHeight<=socialmediaFeedHeight&&$scrollButton.hide(),$scrollButton.click(function(){var direction=$(this).data("direction");const $feedToScroll=$(this).parent().parent().find(".js-feed-feed"),scrollTop=$feedToScroll.scrollTop();var newScrollTop=scrollTop-400;"up"==direction&&(newScrollTop=scrollTop+400),$feedToScroll.animate({scrollTop:newScrollTop},200)})})}function initStudyinLayer(){var $layer=$(".js-layer"),cookies=document.cookie.split("; ");jQuery.inArray("hide_studyinde_layer=true",cookies)>=0||!$layer.length||($layer.removeClass("hidden"),$("body").on("click",".js-layer-close",function(){$layer.remove();var expiryDate=new Date;expiryDate.setTime(expiryDate.getTime()+864e6),document.cookie="hide_studyinde_layer=true; expires="+expiryDate.toGMTString()+"; path=/"}))}var DAAD=function(daad,$){return daad.SLIDER_FULL_ZEHNPUNKTE="STARTPAGE_ZEHNPUNKTE",daad.SLIDER_ZEHNPUNKTE_LINKS="ZEHNPUNKTE_LINKS",daad.SLIDER_ZEHNPUNKTE_RECHTS="ZEHNPUNKTE_RECHTS",daad.SLIDER_WECHSELTEASER="WECHSELTEASER",daad.SLIDER_NEWS="NEWS",daad.Slider=function(){var slider=[],updateSlider=!0,create=function(configObj){var sliderObj,selector,sliderType,touchEnabled,onSlideAfter,autoStart,video,speed=500,nextText="Weiter",prevText="Zurück",pager=!0,pagerType="full",controls=!0,infiniteLoop=!1,hideControlOnEnd=!0,minSlides=1,maxSlides=1,moveSlides=1,slideWidth=0,slideMargin=0,startSlide=0,adaptiveHeight=!0,mode="horizontal",pagerSelector="",pagerShortSeparator=" / ",preventDefaultSwipeY=!0,responsive=!0,preloadImages="all",swipeThreshold=75,auto=!1,autoControls=!0,pause=4e3,autoHover=!1;if(void 0!==configObj.type)switch(configObj.type){case DAAD.SLIDER_FULL_ZEHNPUNKTE:selector=$(".bxslider-horizontal-zehnpunkte"),mode="horizontal",minSlides=4,maxSlides=4,slideWidth=5e3,slideMargin=0,pager=!1,adaptiveHeight=!0,infiniteLoop=!1,hideControlOnEnd=!0,preventDefaultSwipeY=!1;break;case DAAD.SLIDER_ZEHNPUNKTE_LINKS:selector=$(".col-lg-8 .bxslider-horizontal-zehnpunkte"),mode="horizontal",minSlides=2,maxSlides=2,slideWidth=5e3,slideMargin=0,pager=!1,adaptiveHeight=!0,infiniteLoop=!1,hideControlOnEnd=!0,preventDefaultSwipeY=!1,pager=!0;break;case DAAD.SLIDER_ZEHNPUNKTE_RECHTS:selector=$(".col-lg-4 .bxslider-horizontal-zehnpunkte"),mode="horizontal",minSlides=1,maxSlides=1,slideWidth=5e3,slideMargin=0,pager=!1,adaptiveHeight=!0,infiniteLoop=!1,hideControlOnEnd=!0,preventDefaultSwipeY=!1;break;case DAAD.SLIDER_WECHSELTEASER:selector=$(".wt-slider"),mode="horizontal",minSlides=1,maxSlides=1,slideWidth=620;var slideHeight=349;pager=!0,controls=!0,auto=!0,speed=1e3,autoControls=!0,adaptiveHeight=!0,infiniteLoop=!0,pause=8500,hideControlOnEnd=!0,preventDefaultSwipeY=!1,swipeThreshold=50,autoHover=!0,autoStart=!0,video=!1,touchEnabled=!1,onSlideAfter=function($slideElement,oldIndex,newIndex){var slideElement=$slideElement[0];$(".wt-image .mediaelementplayer").each(function(){var player=$(this)[0].player;if(void 0!==player){var parent=$(this).parents("li")[0];slideElement==parent?player.play():player.pause()}})};break;case DAAD.SLIDER_NEWS:selector=$(".bxslider-news"),mode="horizontal",minSlides=3,maxSlides=3,slideWidth=5e3,slideMargin=0,pager=!1,adaptiveHeight=!1,infiniteLoop=!1,hideControlOnEnd=!0,preventDefaultSwipeY=!1}void 0!==configObj.type&&(sliderType=configObj.type),void 0!==configObj.minSlides&&(speed=configObj.speed),void 0!==configObj.minSlides&&(nextText=configObj.nextText),void 0!==configObj.minSlides&&(prevText=configObj.prevText),void 0!==configObj.pager&&(pager=configObj.pager),void 0!==configObj.pager&&(pagerType=configObj.pagerType),void 0!==configObj.controls&&(controls=configObj.controls),void 0!==configObj.controls&&(infiniteLoop=configObj.infiniteLoop),void 0!==configObj.controls&&(hideControlOnEnd=configObj.hideControlOnEnd),void 0!==configObj.minSlides&&(minSlides=configObj.minSlides),void 0!==configObj.maxSlides&&(maxSlides=configObj.maxSlides),void 0!==configObj.maxSlides&&(moveSlides=configObj.moveSlides),void 0!==configObj.slideWidth&&(slideWidth=configObj.slideWidth),void 0!==configObj.slideHeight&&(slideHeight=configObj.slideHeight),void 0!==configObj.slideMargin&&(slideMargin=configObj.slideMargin),void 0!==configObj.startSlide&&(startSlide=configObj.startSlide),void 0!==configObj.adaptiveHeight&&(adaptiveHeight=configObj.adaptiveHeight),void 0!==configObj.mode&&(mode=configObj.mode),void 0!==configObj.pagerSelector&&(pagerSelector=configObj.pagerSelector),void 0!==configObj.pagerShortSeparator&&(pagerShortSeparator=configObj.pagerShortSeparator),void 0!==configObj.preventDefaultSwipeY&&(preventDefaultSwipeY=configObj.preventDefaultSwipeY),void 0!==configObj.responsive&&(responsive=configObj.responsive),void 0!==configObj.preloadImages&&(preloadImages=configObj.preloadImages),void 0!==configObj.swipeThreshold&&(swipeThreshold=configObj.swipeThreshold),void 0!==configObj.auto&&(auto=configObj.auto),void 0!==configObj.autoControls&&(autoControls=configObj.autoControls),void 0!==configObj.pause&&(pause=configObj.pause),void 0!==configObj.autoHover&&(autoHover=configObj.autoHover),void 0!==configObj.touchEnabled&&(touchEnabled=configObj.touchEnabled),void 0!==configObj.autoStart&&(autoStart=configObj.autoStart),void 0!==configObj.video&&(video=configObj.video);for(var selectorLength=selector.length,i=0;i<selectorLength;i++)sliderObj=selector.eq(i).bxSlider({speed:speed,nextText:nextText,prevText:prevText,pager:pager,pagerType:pagerType,controls:controls,infiniteLoop:infiniteLoop,hideControlOnEnd:hideControlOnEnd,minSlides:minSlides,maxSlides:maxSlides,slideWidth:slideWidth,slideHeight:slideHeight,moveSlides:moveSlides,slideMargin:slideMargin,startSlide:startSlide,adaptiveHeight:adaptiveHeight,mode:mode,pagerSelector:pagerSelector,pagerShortSeparator:pagerShortSeparator,preventDefaultSwipeY:preventDefaultSwipeY,responsive:responsive,preloadImages:preloadImages,swipeThreshold:swipeThreshold,auto:auto,autoControls:autoControls,pause:pause,autoHover:autoHover,touchEnabled:touchEnabled,onSlideAfter:onSlideAfter,autoStart:autoStart,video:video}),sliderObj.name=sliderType,slider.push(sliderObj)},update=function(configObj){var sliderLength=slider.length,count=0;for(updateSlider=!0,i=0;i<sliderLength;i++)slider[i].name===configObj.type&&count++;if(0===count)create(configObj);else for(i=0;i<sliderLength;i++)if(slider[i].name===configObj.type){destroy(slider[i].name),updateSlider&&create(configObj);break}},reload=function(sliderType){var count=slider.length;for(i=0;i<count;i++)if(slider[i].name===sliderType){slider[i].reloadSlider();break}},redraw=function(sliderType){var count=slider.length;for(i=0;i<count;i++)if(slider[i].name===sliderType){slider[i].redrawSlider();break}},destroy=function(sliderType){var i,j,count=slider.length,sameSliderTypeCount=0;for(i=0;i<count;i++)slider[i].name===sliderType&&sameSliderTypeCount++;if(sameSliderTypeCount>1)for(j=0;j<slider.length;j++)slider[j].name===sliderType&&(slider[j].destroySlider(),"bx-viewport"===slider[j].parent().attr("class")&&(updateSlider=!1),slider.splice(j,1),j=0);else for(i=0;i<count;i++)if(slider[i].name===sliderType){slider[i].destroySlider(),slider.splice(i,1);break}};return{Create:create,Update:update,Redraw:redraw,Destroy:destroy,GetSlider:function(sliderType){var sliderObj,count=slider.length;for(i=0;i<count;i++)slider[i].name===sliderType&&(sliderObj=slider[i]);return sliderObj},Reload:reload}}(),daad}(DAAD||{},jQuery);$(document).ready(function(){"use strict";$(".zoom-gallery").each(function(){$(this).magnificPopup({delegate:"a",type:"image",mainClass:"mfp-with-zoom mfp-img-mobile",closeOnContentClick:!1,closeBtnInside:!0,closeOnBgClick:!1,closeMarkup:'<button title="%title%" type="button" class="mfp-close">Schließen</button>',tClose:"Schließen",image:{verticalFit:!0,titleSrc:function(item){return item.alt=item.el.attr("data-alt"),item.img.attr("alt",item.alt),item.el.attr("title")+" <br> "+item.el.attr("data-c")}},gallery:{enabled:!0,tPrev:"Zurück (Linke Pfeiltaste)",tNext:"Vor (Rechte Pfeiltaste)",arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"><span class="sprites mfp-arrow-%dir%"></span></button>',tCounter:"%curr% | %total%"},zoom:{enabled:!0,duration:300,opener:function(element){return element.find("img")}}})})});var EVENT_LIST_ITEM=".js-event-teaser-list-item",COUNTRY_SELECT=".js-event-teaser-countries",COUNTRY_FILTER_BUTTON=".js-event-teaser-button",EVENTS_LINK=".js-event-teaser-link",NO_EVENT_MESSAGE=".js-events-none-found";$(document).ready(function(){initEventsTeaser()});var config,rtlStartSlide=1;$(document).ready(function(){"use strict";if(null!=navigator.userAgent.match(/iPad/i)&&($("html").addClass("ipad"),$(".show-ipad").attr("style","display: block !important;")),$("html").removeClass("no-js"),$("#faq-language-select").length&&initRefugeesFaq(),$("#studysearch").length){var availableTags=["ActionScript","AppleScript","Asp","BASIC","C","C++","Clojure","COBOL","ColdFusion","Erlang","Fortran","Groovy","Haskell","Java","JavaScript","Lisp","Perl","PHP","Python","Ruby","Scala","Scheme"];$(".ui-autocomplete-input").autocomplete({source:availableTags})}var isotopeImages=$(".isotope img");isotopeImages.lazyLoadXT({failure_limit:Math.max(isotopeImages.length-1,0),srcAttr:"data-original",selector:".isotope img",updateEvent:"load orientationchange resize scroll alumniLazy",blankImage:""});var $container=$(".isotope").isotope({itemSelector:".element-item",layoutMode:"fitRows",fitRows:{columnWidth:135,rowHeight:165}});$(".isotope").isotope("on","layoutComplete",function(){isotopeImages.filter(function(){var rect=this.getBoundingClientRect();return rect.top>=0&&rect.top<=window.innerHeight}).trigger("alumniLazy")});var filterFns={};if($("#filters").on("click","button",function(){var filterValue=$(this).attr("data-filter");filterValue=filterFns[filterValue]||filterValue,$container.isotope({filter:filterValue})}),$(".isotope").on("click",".button",function(){var filterValue=$(this).attr("data-filter");filterValue=filterFns[filterValue]||filterValue,$container.isotope({filter:filterValue})}),$(".button-group").each(function(i,buttonGroup){var $buttonGroup=$(buttonGroup);$buttonGroup.on("click","button",function(){$buttonGroup.find(".is-checked").removeClass("is-checked"),$(this).addClass("is-checked")})}),$(".isotope").on("click",".button",function(){$(".button-group").find(".is-checked").removeClass("is-checked")}),matchHeight(),$(".richtext table").each(function(){$(this).wrap("<div class='table-responsive'></div>")}),$("#article .wt-slider").length&&(config={type:DAAD.SLIDER_WECHSELTEASER,slideWidth:620},$("body").hasClass("microsite")||(config.slideWidth=950,config.autoStart=!1,config.video=!0),DAAD.Slider.Create(config)),$("#overview .col-lg-12 .wt-slider").length&&(config={type:DAAD.SLIDER_WECHSELTEASER,slideWidth:950},$("body").hasClass("microsite")||(config.autoStart=!1,config.video=!0),"rtl"==$("html").attr("dir")&&(config.startSlide=$("#overview .col-lg-12 .wt-slider li:not(.bx-clone)").length-1),DAAD.Slider.Create(config)),$("#overview .col-lg-8 .wt-slider").length&&(config={type:DAAD.SLIDER_WECHSELTEASER,slideWidth:620},DAAD.Slider.Create(config)),$("#start .wt-slider").length&&(config={type:DAAD.SLIDER_WECHSELTEASER,slideWidth:620},$("body").hasClass("microsite")||(config.slideWidth=950,config.autoStart=!1,config.video=!0,config.adaptiveHeight=!1),DAAD.Slider.Create(config)),$("#landingpage_language_selection").length&&$("#landingpage_language_selection select").change(function(){$("#landingpage_language_selection").submit()}),$(".shariff .shariff-button a").click(function(){trackShariff(this)}),$(".wt-image .mediaelementplayer").length&&$(".wt-image .mediaelementplayer").each(function(index){var player=$(this).mediaelementplayer({startVolume:0,enableKeyboard:!1,clickToPlayPause:!1,hideVideoControlsOnLoad:!0,hideVideoControlsOnPause:!0,features:[],pauseOtherPlayers:!1});0===index?($(player).on("canplay",function(){player[0].play()}),$(player).on("ended",function(){var slider=DAAD.Slider.GetSlider(DAAD.SLIDER_WECHSELTEASER);void 0!==slider&&(slider.goToNextSlide(),slider.startAuto(),void 0!==player[0].setLoop&&player[0].setLoop(!0),$(player).off("ended"))})):void 0!==player[0].setLoop&&player[0].setLoop(!0)}),!$($(".wt-slider li:not(.bx-clone)")[0]).find("video").length){var slider=DAAD.Slider.GetSlider(DAAD.SLIDER_WECHSELTEASER);void 0!==slider&&slider.startAuto()}$(".student-stories .video").magnificPopup({items:{src:'<div class="studentstories-lightbox"><div class="ratio"><iframe width="853" height="480" src="##VIDEO##" frameborder="0" allowfullscreen></iframe></div></div>'},type:"inline",callbacks:{elementParse:function(item){var magnificPopup=$.magnificPopup.instance,videoId=$(magnificPopup.st.el[0]).data("id");item.src=item.src.replace("##VIDEO##","https://www.youtube-nocookie.com/embed/"+encodeURI(videoId)+"?rel=0&amp;showinfo=0")}}}),$(".slide-teaser-slider-wrapper ul").length&&$(".slide-teaser-slider-wrapper ul").each(function(){$(this).slick({lazyLoad:"ondemand",centerMode:!0,infinite:!0,centerPadding:"0px",slidesToShow:5,speed:500,focusOnSelect:!1,draggable:!1,responsive:[{breakpoint:1024,settings:{slidesToShow:3,slidesToScroll:1,swipeToSlide:!0}},{breakpoint:551,settings:{slidesToShow:1,slidesToScroll:1,swipeToSlide:!0}},{breakpoint:461,settings:{slidesToShow:1,slidesToScroll:1,swipeToSlide:!0}}]});var slideGoToTemp=2;$(this).slick("slickGoTo",slideGoToTemp),$(this).find(".post-teaser").click(function(e){var currentSlider=$(this).parent().parent().parent(),sildeToGoTo=parseInt($(this).attr("data-slick-index"));slideGoToTemp==sildeToGoTo?(window.dataLayer=window.dataLayer||[],window.dataLayer.push({event:"study-in-de.city_teaser.click.slide"}),window.location.href=$(this).find("a").attr("href")):(slideGoToTemp=sildeToGoTo,currentSlider.slick("slickGoTo",sildeToGoTo))}),$(".slide-teaser-slider-wrapper ul li a").click(function(e){e.preventDefault()}),$(this).on("afterChange",function(event,slick,currentSlide){slideGoToTemp=currentSlide,$(".slick-cloned").removeClass("slick-center")})}),$("#content").on("change","#pagination_select",function(){window.location.href=$(this).val()});var wtPopupSettings={items:{src:'<div class="studentstories-lightbox"><div class="ratio"><iframe width="853" height="480" src="##VIDEO##" frameborder="0" allowfullscreen></iframe></div></div>'},type:"inline",callbacks:{elementParse:function(item){var magnificPopup=$.magnificPopup.instance,videoId=$(magnificPopup.st.el[0]).parents(".wt-wrapper").data("videoid");item.src=item.src.replace("##VIDEO##","https://www.youtube-nocookie.com/embed/"+encodeURI(videoId)+"?rel=0&amp;showinfo=0")}}};if($(".wt-slider .more-box.video").magnificPopup(wtPopupSettings),$(".wt-slider .wt-image.video-slide").magnificPopup(wtPopupSettings),$("#wohnheimteaser_hochschulort").length&&($("#wohnheimteaser_hochschulort").val(""),$("#wohnheimteaser_hochschule").val(""),$("#wohnheimteaser_hochschulort").change(function(){if($("#wohnheimteaser_submit").prop("disabled",!0),$("#wohnheimteaser_hochschule").prop("disabled",!0),$("#wohnheimteaser_hochschule option").each(function(){""!=$(this).val()&&this.remove()}),""!=$("#wohnheimteaser_hochschulort").val()){var url="/pp_studyinde/dormitoryfinder.php?action=universitylist&lang="+$("#wohnheimteaser_form").data("language")+"&town="+$("#wohnheimteaser_hochschulort").val();$.ajax({url:url,cache:!1}).done(function(data){var selectBox=$("#wohnheimteaser_hochschule");$.each(data,function(){if(this.id){var option=document.createElement("option");option.setAttribute("value",this.id),option.text=this.name,selectBox.append(option)}}),2===data.length&&(selectBox.children(2).attr("selected","selected"),$("#wohnheimteaser_submit").prop("disabled",!1)),$("#wohnheimteaser_hochschule").prop("disabled",!1)}).error(function(){$("#wohnheimteaser_hochschule").prop("disabled",!1)})}$("#wohnheimteaser_hochschule").val("")}),$("#wohnheimteaser_hochschule").change(function(){$("#wohnheimteaser_submit").prop("disabled",!0),""!=$("#wohnheimteaser_hochschule").val()&&$("#wohnheimteaser_submit").prop("disabled",!1)})),$(".prioritylink").length){var path=$(".prioritylink a").prop("href"),currentHref=window.location.href,currentPath=window.location.pathname;path!=currentHref&&path!=currentPath||$(".prioritylink a").addClass("active")}$(".page-top").hide(),initStudyinLayer()}),$(document).ready(function(){"use strict";$(".glossary-term").each(function(){var termElement=$(this),termId=termElement.attr("rel").replace("glossary-",""),language="deu";if((window.location.href.indexOf("/en/")>=0||window.location.href.indexOf("/refugees/")>=0)&&(language="eng"),"undefined"==typeof glossaryAjaxUrl||!glossaryAjaxUrl)return void clearAbbr(termElement);$.ajax({url:glossaryAjaxUrl,data:{language:language,termid:termId}}).done(function(definition){if(!definition)return void clearAbbr(termElement);termElement.attr("data-original-title",definition)}).fail(function(){clearAbbr(termElement)})});var glossaryTerms=$(".glossary-term").tooltip({template:'<div class="tooltip glossary-tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',placement:"top",trigger:"click",delay:0,container:"body"});glossaryTerms.on("shown.bs.tooltip",function(e){var currentTooltip=$(this).attr("aria-describedby"),tooltipArrow=$("#"+currentTooltip+" .tooltip-arrow"),tooltipContentElement=$("#"+currentTooltip+" .tooltip-inner"),tooltipContentElementOffset=tooltipContentElement.offset(),tooltipContentElementWidth=tooltipContentElement.outerWidth(),tooltipContentElementLeftEdge=tooltipContentElementOffset.left,tooltipContentElementRightEdge=tooltipContentElementOffset.left+tooltipContentElementWidth,contentContainer=$("#content .row .col-lg-8"),contentContainerOffset=contentContainer.offset(),contentContainerWidth=contentContainer.outerWidth(),contentContainerLeftEdge=contentContainerOffset.left,contentContainerRightEdge=contentContainerOffset.left+contentContainerWidth;if(tooltipContentElementLeftEdge<=contentContainerLeftEdge){var neededTooltipoffset=contentContainerLeftEdge;$(".glossary-tooltip").css("left",neededTooltipoffset+"px"),tooltipArrow.css("left","0px"),tooltipArrow.css("margin-left",tooltipContentElementWidth/2-5-(neededTooltipoffset-tooltipContentElementLeftEdge)+"px")}if(tooltipContentElementRightEdge>=contentContainerRightEdge){var neededTooltipoffset=tooltipContentElementRightEdge-contentContainerRightEdge;$(".glossary-tooltip").css("margin-left",-1*neededTooltipoffset+"px"),tooltipArrow.css("margin-left",neededTooltipoffset-5+"px")}$(".glossary-tooltip").css("visibility","visible"),$(".glossary-tooltip").css("opacity","1")}),glossaryTerms.on("hide.bs.tooltip",function(e){$(".tooltip-arrow").attr("style",""),$(".tooltip-inner").attr("style",""),$(".glossary-tooltip").attr("style",""),$(".glossary-tooltip").css("visibility","hidden")}),$(".page-top").click(function(e){$(this).removeClass("hover")}),$(".page-top").hover(function(){$(this).addClass("hover")},function(){$(this).removeClass("hover")})}),$(window).scroll(function(){daadToTopButtonOnScroll()});var t,l=(new Date).getTime(),scrolling=!1;enquire.register("screen and (min-width: 1px) and (max-width: 460px)",{match:function(){$(function(){($("#start .bxslider-horizontal-zehnpunkte").length||$("#overview .bxslider-horizontal-zehnpunkte").length)&&(config={type:DAAD.SLIDER_FULL_ZEHNPUNKTE,minSlides:1,maxSlides:1,slideWidth:500},"rtl"==$("html").attr("dir")&&(config.startSlide=rtlStartSlide),DAAD.Slider.Update(config)),$("#article .col-lg-8 .bxslider-horizontal-zehnpunkte").length&&(config={type:DAAD.SLIDER_ZEHNPUNKTE_LINKS,minSlides:1,maxSlides:1,slideWidth:500},DAAD.Slider.Update(config)),$("#article .col-lg-4 .bxslider-horizontal-zehnpunkte").length&&(config={type:DAAD.SLIDER_ZEHNPUNKTE_RECHTS,minSlides:1,maxSlides:1,slideWidth:500},DAAD.Slider.Update(config)),$("#start .bxslider-news").length&&(config={type:DAAD.SLIDER_NEWS,minSlides:1,maxSlides:1,slideWidth:500},DAAD.Slider.Update(config)),matchHeight()})},unmatch:function(){$(function(){})},deferSetup:!0}),enquire.register("screen and (min-width: 461px) and (max-width: 767px)",{match:function(){$(function(){if(($("#start .bxslider-horizontal-zehnpunkte").length||$("#overview .bxslider-horizontal-zehnpunkte").length)&&(config={type:DAAD.SLIDER_FULL_ZEHNPUNKTE,minSlides:2,maxSlides:2,slideWidth:1e3},"rtl"==$("html").attr("dir")&&(config.startSlide=rtlStartSlide),DAAD.Slider.Update(config)),$("#article .col-lg-8 .bxslider-horizontal-zehnpunkte").length&&(config={type:DAAD.SLIDER_ZEHNPUNKTE_LINKS,minSlides:2,maxSlides:2,slideWidth:2e3},DAAD.Slider.Update(config)),$("#article .col-lg-4 .bxslider-horizontal-zehnpunkte").length&&(config={type:DAAD.SLIDER_ZEHNPUNKTE_RECHTS,minSlides:2,maxSlides:2,slideWidth:2e3},DAAD.Slider.Update(config)),$("#start .bxslider-news").length&&(config={type:DAAD.SLIDER_NEWS,minSlides:1,maxSlides:1,slideWidth:2e3},DAAD.Slider.Update(config)),$("#start .facebook-teaser-rebrush").length){var facebookTeaserCol=$("#start .facebook-teaser-rebrush").parent(".col-sm-6");if($(".blog-teaser-our-bloggers").length){var blogTeaserCol=$(".blog-teaser-our-bloggers").parent(".col-sm-6");$(blogTeaserCol).after(facebookTeaserCol)}}matchHeight()})},unmatch:function(){$(function(){if($("#start .facebook-teaser-rebrush").length){var facebookTeaserCol=$("#start .facebook-teaser-rebrush").parent(".col-sm-6");if($(".quicklinks").length){var blogTeaserCol=$(".quicklinks").parent(".col-sm-12");$(blogTeaserCol).after(facebookTeaserCol)}}})},deferSetup:!0}),enquire.register("screen and (min-width: 768px) and (max-width: 1023px)",{match:function(){$(function(){($("#start .bxslider-horizontal-zehnpunkte").length||$("#overview .bxslider-horizontal-zehnpunkte").length)&&(config={type:DAAD.SLIDER_FULL_ZEHNPUNKTE,minSlides:2,maxSlides:2,slideWidth:1e3},"rtl"==$("html").attr("dir")&&(config.startSlide=rtlStartSlide),DAAD.Slider.Update(config)),$("#article .col-lg-8 .bxslider-horizontal-zehnpunkte").length&&(config={type:DAAD.SLIDER_ZEHNPUNKTE_LINKS,minSlides:2,maxSlides:2,slideWidth:2e3},DAAD.Slider.Update(config)),$("#article .col-lg-4 .bxslider-horizontal-zehnpunkte").length&&(config={type:DAAD.SLIDER_ZEHNPUNKTE_RECHTS,minSlides:2,maxSlides:2,slideWidth:1e3},DAAD.Slider.Update(config)),$("#start .bxslider-news").length&&DAAD.Slider.Destroy(DAAD.SLIDER_NEWS),matchHeight()})},unmatch:function(){$(function(){})}}),enquire.register("screen and (min-width: 1024px)",{match:function(){$(function(){($("#start .bxslider-horizontal-zehnpunkte").length||$("#overview .bxslider-horizontal-zehnpunkte").length)&&(config={type:DAAD.SLIDER_FULL_ZEHNPUNKTE,minSlides:4,maxSlides:4,slideWidth:5e3},"rtl"==$("html").attr("dir")&&(config.startSlide=rtlStartSlide),DAAD.Slider.Update(config)),$("#article .col-lg-8 .bxslider-horizontal-zehnpunkte").length&&(config={type:DAAD.SLIDER_ZEHNPUNKTE_LINKS,minSlides:2,maxSlides:2,slideWidth:2e3},DAAD.Slider.Update(config)),$("#article .col-lg-4 .bxslider-horizontal-zehnpunkte").length&&(config={type:DAAD.SLIDER_ZEHNPUNKTE_RECHTS,minSlides:1,maxSlides:1,slideWidth:500},DAAD.Slider.Update(config)),$("#start .bxslider-news").length&&DAAD.Slider.Destroy(DAAD.SLIDER_NEWS),$(".student-stories .video").hover(function(){$("#studentstories-description #default").hide(),$("#studentstories-description #video-specific").append(renderVideoInformation(this))},function(){$("#studentstories-description #video-specific").empty(),$("#studentstories-description #default").show()}),matchHeight()})},unmatch:function(){}}),initYoutubeFrames(),initFeedTeaser();
//# sourceMappingURL=scripts-min.map