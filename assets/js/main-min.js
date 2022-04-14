function globalNavDropdowns(t) {
  var e = this;

  if (this.container = document.querySelector(t), this.container && !this.container.classList.contains("no-dropdown") && (this.root = this.container.querySelector(".navRoot"), this.primaryNav = this.root.querySelector(".navSection.primary"), this.primaryNavItem = this.root.querySelector(".navSection.primary .rootLink:last-child"), this.secondaryNavItem = this.root.querySelector(".navSection.secondary .rootLink:first-child"), this.primaryNav)) {
    this.checkCollision(), window.addEventListener("load", this.checkCollision.bind(this)), window.addEventListener("resize", this.checkCollision.bind(this)), this.container.classList.add("noDropdownTransition"), this.dropdownBackground = this.container.querySelector(".dropdownBackground"), this.dropdownBackgroundAlt = this.container.querySelector(".alternateBackground"), this.dropdownRoot = this.container.querySelector(".dropdownRoot"), this.dropdownContainer = this.container.querySelector(".dropdownContainer"), this.dropdownArrow = this.container.querySelector(".dropdownArrow"), this.dropdownRoots = Strut.queryArray(".hasDropdown", this.root), this.dropdownSections = Strut.queryArray(".dropdownSection", this.container).map(function (t) {
      return {
        el: t,
        name: t.getAttribute("data-dropdown"),
        content: t.querySelector(".dropdownContent")
      };
    });
    var n = window.PointerEvent ? {
      end: "pointerup",
      enter: "pointerenter",
      leave: "pointerleave"
    } : {
      end: "touchend",
      enter: "mouseenter",
      leave: "mouseleave"
    };
    this.keyDownHandler = null, this.dropdownRoots.forEach(function (t, i) {
      t.addEventListener(n.end, function (n) {
        n.preventDefault(), n.stopPropagation(), e.toggleDropdown(t);
      }), t.addEventListener("focusin", function (n) {
        e.stopCloseTimeout(), e.openDropdown(t, {
          keyboardNavigation: !0
        });
      }), t.addEventListener(n.enter, function (n) {
        "touch" != n.pointerType && (e.stopCloseTimeout(), e.openDropdown(t));
      }), t.addEventListener(n.leave, function (t) {
        "touch" != t.pointerType && e.startCloseTimeout();
      });
    }), this.dropdownContainer && this.dropdownContainer.addEventListener(n.end, function (t) {
      t.stopPropagation();
    }), this.dropdownContainer && this.dropdownContainer.addEventListener(n.enter, function (t) {
      "touch" != t.pointerType && e.stopCloseTimeout();
    }), this.dropdownContainer && this.dropdownContainer.addEventListener(n.leave, function (t) {
      "touch" != t.pointerType && e.startCloseTimeout();
    }), document.body.addEventListener(n.end, function (t) {
      Strut.touch.isDragging || e.closeDropdown();
    }), this.container.classList.add("initialized");
  }
}

function globalNavPopup(t) {
  var e = this,
      n = Strut.touch.isSupported ? "touchend" : "click";
  this.activeClass = "globalPopupActive", this.root = document.querySelector(t), this.root && (this.link = this.root.querySelector(".rootLink"), this.popup = this.root && this.root.querySelector(".popup"), this.closeButton = this.root && this.root.querySelector(".popupCloseButton"), this.link && this.link.addEventListener(n, function (t) {
    t.stopPropagation(), e.togglePopup();
  }), this.popup.addEventListener(n, function (t) {
    t.stopPropagation();
  }), this.popup.addEventListener("transitionend", function (t) {
    if (e.isOpening) {
      e.isOpening = !1;
      var n = e.popup.getBoundingClientRect().top + window.scrollY;

      if (n < 12) {
        var i = 12 - n;
        e.popup.style.transform = "translateY(" + i + "px)";
      }
    }
  }), this.closeButton && this.closeButton.addEventListener(n, function (t) {
    e.closeAllPopups();
  }), document.body.addEventListener(n, function (t) {
    Strut.touch.isDragging || e.closeAllPopups();
  }, !1));
}

!function () {
  var t,
      e,
      n = "cookie_banner_ack";

  function i(e) {
    var i, o;
    i = new Date(), o = n + "=ack", i.setYear(i.getFullYear() + 10), o += ";expires=" + i.toGMTString(), o += ";domain=" + document.domain, o += ";samesite=lax", document.cookie = o, t.parentNode.removeChild(t);
  }

  document.addEventListener("DOMContentLoaded", function () {
    t = document.querySelector('[rel="cookie-notification"]'), (e = document.querySelector('[rel="dismiss-cookie-notification"]')) && e.addEventListener("click", i);
  });
}(), window.$ && window.$.ajaxPrefilter && $(function () {
  var t;
  return t = function () {
    var t, e;
    return (t = $("form input[name=csrf-token]")).length > 0 ? t.attr("value") : (e = $("meta[name=csrf-token]")).length > 0 ? e.attr("content") : "";
  }, $.ajaxPrefilter(function (e, n, i) {
    var o;
    return o = t(), i.setRequestHeader("x-stripe-csrf-token", o);
  });
}), window.Strut = {
  random: function (t, e) {
    return Math.random() * (e - t) + t;
  },
  arrayRandom: function (t) {
    return t[Math.floor(Math.random() * t.length)];
  },
  interpolate: function (t, e, n) {
    return t * (1 - n) + e * n;
  },
  rangePosition: function (t, e, n) {
    return (n - t) / (e - t);
  },
  clamp: function (t, e, n) {
    return Math.max(Math.min(t, n), e);
  },
  queryArray: function (t, e) {
    return e || (e = document.body), Array.prototype.slice.call(e.querySelectorAll(t));
  },
  ready: function (t) {
    "loading" !== document.readyState ? t() : document.addEventListener("DOMContentLoaded", t);
  },
  debounce: function (t, e) {
    let n;
    return function () {
      clearTimeout(n), n = setTimeout(function () {
        return t.apply(this, arguments);
      }, e);
    };
  },
  throttle: function (t, e, n) {
    var i = n || this,
        o = null,
        a = null,
        r = function () {
      t.apply(i, a), o = null;
    };

    return function () {
      o || (a = arguments, o = setTimeout(r, e));
    };
  }
}, Strut.isRetina = window.devicePixelRatio > 1.3, Strut.mobileViewportWidth = 670, Strut.isMobileViewport = window.innerWidth < Strut.mobileViewportWidth, window.addEventListener("resize", function () {
  Strut.isMobileViewport = window.innerWidth < Strut.mobileViewportWidth;
}), Strut.touch = {
  isSupported: "ontouchstart" in window || navigator.maxTouchPoints,
  isDragging: !1
}, document.addEventListener("DOMContentLoaded", function () {
  document.body.addEventListener("touchmove", function () {
    Strut.touch.isDragging = !0;
  }), document.body.addEventListener("touchstart", function () {
    Strut.touch.isDragging = !1;
  });
}), Strut.load = {
  images: function (t, e) {
    "string" == typeof t && (t = [t]);
    var n = -t.length;
    t.forEach(function (t) {
      var i = new Image();
      i.src = t, i.onload = function () {
        0 === ++n && e && e();
      };
    });
  },
  css: function (t, e) {
    var n = document.createElement("link"),
        i = (window.readConfig("strut_files") || {})[t];
    if (!i) throw new Error('CSS file "' + t + '" not found in strut_files config');
    n.href = i, n.rel = "stylesheet", document.head.appendChild(n), e && (n.onload = e);
  },
  js: function (t, e) {
    var n = document.createElement("script"),
        i = (window.readConfig("strut_files") || {})[t];
    if (!i) throw new Error('Javascript file "' + t + '" not found in strut_files config');
    n.src = i, n.async = !1, document.head.appendChild(n), e && (n.onload = e);
  }
}, Strut.supports = {
  es6: !!window.Symbol && !!window.Symbol.species,
  pointerEvents: function () {
    var t = document.createElement("a").style;
    return t.cssText = "pointer-events:auto", "auto" === t.pointerEvents;
  }(),
  positionSticky: Boolean(window.CSS && CSS.supports("(position: -webkit-sticky) or (position: sticky)")),
  masks: !/MSIE|Trident|Edge/i.test(navigator.userAgent)
}, globalNavDropdowns.prototype.checkCollision = function () {}, globalNavDropdowns.prototype.registerArrowKeyNavigation = function (t, e) {
  var n = this;
  null !== this.keyDownHandler && this.unregisterArrowKeyNavigation();
  var i = [].slice.call(e.querySelectorAll("a")),
      o = 0;
  i[o].focus(), this.keyDownHandler = function (e) {
    9 === e.keyCode ? (t.focus(), n.startCloseTimeout()) : 38 === e.keyCode ? (e.preventDefault(), --o < 0 && (o += i.length), i[o].focus()) : 40 === e.keyCode && (e.preventDefault(), ++o >= i.length && (o -= i.length), i[o].focus());
  }, this.container.addEventListener("keydown", this.keyDownHandler);
}, globalNavDropdowns.prototype.unregisterArrowKeyNavigation = function () {
  this.container.removeEventListener("keydown", this.keyDownHandler), this.keyDownHandler = null;
}, globalNavDropdowns.prototype.openDropdown = function (t, e) {
  var n = this;

  if (this.activeDropdown !== t) {
    this.container.classList.add("overlayActive"), this.container.classList.add("dropdownActive"), this.activeDropdown = t, this.activeDropdown.setAttribute("aria-expanded", "true"), this.dropdownRoots.forEach(function (t, e) {
      t.classList.remove("active");
    }), t.classList.add("active");
    var i,
        o,
        a,
        r = t.getAttribute("data-dropdown"),
        s = "left";
    this.dropdownSections.forEach(function (c) {
      c.el.classList.remove("active"), c.el.classList.remove("left"), c.el.classList.remove("right"), c.name == r ? (c.el.setAttribute("aria-hidden", "false"), c.el.classList.add("active"), s = "right", i = c.content.offsetWidth, o = c.content.offsetHeight, c.content.getAttribute("data-fixed") ? c.content.setAttribute("data-fixed", !0) : (c.content.style.width = i + "px", c.content.style.height = o + "px"), a = c.content, e && e.keyboardNavigation && n.registerArrowKeyNavigation(t, c.el)) : (c.el.classList.add(s), c.el.setAttribute("aria-hidden", "true"));
    });
    var c = i / 380,
        d = o / 400,
        l = t.getBoundingClientRect(),
        u = l.left + l.width / 2 - i / 2;
    u = Math.round(Math.max(u, 10)), clearTimeout(this.disableTransitionTimeout), this.enableTransitionTimeout = setTimeout(function () {
      n.container.classList.remove("noDropdownTransition");
    }, 50), this.dropdownBackground.style.transform = "translateX(" + u + "px) scaleX(" + c + ") scaleY(" + d + ")", this.dropdownContainer.style.transform = "translateX(" + u + "px)", this.dropdownContainer.style.width = i + "px", this.dropdownContainer.style.height = o + "px";
    var w = Math.round(l.left + l.width / 2);
    this.dropdownArrow.style.transform = "translateX(" + w + "px) rotate(45deg)";
    var p = a.children[0].offsetHeight / d;
    this.dropdownBackgroundAlt.style.transform = "translateY(" + p + "px)", window.siteAnalytics && window.siteAnalytics.trackGlobalNavDropdownOpen && window.siteAnalytics.trackGlobalNavDropdownOpen(r);
  }
}, globalNavDropdowns.prototype.closeDropdown = function () {
  var t = this;
  this.activeDropdown && (this.dropdownRoots.forEach(function (t, e) {
    t.classList.remove("active");
  }), this.dropdownContainer.querySelector('[aria-hidden="false"]').setAttribute("aria-hidden", "true"), clearTimeout(this.enableTransitionTimeout), this.disableTransitionTimeout = setTimeout(function () {
    t.container.classList.add("noDropdownTransition");
  }, 50), this.container.classList.remove("overlayActive"), this.container.classList.remove("dropdownActive"), this.activeDropdown.setAttribute("aria-expanded", "false"), this.activeDropdown = void 0, this.unregisterArrowKeyNavigation());
}, globalNavDropdowns.prototype.toggleDropdown = function (t) {
  this.activeDropdown === t ? this.closeDropdown() : this.openDropdown(t);
}, globalNavDropdowns.prototype.startCloseTimeout = function () {
  var t = this;
  t.closeDropdownTimeout = setTimeout(function () {
    t.closeDropdown();
  }, 50);
}, globalNavDropdowns.prototype.stopCloseTimeout = function () {
  clearTimeout(this.closeDropdownTimeout);
}, globalNavPopup.prototype.togglePopup = function () {
  var t = this.root.classList.contains(this.activeClass);
  this.closeAllPopups(!0), t || (this.root.classList.add(this.activeClass), this.isOpening = !0);
}, globalNavPopup.prototype.closeAllPopups = function (t) {
  for (var e = document.getElementsByClassName(this.activeClass), n = 0; n < e.length; n++) e[n].querySelector(".popup").style.transform = null, e[n].classList.remove(this.activeClass);
}, Strut.supports.pointerEvents || Strut.load.css("v3/shared/navigation_ie10.css"), Strut.ready(function () {
  new globalNavDropdowns(".globalNav"), new globalNavPopup(".globalNav .navSection.mobile"), new globalNavPopup(".globalFooterNav .select.country"), new globalNavPopup(".globalFooterNav .select.language"), document.body.addEventListener("keydown", function (t) {
    9 == t.keyCode && document.body.classList.add("keyboard-navigation");
  }), document.body.addEventListener("mousedown", function (t) {
    document.body.classList.remove("keyboard-navigation");
  });
}), function () {
  var t = "nav_dropdown_open",
      e = {};

  function n(n) {
    e[n] || (e[n] = !0, window.siteAnalyticsUtil.emitAction(t, {
      dropdown: n
    }));
  }

  if (window.siteAnalytics)
    window.siteAnalytics.trackGlobalNavDropdownOpen = n;
}();
