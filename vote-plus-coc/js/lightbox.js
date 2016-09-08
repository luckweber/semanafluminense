(function ($) {
    $(document).ready(function( $ ){
        
       
        $.fn.lightbox = function () {
            
           
            
            var settings = $.extend({
                animation: "animationSlider" // animationfadeIn, animationSlider
            });
            
            
            

            var self = $(this);

            currentItem = 1;

            var bodyElements = document.getElementsByClassName("lightbox");

            var arrayItem = document.getElementsByClassName("panel-lightbox");


            var background = $("<div/>", {id: "lightbox-background"});
            var lightbox = $("<div/>", {id: "lightbox"});
            var img = $("<img/>", {id: "lightbox-image", class: "image"});
            var buttont = $("<a/>", {class: "lightbox-button"});
            var menu = $("<div/>", {id: "lightbox-menu"});
            var textt = $("<h6/>", {id: "lightbox-text"});

            var arrowRight = $("<div/>", {id: "lightbox-arrow-right"});
            var arrowLeft = $("<div/>", {id: "lightbox-arrow-left"});


            background.append(menu);
            var width = lightbox.css("width");
            background.append(lightbox);
           

            $("body").append(background);

            background.hide();


            $("body").on("click", '.' + self.attr("class"), function (event) {
                event.preventDefault();
                
                $("body").addClass("wp-admin wp-core-ui js  index-php auto-fold admin-bar branch-4-6 version-4-6 admin-color-fresh locale-pt-br customize-support svg folded");


                if ($(this).attr("data-lightbox-gallery") == undefined) {

                    $(this).each(function () {
                        menu.empty();
                        menu.append(buttont);
                        lightbox.empty();

                        img.attr("src", $(this).attr("href"));
                        textt.text($(this).attr("title"));

                        menu.append(textt);


                        var linkImage = img.attr("src");

                        lightbox.append(img);

                        //background.fadeIn(800);
                        
                        if(settings.animation == "animationfadeIn"){
                            lightbox.css("width", width);
                            background.fadeIn(800);
                        }else if(settings.animation == "animationSlider"){
                            background.show();
                            lightbox.css("width", "0%");
                            lightbox.stop().animate({"position": "relative","width":"71%",  "margin-left": "auto", "margin-right": "auto"}, 800);

                        }
                        

                        lightbox.start();
                        

                    });

                } else {
                    menu.empty();
                    menu.append(buttont);
                    background.append(arrowRight);
                    background.append(arrowLeft);
                    var numItem = $(".lightbox").index(this);

                    //currentItem  = 1;

                    //alert(numItem);
                    lightbox.empty();

                    var arrayElements = [];


                    var n = 0;

                    for (var i = 0; i < bodyElements.length; i++) {

                        if (bodyElements[i].getAttribute("data-lightbox-gallery") == $(this).attr("data-lightbox-gallery")) {
                            arrayElements[n] = bodyElements[i];
                            
                            ++n;
                        }

                    }
					
					
					
					currentItem += $(arrayElements).index(this);
					

                    for (var i = 0; i < arrayElements.length; i++) {
                        var panel = $("<div/>", {class: "panel-lightbox"});
                        var imgs = $("<img/>", {class: "image"});
                        var texts = $("<h6/>", {class: "lightbox-text"});

                        imgs.attr("src", arrayElements[i].getAttribute("href"));
                        texts.text(arrayElements[i].getAttribute("title"));


                        menu.append(texts);

                        panel.append(imgs);
                        lightbox.append(panel);
                    }

                    move();


                }

            });



            function move(n) {

                var texxt = document.getElementsByClassName("lightbox-text");

                if (currentItem > arrayItem.length) {
                    currentItem = arrayItem.length;
                }
                
                if (currentItem <= 1) {
                    currentItem = 1;
                }
                
                

                for (var i = 0; i < arrayItem.length; i++) {

                    arrayItem[i].style.display = "none";
                    texxt[i].style.display = "none";


                }

                arrayItem[currentItem - 1].style.display = "block";
                texxt[currentItem - 1].style.display = "block";

                setInterval(function(){
		
                    if(currentItem <= 1){
                            arrowLeft.hide();
                    }else{
                            arrowLeft.show();
                    }
                    if(currentItem >= arrayItem.length){
                            arrowRight.hide();
                    }else{
                            arrowRight.show();
                    }
		
                }, 1);

                background.fadeIn(800);
                //background.show();
                //lightbox.start();
                
            }


            arrowRight.click(function () {
                move(currentItem += 1);
            });

            arrowLeft.click(function () {
                move(currentItem -= 1);
            });


            $("#lightbox-background").click(function (event) {
                $("body").removeClass();
                 $("body").addClass("wp-admin wp-core-ui js  index-php auto-fold admin-bar branch-4-6 version-4-6 admin-color-fresh locale-pt-br customize-support svg");

                if (event.target.id === "lightbox-background") {
                    //background.fadeOut(600);
                    currentItem = 1;
                   if(settings.animation == "animationfadeIn"){
                            background.fadeOut(600);
                    }else if(settings.animation == "animationSlider"){
                        //background.hide();
                        lightbox.stop().animate({"position": "relative","width":"0%",  "margin-left": "auto", "margin-right": "auto"}, 800);
                        //background.hide(900);
                        
                        setTimeout(function(){
                            background.hide();
                        },801);
                    }
                    
                    
                }

            });

            $("body").on("click", ".lightbox-button", function (event) {
                currentItem = 1;
                if(settings.animation == "animationfadeIn"){
                            background.fadeOut(600);
                    }else if(settings.animation == "animationSlider"){
                        //background.hide();
                        lightbox.stop().animate({"position": "relative","width":"0%",  "margin-left": "auto", "margin-right": "auto"}, 800);
                        //background.hide(900);
                        
                        setTimeout(function(){
                            background.hide();
                        },801);
                    }

            });

            $(document).keyup(function (e) {
                if (e.which === 27 && img.length >= 1) {
                    background.fadeOut(600);
                } else if (e.which === 39) {
                    e.preventDefault();
                }

            });

        },
                $.fn.start = function () {

                    return this.each(function () {
                        var $this = $(this),
                                parent = $this.parent(),
                                topPos,
                                topMargin,
                                leftMargin,
                                resizeTimeout,
                                topPos1
                                ;

                        if (parent.is("body:not(.root-height-set)")) {
                            $("html,body").css("height", "100%").addClass("root-height-set");
                        }
                        if ($this.css("position") === "absolute" || $this.css("position") === "fixed") {


                            if ($(window).width() > 1900) {
                                topPos = "100%";
                            } else if ($(window).width() > 800 && $(window).width() < 1900) {
                                topPos = "70%";
                            } else {
                                topPos = "50%";
                            }

                            topMargin = "-" + Math.round($this.outerHeight() / 2) + "px";
                            leftMargin = "-" + Math.round($this.outerWidth() / 2) + "px";
                            $this.css({"left": "50%", "margin-left": leftMargin});
                            


                        } else {
                            topPos = Math.floor((parent.height() - $this.outerHeight()) / 2);
                            topPos1 = "auto";
                            topMargin = "auto";
                            $this.css({"position": "relative", "margin-left": "auto", "margin-right": "auto"});
                        }

                        $this.css({"top": topPos1, "margin-top": topMargin});


                        $(window).resize(function () {
                            if (resizeTimeout) {
                                clearTimeout(resizeTimeout);
                            }
                            resizeTimeout = setTimeout(function () {
                                if ($this.css("position") === "absolute") {
                                    topMargin = "-" + Math.round($this.outerHeight() / 2) + "px";
                                    leftMargin = "-" + Math.round($this.outerWidth() / 2) + "px";
                                    $this.css({"margin-left": leftMargin, "margin-top": topMargin});
                                } else {
                                    topPos = Math.floor((parent.height() - $this.outerHeight()) / 2);
                                    $this.css("top", topPos1);
                                }
                            }, 150);
                        });
                    });
                }


    });
})(jQuery);