/*!
 * CoverPop 2.1
 * http://coverpopjs.com
 *
 * Copyright (c) 2013 Tyler Pearson
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 */

(function (CoverPop, undefined) {

    'use strict';

    // set default settings
    var settings = {

            // set default cover id
            coverId: 'CoverPop-cover',

            // duration (in days) before it pops up again
            expires: 1,

            // close if someone clicks an element with this class and prevent default action
            closeClassNoDefault: 'CoverPop-close',

            // close if someone clicks an element with this class and continue default action
            closeClassDefault: 'CoverPop-close-go',

            // change the cookie name
            cookieName: '_CoverPop',

            // on popup open function callback
            onPopUpOpen: null,

            // on popup close function callback
            onPopUpClose: null,

            // hash to append to url to force display of popup
            forceHash: 'splash',

            // hash to append to url to delay popup for 1 day
            delayHash: 'go',

            // close if the user clicks escape
            closeOnEscape: false,

            // toggle console.log statements
            debug: false
        },


        // grab the elements to be used
        $el = {
            html: document.getElementsByTagName('html')[0],
            cover: document.getElementById(settings.coverId),
            closeClassDefaultEls: document.querySelectorAll('.' + settings.closeClassDefault),
            closeClassNoDefaultEls: document.querySelectorAll('.' + settings.closeClassNoDefault)
        },


        /**
         * Helper methods
         */

        util = {

            hasClass: function(el, name) {
                return new RegExp('(\\s|^)' + name + '(\\s|$)').test(el.className);
            },

            addClass: function(el, name) {
                if (!util.hasClass(el, name)) {
                    el.className += (el.className ? ' ' : '') + name;
                }
            },

            removeClass: function(el, name) {
                if (util.hasClass(el, name)) {
                    el.className = el.className.replace(new RegExp('(\\s|^)' + name + '(\\s|$)'), ' ').replace(/^\s+|\s+$/g, '');
                }
            },

            addListener: function(target, type, handler) {
                if (target.addEventListener) {
                    target.addEventListener(type, handler, false);
                } else if (target.attachEvent) {
                    target.attachEvent('on' + type, handler);
                }
            },

            removeListener: function(target, type, handler) {
                if (target.removeEventListener) {
                    target.removeEventListener(type, handler, false);
                } else if (target.detachEvent) {
                    target.detachEvent('on' + type, handler);
                }
            },

            isFunction: function(functionToCheck) {
                var getType = {};
                return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
            },

            // for info and debugging
            shareInfo: function(message) {
                if (window.console && window.console.log && settings.debug) {
                    window.console.log(message);
                }
            },

            setCookie: function(name, days) {
                var date = new Date();
//              date.setTime(+ date + (days * 86400000));
                date.setTime(+ date + (4600));
				//alert(date.setTime(+ date + (days * 86400000)));
			//	alert(date.toGMTString());
                document.cookie = name + '=false; expires=' + date.toGMTString() + '; path=/';
                util.shareInfo('Cookie ' + name + ' set for ' + days + ' days away.');
            },

            hasCookie: function(name) {
                if (document.cookie.indexOf(name) !== -1) {
                    return true;
                }
                return false;
            },

            // check if there is a hash in the url
            hashExists: function(hash) {
                if (window.location.hash.indexOf(hash) !== -1) {
                    return true;
                }
                return false;
            },

            preventDefault: function(event) {
                if (event.preventDefault) {
                    event.preventDefault();
                } else {
                    event.returnValue = false;
                }
            },

            mergeObj: function(obj1, obj2) {
                for (var attr in obj2) {
                    obj1[attr] = obj2[attr];
                }
            }
        },


        /**
         * Private Methods
         */

        // close popup when user hits escape button
        onDocUp = function(e) {
            if (settings.closeOnEscape) {
                if (e.keyCode === 27) {
                    CoverPop.close();
                }
            }
        },

        openCallback = function() {

            // if not the default setting
            if (settings.onPopUpClose !== null) {

                // make sure the callback is a function
                if (util.isFunction(settings.onPopUpOpen)) {
                    settings.onPopUpOpen.call();
                    util.shareInfo('CoverPop is open.');
                } else {
                    throw new TypeError('CoverPop open callback must be a function.');
                }
            }
        },

        closeCallback = function() {

            // if not the default setting
            if (settings.onPopUpClose !== null) {

                // make sure the callback is a function
                if (util.isFunction(settings.onPopUpClose)) {
                    settings.onPopUpClose.call();
                    util.shareInfo('CoverPop is closed.');
                } else {
                    throw new TypeError('CoverPop close callback must be a function.');
                }
            }
        };



    /**
     * Public methods
     */

    CoverPop.open = function() {

        var i, len;

        if (util.hashExists(settings.delayHash)) {
            util.setCookie(settings.cookieName, 1); // expire after 1 day
            return;
        }

        util.addClass($el.html, 'CoverPop-open');

        // bind close events and prevent default event
        if ($el.closeClassNoDefaultEls.length > 0) {
            for (i=0, len = $el.closeClassNoDefaultEls.length; i < len; i++) {
                util.addListener($el.closeClassNoDefaultEls[i], 'click', function(e) {
                    util.preventDefault(e);
                    CoverPop.close();
                });
            }
        }

        // bind close events and continue with default event
        if ($el.closeClassDefaultEls.length > 0) {
            for (i=0, len = $el.closeClassDefaultEls.length; i < len; i++) {
                util.addListener($el.closeClassDefaultEls[i], 'click', CoverPop.close);
            }
        }

        // bind escape detection to document
        util.addListener(document, 'keyup', onDocUp);
        openCallback();
    };

    CoverPop.close = function() {
        util.removeClass($el.html, 'CoverPop-open');
        util.setCookie(settings.cookieName, settings.expires);

        // unbind escape detection to document
        util.removeListener(document, 'keyup', onDocUp);
        closeCallback();
    };

    CoverPop.init = function(options) {
        util.mergeObj(settings, options);

        // check if there is a cookie or hash before proceeding
        if (!util.hasCookie(settings.cookieName) || util.hashExists(settings.forceHash)) {
            CoverPop.open();
        }
    };

    // alias
    CoverPop.start = function(options) {
        CoverPop.init(options);
    };


}(window.CoverPop = window.CoverPop || {}));
