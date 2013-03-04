/* ===================================================
 * budkit-editor.js v0.0.1
 * http://budkit.org/docs/editor
 * ===================================================
 * Copyright 2012 The BudKit Team
 *
 * This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

!function($) {

    "use strict"

    //Class Definition
    var BKEditor = function(element, options) {

        var $editor = this;

        this.options = $.extend({}, $.fn.bkeditor.defaults, options)
        this.element = $(element);
        this.container = $("<div/>").addClass("bkeditor").insertAfter(this.element);
        this.editorbar = $("<div/>").hide().addClass("bkeditor-toolbar btn-toolbar").appendTo(this.container);

        //iframe
        this.iframe = $("<iframe/>").addClass("bkeditor-content input").height(this.element.outerHeight()).width("100%").appendTo(this.container) //.addClass("bkeditor-content input").appendTo(this.container).width(this.element.outerWidth()).attr("contenteditable", true);                     

        //Not all browsers use ContentWindow this will fail in Firefox
        var edit = this.editor = this.iframe[0].contentWindow.document;
        edit.designMode = 'on';
        edit.open();
        edit.write(this.element.val());
        edit.close();

        //console.log(edit.body);
        //Optional styling
        if (this.options.stylesheet) {
            var e = edit.createElement('link');
            e.rel = 'stylesheet';
            e.type = 'text/css';
            e.href = this.options.stylesheet;
            edit.getElementsByTagName('head')[0].appendChild(e);
        }

        //this.copyAttributes(["spellcheck", "value", "placeholder"]).from( this.element ).to(this.editor.body);
        $(edit.body).attr("contenteditable", true).on('click keyup keydown mousedown blur', function() {
            $editor.updateElement()
        })
        .empty() //some browsers like mozilla add a .element.height()})br element to a design mode body, empty this when created

        this.element.on('click keyup keydown mousedown blur', function() {
            $editor.updateEditor()
        });

        this.togglePlaceHolder();
        this.element.hide();

        //Initialize the toolbar
        this.toolbar = new BKEditorToolbar(this, this.options);
    }

    BKEditor.prototype = {
        Constructor: BKEditor,
        toString: function(html) {
            html = html || false;
            return (!html) ? $(this.editor.body).text() : $(this.editor.body).html();
        },
        updateElement: function() {
            //this.toolbar.build();
            //console.log("Element:::: scrollheight: "+$(this.editor.body).outerHeight()+", iframeheight: "+ this.iframe.height() );
            this.element.val(this.toString(true)).height($(this.editor.body).outerHeight());
            //Autoresize
            if ($(this.editor.body).outerHeight() > this.iframe.height())
                this.iframe.height($(this.editor.body).outerHeight(true) + 40);
        },
        updateEditor: function() {
            $(this.editor.body).html(this.element.val());
            //Autoresize
            if ($(this.editor.body).outerHeight() > this.iframe.height())
                this.iframe.height($(this.editor.body).outerHeight() + 40);
        },
        copyAttributes: function(attributesToCopy) {
            return {
                from: function(elementToCopyFrom) {
                    return {
                        to: function(elementToCopyTo) {
                            var attribute, i = 0, length = attributesToCopy.length;
                            for (; i < length; i++) {
                                attribute = attributesToCopy[i];
                                if (typeof(elementToCopyFrom.attr(attribute)) !== "undefined" && elementToCopyFrom.attr(attribute) !== "") {
                                    elementToCopyTo.attr(attribute, elementToCopyFrom.attr(attribute));
                                }
                            }
                        }
                    };
                }
            };
        },
        togglePlaceHolder: function() {
            var CLASS_NAME = "placeholder",
            $this = this,
            $editor = $(this.editor.body),
            unset = function() {
                if ($editor.hasClass(CLASS_NAME)) {
                    $editor.empty();
                }
                $editor.removeClass(CLASS_NAME);
            },
            set = function() {
                if ($editor.is(":empty")) {
                    $editor.html($this.element.attr("placeholder"));
                    $editor.addClass(CLASS_NAME);
                }
            };
            $editor.on("focus click keyup keydown mousedown", unset)
            $($editor).blur(set);
            set();
        },
        execCommand: function(a, b, c) {
            $(this.editor.body).focus();
            this.editor.execCommand(a, b || false, c || null);
            this.updateElement();
        },
        ec: function(a, b, c) {
            this.execCommand(a, b, c);
        },
        queryCommandValue: function(a) {
            $(this.editor.body).focus();
            return this.editor.queryCommandValue(a);
        },
        qc: function(a) {
            return this.queryCommandValue(a);
        }
    };
    var BKEditorToolbar = function($this, options) {

        var $toolbar = this;
        this.options = $.extend({}, options);
        if(this.options.hidetoolbar) return $toolbar;
        //console.log(this.options.toolbar);

        $.each(this.options.toolbar, function(i, commands) {
            if ($.isArray(commands)) {
                //Then we are defining a custom object
                //or it is a lonely item;
                $toolbar.getBtnGroup(commands, $this).appendTo($this.editorbar);
            }
        });
        //Show toolbar on focus, hide onexit;
        //console.log( $this.editor.html());
        $($this.editor.body).on("click focus keydown keyup mousedown", function() {
            $this.editorbar.show();
        });
    };
    BKEditorToolbar.prototype = {
        commands: {
            bold: ['bold', 'Bold', function($this) {
                $this.ec("bold")
            }], //class, title, onClick, onAfterExecute,
            italic: ['italics', 'italic', function($this) {
                $this.ec("italic")
            }],
            underline: ['underline', 'Underline', function($this) {
                $this.ec("underline");
            }],
            strikethrough: ['strikethrough', 'Strike through', function($this) {
                $this.ec("strikethrough");
            }],
            orderedlist: ['list-ol', 'Insert ordered list', function($this) {
                $this.ec("insertorderedlist");
            }],
            unorderedlist: ['list-ul', 'Insert unordered list', function($this) {
                $this.ec("insertunorderedlist");
            }],
            outdent: ['indent-right', 'Indent right'],
            indent: ['indent-left', 'Indent-left'],
            leftalign: ['align-left', 'Left Align'],
            centeralign: ['align-center', 'Centralize'],
            rightalign: ['align-right', 'Right Align'],
            blockjustify: ['align-justify', 'Justify'],
            undo: ['undo', 'Undo'],
            redo: ['repeat', 'Redo'],
            image: ['photo', 'Insert image'],
            link: ['link', 'Createlink']
        },
        addSeperator: function() {
        },
        getBtnGroup: function(group, $this) {
            var $toolbar = this,
            btnGroup = $("<div/>").addClass("btn-group");
            //console.log(group);
            if (!$.isArray(group))
                return $();
            $.each(group, function(i, btn) {
                $toolbar.getBtn(btn, $this).appendTo(btnGroup);
            });

            return btnGroup;
        },
        getBtn: function(button, $this) {
            var btn = $("<a/>").addClass("btn"),
            btnicon = $("<i/>").addClass("icon"),
            commands = this.commands,
            btnObj = (typeof button == "string" && commands[button])? commands[button] : button;

            if ($.isArray(btnObj)) {
                btnicon.addClass("icon-" + btnObj[0]).appendTo(btn);
                //console.log(btnObj);
                //Add Button method;
                if (btnObj[2] && typeof btnObj[2] == "function") {
                    btn.on('click', function() {
                        btnObj[2]($this);
                    });
                }
                return btn;
            }
            return $();
        },
        toggleBtnActive: function() {
        },
        toggleBtnDisable: function() {
        },
        inactivateAllBtn: function() {
        }
    }
    //Plugin Defintion
    $.fn.bkeditor = function(option) {
        return this.each(function() {
            var $this = $(this)
            , data = $this.data('bkeditor')
            , options = typeof option == 'object' && option;
            if (!data)
                $this.data('bkeditor', (data = new BKEditor(this, options)));
        //data.editor.on('click keyup keydown mousedown blur', function(){ data.updateElement()}).on('click', function(){ data.editor.focus() } ) 

        });
    };
    $.fn.bkeditor.defaults = {
        hidetoolbar:true,
        toolbar: [
        ["bold", "italic", "underline", "strikethrough"],
        ["unorderedlist"],
        ["indent", "outdent"],
        ["leftalign", "centeralign", "rightalign", "blockjustify"],
        ["link", "image"]
        ],
        stylesheet: "../../socialkit/assets/css/editor.css"
    };
    $.fn.bkeditor.Constructor = BKEditor;
    /* EDITOR DATA-API
     * ============== */

    $(function() {
        $('[data-target="budkit-editor"]').bkeditor();
    })
}(window.jQuery);

/* ===================================================
 * budkit-uploader.js v0.0.1
 * http://budkit.org/docs/editor
 * ===================================================
 * Copyright 2012 The BudKit Team
 *
 * This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

!function($) {
    "use strict"
    var BKUploader = function(field, options) {
        
        var $uploader = this;
        this.options = $.extend({}, $.fn.bkuploader.defaults, options);
        this.field = $(field);
        this.form = $(field).closest('form');
        this.iframe = $("<iframe />").attr({
            height:0,
            width:0,
            name:'bkeditor-uploader-transport'
        }).insertAfter(this.field).hide();
        this.selector = $('<a />').addClass('add-on btn no-margin').text(this.field.attr("data-label") || "Choose File").insertAfter(this.field);
        ; 
        this.datalist = this.field.attr('data-display');
        //Hide the remove type="file"
        this.field.hide();
        this.multiple = false;
       
        //Click to upload
        this.selector.on("click", function(event){
            event.preventDefault();
            $uploader.field.click();
        });
        
        if (typeof this.field.attr("multiple") !== 'undefined' && this.field.attr("multiple") !== false) {
            this.multiple = true;
        }
        this.field.on('change', $.proxy(( this.multiple) ? this.getSelectedFiles : this.getSelectedFile, this));
        $(this.form.find('.upload-start')).on('click', $.proxy(this.beginUpload, this));
    };
    //Uploader Class
    BKUploader.prototype = {
        Constructor : BKUploader,
        getUploadCount: function(){},
        getDroppedFiles : function(){},
        getUploadedFiles : function(){},
        getSelectedFile : function(event){
            event.preventDefault();   
            this.selector.text( this.field.val() );
        },
        getSelectedFiles : function(event){
            event.preventDefault();   
            
            //Disable the upload button
            this.selector.off('click').addClass("disabled");
            //this.field.off('change')
            var files = this.field.prop('files'),
            ul    = $('<ul />').addClass('nav nav-files');    
            if(this.datalist){
                for (var x = 0; x < files.length; x++) {   
                    var pb  = $('<div />').addClass('upload-progress'),
                        file = files[x],
                        imageType = /image.*/,
                        img = $('<img />'),
                        imgName = $('<span />').text( file.name ),
                        imgPreview = $('<a />');
                    ;
                    if (file.type.match(imageType)) {
                        img = $("<img />");
                        imgPreview.append( img );
                        var reader = new FileReader();
                        reader.onload = (function(aImg) { return function(e) { aImg.attr('src', e.target.result ).attr('width', 100 ); }; })(img);
                        reader.readAsDataURL(file);          
                    }
                    
                    ul.append( $('<li/>').append( imgPreview.append( pb ) ) );
                }
                $(this.datalist).append(ul);
            }
            //@todo if autoupload
            //@todo maybe use a data-autoupload attribute?
            if (typeof this.field.attr("autoload") !== 'undefined' && this.field.attr("autoload") !== false) {
                this.beginUpload( event );
            }
        },
        validate: function(){},
        beginUpload: function(event){
            event.preventDefault(); 
  
            
            var uploadurl   = $(this.datalist).attr('data-src'),
                progresskey = $(this.datalist).attr('data-progress'),
                bucketlist  = $(this.datalist).find('ul'), 
                bucket      = $(this.datalist),
                selector    = this.selector,
                field       = this.field,
                filecount   = field[0].files.length,
                form        = this.form
                
            ;
            
            //Can we send the files asynchronously?
            $.each(field[0].files, function(i, file){
                var data = new FormData(),
                preview  = bucketlist.eq(i).find('a'),
                indicator = $('<i />').appendTo(  preview.find('div.upload-progress') );
                data.append('bkattachment', file);
                data.append( progresskey, 'bkattachment-'+i );
                
                $(indicator).addClass('icon-refresh icon-spin');
                $.ajax({url:uploadurl+"create/bkattachment.json",data: data, cache: false,contentType: false,processData: false,type: 'POST',
                    success: function (response) {
                        var newField = $('<input type="hidden" name="attachment[]" />').val( response.data.object.uri );
                            form.append( newField );
                        $(indicator).removeClass('icon-refresh icon-spin');
                        $(indicator).addClass('icon-ok');
                        $(indicator).closest('.upload-progress').addClass("completed");
                    },
                    complete: function(){

                        //Remove the progress bar, replace with a tick;
               
                        
                        //The last request is complete
                        if(parseInt(i+1)==filecount){
                            //Move the uploaded files outof the bucket;
                            //Clear the val of this.field
                            field.val("");
                            //field.on("change");
                            //Re-enable the upload form
                        }
                    }
                });
            })
        },
        onUpload: function(){},
        beforeUpload: function(){},
        afterUpload: function(){},
        abortUpload: function(){}
    };
    //Plugin Defintion
    $.fn.bkuploader = function(option) {
        return this.each(function() {
            var $this = $(this)
            , data = $this.data('bkuploader')
            , options = typeof option == 'object' && option;
            if (!data)
                $this.data('bkuploader', (data = new BKUploader(this, options)));
        });
    };
    $.fn.bkuploader.defaults = {};
    $.fn.bkuploader.Constructor = BKUploader;
    
    //Plugin data api
    $(function() {
        $('[data-target="budkit-uploader"]').bkuploader();
    })
}(window.jQuery);