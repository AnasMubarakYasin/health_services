/* empty css              *//* empty css               */function se(i){return i&&i.__esModule&&Object.prototype.hasOwnProperty.call(i,"default")?i.default:i}var re=!!(typeof window<"u"&&window.document&&window.document.createElement),le=re;const B=se(le);var ne=typeof global=="object"&&global&&global.Object===Object&&global;const oe=ne;var ae=typeof self=="object"&&self&&self.Object===Object&&self,ce=oe||ae||Function("return this")();const U=ce;var he=U.Symbol;const N=he;var G=Object.prototype,ue=G.hasOwnProperty,de=G.toString,z=N?N.toStringTag:void 0;function fe(i){var t=ue.call(i,z),s=i[z];try{i[z]=void 0;var e=!0}catch{}var r=de.call(i);return e&&(t?i[z]=s:delete i[z]),r}var pe=Object.prototype,ve=pe.toString;function me(i){return ve.call(i)}var ge="[object Null]",be="[object Undefined]",X=N?N.toStringTag:void 0;function ye(i){return i==null?i===void 0?be:ge:X&&X in Object(i)?fe(i):me(i)}function Ee(i){return i!=null&&typeof i=="object"}var xe="[object Symbol]";function Oe(i){return typeof i=="symbol"||Ee(i)&&ye(i)==xe}var Se=/\s/;function we(i){for(var t=i.length;t--&&Se.test(i.charAt(t)););return t}var Ae=/^\s+/;function We(i){return i&&i.slice(0,we(i)+1).replace(Ae,"")}function D(i){var t=typeof i;return i!=null&&(t=="object"||t=="function")}var I=0/0,ke=/^[-+]0x[0-9a-f]+$/i,Me=/^0b[01]+$/i,Ce=/^0o[0-7]+$/i,ze=parseInt;function Y(i){if(typeof i=="number")return i;if(Oe(i))return I;if(D(i)){var t=typeof i.valueOf=="function"?i.valueOf():i;i=D(t)?t+"":t}if(typeof i!="string")return i===0?i:+i;i=We(i);var s=Me.test(i);return s||Ce.test(i)?ze(i.slice(2),s?2:8):ke.test(i)?I:+i}var Te=function(){return U.Date.now()};const j=Te;var Le="Expected a function",_e=Math.max,Ne=Math.min;function L(i,t,s){var e,r,l,n,o,a,c=0,p=!1,u=!1,v=!0;if(typeof i!="function")throw new TypeError(Le);t=Y(t)||0,D(s)&&(p=!!s.leading,u="maxWait"in s,l=u?_e(Y(s.maxWait)||0,t):l,v="trailing"in s?!!s.trailing:v);function d(h){var b=e,y=r;return e=r=void 0,c=h,n=i.apply(y,b),n}function W(h){return c=h,o=setTimeout(g,t),p?d(h):n}function x(h){var b=h-a,y=h-c,$=t-b;return u?Ne($,l-y):$}function E(h){var b=h-a,y=h-c;return a===void 0||b>=t||b<0||u&&y>=l}function g(){var h=j();if(E(h))return O(h);o=setTimeout(g,x(h))}function O(h){return o=void 0,v&&e?d(h):(e=r=void 0,n)}function T(){o!==void 0&&clearTimeout(o),c=0,e=a=r=o=void 0}function R(){return o===void 0?n:O(j())}function C(){var h=j(),b=E(h);if(e=arguments,r=this,a=h,b){if(o===void 0)return W(a);if(u)return clearTimeout(o),o=setTimeout(g,t),d(a)}return o===void 0&&(o=setTimeout(g,t)),n}return C.cancel=T,C.flush=R,C}var De="Expected a function";function Re(i,t,s){var e=!0,r=!0;if(typeof i!="function")throw new TypeError(De);return D(s)&&(e="leading"in s?!!s.leading:e,r="trailing"in s?!!s.trailing:r),L(i,t,{leading:e,maxWait:t,trailing:r})}var M=function(){return M=Object.assign||function(t){for(var s,e=1,r=arguments.length;e<r;e++){s=arguments[e];for(var l in s)Object.prototype.hasOwnProperty.call(s,l)&&(t[l]=s[l])}return t},M.apply(this,arguments)},k=null,F=null;B&&window.addEventListener("resize",function(){F!==window.devicePixelRatio&&(F=window.devicePixelRatio,k=null)});function q(){if(k===null){if(typeof document>"u")return k=0,k;var i=document.body,t=document.createElement("div");t.classList.add("simplebar-hide-scrollbar"),i.appendChild(t);var s=t.getBoundingClientRect().right;i.removeChild(t),k=s}return k}function Q(i){return!i||!i.ownerDocument||!i.ownerDocument.defaultView?window:i.ownerDocument.defaultView}function Z(i){return!i||!i.ownerDocument?document:i.ownerDocument}var J=function(i){var t={},s=Array.prototype.reduce.call(i,function(e,r){var l=r.name.match(/data-simplebar-(.+)/);if(l){var n=l[1].replace(/\W+(.)/g,function(o,a){return a.toUpperCase()});switch(r.value){case"true":e[n]=!0;break;case"false":e[n]=!1;break;case void 0:e[n]=!0;break;default:e[n]=r.value}}return e},t);return s};function K(i,t){var s;i&&(s=i.classList).add.apply(s,t.split(" "))}function ee(i,t){i&&t.split(" ").forEach(function(s){i.classList.remove(s)})}function te(i){return".".concat(i.split(" ").join("."))}var je=Object.freeze({__proto__:null,getElementWindow:Q,getElementDocument:Z,getOptions:J,addClasses:K,removeClasses:ee,classNamesToQuery:te}),S=Q,H=Z,He=J,w=K,A=ee,f=te,_=function(){function i(t,s){s===void 0&&(s={});var e=this;if(this.removePreventClickId=null,this.minScrollbarWidth=20,this.stopScrollDelay=175,this.isScrolling=!1,this.isMouseEntering=!1,this.scrollXTicking=!1,this.scrollYTicking=!1,this.wrapperEl=null,this.contentWrapperEl=null,this.contentEl=null,this.offsetEl=null,this.maskEl=null,this.placeholderEl=null,this.heightAutoObserverWrapperEl=null,this.heightAutoObserverEl=null,this.rtlHelpers=null,this.scrollbarWidth=0,this.resizeObserver=null,this.mutationObserver=null,this.elStyles=null,this.isRtl=null,this.mouseX=0,this.mouseY=0,this.onMouseMove=function(){},this.onWindowResize=function(){},this.onStopScrolling=function(){},this.onMouseEntered=function(){},this.onScroll=function(){var r=S(e.el);e.scrollXTicking||(r.requestAnimationFrame(e.scrollX),e.scrollXTicking=!0),e.scrollYTicking||(r.requestAnimationFrame(e.scrollY),e.scrollYTicking=!0),e.isScrolling||(e.isScrolling=!0,w(e.el,e.classNames.scrolling)),e.showScrollbar("x"),e.showScrollbar("y"),e.onStopScrolling()},this.scrollX=function(){e.axis.x.isOverflowing&&e.positionScrollbar("x"),e.scrollXTicking=!1},this.scrollY=function(){e.axis.y.isOverflowing&&e.positionScrollbar("y"),e.scrollYTicking=!1},this._onStopScrolling=function(){A(e.el,e.classNames.scrolling),e.options.autoHide&&(e.hideScrollbar("x"),e.hideScrollbar("y")),e.isScrolling=!1},this.onMouseEnter=function(){e.isMouseEntering||(w(e.el,e.classNames.mouseEntered),e.showScrollbar("x"),e.showScrollbar("y"),e.isMouseEntering=!0),e.onMouseEntered()},this._onMouseEntered=function(){A(e.el,e.classNames.mouseEntered),e.options.autoHide&&(e.hideScrollbar("x"),e.hideScrollbar("y")),e.isMouseEntering=!1},this._onMouseMove=function(r){e.mouseX=r.clientX,e.mouseY=r.clientY,(e.axis.x.isOverflowing||e.axis.x.forceVisible)&&e.onMouseMoveForAxis("x"),(e.axis.y.isOverflowing||e.axis.y.forceVisible)&&e.onMouseMoveForAxis("y")},this.onMouseLeave=function(){e.onMouseMove.cancel(),(e.axis.x.isOverflowing||e.axis.x.forceVisible)&&e.onMouseLeaveForAxis("x"),(e.axis.y.isOverflowing||e.axis.y.forceVisible)&&e.onMouseLeaveForAxis("y"),e.mouseX=-1,e.mouseY=-1},this._onWindowResize=function(){e.scrollbarWidth=e.getScrollbarWidth(),e.hideNativeScrollbar()},this.onPointerEvent=function(r){if(!(!e.axis.x.track.el||!e.axis.y.track.el||!e.axis.x.scrollbar.el||!e.axis.y.scrollbar.el)){var l,n;e.axis.x.track.rect=e.axis.x.track.el.getBoundingClientRect(),e.axis.y.track.rect=e.axis.y.track.el.getBoundingClientRect(),(e.axis.x.isOverflowing||e.axis.x.forceVisible)&&(l=e.isWithinBounds(e.axis.x.track.rect)),(e.axis.y.isOverflowing||e.axis.y.forceVisible)&&(n=e.isWithinBounds(e.axis.y.track.rect)),(l||n)&&(r.stopPropagation(),r.type==="pointerdown"&&r.pointerType!=="touch"&&(l&&(e.axis.x.scrollbar.rect=e.axis.x.scrollbar.el.getBoundingClientRect(),e.isWithinBounds(e.axis.x.scrollbar.rect)?e.onDragStart(r,"x"):e.onTrackClick(r,"x")),n&&(e.axis.y.scrollbar.rect=e.axis.y.scrollbar.el.getBoundingClientRect(),e.isWithinBounds(e.axis.y.scrollbar.rect)?e.onDragStart(r,"y"):e.onTrackClick(r,"y"))))}},this.drag=function(r){var l,n,o,a,c,p,u,v,d,W,x;if(!(!e.draggedAxis||!e.contentWrapperEl)){var E,g=e.axis[e.draggedAxis].track,O=(n=(l=g.rect)===null||l===void 0?void 0:l[e.axis[e.draggedAxis].sizeAttr])!==null&&n!==void 0?n:0,T=e.axis[e.draggedAxis].scrollbar,R=(a=(o=e.contentWrapperEl)===null||o===void 0?void 0:o[e.axis[e.draggedAxis].scrollSizeAttr])!==null&&a!==void 0?a:0,C=parseInt((p=(c=e.elStyles)===null||c===void 0?void 0:c[e.axis[e.draggedAxis].sizeAttr])!==null&&p!==void 0?p:"0px",10);r.preventDefault(),r.stopPropagation(),e.draggedAxis==="y"?E=r.pageY:E=r.pageX;var h=E-((v=(u=g.rect)===null||u===void 0?void 0:u[e.axis[e.draggedAxis].offsetAttr])!==null&&v!==void 0?v:0)-e.axis[e.draggedAxis].dragOffset;h=e.draggedAxis==="x"&&e.isRtl?((W=(d=g.rect)===null||d===void 0?void 0:d[e.axis[e.draggedAxis].sizeAttr])!==null&&W!==void 0?W:0)-T.size-h:h;var b=h/(O-T.size),y=b*(R-C);e.draggedAxis==="x"&&e.isRtl&&(y=!((x=i.getRtlHelpers())===null||x===void 0)&&x.isScrollingToNegative?-y:y),e.contentWrapperEl[e.axis[e.draggedAxis].scrollOffsetAttr]=y}},this.onEndDrag=function(r){var l=H(e.el),n=S(e.el);r.preventDefault(),r.stopPropagation(),A(e.el,e.classNames.dragging),l.removeEventListener("mousemove",e.drag,!0),l.removeEventListener("mouseup",e.onEndDrag,!0),e.removePreventClickId=n.setTimeout(function(){l.removeEventListener("click",e.preventClick,!0),l.removeEventListener("dblclick",e.preventClick,!0),e.removePreventClickId=null})},this.preventClick=function(r){r.preventDefault(),r.stopPropagation()},this.el=t,this.options=M(M({},i.defaultOptions),s),this.classNames=M(M({},i.defaultOptions.classNames),s.classNames),this.axis={x:{scrollOffsetAttr:"scrollLeft",sizeAttr:"width",scrollSizeAttr:"scrollWidth",offsetSizeAttr:"offsetWidth",offsetAttr:"left",overflowAttr:"overflowX",dragOffset:0,isOverflowing:!0,forceVisible:!1,track:{size:null,el:null,rect:null,isVisible:!1},scrollbar:{size:null,el:null,rect:null,isVisible:!1}},y:{scrollOffsetAttr:"scrollTop",sizeAttr:"height",scrollSizeAttr:"scrollHeight",offsetSizeAttr:"offsetHeight",offsetAttr:"top",overflowAttr:"overflowY",dragOffset:0,isOverflowing:!0,forceVisible:!1,track:{size:null,el:null,rect:null,isVisible:!1},scrollbar:{size:null,el:null,rect:null,isVisible:!1}}},typeof this.el!="object"||!this.el.nodeName)throw new Error("Argument passed to SimpleBar must be an HTML element instead of ".concat(this.el));this.onMouseMove=Re(this._onMouseMove,64),this.onWindowResize=L(this._onWindowResize,64,{leading:!0}),this.onStopScrolling=L(this._onStopScrolling,this.stopScrollDelay),this.onMouseEntered=L(this._onMouseEntered,this.stopScrollDelay),this.init()}return i.getRtlHelpers=function(){if(i.rtlHelpers)return i.rtlHelpers;var t=document.createElement("div");t.innerHTML='<div class="simplebar-dummy-scrollbar-size"><div></div></div>';var s=t.firstElementChild,e=s==null?void 0:s.firstElementChild;if(!e)return null;document.body.appendChild(s),s.scrollLeft=0;var r=i.getOffset(s),l=i.getOffset(e);s.scrollLeft=-999;var n=i.getOffset(e);return document.body.removeChild(s),i.rtlHelpers={isScrollOriginAtZero:r.left!==l.left,isScrollingToNegative:l.left!==n.left},i.rtlHelpers},i.prototype.getScrollbarWidth=function(){try{return this.contentWrapperEl&&getComputedStyle(this.contentWrapperEl,"::-webkit-scrollbar").display==="none"||"scrollbarWidth"in document.documentElement.style||"-ms-overflow-style"in document.documentElement.style?0:q()}catch{return q()}},i.getOffset=function(t){var s=t.getBoundingClientRect(),e=H(t),r=S(t);return{top:s.top+(r.pageYOffset||e.documentElement.scrollTop),left:s.left+(r.pageXOffset||e.documentElement.scrollLeft)}},i.prototype.init=function(){B&&(this.initDOM(),this.rtlHelpers=i.getRtlHelpers(),this.scrollbarWidth=this.getScrollbarWidth(),this.recalculate(),this.initListeners())},i.prototype.initDOM=function(){var t,s;this.wrapperEl=this.el.querySelector(f(this.classNames.wrapper)),this.contentWrapperEl=this.options.scrollableNode||this.el.querySelector(f(this.classNames.contentWrapper)),this.contentEl=this.options.contentNode||this.el.querySelector(f(this.classNames.contentEl)),this.offsetEl=this.el.querySelector(f(this.classNames.offset)),this.maskEl=this.el.querySelector(f(this.classNames.mask)),this.placeholderEl=this.findChild(this.wrapperEl,f(this.classNames.placeholder)),this.heightAutoObserverWrapperEl=this.el.querySelector(f(this.classNames.heightAutoObserverWrapperEl)),this.heightAutoObserverEl=this.el.querySelector(f(this.classNames.heightAutoObserverEl)),this.axis.x.track.el=this.findChild(this.el,"".concat(f(this.classNames.track)).concat(f(this.classNames.horizontal))),this.axis.y.track.el=this.findChild(this.el,"".concat(f(this.classNames.track)).concat(f(this.classNames.vertical))),this.axis.x.scrollbar.el=((t=this.axis.x.track.el)===null||t===void 0?void 0:t.querySelector(f(this.classNames.scrollbar)))||null,this.axis.y.scrollbar.el=((s=this.axis.y.track.el)===null||s===void 0?void 0:s.querySelector(f(this.classNames.scrollbar)))||null,this.options.autoHide||(w(this.axis.x.scrollbar.el,this.classNames.visible),w(this.axis.y.scrollbar.el,this.classNames.visible))},i.prototype.initListeners=function(){var t=this,s,e=S(this.el);if(this.el.addEventListener("mouseenter",this.onMouseEnter),this.el.addEventListener("pointerdown",this.onPointerEvent,!0),this.el.addEventListener("mousemove",this.onMouseMove),this.el.addEventListener("mouseleave",this.onMouseLeave),(s=this.contentWrapperEl)===null||s===void 0||s.addEventListener("scroll",this.onScroll),e.addEventListener("resize",this.onWindowResize),!!this.contentEl){if(window.ResizeObserver){var r=!1,l=e.ResizeObserver||ResizeObserver;this.resizeObserver=new l(function(){r&&e.requestAnimationFrame(function(){t.recalculate()})}),this.resizeObserver.observe(this.el),this.resizeObserver.observe(this.contentEl),e.requestAnimationFrame(function(){r=!0})}this.mutationObserver=new e.MutationObserver(function(){e.requestAnimationFrame(function(){t.recalculate()})}),this.mutationObserver.observe(this.contentEl,{childList:!0,subtree:!0,characterData:!0})}},i.prototype.recalculate=function(){if(!(!this.heightAutoObserverEl||!this.contentEl||!this.contentWrapperEl||!this.wrapperEl||!this.placeholderEl)){var t=S(this.el);this.elStyles=t.getComputedStyle(this.el),this.isRtl=this.elStyles.direction==="rtl";var s=this.contentEl.offsetWidth,e=this.heightAutoObserverEl.offsetHeight<=1,r=this.heightAutoObserverEl.offsetWidth<=1||s>0,l=this.contentWrapperEl.offsetWidth,n=this.elStyles.overflowX,o=this.elStyles.overflowY;this.contentEl.style.padding="".concat(this.elStyles.paddingTop," ").concat(this.elStyles.paddingRight," ").concat(this.elStyles.paddingBottom," ").concat(this.elStyles.paddingLeft),this.wrapperEl.style.margin="-".concat(this.elStyles.paddingTop," -").concat(this.elStyles.paddingRight," -").concat(this.elStyles.paddingBottom," -").concat(this.elStyles.paddingLeft);var a=this.contentEl.scrollHeight,c=this.contentEl.scrollWidth;this.contentWrapperEl.style.height=e?"auto":"100%",this.placeholderEl.style.width=r?"".concat(s||c,"px"):"auto",this.placeholderEl.style.height="".concat(a,"px");var p=this.contentWrapperEl.offsetHeight;this.axis.x.isOverflowing=s!==0&&c>s,this.axis.y.isOverflowing=a>p,this.axis.x.isOverflowing=n==="hidden"?!1:this.axis.x.isOverflowing,this.axis.y.isOverflowing=o==="hidden"?!1:this.axis.y.isOverflowing,this.axis.x.forceVisible=this.options.forceVisible==="x"||this.options.forceVisible===!0,this.axis.y.forceVisible=this.options.forceVisible==="y"||this.options.forceVisible===!0,this.hideNativeScrollbar();var u=this.axis.x.isOverflowing?this.scrollbarWidth:0,v=this.axis.y.isOverflowing?this.scrollbarWidth:0;this.axis.x.isOverflowing=this.axis.x.isOverflowing&&c>l-v,this.axis.y.isOverflowing=this.axis.y.isOverflowing&&a>p-u,this.axis.x.scrollbar.size=this.getScrollbarSize("x"),this.axis.y.scrollbar.size=this.getScrollbarSize("y"),this.axis.x.scrollbar.el&&(this.axis.x.scrollbar.el.style.width="".concat(this.axis.x.scrollbar.size,"px")),this.axis.y.scrollbar.el&&(this.axis.y.scrollbar.el.style.height="".concat(this.axis.y.scrollbar.size,"px")),this.positionScrollbar("x"),this.positionScrollbar("y"),this.toggleTrackVisibility("x"),this.toggleTrackVisibility("y")}},i.prototype.getScrollbarSize=function(t){var s,e;if(t===void 0&&(t="y"),!this.axis[t].isOverflowing||!this.contentEl)return 0;var r=this.contentEl[this.axis[t].scrollSizeAttr],l=(e=(s=this.axis[t].track.el)===null||s===void 0?void 0:s[this.axis[t].offsetSizeAttr])!==null&&e!==void 0?e:0,n=l/r,o;return o=Math.max(~~(n*l),this.options.scrollbarMinSize),this.options.scrollbarMaxSize&&(o=Math.min(o,this.options.scrollbarMaxSize)),o},i.prototype.positionScrollbar=function(t){var s,e,r;t===void 0&&(t="y");var l=this.axis[t].scrollbar;if(!(!this.axis[t].isOverflowing||!this.contentWrapperEl||!l.el||!this.elStyles)){var n=this.contentWrapperEl[this.axis[t].scrollSizeAttr],o=((s=this.axis[t].track.el)===null||s===void 0?void 0:s[this.axis[t].offsetSizeAttr])||0,a=parseInt(this.elStyles[this.axis[t].sizeAttr],10),c=this.contentWrapperEl[this.axis[t].scrollOffsetAttr];c=t==="x"&&this.isRtl&&(!((e=i.getRtlHelpers())===null||e===void 0)&&e.isScrollOriginAtZero)?-c:c,t==="x"&&this.isRtl&&(c=!((r=i.getRtlHelpers())===null||r===void 0)&&r.isScrollingToNegative?c:-c);var p=c/(n-a),u=~~((o-l.size)*p);u=t==="x"&&this.isRtl?-u+(o-l.size):u,l.el.style.transform=t==="x"?"translate3d(".concat(u,"px, 0, 0)"):"translate3d(0, ".concat(u,"px, 0)")}},i.prototype.toggleTrackVisibility=function(t){t===void 0&&(t="y");var s=this.axis[t].track.el,e=this.axis[t].scrollbar.el;!s||!e||!this.contentWrapperEl||(this.axis[t].isOverflowing||this.axis[t].forceVisible?(s.style.visibility="visible",this.contentWrapperEl.style[this.axis[t].overflowAttr]="scroll",this.el.classList.add("".concat(this.classNames.scrollable,"-").concat(t))):(s.style.visibility="hidden",this.contentWrapperEl.style[this.axis[t].overflowAttr]="hidden",this.el.classList.remove("".concat(this.classNames.scrollable,"-").concat(t))),this.axis[t].isOverflowing?e.style.display="block":e.style.display="none")},i.prototype.showScrollbar=function(t){t===void 0&&(t="y"),this.axis[t].isOverflowing&&!this.axis[t].scrollbar.isVisible&&(w(this.axis[t].scrollbar.el,this.classNames.visible),this.axis[t].scrollbar.isVisible=!0)},i.prototype.hideScrollbar=function(t){t===void 0&&(t="y"),this.axis[t].isOverflowing&&this.axis[t].scrollbar.isVisible&&(A(this.axis[t].scrollbar.el,this.classNames.visible),this.axis[t].scrollbar.isVisible=!1)},i.prototype.hideNativeScrollbar=function(){this.offsetEl&&(this.offsetEl.style[this.isRtl?"left":"right"]=this.axis.y.isOverflowing||this.axis.y.forceVisible?"-".concat(this.scrollbarWidth,"px"):"0px",this.offsetEl.style.bottom=this.axis.x.isOverflowing||this.axis.x.forceVisible?"-".concat(this.scrollbarWidth,"px"):"0px")},i.prototype.onMouseMoveForAxis=function(t){t===void 0&&(t="y");var s=this.axis[t];!s.track.el||!s.scrollbar.el||(s.track.rect=s.track.el.getBoundingClientRect(),s.scrollbar.rect=s.scrollbar.el.getBoundingClientRect(),this.isWithinBounds(s.track.rect)?(this.showScrollbar(t),w(s.track.el,this.classNames.hover),this.isWithinBounds(s.scrollbar.rect)?w(s.scrollbar.el,this.classNames.hover):A(s.scrollbar.el,this.classNames.hover)):(A(s.track.el,this.classNames.hover),this.options.autoHide&&this.hideScrollbar(t)))},i.prototype.onMouseLeaveForAxis=function(t){t===void 0&&(t="y"),A(this.axis[t].track.el,this.classNames.hover),A(this.axis[t].scrollbar.el,this.classNames.hover),this.options.autoHide&&this.hideScrollbar(t)},i.prototype.onDragStart=function(t,s){var e;s===void 0&&(s="y");var r=H(this.el),l=S(this.el),n=this.axis[s].scrollbar,o=s==="y"?t.pageY:t.pageX;this.axis[s].dragOffset=o-(((e=n.rect)===null||e===void 0?void 0:e[this.axis[s].offsetAttr])||0),this.draggedAxis=s,w(this.el,this.classNames.dragging),r.addEventListener("mousemove",this.drag,!0),r.addEventListener("mouseup",this.onEndDrag,!0),this.removePreventClickId===null?(r.addEventListener("click",this.preventClick,!0),r.addEventListener("dblclick",this.preventClick,!0)):(l.clearTimeout(this.removePreventClickId),this.removePreventClickId=null)},i.prototype.onTrackClick=function(t,s){var e=this,r,l,n,o;s===void 0&&(s="y");var a=this.axis[s];if(!(!this.options.clickOnTrack||!a.scrollbar.el||!this.contentWrapperEl)){t.preventDefault();var c=S(this.el);this.axis[s].scrollbar.rect=a.scrollbar.el.getBoundingClientRect();var p=this.axis[s].scrollbar,u=(l=(r=p.rect)===null||r===void 0?void 0:r[this.axis[s].offsetAttr])!==null&&l!==void 0?l:0,v=parseInt((o=(n=this.elStyles)===null||n===void 0?void 0:n[this.axis[s].sizeAttr])!==null&&o!==void 0?o:"0px",10),d=this.contentWrapperEl[this.axis[s].scrollOffsetAttr],W=s==="y"?this.mouseY-u:this.mouseX-u,x=W<0?-1:1,E=x===-1?d-v:d+v,g=40,O=function(){e.contentWrapperEl&&(x===-1?d>E&&(d-=g,e.contentWrapperEl[e.axis[s].scrollOffsetAttr]=d,c.requestAnimationFrame(O)):d<E&&(d+=g,e.contentWrapperEl[e.axis[s].scrollOffsetAttr]=d,c.requestAnimationFrame(O)))};O()}},i.prototype.getContentElement=function(){return this.contentEl},i.prototype.getScrollElement=function(){return this.contentWrapperEl},i.prototype.removeListeners=function(){var t=S(this.el);this.el.removeEventListener("mouseenter",this.onMouseEnter),this.el.removeEventListener("pointerdown",this.onPointerEvent,!0),this.el.removeEventListener("mousemove",this.onMouseMove),this.el.removeEventListener("mouseleave",this.onMouseLeave),this.contentWrapperEl&&this.contentWrapperEl.removeEventListener("scroll",this.onScroll),t.removeEventListener("resize",this.onWindowResize),this.mutationObserver&&this.mutationObserver.disconnect(),this.resizeObserver&&this.resizeObserver.disconnect(),this.onMouseMove.cancel(),this.onWindowResize.cancel(),this.onStopScrolling.cancel(),this.onMouseEntered.cancel()},i.prototype.unMount=function(){this.removeListeners()},i.prototype.isWithinBounds=function(t){return this.mouseX>=t.left&&this.mouseX<=t.left+t.width&&this.mouseY>=t.top&&this.mouseY<=t.top+t.height},i.prototype.findChild=function(t,s){var e=t.matches||t.webkitMatchesSelector||t.mozMatchesSelector||t.msMatchesSelector;return Array.prototype.filter.call(t.children,function(r){return e.call(r,s)})[0]},i.rtlHelpers=null,i.defaultOptions={forceVisible:!1,clickOnTrack:!0,scrollbarMinSize:25,scrollbarMaxSize:0,ariaLabel:"scrollable content",classNames:{contentEl:"simplebar-content",contentWrapper:"simplebar-content-wrapper",offset:"simplebar-offset",mask:"simplebar-mask",wrapper:"simplebar-wrapper",placeholder:"simplebar-placeholder",scrollbar:"simplebar-scrollbar",track:"simplebar-track",heightAutoObserverWrapperEl:"simplebar-height-auto-observer-wrapper",heightAutoObserverEl:"simplebar-height-auto-observer",visible:"simplebar-visible",horizontal:"simplebar-horizontal",vertical:"simplebar-vertical",hover:"simplebar-hover",dragging:"simplebar-dragging",scrolling:"simplebar-scrolling",scrollable:"simplebar-scrollable",mouseEntered:"simplebar-mouse-entered"},scrollableNode:null,contentNode:null,autoHide:!0},i.getOptions=He,i.helpers=je,i}(),P=function(i,t){return P=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(s,e){s.__proto__=e}||function(s,e){for(var r in e)Object.prototype.hasOwnProperty.call(e,r)&&(s[r]=e[r])},P(i,t)};function Ve(i,t){if(typeof t!="function"&&t!==null)throw new TypeError("Class extends value "+String(t)+" is not a constructor or null");P(i,t);function s(){this.constructor=i}i.prototype=t===null?Object.create(t):(s.prototype=t.prototype,new s)}var ie=_.helpers,V=ie.getOptions,m=ie.addClasses,Pe=function(i){Ve(t,i);function t(){for(var s=[],e=0;e<arguments.length;e++)s[e]=arguments[e];var r=i.apply(this,s)||this;return t.instances.set(s[0],r),r}return t.initDOMLoadedElements=function(){document.removeEventListener("DOMContentLoaded",this.initDOMLoadedElements),window.removeEventListener("load",this.initDOMLoadedElements),Array.prototype.forEach.call(document.querySelectorAll("[data-simplebar]"),function(s){s.getAttribute("data-simplebar")!=="init"&&!t.instances.has(s)&&new t(s,V(s.attributes))})},t.removeObserver=function(){var s;(s=t.globalObserver)===null||s===void 0||s.disconnect()},t.prototype.initDOM=function(){var s=this,e,r,l;if(!Array.prototype.filter.call(this.el.children,function(a){return a.classList.contains(s.classNames.wrapper)}).length){for(this.wrapperEl=document.createElement("div"),this.contentWrapperEl=document.createElement("div"),this.offsetEl=document.createElement("div"),this.maskEl=document.createElement("div"),this.contentEl=document.createElement("div"),this.placeholderEl=document.createElement("div"),this.heightAutoObserverWrapperEl=document.createElement("div"),this.heightAutoObserverEl=document.createElement("div"),m(this.wrapperEl,this.classNames.wrapper),m(this.contentWrapperEl,this.classNames.contentWrapper),m(this.offsetEl,this.classNames.offset),m(this.maskEl,this.classNames.mask),m(this.contentEl,this.classNames.contentEl),m(this.placeholderEl,this.classNames.placeholder),m(this.heightAutoObserverWrapperEl,this.classNames.heightAutoObserverWrapperEl),m(this.heightAutoObserverEl,this.classNames.heightAutoObserverEl);this.el.firstChild;)this.contentEl.appendChild(this.el.firstChild);this.contentWrapperEl.appendChild(this.contentEl),this.offsetEl.appendChild(this.contentWrapperEl),this.maskEl.appendChild(this.offsetEl),this.heightAutoObserverWrapperEl.appendChild(this.heightAutoObserverEl),this.wrapperEl.appendChild(this.heightAutoObserverWrapperEl),this.wrapperEl.appendChild(this.maskEl),this.wrapperEl.appendChild(this.placeholderEl),this.el.appendChild(this.wrapperEl),(e=this.contentWrapperEl)===null||e===void 0||e.setAttribute("tabindex","0"),(r=this.contentWrapperEl)===null||r===void 0||r.setAttribute("role","region"),(l=this.contentWrapperEl)===null||l===void 0||l.setAttribute("aria-label",this.options.ariaLabel)}if(!this.axis.x.track.el||!this.axis.y.track.el){var n=document.createElement("div"),o=document.createElement("div");m(n,this.classNames.track),m(o,this.classNames.scrollbar),n.appendChild(o),this.axis.x.track.el=n.cloneNode(!0),m(this.axis.x.track.el,this.classNames.horizontal),this.axis.y.track.el=n.cloneNode(!0),m(this.axis.y.track.el,this.classNames.vertical),this.el.appendChild(this.axis.x.track.el),this.el.appendChild(this.axis.y.track.el)}_.prototype.initDOM.call(this),this.el.setAttribute("data-simplebar","init")},t.prototype.unMount=function(){_.prototype.unMount.call(this),t.instances.delete(this.el)},t.initHtmlApi=function(){this.initDOMLoadedElements=this.initDOMLoadedElements.bind(this),typeof MutationObserver<"u"&&(this.globalObserver=new MutationObserver(t.handleMutations),this.globalObserver.observe(document,{childList:!0,subtree:!0})),document.readyState==="complete"||document.readyState!=="loading"&&!document.documentElement.doScroll?window.setTimeout(this.initDOMLoadedElements):(document.addEventListener("DOMContentLoaded",this.initDOMLoadedElements),window.addEventListener("load",this.initDOMLoadedElements))},t.handleMutations=function(s){s.forEach(function(e){e.addedNodes.forEach(function(r){r.nodeType===1&&(r.hasAttribute("data-simplebar")?!t.instances.has(r)&&document.documentElement.contains(r)&&new t(r,V(r.attributes)):r.querySelectorAll("[data-simplebar]").forEach(function(l){l.getAttribute("data-simplebar")!=="init"&&!t.instances.has(l)&&document.documentElement.contains(l)&&new t(l,V(l.attributes))}))}),e.removedNodes.forEach(function(r){r.nodeType===1&&(r.getAttribute("data-simplebar")==="init"?t.instances.has(r)&&!document.documentElement.contains(r)&&t.instances.get(r).unMount():Array.prototype.forEach.call(r.querySelectorAll('[data-simplebar="init"]'),function(l){t.instances.has(l)&&!document.documentElement.contains(l)&&t.instances.get(l).unMount()}))})})},t.instances=new WeakMap,t}(_);B&&Pe.initHtmlApi();
