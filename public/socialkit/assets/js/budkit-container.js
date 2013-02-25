!function ($) {
 

    "use strict"; // jshint ;_;
  
    /*!
    * jQuery Cookie Plugin v1.3.1
    * https://github.com/carhartl/jquery-cookie
    *
    * Copyright 2013 Klaus Hartl
    * Released under the MIT license
    */
    var pluses = /\+/g;

    function raw(s) {
        return s;
    }

    function decoded(s) {
        return decodeURIComponent(s.replace(pluses, ' '));
    }

    function converted(s) {
        if (s.indexOf('"') === 0) {
            // This is a quoted cookie as according to RFC2068, unescape
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            return config.json ? JSON.parse(s) : s;
        } catch(er) {}
    }

    var config = $.cookie = function (key, value, options) {

        // write
        if (value !== undefined) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = config.json ? JSON.stringify(value) : String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', config.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
                ].join(''));
        }

        // read
        var decode = config.raw ? raw : decoded;
        var cookies = document.cookie.split('; ');
        var result = key ? undefined : {};
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = decode(parts.join('='));

            if (key && key === name) {
                result = converted(cookie);
                break;
            }

            if (!key) {
                result[name] = converted(cookie);
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function (key, options) {
        if ($.cookie(key) !== undefined) {
            $.cookie(key, '', $.extend(options, {
                expires: -1
            }));
            return true;
        }
        return false;
    };
    

        
    $(document).ready(function() {
        var activeTabs = {};
        if($.cookie("activeTabs")){
            activeTabs = JSON.parse($.cookie("activeTabs"));
            $.each(activeTabs, function(nid, active){
                $('#'+nid).find('[data-target="'+active+'"]').tab('show') //Click to show the tab
            });
        }
        $.each($('.nav'), function(index, nav){
            var navId = $(nav).attr('id');
            if(navId){
                $(nav).find('[data-toggle="tab"]').bind('click', function(e) {
                    activeTabs[navId] = $(this).attr('data-target');                  
                    $.cookie("activeTabs", JSON.stringify(activeTabs, null, 2) , {
                        expires: 90, 
                        path: '/'
                    } );            
                });
            }
        });
        
    });
  
    $(document).on('click.container.data-api', '[data-toggle="container-left"]', function (e) {
        e.preventDefault();
        $('.container-box').toggleClass('has-left');
        $('.container-box-toggle').find('i').toggleClass(function(){
            return ($(this).hasClass('icon-chevron-left'))?'icon-chevron-right':'icon-chevron-left'; 
        });
    }).on('click.container.data-api', '[data-toggle="container-aside"]', function (e) {
        e.preventDefault();
        $('.container-right').toggleClass('has-aside');
        $('.container-right-toggle').find('i').toggleClass(function(i, $oldClassName){
            //alert($(this).attr('class'));
            var $newClassName = ($(this).hasClass('icon-chevron-right'))?'icon-chevron-left':'icon-chevron-right'
            $(this).removeClass( $oldClassName );
            return $newClassName; 
        });
    })

}(window.jQuery);



