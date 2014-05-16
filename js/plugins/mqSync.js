// Add Events Cross-browser
if(typeof define === 'undefined') var define = function (a,b){core = {}; core.run = b; core.run($)};
define(['jquery'],function($){
    var activeMQ;
    var currentMQ = "unknown";

    var event = {
        add: function(elem, type, fn) {
            if (elem.attachEvent) {
                elem['e'+type+fn] = fn;
                elem[type+fn] = function() {elem['e'+type+fn](window.event);}
                elem.attachEvent('on'+type, elem[type+fn]);
            } else
                elem.addEventListener(type, fn, false);
        }
    };

    var _querys = [];
    // Checks CSS value in active media query and syncs Javascript functionality
    var _cssCheck = function(){

        // Fix for Opera issue when using font-family to store value
        if (window.opera){
            var activeMQ = window.getComputedStyle(document.body,':after').getPropertyValue('content');
        }
        // For all other modern browsers
        else if (window.getComputedStyle)
        {
            var activeMQ = window.getComputedStyle(document.head,null).getPropertyValue('font-family');
        }
        // For oldIE
        else {
            // Use .getCompStyle instead of .getComputedStyle so above check for window.getComputedStyle never fires true for old browsers
            window.getCompStyle = function(el, pseudo) {
                this.el = el;
                this.getPropertyValue = function(prop) {
                    var re = /(\-([a-z]){1})/g;
                    if (prop == 'float') prop = 'styleFloat';
                    if (re.test(prop)) {
                        prop = prop.replace(re, function () {
                            return arguments[2].toUpperCase();
                        });
                    }
                    return el.currentStyle[prop] ? el.currentStyle[prop] : null;
                }
                return this;
            }
            var compStyle = window.getCompStyle(document.getElementsByTagName('head')[0], "");
            var activeMQ = compStyle.getPropertyValue("font-family");
        }

        activeMQ = activeMQ.replace(/"/g, "");
        activeMQ = activeMQ.replace(/'/g, "");

        if (activeMQ != currentMQ) {
            currentMQ = activeMQ;
            $(window).trigger('mqchange',[currentMQ]);
            $(window).trigger('mqchange:'+currentMQ,[currentMQ]);
        }

    }; // End mqSync
    $(window).on('resize',_cssCheck);
    $(window).load(function(){currentMQ = 'unknown'; _cssCheck()});
    $(window).on('mqcheck',function(){currentMQ = 'unknown'; _cssCheck()});
    _cssCheck();
});