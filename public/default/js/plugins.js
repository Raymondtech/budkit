/* PLUGIN DIRECTORY
What you can find in this file [listed in order they appear]

       1.) Animate Background Position - plugins.jquery.com/project/backgroundPosition-Effect
       2.) jQuery Easing Plugin - gsgd.co.uk/sandbox/jquery/easing/
       3.) jQuery Ajax Form plugin - jquery.malsup.com/form/#download            
       4.) jQuery validation plugin (form validation) - docs.jquery.com/Plugins/Validation
           -password strength
       5.) Styled Selects (lightweight) - code.google.com/p/lnet/wiki/jQueryStyledSelectOverview
*/

window.log=function(){log.history=log.history||[];log.history.push(arguments);if(this.console){arguments.callee=arguments.callee.caller;var a=[].slice.call(arguments);(typeof console.log==="object"?log.apply.call(console.log,console,a):console.log.apply(console,a))}};
(function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,timeStamp,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();){b[a]=b[a]||c}})((function(){try
{console.log();return window.console;}catch(err){return window.console={};}})());

/* ============================================================
 * CHECKBOX SELECT TOGGLER PLUGIN
 * Copyright 2012 Stonyhills HQ.
 * ============================================================ */


!function( $ ){

  "use strict"

  /* CHECKBOX TOGGLER PLUGIN DEFINITION
   * ========================== */
   
   var Toggler = function ( checkbox, options ) {
       this.settings = $.extend({}, $.fn.toggler.defaults, options)
       this.$element = $(checkbox).delegate('.checkbox', 'click.toggler', $.proxy(this.toggle, this))
   
       if ( this.settings.show ) {
         this.show()
       }
   
       return this
     }
     
  Toggler.prototype = {
  
        toggle: function () {
          return this[!this.isChecked ? 'check' : 'uncheck']()
        }
  
      , check: function () {
          var that = this
          this.isChecked = true
          this.$element.trigger('check')
  
          checkbox.call(this, function () {
            var transition = $.support.transition && that.$element.hasClass('slide')
  
            that.$element.toggle();
  
            if (transition) {
              that.$element[0].offsetWidth // force reflow
            }
  
            that.$element.addClass('horizontal-slide')
  
            transition ?
              that.$element.one(transitionEnd, function () { that.$element.trigger('check') }) :
              that.$element.trigger('check')
  
          })
  
          return this
        }
  
      , uncheck: function (e) {
          //e && e.preventDefault()
  
          if ( !this.isChecked ) {
            return this
          }
  
          var that = this
          this.isChecked = false
  
          this.$element.trigger('uncheck').removeClass('horizontal-slide')
 
  
          return this
        }
  
    }
    
    function checkbox ( callback ) {
        var that = this
          , animate = this.$element.hasClass('slide') ? 'slide' : ''
        if ( this.isChecked ) {
          var doAnimate = $.support.transition && animate
    
          this.$checkbox = $('<span class="checkbox checked"><span class="checkbox-on">Show</span><span class="checkbox-off">Hide</span></span>')
            .insertAfter(this.$element)
    
          if ( this.settings.backdrop != 'static' ) {
            this.$backdrop.click($.proxy(this.hide, this))
          }
    
          if ( doAnimate ) {
            this.$backdrop[0].offsetWidth // force reflow
          }
    
          this.$checkbox.addClass('checked')
    
          doAnimate ?
            this.$backdrop.one(transitionEnd, callback) :
            callback()
    
        } else if ( !this.isActive && this.$checkbox ) {
          this.$checkbox.removeClass('checked')
    
        } else if ( callback ) {
           callback()
        }
      }

  /* Plugin definition 
  =======================================*/
  $.fn.toggler = function ( selector ) {
    return this.each(function () {
      $(this).delegate(selector || d, 'click', function (e) {
        var checkbox  = $(this)
          , isChecked = checkbox.is(':checked');

        clearMenus()
        !isActive && chechbox.toggleClass('open')
        return false
      })
    })
  }

  /* APPLY TO STANDARD CHECKBOX ELEMENTS
   * =================================== */

  var d = 'input.checkbox, .checkbox';
  
  function controls(){
  }

  $(function () {
    //$('html').bind("click", clearMenus)
    //$('body').toggler( d );
  })

}( window.jQuery || window.ender );


/* ============================================================
 * bootstrap-dropdown.js v1.4.0
 * http://twitter.github.com/bootstrap/javascript.html#dropdown
 * ============================================================
 * Copyright 2011 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


!function( $ ){

  "use strict"

  /* DROPDOWN PLUGIN DEFINITION
   * ========================== */

  $.fn.dropdown = function ( selector ) {
    return this.each(function () {
      $(this).delegate(selector || d, 'click', function (e) {
        var li = $(this).parent('li')
          , isActive = li.hasClass('open')

        clearMenus()
        !isActive && li.toggleClass('open')
        return false
      })
    })
  }

  /* APPLY TO STANDARD DROPDOWN ELEMENTS
   * =================================== */

  var d = 'a.menu, .dropdown-toggle'

  function clearMenus() {
    $(d).parent('li').removeClass('open')
  }

  $(function () {
    $('html').bind("click", clearMenus)
    $('body').dropdown( '[data-dropdown] a.menu, [data-dropdown] .dropdown-toggle' )
  })

}( window.jQuery || window.ender );

/* =========================================================
 * bootstrap-modal.js v1.4.0
 * http://twitter.github.com/bootstrap/javascript.html#modal
 * =========================================================
 * Copyright 2011 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */


!function( $ ){

  "use strict"

 /* CSS TRANSITION SUPPORT (https://gist.github.com/373874)
  * ======================================================= */

  var transitionEnd

  $(document).ready(function () {

    $.support.transition = (function () {
      var thisBody = document.body || document.documentElement
        , thisStyle = thisBody.style
        , support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined
      return support
    })()

    // set CSS transition event type
    if ( $.support.transition ) {
      transitionEnd = "TransitionEnd"
      if ( $.browser.webkit ) {
      	transitionEnd = "webkitTransitionEnd"
      } else if ( $.browser.mozilla ) {
      	transitionEnd = "transitionend"
      } else if ( $.browser.opera ) {
      	transitionEnd = "oTransitionEnd"
      }
    }

  })


 /* MODAL PUBLIC CLASS DEFINITION
  * ============================= */

  var Modal = function ( content, options ) {
    this.settings = $.extend({}, $.fn.modal.defaults, options)
    this.$element = $(content)
      .delegate('.close', 'click.modal', $.proxy(this.hide, this))

    if ( this.settings.show ) {
      this.show()
    }

    return this
  }

  Modal.prototype = {

      toggle: function () {
        return this[!this.isShown ? 'show' : 'hide']()
      }

    , show: function () {
        var that = this
        this.isShown = true
        this.$element.trigger('show')

        escape.call(this)
        backdrop.call(this, function () {
          var transition = $.support.transition && that.$element.hasClass('fade')

          that.$element
            .appendTo(document.body)
            .show()

          if (transition) {
            that.$element[0].offsetWidth // force reflow
          }

          that.$element.addClass('in')

          transition ?
            that.$element.one(transitionEnd, function () { that.$element.trigger('shown') }) :
            that.$element.trigger('shown')

        })

        return this
      }

    , hide: function (e) {
        e && e.preventDefault()

        if ( !this.isShown ) {
          return this
        }

        var that = this
        this.isShown = false

        escape.call(this)

        this.$element
          .trigger('hide')
          .removeClass('in')

        $.support.transition && this.$element.hasClass('fade') ?
          hideWithTransition.call(this) :
          hideModal.call(this)

        return this
      }

  }


 /* MODAL PRIVATE METHODS
  * ===================== */

  function hideWithTransition() {
    // firefox drops transitionEnd events :{o
    var that = this
      , timeout = setTimeout(function () {
          that.$element.unbind(transitionEnd)
          hideModal.call(that)
        }, 500)

    this.$element.one(transitionEnd, function () {
      clearTimeout(timeout)
      hideModal.call(that)
    })
  }

  function hideModal (that) {
    this.$element
      .hide()
      .trigger('hidden')

    backdrop.call(this)
  }

  function backdrop ( callback ) {
    var that = this
      , animate = this.$element.hasClass('fade') ? 'fade' : ''
    if ( this.isShown && this.settings.backdrop ) {
      var doAnimate = $.support.transition && animate

      this.$backdrop = $('<div class="modal-backdrop ' + animate + '" />')
        .appendTo(document.body)

      if ( this.settings.backdrop != 'static' ) {
        this.$backdrop.click($.proxy(this.hide, this))
      }

      if ( doAnimate ) {
        this.$backdrop[0].offsetWidth // force reflow
      }

      this.$backdrop.addClass('in')

      doAnimate ?
        this.$backdrop.one(transitionEnd, callback) :
        callback()

    } else if ( !this.isShown && this.$backdrop ) {
      this.$backdrop.removeClass('in')

      $.support.transition && this.$element.hasClass('fade')?
        this.$backdrop.one(transitionEnd, $.proxy(removeBackdrop, this)) :
        removeBackdrop.call(this)

    } else if ( callback ) {
       callback()
    }
  }

  function removeBackdrop() {
    this.$backdrop.remove()
    this.$backdrop = null
  }

  function escape() {
    var that = this
    if ( this.isShown && this.settings.keyboard ) {
      $(document).bind('keyup.modal', function ( e ) {
        if ( e.which == 27 ) {
          that.hide()
        }
      })
    } else if ( !this.isShown ) {
      $(document).unbind('keyup.modal')
    }
  }


 /* MODAL PLUGIN DEFINITION
  * ======================= */

  $.fn.modal = function ( options ) {
    var modal = this.data('modal')

    if (!modal) {

      if (typeof options == 'string') {
        options = {
          show: /show|toggle/.test(options)
        }
      }

      return this.each(function () {
        $(this).data('modal', new Modal(this, options))
      })
    }

    if ( options === true ) {
      return modal
    }

    if ( typeof options == 'string' ) {
      modal[options]()
    } else if ( modal ) {
      modal.toggle()
    }

    return this
  }

  $.fn.modal.Modal = Modal

  $.fn.modal.defaults = {
    backdrop: false
  , keyboard: false
  , show: false
  }


 /* MODAL DATA- IMPLEMENTATION
  * ========================== */

  $(document).ready(function () {
    $('body').delegate('[data-controls-modal]', 'click', function (e) {
      e.preventDefault()
      var $this = $(this).data('show', true)
      $('#' + $this.attr('data-controls-modal')).modal( $this.data() )
    })
  })

}( window.jQuery || window.ender );


