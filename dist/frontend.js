!function(e){var t={};function o(n){if(t[n])return t[n].exports;var i=t[n]={i:n,l:!1,exports:{}};return e[n].call(i.exports,i,i.exports,o),i.l=!0,i.exports}o.m=e,o.c=t,o.d=function(e,t,n){o.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:n})},o.r=function(e){Object.defineProperty(e,"__esModule",{value:!0})},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=2)}([function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=function(e,t,o,n){e.classList.contains("bottom-fixed")?(document.body.style.marginBottom=o+"px",e.style.transform="translate(50%, "+t+"px)"):(document.body.style.marginTop=n+"px",e.style.transform="translate(50%, -"+t+"px)"),window.WP_EASY_NOTICES_VARS.is_customizer||window.localStorage.setItem("wp-easy-notices-hidden",window.WP_EASY_NOTICES_VARS.dismissal_cache),window.setTimeout(function(){e.parentNode.removeChild(e)},500)}},function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=function(){var e=window.localStorage.getItem("wp-easy-notices-hidden");return!!e&&(!window.WP_EASY_NOTICES_VARS.is_customizer&&!(!window.WP_EASY_NOTICES_VARS.dismissable||e!==window.WP_EASY_NOTICES_VARS.dismissal_cache))}},function(e,t,o){"use strict";o(5);var n=r(o(1)),i=r(o(0));function r(e){return e&&e.__esModule?e:{default:e}}!function(){var e=document.getElementById("wp-easy-notices");if((0,n.default)())e.parentNode.removeChild(e);else if(e){var t=Number(e.offsetHeight),o=Number(getComputedStyle(document.body)["margin-bottom"].split(/[a-z]/)[0]),r=Number(getComputedStyle(document.body)["margin-top"].split(/[a-z]/)[0]);e.classList.contains("bottom-fixed")?document.body.style.marginBottom=t+o+"px":document.body.style.marginTop=t+r+"px";var s=document.querySelector("#wp-easy-notices .dismiss");s&&s.addEventListener("click",function(){(0,i.default)(e,t,o,r)})}}()},,,function(e,t){}]);