/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * Repository: https://github.com/shaack/bootstrap-input-spinner
 * License: MIT, see file 'LICENSE'
 */
;

(function ($) {
  "use strict";

  var triggerKeyPressed = false;
  var originalVal = $.fn.val;

  $.fn.val = function (value) {
    if (arguments.length >= 1) {
      if (this[0] && this[0]["bootstrap-input-spinner"] && this[0].setValue) {
        var element = this[0];
        setTimeout(function () {
          element.setValue(value);
        });
      }
    }

    return originalVal.apply(this, arguments);
  };

  $.fn.InputSpinner = $.fn.inputSpinner = function (options) {
    var config = {
      decrementButton: "<strong>-</strong>",
      // button text
      incrementButton: "<strong>+</strong>",
      // ..
      groupClass: "",
      // css class of the resulting input-group
      buttonsClass: "btn-outline-secondary",
      buttonsWidth: "2.5rem",
      textAlign: "center",
      autoDelay: 500,
      // ms holding before auto value change
      autoInterval: 100,
      // speed of auto value change
      boostThreshold: 10,
      // boost after these steps
      boostMultiplier: "auto" // you can also set a constant number as multiplier

    };

    for (var option in options) {
      config[option] = options[option];
    }

    var html = '<div class="input-group ' + config.groupClass + '">' + '<div class="input-group-prepend">' + '<button style="min-width: ' + config.buttonsWidth + '" class="btn btn-decrement ' + config.buttonsClass + '" type="button">' + config.decrementButton + '</button>' + '</div>' + '<input type="text" inputmode="decimal" style="text-align: ' + config.textAlign + '" class="form-control"/>' + '<div class="input-group-append">' + '<button style="min-width: ' + config.buttonsWidth + '" class="btn btn-increment ' + config.buttonsClass + '" type="button">' + config.incrementButton + '</button>' + '</div>' + '</div>';
    var locale = navigator.language || "en-US";
    this.each(function () {
      var $original = $(this);
      $original[0]["bootstrap-input-spinner"] = true;
      $original.hide();
      var autoDelayHandler = null;
      var autoIntervalHandler = null;
      var autoMultiplier = config.boostMultiplier === "auto";
      var boostMultiplier = autoMultiplier ? 1 : config.boostMultiplier;
      var $inputGroup = $(html);
      var $buttonDecrement = $inputGroup.find(".btn-decrement");
      var $buttonIncrement = $inputGroup.find(".btn-increment");
      var $input = $inputGroup.find("input");
      var min = null;
      var max = null;
      var step = null;
      var stepMax = null;
      var decimals = null;
      var digitGrouping = null;
      var numberFormat = null;
      updateAttributes();
      var value = parseFloat($original[0].value);
      var boostStepsCount = 0;
      var prefix = $original.attr("data-prefix") || "";
      var suffix = $original.attr("data-suffix") || "";

      if (prefix) {
        var prefixElement = $('<span class="input-group-text">' + prefix + '</span>');
        $inputGroup.find(".input-group-prepend").append(prefixElement);
      }

      if (suffix) {
        var suffixElement = $('<span class="input-group-text">' + suffix + '</span>');
        $inputGroup.find(".input-group-append").prepend(suffixElement);
      }

      $original[0].setValue = function (newValue) {
        setValue(newValue);
      };

      var observer = new MutationObserver(function () {
        updateAttributes();
        setValue(value, true);
      });
      observer.observe($original[0], {
        attributes: true
      });
      $original.after($inputGroup);
      setValue(value);
      $input.on("paste input change focusout", function (event) {
        var newValue = $input[0].value;
        var focusOut = event.type === "focusout";
        newValue = parseLocaleNumber(newValue);
        setValue(newValue, focusOut);
        dispatchEvent($original, event.type);
      });
      onPointerDown($buttonDecrement[0], function () {
        stepHandling(-step);
      });
      onPointerDown($buttonIncrement[0], function () {
        stepHandling(step);
      });
      onPointerUp(document.body, function () {
        resetTimer();
      });

      function setValue(newValue, updateInput) {
        if (updateInput === undefined) {
          updateInput = true;
        }

        if (isNaN(newValue) || newValue === "") {
          $original[0].value = "";

          if (updateInput) {
            $input[0].value = "";
          }

          value = NaN;
        } else {
          newValue = parseFloat(newValue);
          newValue = Math.min(Math.max(newValue, min), max);
          newValue = Math.round(newValue * Math.pow(10, decimals)) / Math.pow(10, decimals);
          $original[0].value = newValue;

          if (updateInput) {
            $input[0].value = numberFormat.format(newValue);
          }

          value = newValue;
        }
      }

      function dispatchEvent($element, type) {
        if (type) {
          setTimeout(function () {
            var event;

            if (typeof Event === 'function') {
              event = new Event(type, {
                bubbles: true
              });
            } else {
              // IE
              event = document.createEvent('Event');
              event.initEvent(type, true, true);
            }

            $element[0].dispatchEvent(event);
          });
        }
      }

      function stepHandling(step) {
        if (!$input[0].disabled && !$input[0].readOnly) {
          calcStep(step);
          resetTimer();
          autoDelayHandler = setTimeout(function () {
            autoIntervalHandler = setInterval(function () {
              if (boostStepsCount > config.boostThreshold) {
                if (autoMultiplier) {
                  calcStep(step * parseInt(boostMultiplier, 10));

                  if (boostMultiplier < 100000000) {
                    boostMultiplier = boostMultiplier * 1.1;
                  }

                  if (stepMax) {
                    boostMultiplier = Math.min(stepMax, boostMultiplier);
                  }
                } else {
                  calcStep(step * boostMultiplier);
                }
              } else {
                calcStep(step);
              }

              boostStepsCount++;
            }, config.autoInterval);
          }, config.autoDelay);
        }
      }

      function calcStep(step) {
        if (isNaN(value)) {
          value = 0;
        }

        setValue(Math.round(value / step) * step + step);
        dispatchEvent($original, "input");
        dispatchEvent($original, "change");
      }

      function resetTimer() {
        boostStepsCount = 0;
        boostMultiplier = boostMultiplier = autoMultiplier ? 1 : config.boostMultiplier;
        clearTimeout(autoDelayHandler);
        clearTimeout(autoIntervalHandler);
      }

      function updateAttributes() {
        // copy properties from original to the new input
        $input.prop("required", $original.prop("required"));
        $input.prop("placeholder", $original.prop("placeholder"));
        $input.attr("inputmode", $original.attr("inputmode") || "decimal");
        var disabled = $original.prop("disabled");
        var readonly = $original.prop("readonly");
        $input.prop("disabled", disabled);
        $input.prop("readonly", readonly);
        $buttonIncrement.prop("disabled", disabled || readonly);
        $buttonDecrement.prop("disabled", disabled || readonly);

        if (disabled || readonly) {
          resetTimer();
        }

        var originalClass = $original.prop("class");
        var groupClass = ""; // sizing

        if (/form-control-sm/g.test(originalClass)) {
          groupClass = "input-group-sm";
        } else if (/form-control-lg/g.test(originalClass)) {
          groupClass = "input-group-lg";
        }

        var inputClass = originalClass.replace(/form-control(-(sm|lg))?/g, "");
        $inputGroup.prop("class", "input-group " + groupClass + " " + config.groupClass);
        $input.prop("class", "form-control " + inputClass); // update the main attributes

        min = parseFloat($original.prop("min")) || 0;
        max = isNaN($original.prop("max")) || $original.prop("max") === "" ? Infinity : parseFloat($original.prop("max"));
        step = parseFloat($original.prop("step")) || 1;
        stepMax = parseInt($original.attr("data-step-max")) || 0;
        var newDecimals = parseInt($original.attr("data-decimals")) || 0;
        var newDigitGrouping = !($original.attr("data-digit-grouping") === "false");

        if (decimals !== newDecimals || digitGrouping !== newDigitGrouping) {
          decimals = newDecimals;
          digitGrouping = newDigitGrouping;
          numberFormat = new Intl.NumberFormat(locale, {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals,
            useGrouping: digitGrouping
          });
        }
      }

      function parseLocaleNumber(stringNumber) {
        var numberFormat = new Intl.NumberFormat(locale);
        var thousandSeparator = numberFormat.format(1111).replace(/1/g, '');
        var decimalSeparator = numberFormat.format(1.1).replace(/1/g, '');
        return parseFloat(stringNumber.replace(new RegExp('\\' + thousandSeparator, 'g'), '').replace(new RegExp('\\' + decimalSeparator), '.'));
      }
    });
    return this;
  };

  function onPointerUp(element, callback) {
    element.addEventListener("mouseup", function (e) {
      callback(e);
    });
    element.addEventListener("touchend", function (e) {
      callback(e);
    });
    element.addEventListener("keyup", function (e) {
      if (e.keyCode === 32 || e.keyCode === 13) {
        triggerKeyPressed = false;
        callback(e);
      }
    });
  }

  function onPointerDown(element, callback) {
    element.addEventListener("mousedown", function (e) {
      e.preventDefault();
      callback(e);
    });
    element.addEventListener("touchstart", function (e) {
      if (e.cancelable) {
        e.preventDefault();
      }

      callback(e);
    });
    element.addEventListener("keydown", function (e) {
      if ((e.keyCode === 32 || e.keyCode === 13) && !triggerKeyPressed) {
        triggerKeyPressed = true;
        callback(e);
      }
    });
  }
})(jQuery);
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
  // Site title and description.
  wp.customize('blogname', function (value) {
    value.bind(function (to) {
      $('.site-title a').text(to);
    });
  });
  wp.customize('blogdescription', function (value) {
    value.bind(function (to) {
      $('.site-description').text(to);
    });
  }); // Header text color.

  wp.customize('header_textcolor', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.site-title a, .site-description').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.site-title a, .site-description').css({
          'clip': 'auto',
          'position': 'relative'
        });
        $('.site-title a, .site-description').css({
          'color': to
        });
      }
    });
  });
})(jQuery);
/*!

 =========================================================
 * PL-Bigbend V1
 =========================================================
 */
(function (factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    // CommonJS
    factory(require('jquery'));
  } else {
    // Browser globals
    factory(jQuery);
  }
})(function ($) {
  var CountTo = function (element, options) {
    this.$element = $(element);
    this.options = $.extend({}, CountTo.DEFAULTS, this.dataOptions(), options);
    this.init();
  };

  CountTo.DEFAULTS = {
    from: 0,
    // the number the element should start at
    to: 0,
    // the number the element should end at
    speed: 1000,
    // how long it should take to count between the target numbers
    refreshInterval: 25,
    // how often the element should be updated
    decimals: 0,
    // the number of decimal places to show
    formatter: formatter,
    // handler for formatting the value before rendering
    onUpdate: null,
    // callback method for every time the element is updated
    onComplete: null // callback method for when the element finishes updating

  };

  CountTo.prototype.init = function () {
    this.value = this.options.from;
    this.loops = Math.ceil(this.options.speed / this.options.refreshInterval);
    this.loopCount = 0;
    this.increment = (this.options.to - this.options.from) / this.loops;
  };

  CountTo.prototype.dataOptions = function () {
    var options = {
      from: this.$element.data('from'),
      to: this.$element.data('to'),
      speed: this.$element.data('speed'),
      refreshInterval: this.$element.data('refresh-interval'),
      decimals: this.$element.data('decimals')
    };
    var keys = Object.keys(options);

    for (var i in keys) {
      var key = keys[i];

      if (typeof options[key] === 'undefined') {
        delete options[key];
      }
    }

    return options;
  };

  CountTo.prototype.update = function () {
    this.value += this.increment;
    this.loopCount++;
    this.render();

    if (typeof this.options.onUpdate == 'function') {
      this.options.onUpdate.call(this.$element, this.value);
    }

    if (this.loopCount >= this.loops) {
      clearInterval(this.interval);
      this.value = this.options.to;

      if (typeof this.options.onComplete == 'function') {
        this.options.onComplete.call(this.$element, this.value);
      }
    }
  };

  CountTo.prototype.render = function () {
    var formattedValue = this.options.formatter.call(this.$element, this.value, this.options);
    this.$element.text(formattedValue);
  };

  CountTo.prototype.start = function () {
    this.stop();
    this.render();
    this.interval = setInterval(this.update.bind(this), this.options.refreshInterval);
  };

  CountTo.prototype.stop = function () {
    if (this.interval) {
      clearInterval(this.interval);
    }
  };

  function formatter(value, options) {
    return value.toFixed(options.decimals);
  }

  $.fn.countTo = function (option) {
    return this.each(function () {
      var $this = $(this);
      var data = $this.data('countTo');
      var init = !data || typeof option === 'object';
      var options = typeof option === 'object' ? option : {};
      var method = typeof option === 'string' ? option : 'start';

      if (init) {
        if (data) data.stop();
        $this.data('countTo', data = new CountTo(this, options));
      }

      data[method].call(data);
    });
  };
}); // custom formatting example


$('#millions').data('countToOptions', {
  formatter: function (value, options) {
    return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
  }
}); // start all the timers

$('.timer').each(count);

function count(options) {
  var $this = $(this);
  options = $.extend({}, options || {}, $this.data('countToOptions') || {});
  $this.countTo(options);
}

function debounce(func, wait, immediate) {
  var timeout;
  return function () {
    var context = this,
        args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      timeout = null;
      if (!immediate) func.apply(context, args);
    }, wait);
    if (immediate && !timeout) func.apply(context, args);
  };
}

; // Init AOS Animations

AOS.init(); // Init Headroom

var myElement = document.querySelector("#headroom");
var headroom = new Headroom(myElement);
headroom.init();
$(document).ready(function () {
  $("#search_button").click(function () {
    $("#search_popup").toggle(100);
  });
  $("#search_button_lg").click(function () {
    $("#search_popup_lg").toggle(100);
  });
  $("form").removeClass("mktoForm");
});